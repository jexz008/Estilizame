<?php
try{
	$Empresa = new Empresa();
//$return['post'] = $_POST;

	if( $Empresa->setEmpresa() ){
    $return['message'] = "Tu información ha sido enviada! , Gracias";
    $return['success'] = TRUE;
  }else{ 
    throw new Exception("Error Processing Request", 1); 
  }
	
}catch(Exception $e){
    $return['message'] = 'Excepción capturada: '.  $e->getMessage(). "\n";
}
echo json_encode($return);  



