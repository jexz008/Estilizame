<?php

$nombre     = $_POST['contacto_nombre'];
$email      = $_POST['contacto_email'];
$telefono   = $_POST['contacto_telefono'];
$comentario = $_POST['contacto_mensaje'];

$mensaje="Datos Contacto Estilizame"."<br>";

$mensaje.="Nombre: ".$nombre."<br>";
$mensaje.="Email: ".$email."<br>";
$mensaje.="Telefono: ".$telefono."<br>";
$mensaje.="Mensaje: ".$comentario."<br>";


$para = $_Correos;
$ausnto ="Contacto de Estilizame";

$return['success'] = FALSE;

try{
  new sendmail($email, $para, $asunto, $mensaje);
  $return['message'] = "Tu información ha sido enviada! , Gracias";
  $return['success'] = TRUE;
}catch(Exception $e){
  $return['message'] = 'Excepción capturada: '.  $e->getMessage(). "\n";
}

echo json_encode($return);


?>