<?php declare(strict_types=1);

namespace app\Controllers;

use app\Core\Controller;
use app\Models\ManagerDAO;
use app\Models\Manager;
use app\Models\Address;

class ManagerController extends Controller {
    
    public function __construct() {
        if (!OwnerAuthController::isLogged()):
            header("Location: " . BASE_URL . "/ownerauth");
        endif;
    }
    
    public function index() {
        $viewPath = 'manager/';
        $viewName = "home";

        $managerDAO = new ManagerDAO();
        
        $this->data['managers'] = $managerDAO->getAllManagers();
        
        $this->loadView($viewPath, $viewName, $this->data);
    }

    public function signupFull() {
        $clientDAO = new ManagerDAO();

        /**if (self::isLogged() && $clientDAO->isActived(self::getClientId())):
            header("Location: " . BASE_URL . "/home");
        endif;*/
        
        $response["success"] = false;
        $form = json_decode(file_get_contents('php://input'), true);
            
        in_array(null, $form, true) ? header("Location: " . BASE_URL . "/ownerauth") : $form = filter_var_array($form, FILTER_SANITIZE_STRING);
        extract($form);
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        $addressId = filter_var($address_id, FILTER_VALIDATE_INT);
        
        if ($name && $surname && $phone && $email && $cpf && $ordenado
            && $zipcode && $address && $number && $district && $city && $state) {
            $manager = new Manager();
            $managerAddress = new Address();

           // $manager->setId(AuthController::getClientId());
            $manager->setName($name);
            $manager->setSurname($surname);
            $manager->setPhone($phone);
            $manager->setEmail($email);
            $manager->setCpf($cpf);

            $managerAddress->setZipcode($zipcode);
            $managerAddress->setStreet($address);
            $managerAddress->setNumber($number);
            $managerAddress->setOptional($optional);
            $managerAddress->setDistrict($district);
            $managerAddress->setCity($city);
            $managerAddress->setState($state);
            $managerAddress->setClientId($addressId);

            $manager->setAddress($managerAddress);

            $response["success"] = $managerDAO->update($manager);
        }
        
        echo json_encode($response);
    }

}?>
