<?php
session_start();

try {
    if (!$sesion_id) {
        throw new Exception(ERROR_SESSION);
    }

    $Empresa = new Empresa();

    $empresaId = $_REQUEST['empresaId'];
    $categoriaId = $_REQUEST['categoriaId'];

    $attrsPerfil = array(
        array('post' => 'perfil_empresa',           'field' => 'nombre',            'hdnField' => 'hdnPerfilNombre',        'content' => 'cntPerfilNombre'),
        array('post' => 'perfil_categoria',         'field' => 'categoria_id_fk',   'hdnField' => 'hdnPerfilCategoriaId',   'content' => 'cntPerfilCategoriaId'),
        array('post' => 'perfil_descripcion',       'field' => 'descripcion',       'hdnField' => 'hdnPerfilDescripcion',   'content' => 'cntPerfilDescripcion'),
//        array('post' => 'perfil_estado_nombre', 'field' => 'estado'),
        array('post' => 'perfil_municipio_nombre',  'field' => 'municipio',         'hdnField' => 'hdnPerfilMunicipio',     'content' => 'cntPerfilMunicipio'),
        array('post' => 'perfil_direccion',         'field' => 'direccion',         'hdnField' => 'hdnPerfilDireccion',     'content' => 'cntPerfilDireccion'),
        array('post' => 'perfil_telefono',          'field' => 'telefono',          'hdnField' => 'hdnPerfilTelefono1',     'content' => 'cntPerfilTelefono1'),
        array('post' => 'perfil_email',             'field' => 'email',             'hdnField' => 'hdnPerfilEmail',         'content' => 'cntPerfilEmail'),
//        array('post' => 'perfil_contrasena', 'field' => 'contrasena'),
        array('post' => 'perfil_ubicacion',         'field' => 'ubicacion_html',    'hdnField' => 'hdnPerfilUbicacion',     'content' => 'cntPerfilUbicacion'),
        array('post' => 'perfil_video',             'field' => 'video',             'hdnField' => 'hdnPerfilVideo',         'content' => 'cntPerfilVideo'),
        array('post' => 'perfil_facebook',          'field' => 'facebook',          'hdnField' => 'hdnPerfilFacebook',      'content' => 'cntPerfilFacebook'),
        array('post' => 'perfil_twitter',           'field' => 'twitter',           'hdnField' => 'hdnPerfilTwitter',       'content' => 'cntPerfilTwitter'),
        array('post' => 'perfil_google',            'field' => 'googleplus',        'hdnField' => 'hdnPerfilGoogle',        'content' => 'cntPerfilGoogle'),
        array('post' => 'perfil_instagram',         'field' => 'instagram',         'hdnField' => 'hdnPerfilInstagram',     'content' => 'cntPerfilInstagram'),
    );

    if (isset($_POST['perfil_especialidad'])) {
        $especialidades = $_POST['perfil_especialidad'][$categoriaId];
        $Empresa->updatetEmpresaEspecialidades($empresaId, $especialidades);
    } elseif (isset($_POST['perfil_estado_nombre'])) {
        if (!empty($_POST['perfil_estado_nombre'])) {
            if (isset($_POST['perfil_municipio_nombre']) && !empty($_POST['perfil_municipio_nombre'])) {
                $Empresa->updateEmpresa($empresaId, NULL, NULL, NULL, NULL, $_POST['perfil_estado_nombre'], $_POST['perfil_municipio_nombre']);
            } else {
                throw new Exception("Es requerido el campo municipio.");
            }
        } else {
            throw new Exception("El dato no debe estar vacío.");
        }
    } elseif (isset($_POST['perfil_municipio'])) {
        if (!empty($_POST['perfil_municipio'])) {
            $Empresa->updateEmpresa($empresaId, NULL, NULL, NULL, NULL, NULL, $_POST['perfil_municipio']);
        } else {
            throw new Exception("El dato no debe estar vacío.");
        }
    } elseif (isset($_FILES['perfil_foto_perfil'])) {
        if (!empty($_FILES['perfil_foto_perfil'])) {
            $ext = '.jpg';
            $registro_foto_perfil = "perfil-" . str_replace(" ", "", $_REQUEST['perfil_nombre_actual']);
            $Empresa->deleteImgPerfil($empresaId, $_POST['perfil_foto_perfil_actual']);
            $Empresa->uploadImgPerfil($_FILES['perfil_foto_perfil'], $empresaId, $registro_foto_perfil);
            $Empresa->updateFieldEmpresa($empresaId, 'foto_perfil', $registro_foto_perfil . $ext);
        } else {
            throw new Exception("El dato no debe estar vacío.");
        }
    } elseif (isset($_FILES['perfil_foto_cabecera'])) {
        if (!empty($_FILES['perfil_foto_cabecera'])) {
            $ext = '.jpg';
            $registro_foto_cabecera = "cabecera-" . str_replace(" ", "", $_REQUEST['perfil_nombre_actual']);
            $Empresa->deleteImgCabecera($empresaId, $_POST['perfil_foto_cabecera_actual']);
            $Empresa->uploadImgCabecera($_FILES['perfil_foto_cabecera'], $empresaId, $registro_foto_cabecera);
            $Empresa->updateFieldEmpresa($empresaId, 'foto_cabecera', $registro_foto_cabecera . $ext);
        } else {
            throw new Exception("El dato no debe estar vacío.");
        }
    } elseif (isset($_FILES['perfil_foto_galeria'])) {
        if (!empty($_FILES['perfil_foto_galeria'])) {
            $path = $_Storage_Images . $_Storage_Images_Prefix . $empresaId . '/galeria';
            $filesImg = scandir($path);
            $lastImg = $filesImg[count($filesImg) - 5]; // -5 restando thumbs
            list($prefijo, $consecutivo) = explode('-', substr($lastImg, 0, (strlen($lastImg)) - (strlen(strrchr($lastImg, '.')))));
            $registro_foto_galeria = "galeria-" . str_pad((int) ++$consecutivo, 5, "0", STR_PAD_LEFT); // galeria-0000X
            $Empresa->uploadImgGaleria($_FILES['perfil_foto_galeria'], $empresaId, $registro_foto_galeria);
        } else {
            throw new Exception("El dato no debe estar vacío.");
        }
    } elseif (isset($_POST['borra_foto_galeria'])) {
        if (!empty($_POST['borra_foto_galeria'])) {
            $ext = '.jpg';
            $Empresa->deleteImgGaleria($empresaId, $_POST['borra_foto_galeria']);
        } else {
            throw new Exception("El dato no debe estar vacío.");
        }
    } elseif (isset($_POST['perfil_contrasena'])) {
        if (!empty($_POST['perfil_contrasena'])) {
            if($_POST['perfil_contrasena'] == $_POST['perfil_contrasena2']){
                if(sha1($_POST['perfil_contrasena3']) == $_SESSION[$_app->prefijo.'_usuario_password']){
                    $Empresa->updateFieldEmpresa($empresaId, 'contrasena', sha1($_POST['perfil_contrasena']));
                }else{
                    throw new Exception("Las contraseña actual es inválida.");
                }
            }else{
                throw new Exception("Las contraseñas no coinciden.");
            }
        } else {
            throw new Exception("El dato no debe estar vacío.");
        }
    } else {
        $issetField = FALSE;
        foreach ($attrsPerfil as $key => $value) {
            $fieldPostName  = $value['post'];
            $fieldPostValue = $_POST[$fieldPostName];
            $fieldDBName    = $value['field'];
            $hdnField       = $value['hdnField'];
            $content        = $value['content'];

            if (isset($_POST[$fieldPostName])) {

                if (!empty($_POST[$fieldPostName])) {
                    if ($fieldPostName == "perfil_telefono")
                        $fieldPostValue = implode(",", $fieldPostValue);
                    $Empresa->updateFieldEmpresa($empresaId, $fieldDBName, $fieldPostValue);
                } else {
                    throw new Exception("El dato no debe estar vacío.");
                }
                $issetField = TRUE;
                break;
            }
        }
        if (!$issetField) {
            throw new Exception("Acción no encontrada al intentar actualizar.");
        }
    }

    $return['content']  = $content;
    $return['hdnField'] = $hdnField;
    $return['field']    = $fieldPostName;
    $return['value']    = $fieldPostValue;
    $return['message']  = "Tu información ha sido actualizada correctamente!";
    $return['success']  = TRUE;
} catch (Exception $e) {
    $return['message'] = 'Excepción capturada: ' . $e->getMessage() . "\n";
}
echo json_encode($return);
