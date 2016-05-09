<?php

class especialidad{

	public $db;

	function __construct(){
		$this->db = new db();
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////	

	private function getEspecialidades(){
			$sql = <<<SQL
				SELECT E.id, E.nombre FROM especialidad AS E
				INNER JOIN entidad EN ON EN.entidad_id_fk = E.id AND EN.estatus = 1 AND EN.tipo='especialidad'
				ORDER BY E.nombre
SQL;
		return $data = $this->db->execute_sql($sql);

	}

		//$data = crearArraySQL($this->getCategorias());




///////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	
}//Fin class especialidad

?>