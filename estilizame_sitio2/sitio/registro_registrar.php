<?php
try{
	$Empresa = new Empresa();
//$return['post'] = $_POST;

	/*if( $Empresa->registraEmpresa($_POST,$_FILES) ){
    $return['message'] = "Tu información ha sido enviada! , Gracias";
    $return['success'] = TRUE;
  }else{ 
    throw new Exception("Error Processing Request", 1); 
  }*/
    $Empresa->registraEmpresa($_POST,$_FILES);
    $return['message'] = "Tu información ha sido enviada! , Gracias";
    $return['success'] = TRUE;
	
}catch(Exception $e){
    $return['message'] = 'Excepción capturada: '.  $e->getMessage(). "\n";
}
echo json_encode($return);  



