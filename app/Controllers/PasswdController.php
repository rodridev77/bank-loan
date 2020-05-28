<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\Address;
use app\Models\ClientDAO;
use app\Models\Client;
use app\Models\Auth;
use app\PHP_Mailer\PHPMail;
use PHPMailer\PHPMailer\Exception;
/**
 * 
 */
class PasswdController extends Controller
{

	private $data = array('success' => false);

	//############## Change Old Pass ################
    private function genCode(){
        $code = "";
        for ($i=0;$i<=5;$i++){
            $code.=(string)mt_rand(0,9);
        }
        return $code;
    }

	public function getCodeEmail(){
	    $clientDAO = new ClientDAO();
	    $email = new PHPMail();
        $client = $clientDAO->getClient(AuthController::getClientId());
        $code = $this->genCode();
        $_SESSION['client']['code'] = $code;
        $subject = "Código para alteração de senha Bank loan";
        $body = "Código: ".$code;

        if ($email->sendEmail($client->getEmail(),$subject,$body)){
            $this->data['success'] = true;
        }
        echo json_encode($this->data);
	}

	public function changePassForm(){
		$clientDao = new ClientDAO();
        $viewPath = 'client/';
        $viewName = "change_pass_form";
        $data = [];
        $data['client'] = $clientDao->getClient(AuthController::getClientId());
		$this->loadTemplate($viewPath,$viewName,$data);
	}

	public function changeOldPass(){

        $newPass = json_decode(file_get_contents("php://input"), true);
        $code  = $newPass['code'];
        $oldPass = $newPass['oldPass'];

        $client = new ClientDAO();
        $clientObj = $client->getClient(AuthController::getClientId());

        $oldPassword = $client->getPassById($clientObj->getId());
        $clientObj->setPass($oldPass);
        $oldPassForm = $clientObj->getPass();

         
        if ($oldPassword['pass']===$oldPassForm && isset($_SESSION['client']["code"]) && $code === $_SESSION['client']["code"]) {
        	$clientObj->setPass($newPass['newPass']);
        	$this->passwordReset($clientObj);
        }else{
        	echo json_encode($this->data);
        }

    }
    //################################################

	//############## Forgotten Password ##############
    public function forgotPassForm(){
        $token = filter_input(INPUT_GET, "token",FILTER_SANITIZE_STRING);
        $this->data['token'] = $token;
        if ($token) {
            $this->loadView("login","/forgot_pass_form",$this->data);
        }else{
            header("Location:".BASE_URL);
        }
    }

    public function forgotPassEmail(){
    
        $form = json_decode(file_get_contents('php://input'), true);
        $form = filter_var_array($form,FILTER_SANITIZE_STRING);

        extract($form);

        if ($cpf && $name && $email) {
            $client = new Client();
            $client->setCpf($cpf);
            $client->setName($name);
            $client->setEmail($email);
            $clientDAO = new ClientDAO();
            $mail = new PHPMail();
            $id_token = $clientDAO->getIdToken($client);
            if($id_token)
            {
                $_SESSION['change_Pass']['id'] = $id_token['id'];
                $_SESSION['change_Pass']['token'] = $id_token['token'];

                $subject = "Alteração de Senha Bank-Loan";
                $body = "Link de alteração de senha ".BASE_URL."/passwd/forgotPassForm/?token=".$id_token['token'];

                if($mail->sendEmail($client->getEmail(),$subject,$body))
                {
                    $this->data['success'] = true;
                }
            }
            
        }
        echo json_encode($this->data);
    }

    public function changeForgottenPass(){
        $newPass = json_decode(file_get_contents("php://input"), true);
        $client = new ClientDAO();
        $clientObj = $client->getClient((int)$_SESSION['change_Pass']['id']);
        $clientObj->setPass($newPass['passwd']);
        $this->passwordReset($clientObj);
    }
    //################################################
    

    private function passwordReset(Client $clientObj){

        try {
        	$client = new ClientDAO();
            if ($client->updatePass($clientObj)) {
                $this->data['success'] = true;
                //session_destroy();
            }

            echo json_encode($this->data);

        } catch (\Exception $exception) {
            echo $exception;
        }
    }

}
