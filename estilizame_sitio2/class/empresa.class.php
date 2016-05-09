<?php

class Empresa{

////////////////////////////////////////////////////////////////////////////////////////////////////////

	private function setEmpresa($nombre, $descripcion, $email, $telefono, $logo, $estado, $municipio, $direccion, $foto_perfil, $foto_cabecera, $video, $facebook, $twitter, $googleplus, $instagram, $ubicacion_html, $categoria_id, $jerarquia_id, $especialidades){

		$sql = <<<SQL
INSERT INTO `usuario` (`email`, `contrasena`, `empresa_id_fk`, `nombre`, `apellido`) VALUES
({$email}, SHA5({$password}), NULL, {$nombre}, 'Corona')
SQL;

		$sql = <<<SQL
INSERT INTO empresa 
(nombre, descripcion, email, telefono, logo, estado, municipio, direccion, foto_perfil, foto_cabecera, video, facebook, twitter, googleplus, instagram, ubicacion_html, categoria_id_fk, jerarquia_id_fk)
VALUES
({$nombre}, {$descripcion}, {$email}, {$telefono}, {$logo}, {$estado}, {$municipio}, {$direccion}, {$foto_perfil}, {$foto_cabecera}, {$video}, {$facebook}, {$twitter}, {$googleplus}, {$instagram}, {$ubicacion_html}, {$categoria_id}, {$jerarquia_id})
SQL;
		$sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, , `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('empresa', {$empresaId}, 1, , CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId}),

SQL;

	 //$rsql = $this->db->execute_sql($sql);
	 if($sql){
	 	//return $empresaId = $this->db->last_insert();
		return FALSE;
	 }
	 return FALSE;

	}
////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public function registraEmpresa($data){
		extract($data); 
		
		$this->setEmpresa($registro_empresa, $registro_descripcion, $registro_email, $registro_telefono, $logo, $registro_estado, $registro_municipio, $registro_direccion, $registro_foto_perfil, $registro_foto_cabecera, $registro_video, $registro_facebook, $registro_twitter, $registro_google, $registro_instagram, $registro_ubicacion, $registro_categoria, $jerarquia_id, $registro_password, $registro_especialidades, $registro_galeria);
		return FALSE;

	}

}//Fin class Empresa

?>