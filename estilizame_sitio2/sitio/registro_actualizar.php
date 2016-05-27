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
//        array('post' => 'perfil_estado_nombre', 'field' => 'estado'),
        array('post' => 'perfil_municipio_nombre', 'field' => 'municipio'),
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
    );

    if(isset($_POST['perfil_especialidad'])){
        $especialidades = $_POST['perfil_especialidad'][$categoriaId];
        $Empresa->updatetEmpresaEspecialidades($empresaId, $especialidades);
    }elseif(isset($_POST['perfil_estado_nombre'])){
        if(!empty($_POST['perfil_estado_nombre'])){
            if(isset($_POST['perfil_municipio_nombre']) && !empty($_POST['perfil_municipio_nombre'])){
                $Empresa->updateEmpresa($empresaId, NULL, NULL, NULL, NULL, $estado, $municipio);
            }else{
                throw new Exception("Es requerido el campo municipio.");
            }
        }else{
            throw new Exception("El dato no debe estar vacío.");
        }
    }elseif(isset($_FILES['perfil_foto_perfil'])){
        if(!empty($_FILES['perfil_foto_perfil'])){
            $registro_foto_perfil   = "perfil-" . str_replace(" ", "", $_REQUEST['perfil_nombre_actual']);
            $Empresa->deleteImgPerfil($empresaId, $registro_foto_perfil);
            $Empresa->uploadImgPerfil($_FILES['registro_foto_perfil'], $empresaId, $registro_foto_perfil);
            $Empresa->updateFieldEmpresa($empresaId, 'foto_perfil', $registro_foto_perfil);
        }else{
            throw new Exception("El dato no debe estar vacío.");
        }
    }elseif(isset($_FILES['perfil_foto_cabecera'])){
        if(!empty($_FILES['perfil_foto_cabecera'])){
            $registro_foto_cabecera   = "cabecera-" . str_replace(" ", "", $_REQUEST['perfil_nombre_actual']);
            $Empresa->deleteImgCabecera($empresaId, $registro_foto_cabecera);
            $Empresa->uploadImgCabecera($_FILES['registro_foto_cabecera'], $empresaId, $registro_foto_cabecera);
            $Empresa->updateFieldEmpresa($empresaId, 'foto_cabecera', $registro_foto_cabecera);
        }else{
            throw new Exception("El dato no debe estar vacío.");
        }
    }else{
        $issetField = FALSE;
        foreach ($attrsPerfil as $key => $value) {
            $fieldPostName    = $value['post'];
            $fieldPostValue   = $_POST[$fieldPostName];
            $fieldDBName      = $value['field'];

            if(isset($_POST[$fieldPostName])){

                if(!empty($_POST[$fieldPostName])){
                    if($fieldPostName == "perfil_telefono") $fieldPostValue = implode (",", $fieldPostValue);
                    $Empresa->updateFieldEmpresa($empresaId, $fieldDBName, $fieldPostValue);
                }  else {
                    throw new Exception("El dato no debe estar vacío.");
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
