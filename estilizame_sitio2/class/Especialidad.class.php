<?php

class Especialidad {

    public $db;

    function __construct() {
        $this->db = new DB();
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////	

    private function getEspecialidades() {
        $sql = <<<SQL
SELECT E.id, E.nombre FROM especialidad AS E
INNER JOIN entidad EN ON EN.entidad_id_fk = E.id AND EN.estatus = 1 AND EN.tipo='especialidad'
ORDER BY E.nombre
SQL;
        return $data = $this->db->execute_sql($sql);
    }
    
    private function setEspecialidad($nombre, $usuarioId) {
        $sql = <<<SQL
INSERT INTO especialidad (nombre) VALUES ('{$nombre}')
SQL;
        $this->db->execute_sql($sql);
        $especialidadId = $this->db->last_insert();

        $sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('especialidad', {$especialidadId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
        $this->db->execute_sql($sql);
        return $especialidadId;
}
    //$data = crearArraySQL($this->getCategorias());
///////////////////////////////////////////////////////////////////////////////////////////////////////////	
}

//Fin class especialidad
?>