<?php

$nombre     = $_POST['contacto_nombre'];
$email      = $_POST['contacto_email'];
$telefono   = $_POST['contacto_telefono'];
$comentario = $_POST['contacto_mensaje'];

$para = $_Correos;

$return['success'] = FALSE;

try {
    $SendMail = new SendMail();
    if ($SendMail->sendContactMail($para, $nombre, $email, $telefono, $comentario)) {
        $return['message'] = "Tu información ha sido enviada! , Gracias";
        $return['success'] = TRUE;
    } else {
        throw new Exception("Error Processing Request", 1);
    }
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
?>