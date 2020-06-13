<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\AdminAuth;
use app\Models\Manager;
use app\Models\Log;

class AdminAuthController extends Controller {

    public function index() {
        $data = [];
        $viewPath = 'admin/';
        $viewName = "signin";

        $this->loadView($viewPath, $viewName, $data);
    }

    public function signin() {
        $form = json_decode(file_get_contents('php://input'), true);

        ($form['cpf']) ?? header("Location: " . BASE_URL . "/adminAuth");
        ($form['pass']) ?? header("Location: " . BASE_URL . "/adminAuth");

        $cpf = filter_var($form['cpf'], FILTER_SANITIZE_STRING);
        $pass = filter_var($form['pass'], FILTER_SANITIZE_STRING);

        $response = ['success' => false];

        if ($cpf && $pass) {
            $manager = new Manager();
            $adminAuth = new AdminAuth();
            $log = new Log();

            $manager->setCpf($cpf);
            $manager->setPass($pass);

            $response['success'] = $adminAuth->validateAuth($manager);

            if ($response["success"] === true):
                $_SESSION['manager'] = [];
                $_SESSION['manager']['token'] = $adminAuth->getManageToken();
                $_SESSION['manager']['manager_id'] = $adminAuth->getManageManagerId();

                $log->firstAccess(array("manager_id" => $_SESSION['manager']['manager_id']));
                $_SESSION['manager']['log_id'] = $log->getId();
            endif;
        }

        echo json_encode($response);
    }

    public static function isLogged() : bool {

        if (isset($_SESSION['manager']['token']) && !empty($_SESSION['manager']['token'])):
            return true;
        else:
            return false;
        endif;
    }

    public static function getManagerId() : int {
        
        return ($_SESSION['manager']['manager_id']) ?? 0;
    }

    public static function getManagerLogId() : int {
        
        return ($_SESSION['manager']['log_id']) ?? 0;
    }

    public function signout() {
        $log = new Log();
        
        if (!empty(self::getManagerLogId())) :
            $log->lastAccess(self::getManagerLogId(), array("manager_id" => self::getManagerId()));
        endif;

        unset($_SESSION['manager']);
        header("Location:" . BASE_URL . "/adminAuth");
        exit;
    }
}