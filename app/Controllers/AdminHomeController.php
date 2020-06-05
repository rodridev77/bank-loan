<?php

namespace app\Controllers;

use app\Core\Controller;

class AdminHomeController extends Controller {
    private $data = [];

    public function __construct() {
        
        if (!AdminAuthController::isLogged()) {
            header("Location: ".BASE_URL."/adminAuth");
        }
    }

    public function index() {
        $viewPath = 'admin/';
        $viewName = "home";

        $this->data['loans'] = "Lista de Contratos";
        
        $this->loadAdminTemplate($viewPath, $viewName, $this->data);
    }
}