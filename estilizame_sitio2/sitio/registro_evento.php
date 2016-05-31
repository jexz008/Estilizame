<?php
session_start();

$empresaId      = $_REQUEST['empresaId'];

$nombre         = $_POST['evento_nombre'];
$descripcion    = $_POST['evento_descripcion'];
$fechaInicio    =  date('Y-m-d', strtotime($_POST['evento_fecha_ini']));
$horaInicio     = $_POST['evento_hora_ini'];
$fechaFin       =  date('Y-m-d', strtotime($_POST['evento_fecha_fin']));
$horaFin        = $_POST['evento_hora_fin'];
$tipoEventoId   = $_POST['evento_tipo_evento'];
$estado         = $_POST['evento_estado'];
$municipio      = $_POST['evento_municipio'];
$direccion      = $_POST['evento_direccion'];

$imagen         = $_FILES['evento_imagen'];
$usuarioId      = 1;


try {
    $Evento = new Evento();
    $Empresa = new Empresa();
    $eventoId = $Evento->setEvento($nombre, $descripcion, $fechaInicio, $horaInicio, $fechaFin, $horaFin, $estado, $municipio, $direccion, $imagen, $tipoEventoId, $empresaId, $usuarioId);

    if($eventoId){
        $imgName = "evento-" . str_pad($eventoId, 10, "0", STR_PAD_LEFT); // promocion-000000000X
        if($Empresa->uploadImgEvento($imagen, $empresaId, $imgName)){
            $return['eventoId'] = $eventoId;
            $return['message'] = "Evento registrado correctamente!";
            $return['success'] = TRUE;
        }else{
            throw new Exception ("Error al intentar guardar la imagen en el servidor.");
        }
    }else{
        throw new Exception ("Error al intentar registrar el evento.");
    }
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);