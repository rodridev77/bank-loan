<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\AdminAuth;
use app\Models\Manager;

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

        $data = ['success' => false];

        if ($cpf && $pass) {
            $manager = new Manager();
            $adminAuth = new AdminAuth();

            $manager->setCpf($cpf);
            $manager->setPass($pass);

            $data['success'] = $adminAuth->validateAuth($manager);
        }

        echo json_encode($data);
    }

    public function logout() {
        unset($_SESSION['user_token']);
        header("Location:" . BASE_URL . "auth");
        exit;
    }
}