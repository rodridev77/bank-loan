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
        
        /**
        $_name = ($form['name']) ?? header("Location: " . BASE_URL . "/auth");
        $_surname = ($form['surname']) ?? header("Location: " . BASE_URL . "/auth");
        $_phone = ($form['phone']) ?? header("Location: " . BASE_URL . "/auth");
        $_email = ($form['email']) ?? header("Location: " . BASE_URL . "/auth");
        $_cpf = ($form['cpf']) ?? header("Location: " . BASE_URL . "/auth");
        $_ordenado = ($form['ordenado']) ?? header("Location: " . BASE_URL . "/auth");

        $_zipcode = ($form['zipcode']) ?? header("Location: " . BASE_URL . "/auth");
        $_address = ($form['address']) ?? header("Location: " . BASE_URL . "/auth");
        $_number = ($form['number']) ?? header("Location: " . BASE_URL . "/auth");
        $_district = ($form['district']) ?? header("Location: " . BASE_URL . "/auth");
        $_city = ($form['city']) ?? header("Location: " . BASE_URL . "/auth");
        $_state = ($form['state']) ?? header("Location: " . BASE_URL . "/auth");
        $_address_id = ($form['address_id']) ?? header("Location: " . BASE_URL . "/auth");

        $name = filter_var($_name, FILTER_SANITIZE_STRING);
        $surname = filter_var($_surname, FILTER_SANITIZE_STRING);
        $phone = filter_var($_phone, FILTER_SANITIZE_STRING);
        $email = filter_var($_email, FILTER_VALIDATE_EMAIL);
        $cpf = filter_var($_cpf, FILTER_SANITIZE_STRING);
        $ordenado = filter_var($_ordenado, FILTER_SANITIZE_STRING);

        $zipcode = filter_var($_zipcode, FILTER_SANITIZE_STRING);
        $address = filter_var($_address, FILTER_SANITIZE_STRING);
        $number = filter_var($_number, FILTER_SANITIZE_STRING);
        $optional = filter_var($form['optional']);
        $district = filter_var($_district, FILTER_SANITIZE_STRING);
        $city = filter_var($_city, FILTER_SANITIZE_STRING);
        $state = filter_var($_state, FILTER_SANITIZE_STRING);
        $address_id = filter_var($_address_id, FILTER_VALIDATE_INT);
        */

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