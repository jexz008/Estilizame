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
                $Empresa->updateEmpresa($empresaId, NULL, NULL, NULL, NULL, $_POST['perfil_estado_nombre'], $_POST['perfil_municipio_nombre']);
            }else{
                throw new Exception("Es requerido el campo municipio.");
            }
        }else{
            throw new Exception("El dato no debe estar vacío.");
        }
    }elseif(isset($_POST['perfil_municipio'])){
        if(!empty($_POST['perfil_municipio'])){
            $Empresa->updateEmpresa($empresaId, NULL, NULL, NULL, NULL, NULL, $_POST['perfil_municipio']);
        }else{
            throw new Exception("El dato no debe estar vacío.");
        }
    }elseif(isset($_FILES['perfil_foto_perfil'])){
        if(!empty($_FILES['perfil_foto_perfil'])){
            $ext = '.jpg';
            $registro_foto_perfil   = "perfil-" . str_replace(" ", "", $_REQUEST['perfil_nombre_actual']);
            $Empresa->deleteImgPerfil($empresaId, $_POST['perfil_foto_perfil_actual']);
            $Empresa->uploadImgPerfil($_FILES['perfil_foto_perfil'], $empresaId, $registro_foto_perfil);
            $Empresa->updateFieldEmpresa($empresaId, 'foto_perfil', $registro_foto_perfil . $ext);
        }else{
            throw new Exception("El dato no debe estar vacío.");
        }
    }elseif(isset($_FILES['perfil_foto_cabecera'])){
        if(!empty($_FILES['perfil_foto_cabecera'])){
            $ext = '.jpg';
            $registro_foto_cabecera   = "cabecera-" . str_replace(" ", "", $_REQUEST['perfil_nombre_actual']);
            $Empresa->deleteImgCabecera($empresaId, $_POST['perfil_foto_cabecera_actual']);
            $Empresa->uploadImgCabecera($_FILES['perfil_foto_cabecera'], $empresaId, $registro_foto_cabecera);
            $Empresa->updateFieldEmpresa($empresaId, 'foto_cabecera', $registro_foto_cabecera . $ext);
        }else{
            throw new Exception("El dato no debe estar vacío.");
        }
    }elseif(isset($_FILES['perfil_foto_galeria'])){
        if(!empty($_FILES['perfil_foto_galeria'])){
            $path = $_Storage_Images . $_Storage_Images_Prefix . $empresaId . '/galeria';
            $filesImg = scandir($path);
            $lastImg = $filesImg[count($filesImg) - 5]; // -5 restando thumbs
            list($prefijo, $consecutivo) = explode('-', substr($lastImg, 0, (strlen($lastImg))-(strlen(strrchr($lastImg, '.')))));
            $registro_foto_galeria  = "galeria-" . str_pad((int)++$consecutivo, 5, "0", STR_PAD_LEFT); // galeria-0000X
            $Empresa->uploadImgGaleria($_FILES['perfil_foto_galeria'], $empresaId, $registro_foto_galeria);
        }else{
            throw new Exception("El dato no debe estar vacío.");
        }
    }elseif(isset($_POST['borra_foto_galeria'])){
        if(!empty($_POST['borra_foto_galeria'])){
            $ext = '.jpg';
            $Empresa->deleteImgGaleria($empresaId, $_POST['borra_foto_galeria']);
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

    $return['field'] = $fieldPostName;
    $return['value'] = $fieldPostValue;
    $return['message'] = "Tu información ha sido actualizada correctamente!";
    $return['success'] = TRUE;
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
