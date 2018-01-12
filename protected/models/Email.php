<?php

class EmaiL
{
    public static function SendEmail($email, $header, $text)
    {
    	include_once($_SERVER['DOCUMENT_ROOT'] . '/protected/extensions/class.phpmailer.php');
    	$mail = new PHPMailer();

		$mail->CharSet = "UTF-8";

		$mail->From =  "no-reply@teleport-mfo.ru";
		$mail->FromName = 'no-reply';

		$mail->addAddress($email, '');
		$mail->addReplyTo("no-reply@teleport-mfo.ru", '');

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->isHTML(true);   									// Set email format to HTML

		$mail->isSMTP();      
		$mail->SMTPSecure = "ssl";
		$mail->Port = "465";
		$mail->Host = "smtp.yandex.ru";      
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Username   = "no-reply@teleport-mfo.ru"; // SMTP account username
		$mail->Password   = "teleport555";        // SMTP account password
                   

		$mail->Subject = $header;
		$mail->Body    = $text;
		$sent = $mail->send();

		return $mail;
    }
}
