<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');
//date_default_timezone_set('America/Mexico_City');
//require 'PHPMailer/PHPMailerAutoload.php';

class SendMailer{

	//var to object Mail
	private $mail;

	/*
	*	$debug
	*	default 0
	*	0 = off (for production use)
	*   1 = client messages
	*	2 = client and server messages
	*/
	function __construct($debug = 2){
            global $_Smtp;           $debug = 2;

		//is create object
		$this->mail = new PHPMailer;
                //$this->mail->Mailer = "smtp";
                
		//Tell PHPMailer to use SMTP
		$this->mail->isSMTP();
		//Codificacion;
		$this->mail->CharSet = "UTF-8";
		//Enable SMTP debugging
		$this->mail->SMTPDebug = $debug;
		//Ask for HTML-friendly debug output
		$this->mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$this->mail->Host = 'mail.estilizame.com';//$_Smtp['server']; // 'smtp.gmail.com';
		// use $this->mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$this->mail->Port = '465';//$_Smtp['port']; //587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$this->mail->SMTPSecure = 'tls';//'tls';
		//Whether to use SMTP authentication
		$this->mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$this->mail->Username = 'estilizame@estilizame.com';//$_Smtp['user']; //"ortegafull87@gmail.com";
		//Password to use for SMTP authentication
		$this->mail->Password = 'estilizame2016*';//$_Smtp['pass']; //"_Victor123_";
	}

	function setFrom($email="admin@estilizame.com",$nameEmail=""){
		//Set who the message is to be sent from
		$this->mail->setFrom($email, $nameEmail);echo $email;
	}

	function replayTo($email="admin@estilizame.com",$nameEmail=""){
		//Set an alternative reply-to address
		$this->mail->addReplyTo($email, $nameEmail);

	}

	function setTo($emailTo,$nameTo){
            global $_Pruebas, $_Correos;
            $emailTo = ($_Pruebas) ? $_Correos['pruebas'] : $emailTo;
            //Set who the message is to be sent to
		$this->mail->addAddress($emailTo,$nameTo);
	}
	function subject($str){
		//Set the subject line
		$this->mail->Subject = $str;
	}

	function setMainTitle($str){
		//Replace the plain text body with one created manually
		$this->mail->AltBody = $str;
	}

	function msgText($str){
		$this->mail->Body = $str;
	}

	function msgHTML($embebed){
		$this->mail->msgHTML($embebed);
	}

	function msgHTMLFromFile($URL){
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$this->mail->msgHTML(file_get_contents($URL), dirname(__FILE__));
	}

	function addAttachment($relativePath){
		//Attach an image file
		$this->mail->addAttachment($relativePath);
	}

	function send(){
		//send the message, check for errors
		if (!$this->mail->send()) {
    		echo "Mailer Error: " . $this->mail->ErrorInfo;
    		return false;
		} else {
    		return true;
		}
	}

}