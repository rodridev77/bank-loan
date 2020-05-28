<?php declare(strict_types=1);

namespace app\Controllers;

use app\Core\Controller;
use app\Models\Address;
use app\Models\ClientDAO;
use app\Models\Client;
use app\Models\Auth;
use app\PHP_Mailer\PHPMail;
use PHPMailer\PHPMailer\Exception;

class AuthController extends Controller {
    
    public function __construct() {
       
    }
    
    public function index() {
        if (self::isLogged()):
            header("Location: " . BASE_URL . "/home");
        endif;

        $viewPath = 'login/';
        $viewName = "index";
        
        $data = [];
        
        $this->loadView($viewPath, $viewName, $data);
    }

    public function signin() {
        if (self::isLogged()):
            header("Location: " . BASE_URL . "/home");
        endif;

        $form = json_decode(file_get_contents('php://input'), true);
        
        ($form['cpf']) ?? header("Location: " . BASE_URL . "/auth");
        ($form['pass']) ?? header("Location: " . BASE_URL . "/auth");
        
        $cpf = filter_var($form['cpf'], FILTER_SANITIZE_STRING);
        $pass = filter_var($form['pass'], FILTER_SANITIZE_STRING);

        $response["success"] = false;

        if ($cpf && $pass) {
            $client = new Client();
            $auth = new Auth();

            $client->setCpf($cpf);
            $client->setPass($pass);
            $response["success"] = $auth->validateAuth($client);

            if ($response["success"] === true):
                $_SESSION['client'] = [];
                $_SESSION['client']['token'] = $auth->getToken();
                $_SESSION['client']['id'] = $auth->getId();
            endif;
        }
        
        echo json_encode($response);
    }

    public function signup() {

        if (self::isLogged()):
            header("Location: " . BASE_URL . "/home");
        endif;

        $response["success"] = false;
        $form = json_decode(file_get_contents('php://input'), true);
        
        $_cpf = ($form['cpf']) ?? header("Location: " . BASE_URL . "/auth");
        $_email = ($form['email']) ?? header("Location: " . BASE_URL . "/auth");
        $_pass = ($form['pass']) ?? header("Location: " . BASE_URL . "/auth");
        
        $cpf = filter_var($_cpf, FILTER_SANITIZE_STRING);
        $email = filter_var($_email, FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_pass, FILTER_SANITIZE_STRING);

        if ($cpf && $email && $pass) {
            $clientDAO = new ClientDAO();
            $client = new Client();

            $client->setCpf($cpf);
            $client->setEmail($email);
            $client->setPass($pass);

            $response["success"] = $clientDAO->insert($client);
        }
        
        echo json_encode($response);
    }
    
    public static function isLogged() : bool {

        if (isset($_SESSION['client']['token']) && !empty($_SESSION['client']['token'])):
            return true;
        else:
            return false;
        endif;
    }

    public static function getClientId() : int {
        
        return ($_SESSION['client']['id']) ?? 0;
    }

    public function signout() {
        unset($_SESSION['client']);
        header("Location:" . BASE_URL . "/auth");
        exit;
    }

}


?>