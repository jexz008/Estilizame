<?php

$action     = $_REQUEST['action'];
$estado     = isset($_REQUEST['estado']) ? $_REQUEST['estado'] : NULL;
$municipio  = isset($_REQUEST['municipio']) ? $_REQUEST['municipio'] : NULL;

$return['success'] = FALSE;

try {
    if($action == 'getEstados'){
        if ($selectEstados = PaisEstados::selectEstados('perfil_estado', strtoupper(elimina_acentos($estado)))) {
            $return['html'] = $selectEstados;
            $return['message'] = "Consuta de estados correcta";
            $return['success'] = TRUE;
        } else {
            throw new Exception("Error al intentar obtener estados.");
        }        
    }elseif($action == 'getMunicipios'){
        if(empty($estado)){
            throw new Exception("No se recibió el parametro estado.");            
        }
        if ($selectMunicipios = PaisEstados::selectMunicipios($estado, $municipio, 'perfil_estado')) {
            $return['html'] = $selectMunicipios;
            $return['message'] = "Consuta de municipios correcta";
            $return['success'] = TRUE;
        } else {
            throw new Exception("Error al intentar obtener municipios.");
        }
    }
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
?>