<?php declare(strict_types=1);

namespace app\Controllers;

use app\Core\Controller;
use app\Models\ClientDAO;
use app\Models\Client;
use app\Models\Auth;
use app\PHP_Mailer\PHPMail;

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

    public function signupFull() {
        $clientDAO = new ClientDAO();

        /**if (self::isLogged() && $clientDAO->isActived(self::getClientId())):
            header("Location: " . BASE_URL . "/home");
        endif;*/
        
        $response["success"] = false;
        $form = json_decode(file_get_contents('php://input'), true);
        
        $_name = ($form['name']) ?? header("Location: " . BASE_URL . "/auth");
        $_surname = ($form['surname']) ?? header("Location: " . BASE_URL . "/auth");
        $_cpf = ($form['cpf']) ?? header("Location: " . BASE_URL . "/auth");
        $_email = ($form['email']) ?? header("Location: " . BASE_URL . "/auth");
        $_ordenado = ($form['ordenado']) ?? header("Location: " . BASE_URL . "/auth");
        
        $name = filter_var($_name, FILTER_SANITIZE_STRING);
        $surname = filter_var($_surname, FILTER_SANITIZE_STRING);
        $cpf = filter_var($_cpf, FILTER_SANITIZE_STRING);
        $email = filter_var($_email, FILTER_SANITIZE_EMAIL);
        $ordenado = filter_var($_ordenado, FILTER_SANITIZE_STRING);

        if ($name && $surname && $cpf && $email && $ordenado) {
            $client = new Client();

            $client->setId(self::getClientId());
            $client->setName($name);
            $client->setSurname($surname);
            $client->setCpf($cpf);
            $client->setEmail($email);
            $client->setOrdenado(floatval($ordenado));

            $response["success"] = $clientDAO->update($client);
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

    public function recoverPass(){
    
        $form = json_decode(file_get_contents('php://input'), true);
        $cpf = filter_var($form['cpf'],FILTER_SANITIZE_STRING);
        $name = filter_var($form['name'],FILTER_SANITIZE_STRING);
        $email = filter_var($form['email'],FILTER_SANITIZE_STRING);
    
        $response['success'] = false;

        if ($cpf && $name && $email) {
            $client = new Client();
            $client->setCpf($cpf);
            $client->setName($name);
            $client->setEmail($email);
            $clientDAO = new ClientDAO();
            $mail = new PHPMail();
            $token = $clientDAO->getToken($client);
            if($token)
            {
                session_start();
                $_SESSION['token'] = $token['token'];
                if($mail->sendEmail($token['token'],$client))
                {
                    $response['success'] = true;
                }
            }
            
        }
        echo json_encode($response);
    }

    public function changePassForm(){
        $token = filter_input(INPUT_GET, "token",FILTER_SANITIZE_STRING);
        $data['token'] = $token;
        if ($token) {
            $this->loadView("login","/change_pass_form",$data);
        }else{
            header("Location:".BASE_URL);
        }
    }
}
?>