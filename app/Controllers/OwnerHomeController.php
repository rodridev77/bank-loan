<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\ManagerDAO;
use app\Models\Manager;
use app\Models\Address;

class OwnerHomeController extends Controller {
    private $data = [];

    public function __construct() {
        
        if (!OwnerAuthController::isLogged()) {
            header("Location: ".BASE_URL."/ownerauth");
        }
    }

    public function index() {
        $viewPath = "manager/";
        $viewName = "home";

        $managerDAO = new ManagerDAO();

        $this->data['managers'] = $managerDAO->getAllManagers();
        
        $this->loadAdminTemplate($viewPath, $viewName, $this->data);
    }
}