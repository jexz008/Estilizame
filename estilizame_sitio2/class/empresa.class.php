<?php

class Empresa {

    public $db;

    function __construct() {
        $this->db = new DB();
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////

    private function setEmpresa($nombre, $descripcion, $email, $telefono, $logo, $estado, $municipio, $direccion, $foto_perfil, $foto_cabecera, $video, $facebook, $twitter, $googleplus, $instagram, $ubicacion_html, $categoria_id, $jerarquia_id, $password, $especialidades, $registro_galeria) {
        try {
            $this->db->begin();
            // Usuario
            $sql = <<<SQL
INSERT INTO `usuario` (`email`, `contrasena`, `empresa_id_fk`, `nombre`) VALUES
('{$email}', SHA1({$password}), NULL, '{$nombre}')
SQL;
            $this->db->execute_sql($sql);
            $usuarioId = $this->db->last_insert();

            $sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('usuario', {$usuarioId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
            $this->db->execute_sql($sql);


            // Empresa
            $sql = <<<SQL
INSERT INTO empresa 
(nombre, descripcion, email, telefono, logo, estado, municipio, direccion, foto_perfil, foto_cabecera, video, facebook, twitter, googleplus, instagram, ubicacion_html, categoria_id_fk, jerarquia_id_fk)
VALUES
('{$nombre}', '{$descripcion}', '{$email}', '{$telefono}', '{$logo}', '{$estado}', '{$municipio}', '{$direccion}', '{$foto_perfil}', '{$foto_cabecera}', '{$video}', '{$facebook}', '{$twitter}', '{$googleplus}', '{$instagram}', '{$ubicacion_html}', {$categoria_id}, {$jerarquia_id})
SQL;
            $this->db->execute_sql($sql);
            $empresaId = $this->db->last_insert();

            $sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('empresa', {$empresaId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
            $this->db->execute_sql($sql);

            // Usuario
            $sql = <<<SQL
UPDATE usuario SET empresa_id_fk = {$empresaId} WHERE id = {$usuarioId}
SQL;
            $this->db->execute_sql($sql);


            // Especialidades
            foreach ($especialidades as $especialidad) {
                $sql = <<<SQL
INSERT INTO empresa_especialidad (empresa_id_fk, especialidad_id_fk) 
VALUES ({$empresaId}, {$especialidad})
SQL;
                $this->db->execute_sql($sql);
            }

            // Banners
            $sql = <<<SQL
INSERT INTO banner (nombre, imagen_url, celda, fila, empresa_id_fk)
VALUES ('{$nombre}', '{$foto_cabecera}', 1, 1, {$empresaId})
SQL;
            $this->db->execute_sql($sql);
            $bannerId = $this->db->last_insert();

            echo $sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('banner', {$bannerId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
            $this->db->execute_sql($sql);

            $this->db->commit();
            return $empresaId;
            
        } catch (Exception $e) {
            $this->db->rollback();
            if (strpos($e->getMessage(), "Duplicate entry") !== false) {
                throw new Exception("El correo ya está registrado.");
            }
            throw $e;
        }

        return FALSE;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////	

    public function registraEmpresa($data, $files) {
        extract($data);
        
        $ext = ".jpg";
        $registro_telefono      = implode(",", $registro_telefono);
        $registro_estado        = $registro_estado_nombre;
        $registro_foto_perfil   = "perfil-" . str_replace(" ", "", $registro_empresa);
        $registro_foto_cabecera = "cabecera-" . str_replace(" ", "", $registro_empresa);
        $registro_especialidades = $registro_especialidad[$registro_categoria];
        $registro_jerarquia     = 1; // 1:Normal, 2:Premium

        $empresaId = $this->setEmpresa($registro_empresa, $registro_descripcion, $registro_email, $registro_telefono, $logo, $registro_estado, $registro_municipio, $registro_direccion, $registro_foto_perfil . $ext, $registro_foto_cabecera . $ext, $registro_video, $registro_facebook, $registro_twitter, $registro_google, $registro_instagram, $registro_ubicacion, $registro_categoria, $registro_jerarquia, $registro_password, $registro_especialidades, $registro_galeria);

        $this->uploadImgCabecera($files['registro_foto_cabecera'], $empresaId, $registro_foto_cabecera);
        $this->uploadImgPerfil($files['registro_foto_perfil'], $empresaId, $registro_foto_perfil);

        return FALSE;
    }

    public function uploadImgCabecera($file, $empresaId, $name) {
        global $_Storage_Images, $_Storage_Images_Prefix, $_Banners_Width, $_Banners_Height;

        $path = $_Storage_Images . $_Storage_Images_Prefix . $empresaId . '/cabecera/';

        $this->uploadImg($file, $name, $path, $_Banners_Width, $_Banners_Height);
    }

    public function uploadImgPerfil($file, $empresaId, $name) {
        global $_Storage_Images, $_Storage_Images_Prefix, $_Perfil_Width, $_Perfil_Height;

        $path = $_Storage_Images . $_Storage_Images_Prefix . $empresaId . '/';

        $this->uploadImg($file, $name, $path, $_Perfil_Width, $_Perfil_Height);
        // Creando thumbs
        $this->uploadImg($file, $name."_256x256", $path, 256, 256);
        $this->uploadImg($file, $name."_48x48", $path, 48, 48);        
        $this->uploadImg($file, $name."_32x32", $path, 32, 32);        
        $this->uploadImg($file, $name."_16x16", $path, 16, 16);        
    }


    public function uploadImg($file, $name, $path, $width, $height) {
        
        $handle = new upload($file, 'es_Es');
        if ($handle->uploaded) {
            // Procesando
            $handle->file_new_name_body = $name; //'image_resized';
            $handle->image_resize = true;
            $handle->image_ratio_crop = true;
            $handle->image_x = $width;
            $handle->image_y = $height;
            $handle->image_convert = 'jpg';
            //$handle->image_ratio_y        = true;
            $handle->process($path);
            if ($handle->processed) {
                $handle->clean();
                return TRUE;
            } else {
                throw new Exception($handle->error);
            }
        }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////	
    public function getEmpresas($param) {
	$sql = <<<SQL
            SELECT E.id, E.nombre, B.imagen_url, B.nombre, B.empresa_id_fk FROM banner AS B
				INNER JOIN empresa E ON B.empresa_id_fk = E.id 
				INNER JOIN jerarquia J ON E.jerarquia_id_fk = J.id 
				INNER JOIN entidad EN ON EN.entidad_id_fk = B.id AND EN.estatus = 1 AND EN.tipo='banner'
				INNER JOIN entidad ENT ON ENT.entidad_id_fk = E.id AND ENT.estatus = 1 AND ENT.tipo='empresa'
				WHERE 
				B.celda = {$celda}
				AND B.fila = {$fila}		
				AND J.nombre = '{$jerarquia}'
SQL;
    }
}

//Fin class Empresa
?>