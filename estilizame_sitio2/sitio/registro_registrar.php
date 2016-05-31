<?php
session_start();

try {
    $Empresa = new Empresa();

    $Empresa->registraEmpresa($_POST, $_FILES);
    $return['message'] = "Tu información ha sido enviada! , Gracias";
    $return['success'] = TRUE;
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);



