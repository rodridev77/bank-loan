<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\OwnerAuth;
use app\Models\Owner;
use app\Controllers\LogController;

class OwnerAuthController extends Controller {

    public function index() {
        $data = [];
        $viewPath = 'owner/';
        $viewName = "signin";

        $this->loadView($viewPath, $viewName, $data);
    }

    public function signin() {
        $form = json_decode(file_get_contents('php://input'), true);

        ($form['cpf']) ?? header("Location: " . BASE_URL . "/ownerauth");
        ($form['pass']) ?? header("Location: " . BASE_URL . "/ownerauth");
        ($form['key']) ?? header("Location: " . BASE_URL . "/ownerauth");

        $cpf = filter_var($form['cpf'], FILTER_SANITIZE_STRING);
        $pass = filter_var($form['pass'], FILTER_SANITIZE_STRING);
        $key = filter_var($form['key'], FILTER_VALIDATE_INT);

        $response = ['success' => false];

        if ($cpf && $pass && $key) {
            $owner = new Owner();
            $ownerAuth = new OwnerAuth();

            $owner->setCpf($cpf);
            $owner->setPass($pass);
            $owner->setSecretKey($key);

            $response['success'] = $ownerAuth->validateAuth($owner);

            if ($response["success"] === true):
                $_SESSION['owner'] = [];
                $_SESSION['owner']['token'] = $ownerAuth->getToken();
                //'LogController::firstAccess(null,$adminAuth->getManageBankId());
            endif;
        }

        echo json_encode($response);
    }

    public static function isLogged() : bool {

        if (isset($_SESSION['owner']['token']) && !empty($_SESSION['owner']['token'])):
            return true;
        else:
            return false;
        endif;
    }

    public function signout() {
        //Logcontroller::lastAccess();
        unset($_SESSION['owner']);
        header("Location:" . BASE_URL . "/ownerauth");
        exit;
    }
}