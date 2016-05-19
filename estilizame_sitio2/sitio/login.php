<?php

$username = (empty($_POST['login_mail'])) ? false : trim($_POST['login_mail']);
$password = (empty($_POST['login_password'])) ? false : trim($_POST['login_password']);

$return['success'] = FALSE;
try {
    $SendMail = new SendMail();
    if ( Login::signIn($username, $password) ) {
        $return['message'] = "Iniciando sesión!, Bienvenido";
        $return['success'] = TRUE;
        $return['target'] = TARGET;
    } else {
        throw new Exception("Usuario o contraseña no válidos");
    }
} catch (Exception $e) {
    $return['message'] = $e->getMessage() . "\n";
}
echo json_encode($return);
?>