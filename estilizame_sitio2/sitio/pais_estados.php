<?php

$estado = $_POST['estado'];

$return['success'] = FALSE;

try{
	if($selectMunicipios = PaisEstados::selectMunicipios($estado)){
		$return['html'] = $selectMunicipios;
	  	$return['message'] = "Consuta de municipios correcta";
	  	$return['success'] = TRUE;
  	}else{
  		throw new Exception("Error Processing Request", 1);
  	}
}catch(Exception $e){
  	$return['message'] = 'Excepción capturada: '.  $e->getMessage(). "\n";
}
echo json_encode($return);




?>