<?php

class Empresa{
	public $db;

	function __construct(){
		$this->db = new DB();
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////

	private function setEmpresa($nombre, $descripcion, $email, $telefono, $logo, $estado, $municipio, $direccion, $foto_perfil, $foto_cabecera, $video, $facebook, $twitter, $googleplus, $instagram, $ubicacion_html, $categoria_id, $jerarquia_id, $especialidades){
            try{
                $this->db->begin();
                // Usuario
		$sql = <<<SQL
INSERT INTO `usuario` (`email`, `contrasena`, `empresa_id_fk`, `nombre`, `apellido`) VALUES
({$email}, SHA5({$password}), NULL, {$nombre}, 'Corona')
SQL;
                if(!$this->db->execute_sql($sql)){
                    throw new Exception("Error al insertar Usuario");
                }
                $usuarioId = $this->db->last_insert();
                
		$sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('empresa', {$empresaId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
                if(!$this->db->execute_sql($sql)){
                    throw new Exception("Error al insertar Entidad Usuario");
                }

                // Empresa
		$sql = <<<SQL
INSERT INTO empresa 
(nombre, descripcion, email, telefono, logo, estado, municipio, direccion, foto_perfil, foto_cabecera, video, facebook, twitter, googleplus, instagram, ubicacion_html, categoria_id_fk, jerarquia_id_fk)
VALUES
({$nombre}, {$descripcion}, {$email}, {$telefono}, {$logo}, {$estado}, {$municipio}, {$direccion}, {$foto_perfil}, {$foto_cabecera}, {$video}, {$facebook}, {$twitter}, {$googleplus}, {$instagram}, {$ubicacion_html}, {$categoria_id}, {$jerarquia_id})
SQL;
                if(!$this->db->execute_sql($sql)){
                    throw new Exception("Error al insertar Empresa");
                }
                $empresaId = $this->db->last_insert();
                
		$sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('empresa', {$empresaId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
                if(!$this->db->execute_sql($sql)){
                    throw new Exception("Error al insertar Entidad Empresa");
                }

		$sql = <<<SQL
UPDATE usuario SET empresa_id_fk = {$empresaId} WHERE id = {$usuarioId}
SQL;
                if(!$this->db->execute_sql($sql)){
                    throw new Exception("Error al insertar Entidad Empresa");
                }
                
                $this->db->commit();
                return $empresaId;
            }catch(Exception $e){
                $this->db->rollback();
            }                
                
	 return FALSE;

	}
////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public function registraEmpresa($data){
		extract($data); 
		
		$empresa_id = $this->setEmpresa($registro_empresa, $registro_descripcion, $registro_email, $registro_telefono, $logo, $registro_estado, $registro_municipio, $registro_direccion, $registro_foto_perfil, $registro_foto_cabecera, $registro_video, $registro_facebook, $registro_twitter, $registro_google, $registro_instagram, $registro_ubicacion, $registro_categoria, $jerarquia_id, $registro_password, $registro_especialidades, $registro_galeria);

                $handle = new upload($_FILES['registro_foto_cabecera'], 'es_Es');
                if ($handle->uploaded) {
                  $handle->file_new_name_body   = 'image_resized';
                  $handle->image_resize         = true;
                  $handle->image_x              = 100;
                  $handle->image_ratio_y        = true;
                  $handle->process('/storage/img/empresas/empresa_'.$empresa_id.'/cabecera/');
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