<?php declare(strict_types=1);

namespace app\Controllers;

use app\Core\Controller;
use app\Models\ClientDAO;
use app\Models\Client;
use app\Models\Address;

class ClientController extends Controller {
    
    public function __construct() {
        if (!AuthController::isLogged()):
            header("Location: " . BASE_URL . "/auth");
        endif;
    }
    
    public function index() {
        $viewPath = 'client/';
        $viewName = "home";
        
        $data = [];
        
        $this->loadView($viewPath, $viewName, $data);
    }

    public function perfil()  {
        $clientDao = new ClientDAO();
        $viewPath = 'client/';
        $viewName = "perfil";
        $data = [];

        $data['client'] = $clientDao->getClient(AuthController::getClientId());

        $this->loadTemplate($viewPath, $viewName, $data);
    }

    public function signupFull() {
        $clientDAO = new ClientDAO();

        /**if (self::isLogged() && $clientDAO->isActived(self::getClientId())):
            header("Location: " . BASE_URL . "/home");
        endif;*/
        
        $response["success"] = false;
        $form = json_decode(file_get_contents('php://input'), true);

        in_array(null, $form, true) ? header("Location: " . BASE_URL . "/auth") : $form = filter_var_array($form, FILTER_SANITIZE_STRING);
        extract($form);
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        $addressId = filter_var($address_id, FILTER_VALIDATE_INT);

        if ($name && $surname && $phone && $email && $cpf && $ordenado
            && $zipcode && $address && $number && $district && $city && $state) {
            $client = new Client();
            $clientAddress = new Address();

            $client->setId(AuthController::getClientId());
            $client->setName($name);
            $client->setSurname($surname);
            $client->setPhone($phone);
            $client->setEmail($email);
            $client->setCpf($cpf);
            $client->setOrdenado(floatval($ordenado));

            $clientAddress->setZipcode($zipcode);
            $clientAddress->setStreet($address);
            $clientAddress->setNumber($number);
            $clientAddress->setOptional($optional);
            $clientAddress->setDistrict($district);
            $clientAddress->setCity($city);
            $clientAddress->setState($state);
            $clientAddress->setClientId($addressId);

            $client->setAddress($clientAddress);

            $response["success"] = $clientDAO->update($client);
        }
        
        echo json_encode($response);
    }

}?>