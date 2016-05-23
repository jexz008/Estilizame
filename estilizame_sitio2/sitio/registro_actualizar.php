<?php

try {
    $Empresa = new Empresa();
//$return['post'] = $_POST;

    /* if( $Empresa->registraEmpresa($_POST,$_FILES) ){
      $return['message'] = "Tu información ha sido enviada! , Gracias";
      $return['success'] = TRUE;
      }else{
      throw new Exception("Error Processing Request", 1);
      } */
    $empresaId = $_REQUEST['empresaId'];
    $categoriaId = $_REQUEST['categoriaId'];
    $especialidades = $_POST['perfil_especialidad'][$categoriaId];
    #var_dump($especialidades);
    $Empresa->updatetEmpresaEspecialidades($empresaId, $especialidades);
    #$Empresa->updateEmpresa($_POST, $_FILES);
    $return['message'] = "Tu información ha sido enviada! , Gracias";
    $return['success'] = TRUE;
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
