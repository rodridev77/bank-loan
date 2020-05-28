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

	public function sendEmail($email,$subject,$body)
	{
		try {
			//Configuração remetente destinatario

			$this->mail->setFrom(MAIL['Username']);
			$this->mail->addAddress($email);

			//Configuração da mensagem
			$this->mail->isHTML(true);
			$this->mail->Subject = $subject;
			$this->mail->Body    = $body;

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