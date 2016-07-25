<?php

require "../load.php";

include_once 'RecuperaPass.php';

$email = $_POST['email'];

$respuesta = new stdClass();

if ($email != "") {
    $RecuperaPass = new RecuperaPass();
    //$Usuario = new Usuario();
    list($dataUser) = $RecuperaPass->Usuario->getUsuarioByEmail($email);
    
    if($dataUser){
        $linkTemporal = $RecuperaPass->generarLinkTemporal($dataUser['id'], $dataUser['email'], $Usuario);
        if ($linkTemporal) {
            if ($RecuperaPass->enviarEmail($email, $linkTemporal, $dataUser['email'])) {
                $respuesta->mensaje = '<div class="alert alert-success"> Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña </div>';
            }
        }
    } else {
        $respuesta->mensaje = '<div class="alert alert-warning"> No existe una cuenta asociada a ese correo. </div>';
    }
} else {
    $respuesta->mensaje = '<div class="alert alert-warning">Debes introducir el email de la cuenta</div>';
}
echo json_encode($respuesta);
