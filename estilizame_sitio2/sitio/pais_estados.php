<?php

$estado = $_REQUEST['estado'];
$action = $_REQUEST['action'];

$return['success'] = FALSE;

try {
    if($action == 'getMunicipios'){
        if ($selectMunicipios = PaisEstados::selectMunicipios($estado)) {
            $return['html'] = $selectMunicipios;
            $return['message'] = "Consuta de municipios correcta";
            $return['success'] = TRUE;
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }elseif($action == 'getEstados'){
        if ($selectEstados = PaisEstados::selectEstados('perfil_estado', strtoupper(elimina_acentos($estado)))) {
            $return['html'] = $selectEstados;
            $return['message'] = "Consuta de estados correcta";
            $return['success'] = TRUE;
        } else {
            throw new Exception("Error Processing Request", 1);
        }        
    }
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
?>