<?php

class Empresa{
	public $db;

	function __construct(){
		$this->db = new DB();
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////

	private function setEmpresa($nombre, $descripcion, $email, $telefono, $logo, $estado, $municipio, $direccion, $foto_perfil, $foto_cabecera, $video, $facebook, $twitter, $googleplus, $instagram, $ubicacion_html, $categoria_id, $jerarquia_id, $password, $especialidades, $registro_galeria){
            try{
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
                    $bannerId = $this->db->last_insert();                    
                }
                
                // Banners
		$sql = <<<SQL
INSERT INTO banner (nombre, imagen_url, celda, fila, empresa_id_fk)
VALUES ('{$nombre}', '{$foto_cabecera}', 1, 1, {$empresaId})
SQL;
                $this->db->execute_sql($sql);
                    
                $sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('banner', {$bannerId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
                $this->db->execute_sql($sql);

                $this->db->commit();
                return $empresaId;
                
            }catch(Exception $e){
                $this->db->rollback();
                if(strpos($e->getMessage(), "Duplicate entry") !== false) {
                    throw new Exception("El correo ya está registrado.");                    
                }
                throw $e;
            }                
                
	 return FALSE;

	}
////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public function registraEmpresa($data, $files){
                global $_Storage_Banners, $_Storage_Banners_Prefix;
            
		extract($data); 
		
                $registro_telefono      = implode(",", $registro_telefono);
                $registro_estado        = $registro_estado_nombre;
                $registro_foto_perfil   = $files['registro_foto_perfil']['name'];
                $registro_foto_cabecera = $files['registro_foto_cabecera']['name'];
                $registro_especialidades = $registro_especialidad[$registro_categoria];
                $registro_jerarquia     = 1;

                $empresa_id = $this->setEmpresa($registro_empresa, $registro_descripcion, $registro_email, $registro_telefono, $logo, $registro_estado, $registro_municipio, $registro_direccion, $registro_foto_perfil, $registro_foto_cabecera, $registro_video, $registro_facebook, $registro_twitter, $registro_google, $registro_instagram, $registro_ubicacion, $registro_categoria, $registro_jerarquia, $registro_password, $registro_especialidades, $registro_galeria);
                #$empresa_id = 1;
                
                $handle = new upload($files['registro_foto_cabecera'], 'es_Es');
                if ($handle->uploaded) {
                  $handle->file_new_name_body   = 'image_resized';
                  $handle->image_resize         = true;
                  $handle->image_x              = 100;
                  $handle->image_ratio_y        = true;
                  $handle->process($_Storage_Banners.$_Storage_Banners_Prefix.$empresa_id.'/cabecera/');
                  if ($handle->processed) {
                    echo 'image resized';
                    $handle->clean();
                  } else {
                    echo 'error : ' . $handle->error;
                  }
                }                
                
                return FALSE;

                

	}

}//Fin class Empresa

?>