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

    $attrsPerfil = array(
        array('post' => 'perfil_empresa', 'field' => 'nombre'),
        array('post' => 'perfil_categoria', 'field' => 'categoria_id_fk'),
        array('post' => 'perfil_descripcion', 'field' => 'descripcion'),
        array('post' => 'registro_estado_nombre', 'field' => 'estado'),
        array('post' => 'registro_municipio_nombre', 'field' => 'municipio'),
        array('post' => 'perfil_direccion', 'field' => 'direccion'),
        array('post' => 'perfil_telefono', 'field' => 'telefono'),
        array('post' => 'perfil_email', 'field' => 'email'),
        array('post' => 'perfil_contrasena', 'field' => 'contrasena'),
        array('post' => 'perfil_ubicacion', 'field' => 'ubicacion_html'),
        array('post' => 'perfil_video', 'field' => 'video'),
        array('post' => 'perfil_facebook', 'field' => 'facebook'),
        array('post' => 'perfil_twitter', 'field' => 'twitter'),
        array('post' => 'perfil_google', 'field' => 'googleplus'),
        array('post' => 'perfil_instagram', 'field' => 'instagram'),
        array('post' => 'perfil_empresa', 'field' => 'nombre'),
        array('post' => 'perfil_empresa', 'field' => 'nombre'),
    );

    if(isset($_POST['perfil_especialidad'])){
        $especialidades = $_POST['perfil_especialidad'][$categoriaId];
        $Empresa->updatetEmpresaEspecialidades($empresaId, $especialidades);
    }else{
        $issetField = FALSE;
        foreach ($attrsPerfil as $key => $value) {
            $fieldPostName    = $value['post'];
            $fieldPostValue   = $_POST[$fieldPostName];
            $fieldDBName      = $value['field'];
            
            if(isset($_POST[$value['post']])){

                if(!empty($_POST['perfil_empresa'])){
                    $Empresa->updateEmpresa($empresaId, $fieldDBName, $fieldPostValue);
                }  else {
                    throw new Exception("El dato no debe estar vacío");
                }
                $issetField = TRUE;
                break;
            }
        }
        if(!$issetField){
            throw new Exception("Acción no encontrada al intentar actualizar.");
        }
    }

    /*elseif(isset($_POST['perfil_empresa'])){
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
    }*/
    #$Empresa->updateEmpresa($_POST, $_FILES);
    $return['field'] = $fieldPostName;
    $return['value'] = $fieldPostValue;
    $return['message'] = "Tu información ha sido actualizada correctamente!";
    $return['success'] = TRUE;
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
