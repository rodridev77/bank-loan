<?php

namespace app\PHP_Mailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use app\Models\Client;

class PHPMail
{
	private $mail;

	public function __construct()
	{
		//Configuração de servidor SMTP GOOGLE
		$this->mail = new PHPMailer(true);
		$this->mail->CharSet = "UTF-8";
		$this->mail->isSMTP();
		$this->mail->Host = MAIL['Host'];
		$this->mail->SMTPAuth = true;
		$this->mail->SMTPSecure = MAIL['SMTPSecure'];
		$this->mail->Username = MAIL['Username'];
		$this->mail->Password = MAIL['Password'];
		$this->mail->Port = MAIL['Port'];
	}

	public function sendEmail($token,Client $client)
	{
		try {
			//Configuração remetente destinatario

			$this->mail->setFrom(MAIL['Username']);
			$this->mail->addAddress($client->getEmail());

			//Configuração da mensagem
			$link = BASE_URL . "/auth/changePassForm/?token=".$token;
			$this->mail->isHTML(true);
			$name = $client->getName();
			$this->mail->Subject = 'Alteração de Senha Bank-Loan';
			$this->mail->Body    = "$name acesse o link para alteração de senha : $link";
			$this->mail->AltBody = "acesse o link para alteração de senha : $link";
			if ($this->mail->send()) {
				return true;
			}

			return false;
		} catch (Exception $e) {
			echo $this->mail->ErrorInfo;
		}
	}
}

 ?>