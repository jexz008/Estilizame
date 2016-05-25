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
    
    if(isset($_POST['perfil_especialidad'])){
        $especialidades = $_POST['perfil_especialidad'][$categoriaId];
        $Empresa->updatetEmpresaEspecialidades($empresaId, $especialidades);
    }elseif(isset($_POST['perfil_empresa'])){
        if(!empty($_POST['perfil_empresa'])){
            $Empresa->updateEmpresa($empresaId, 'nombre', $_POST['perfil_empresa']);
        }else{
            throw new Exception("El dato no debe estar vacío");
        }
    }elseif(isset($_POST['perfil_categoria'])){
        if(!empty($_POST['perfil_categoria'])){
            $Empresa->updateEmpresa($empresaId, 'categoria_id_fk', $_POST['perfil_categoria']);
        }else{
            throw new Exception("El dato no debe estar vacío");
        }
    }elseif(isset($_POST['perfil_descripcion'])){
        if(!empty($_POST['perfil_descripcion'])){
            $Empresa->updateEmpresa($empresaId, 'descripcion', $_POST['perfil_descripcion']);
        }else{
            throw new Exception("El dato no debe estar vacío");
        }
    }elseif(isset($_POST['registro_estado_nombre'])){
        if(!empty($_POST['registro_estado_nombre'])){
            $Empresa->updateEmpresa($empresaId, 'estado', $_POST['registro_estado_nombre']);
        }else{
            throw new Exception("El dato no debe estar vacío");
        }
    }else{
            throw new Exception("Acción no encontrada al intentar actualizar.");        
    }
    #$Empresa->updateEmpresa($_POST, $_FILES);
    $return['message'] = "Tu información ha sido enviada! , Gracias";
    $return['success'] = TRUE;
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
