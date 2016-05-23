<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of evento
 *
 * @author Joel.Corona
 */
class Evento {
    public $db;

    function __construct() {
        $this->db = new DB();
    }

    public function getEventos($empresaId) {
            $sql = <<<SQL
SELECT EV.* FROM evento AS EV
LEFT JOIN evento_tipo AS EVT ON EVT.id = EV.evento_tipo_id_fk
INNER JOIN entidad ENT ON ENT.entidad_id_fk = EV.id AND ENT.estatus = 1 AND ENT.tipo='evento'
INNER JOIN empresa AS E ON E.id = EV.empresa_id_fk
WHERE EV.empresa_id_fk = {$empresaId}
SQL;
            return crearArraySQL($this->db->execute_sql($sql));
    }

    public function setEvento($nombre, $descripcion, $fechaInicio, $horaInicio, $fechaFin, $horaFin, $estado, $municipio, $direccion, $imagen, $tipoEventoId, $empresaId, $usuarioId) {
            $sql = <<<SQL
INSERT INTO `evento` (`nombre`, `descripcion`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `estado`, `municipio`, `direccion`, `imagen`, `tipo_evento_id_fk`, `empresa_id_fk`) VALUES
('{$nombre}', '{$descripcion}', '{$fechaInicio}', '{$horaInicio}', '{$fechaFin}', '{$horaFin}', '{$estado}', '{$municipio}', '{$direccion}', '{$imagen}', '{$tipoEventoId}', '{$empresaId}')
SQL;
            $this->db->execute_sql($sql);
            $eventonId = $this->db->last_insert();

            $sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('evento', {$eventonId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
            $this->db->execute_sql($sql);
            return $eventonId;
    }

    public function updateEvento($eventoId,$nombre, $descripcion, $fechaInicio, $horaInicio, $fechaFin, $horaFin, $estado, $municipio, $direccion, $imagen, $tipoEventoId, $empresaId, $usuarioId) {
            $sql = <<<SQL
UPDATE evento AS EV
INNER JOIN entidad AS ENT ON ENT.entidad_id_fk = EV.id AND ENT.estatus = 1 AND ENT.tipo='evento'
SET EV.nombre='{$nombre}', EV.imagen='{$imagen}', EV.descripcion='{$descripcion}', EV.fechafin='{$fechafin}', ENT.usuario_id_fk='{$usuarioId}'
WHERE EV.id = {$eventoId}
SQL;
            $this->db->execute_sql($sql);
    }

    public function deleteEvento($eventoId) {
        $sql = <<<SQL
UPDATE entidad SET estatus = 0 WHERE entidad_id_fk = {$eventoId} AND tipo = 'evento'
SQL;
            $this->db->execute_sql($sql);
    }
}
