<?php
require "../load.php";

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$idusuario = $_POST['idusuario'];
$token = $_POST['token'];

$respuesta = new stdClass();

if ($password1 != "" && $password2 != "" && $idusuario != "" && $token != "") {

    $Login = Login::getTokenData($token);

    if ($Login) {
        if (sha1($Login['idusuario'] === $idusuario)) {
            if ($password1 === $password2) {

                $Usuario = new Usuario();
                $updateUsuario = $Usuario->updateUsuario($Login['idusuario'], NULL, $password1);

                if ($updateUsuario) {

                    Login::deleteToken($Login['idusuario']);
                    $respuesta->mensaje = '<div class="alert-success">La contraseña se actualizó con exito.</div>';

                } else {
                    $respuesta->mensaje = '<div class="alert-warning"> Ocurrió un error al actualizar la contraseña, intentalo más tarde</div>';
                }
            } else {
                $respuesta->mensaje = '<div class="alert-warning"> Las contraseñas no coinciden</div>';
            }
        } else {
            $respuesta->mensaje = '<div class="alert-warning">El token no es válido</div>';
        }
    } else {
        $respuesta->mensaje = '<div class="alert-warning"><p class="alert alert-danger"> El token no es válido</div>';
    }
} else {
    header('Location:index.html');
}
echo json_encode($respuesta);
