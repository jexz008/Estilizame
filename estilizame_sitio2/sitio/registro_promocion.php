<?php
session_start();

$empresaId      = $_REQUEST['empresaId'];
$nombre         = $_POST['promocion_nombre'];
$imagen         = $_FILES['promocion_imagen'];
$descripcion    = $_POST['promocion_descripcion'];
$fechaFin       = date('Y-m-d', strtotime($_POST['promocion_fecha_fin']));
$usuarioId      = 1;


try {
    $Empresa = new Empresa();
    $promocionId = $Empresa->setPromocion($nombre, NULL, $descripcion, $fechaFin, $empresaId, $usuarioId);
    if($promocionId){
        $imgName = "promocion-" . str_pad($promocionId, 10, "0", STR_PAD_LEFT); // promocion-0000X
        if($Empresa->uploadImgPromocion($imagen, $empresaId, $imgName)){
            $return['promocionId'] = $promocionId;
            $return['message'] = "Promoción registrada correctamente!";
            $return['success'] = TRUE;
        }else{
            throw new Exception ("Error al intentar guardar la imagen en el servidor.");
        }
    }else{
        throw new Exception ("Error al intentar registrar la promoción.");        
    }
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
