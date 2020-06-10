<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\Bank;
use app\Models\Address;
use app\Models\BankDAO;
use app\Models\AddressDAO;

class BankController extends Controller {
    private $data = [];

    public function __construct() {
        
        if (!AdminAuthController::isLogged()) {
            header("Location: ".BASE_URL."/adminAuth");
        }
    }

    public function index() {
        $viewPath = 'bank/';
        $viewName = "home_bank";

        $bankDAO = new BankDAO();

        //$this->data['banks'] = $bankDAO->getBank(adminAuthController::getManageBankId()) ?? new \stdClass;
        $this->data['banks'] = $bankDAO->getAllBanks();
        
        $this->loadAdminTemplate($viewPath, $viewName, $this->data);
    }

    public function insertPage() {
        $viewPath = 'bank/';
        $viewName = "insert_page";
        
        $this->loadAdminTemplate($viewPath, $viewName, $this->data);
    }

    public function updatePage($id) {
        $viewPath = 'bank/';
        $viewName = "update_page";

        $bankDAO = new BankDAO();
        $this->data['bank'] = $bankDAO->getBank($id);
        
        $this->loadAdminTemplate($viewPath, $viewName, $this->data);
    }

    public function insertBank() {
        $bankDAO = new BankDAO();
        $addressDAO = new AddressDAO();

        /**if (self::isLogged() && $clientDAO->isActived(self::getClientId())):
            header("Location: " . BASE_URL . "/home");
        endif;*/
        
        $response["success"] = false;
        $form = json_decode(file_get_contents('php://input'), true);
            
        in_array(null, $form, true) ? header("Location: " . BASE_URL . "/adminauth") : $form = filter_var_array($form, FILTER_SANITIZE_STRING);
        extract($form);
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        
        if ($name && $cnpj && $phone && $email && $zipcode && $address && $number && $district && $city && $state) {
            $bank = new Bank();
            $bankAddress = new Address();

            $bank->setName($name);
            $bank->setCnpj($cnpj);
            $bank->setPhone($phone);
            $bank->setEmail($email);

            $bankAddress->setZipcode($zipcode);
            $bankAddress->setStreet($address);
            $bankAddress->setNumber($number);
            $bankAddress->setOptional($optional);
            $bankAddress->setDistrict($district);
            $bankAddress->setCity($city);
            $bankAddress->setState($state);

            $bank->setAddress($bankAddress);

            if ($bankDAO->insert($bank)):
                $response["success"] = $addressDAO->insert($bankAddress, array("bank_id" => $bankDAO->getId()));
            endif; 
        }
        
        echo json_encode($response);
    }

    public function updateBank() {
        $bankDAO = new BankDAO();
        $addressDAO = new AddressDAO();

        /**if (self::isLogged() && $clientDAO->isActived(self::getClientId())):
            header("Location: " . BASE_URL . "/home");
        endif;*/
        
        $response["success"] = false;
        $form = json_decode(file_get_contents('php://input'), true);
            
        in_array(null, $form, true) ? header("Location: " . BASE_URL . "/adminauth") : $form = filter_var_array($form, FILTER_SANITIZE_STRING);
        extract($form);
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        
        if ($name && $cnpj && $phone && $email && $zipcode && $address && $number && $district && $city && $state && $id) {
            $bank = new Bank();
            $bankAddress = new Address();

            $bank->setName($name);
            $bank->setCnpj($cnpj);
            $bank->setPhone($phone);
            $bank->setEmail($email);
            $bank->setId($id);

            $bankAddress->setZipcode($zipcode);
            $bankAddress->setStreet($address);
            $bankAddress->setNumber($number);
            $bankAddress->setOptional($optional);
            $bankAddress->setDistrict($district);
            $bankAddress->setCity($city);
            $bankAddress->setState($state);

            $bank->setAddress($bankAddress);

            $response["success"] = $bankDAO->update($bank);
        }
        
        echo json_encode($response);
    }

    public function remove() {
        $response = ['success' => true];

        echo json_encode($response);
    }
}