<?php

class SendMail{

/////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	public function sendMailA($de, $para, $asunto, $mensaje){
		$mensaje="Datos Contacto Estilizame"."<br>";

		$mensaje.="Nombre: ".$nombre."<br>";
		$mensaje.="Email: ".$email."<br>";
		$mensaje.="Telefono: ".$telefono."<br>";
		$mensaje.="Mensaje: ".$comentario."<br>";

		//$para="contacto@estilizame.com";
		$titulo="Contacto de Estilizame";
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'From: '.$email. "\r\n" .
		    'Reply-To: '.$email. "\r\n" .
		    'X-Mailer: PHP/' . phpversion();

		return mail($para, $titulo, $mensaje, $cabeceras);

	}

	public function sendContactMail($para, $nombre, $email, $telefono, $comentario){
		$mensaje="Datos Contacto Estilizame"."<br>";

		$mensaje.="Nombre: ".$nombre."<br>";
		$mensaje.="Email: ".$email."<br>";
		$mensaje.="Telefono: ".$telefono."<br>";
		$mensaje.="Mensaje: ".$comentario."<br>";


		$para = $_Correos;
		$ausnto ="Contacto de Estilizame";

		if ($this->sendMailA($email, $para, $asunto, $mensaje)) {
			return TRUE;

		}else{
			throw new Exception("Error Processing Request", 1);
			return FALSE;
		}
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	
}//Fin class sendmail

?>
