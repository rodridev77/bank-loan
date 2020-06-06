<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\AdminAuth;
use app\Models\Manager;
use app\Controllers\LogController;

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

            $manager->setCpf($cpf);
            $manager->setPass($pass);

            $response['success'] = $adminAuth->validateAuth($manager);

            if ($response["success"] === true):
                $_SESSION['manager'] = [];
                $_SESSION['manager']['token'] = $adminAuth->getManageToken();
                $_SESSION['manager']['bank_id'] = $adminAuth->getManageBankId();
                LogController::firstAccess(null,$adminAuth->getManageBankId());
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

    public static function getManageBankId() : int {
        
        return ($_SESSION['manager']['bank_id']) ?? 0;
    }

    public function signout() {
        Logcontroller::lastAccess();
        unset($_SESSION['manager']);
        header("Location:" . BASE_URL . "/adminAuth");
        exit;
    }
}