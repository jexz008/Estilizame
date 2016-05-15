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

            $sql = <<<SQL
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

        $path = $_Storage_Images . $_Storage_Images_Prefix . $empresaId . '/banners/';

        $file = new upload($file, 'es_Es');
        $this->uploadImg($file, $name, $path, $_Banners_Width, $_Banners_Height);
    }

    public function uploadImgPerfil($file, $empresaId, $name) {
        global $_Storage_Images, $_Storage_Images_Prefix, $_Perfil_Width, $_Perfil_Height;

        $path = $_Storage_Images . $_Storage_Images_Prefix . $empresaId . '/';

        $file = new upload($file, 'es_Es');
        $this->uploadImg($file, $name, $path, $_Perfil_Width, $_Perfil_Height, FALSE);
        // Creando thumbs
        $this->uploadImg($file, $name."_256x256", $path, 256, 256, FALSE);
        $this->uploadImg($file, $name."_48x48", $path, 48, 48, FALSE);        
        $this->uploadImg($file, $name."_32x32", $path, 32, 32, FALSE);        
        $this->uploadImg($file, $name."_16x16", $path, 16, 16);        
    }


    public function uploadImg($handle, $name, $path, $width, $height, $clean = TRUE) {
                
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
                if($clean) $handle->clean();
                return TRUE;
            } else {
                throw new Exception($handle->error);
            }
        }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////	
    public function getEmpresas($categoriaId = NULL, $estado = NULL, $especialidadId = NULL) {
        $condicion = array();
	$sql = <<<SQL
            SELECT E.*, J.nombre AS jerarquia, C.Nombre AS categoria
                FROM empresa AS E
		INNER JOIN entidad ENT ON ENT.entidad_id_fk = E.id AND ENT.estatus = 1 AND ENT.tipo='empresa'
        	INNER JOIN jerarquia J ON J.id = E.jerarquia_id_fk
                INNER JOIN categoria AS C ON C.id = E.categoria_id_fk
                
                LEFT JOIN empresa_especialidad AS EES ON EES.empresa_id_fk = E.id
                LEFT JOIN especialidad AS ES ON ES.id = EES.especialidad_id_fk
SQL;
        if($categoriaId){
            $condicion[] = " E.categoria_id_fk = {$categoriaId} ";
        }
        if($estado){
            $condicion[] = " E.estado = '{$estado}' ";
        }
        if($especialidadId){
            $condicion[] = " EES.especialidad_id_fk = {$especialidadId} ";
        }
        if(!empty($condicion)){
            $condicion = implode("AND", $condicion);
            $sql .= " WHERE {$condicion} ";            
        }

        return crearArraySQL($this->db->execute_sql($sql));
    }
    
    public function getEmpresaEspecialidades($empresaId) {
	$sql = <<<SQL
            SELECT E.*
                FROM especialidad AS E
                INNER JOIN empresa_especialidad AS ES ON ES.especialidad_id_fk = E.id
                WHERE ES.empresa_id_fk = {$empresaId}               
SQL;
		/*INNER JOIN entidad ENT ON ENT.entidad_id_fk = E.id AND ENT.estatus = 1 AND ENT.tipo='empresa'
                INNER JOIN especialidad AS ES ON ES.id = EES.especialidad_id_fk
        	INNER JOIN jerarquia J ON J.id = E.jerarquia_id_fk
                INNER JOIN categoria AS C ON C.id = E.categoria_id_fk     */           
        return crearArraySQL($this->db->execute_sql($sql));
    }    
    
    public function gridEmpresas($empresas) {  
        global $_Modulo, $_Storage_Images, $_Storage_Images_Prefix;

        $count = count($empresas);
        $html = <<<HTML
            <h3>{$_Modulo} <small>({$count} Resultados)</small> </H3>    
            <table class="table table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Empresa</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Especialidad</th>
                <tr/>
            </thead>
            <tbody>
HTML;
        foreach ($empresas as $key => $e) { $e = (object)$e;
            $src = $_Storage_Images.$_Storage_Images_Prefix.$e->id."/".$e->foto_perfil;

            $htmlEsp = '';
            foreach ($e->especialidades as $k => $esp) {
                $htmlEsp .= <<<HTML
                        <i class="glyphicon glyphicon-tag" aria-hidden="true"></i>{$esp['nombre']}<br>
HTML;
            }
            $html .= <<<HTML
                <tr>
                    <td><img width="128" height="128" src="{$src}" alt="{$src}"></td>
                    <td><i class="glyphicon glyphicon-user" aria-hidden="true"></i>{$e->nombre}</td>
                    <td>
                        <i class="glyphicon glyphicon-home" aria-hidden="true"></i> {$e->direccion} {$e->municipio}
                        <br><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> {$e->telefono}
                        <br><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> {$e->email}
                    </td>
                    <td>{$e->estado}</td>
                    <td>{$htmlEsp}</td>
                </tr>
HTML;
        }  
        $html .= <<<HTML
            </tbody>
        </table>
HTML;
        return $html;
    }
    
    public function createGridEmpresas($categoriaId, $estado = NULL, $especialidadId = NULL){
        $empresas = $this->getEmpresas($categoriaId, $estado, $especialidadId);
        foreach ($empresas as $key => $e) {
            $empresas[$key]['especialidades'] = $this->getEmpresaEspecialidades($e['id']);
        }
        return $this->gridEmpresas($empresas);
    }
    
}

//Fin class Empresa
?>