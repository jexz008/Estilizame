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

    public function getEventos($empresaId = NULL, $eventoTipoId = NULL, $estado = NULL) {
        $condicion = array();
            $sql = <<<SQL
SELECT EV.*, EVT.nombre AS tipo_evento FROM evento AS EV
LEFT JOIN evento_tipo AS EVT ON EVT.id = EV.evento_tipo_id_fk
INNER JOIN entidad ENT ON ENT.entidad_id_fk = EV.id AND ENT.estatus = 1 AND ENT.tipo='evento'
INNER JOIN empresa AS E ON E.id = EV.empresa_id_fk
SQL;

        if ($empresaId) {
            $condicion[] = " EV.empresa_id_fk = {$empresaId} ";
        }
        if ($estado) {
            $condicion[] = " EV.estado = '{$estado}' ";
        }
        if ($eventoTipoId) {
            $condicion[] = " EV.evento_tipo_id_fk = {$eventoTipoId} ";
        }

        if (!empty($condicion)) {
            $condicion = implode("AND", $condicion);
            $sql .= " WHERE {$condicion} ";
        }

            return crearArraySQL($this->db->execute_sql($sql));
    }

public function getTiposEvento() {
            $sql = <<<SQL
SELECT EVT.* FROM evento_tipo AS EVT
INNER JOIN entidad ENT ON ENT.entidad_id_fk = EVT.id AND ENT.estatus = 1 AND ENT.tipo='tipoevento'
SQL;
            return $this->db->execute_sql($sql);
    }

    public function setEvento($nombre, $descripcion, $fechaInicio, $horaInicio, $fechaFin, $horaFin, $estado, $municipio, $direccion, $imagen = NULL, $tipoEventoId, $empresaId, $usuarioId) {
            $sql = <<<SQL
INSERT INTO `evento` (`nombre`, `descripcion`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `estado`, `municipio`, `direccion`, `imagen`, `evento_tipo_id_fk`, `empresa_id_fk`) VALUES
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

    public function selectEventos($current = NULL, $name = 'evento') {
        $data = crearArraySQL($this->getTiposEvento());
        $html = '';
        if ($data) {
            $html .= '<select name="'.$name.'_tipo_evento" id="'.$name.'_tipo_event" class="form-control">';
            $html .= '<option value="">-Selecciona Tipo Evento-</option>';
            foreach ($data as $key => $value) {
                $selected = ($value['id'] == $current) ? ' selected="selected" ' : '';
                $html .= <<<HTML
			<option value="{$value['id']}" {$selected} >{$value['nombre']}</option>
HTML;
            }
            $html .= '</select>';
        }
        return $html;
    }

    public function createGridEventos($eventoTipoId, $estado = NULL) {
        $eventos = $this->getEventos(NULL, $eventoTipoId, $estado);
        return $this->gridEventos($eventos);
    }

    public function gridEventos($eventos) {
        global $_Modulo, $_Storage_Images, $_Storage_Images_Prefix;

        $count = count($eventos);
        $html = <<<HTML
            <h3>Eventos <small>({$count} Resultados)</small> </h3>
            <table class="table table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Descripción</th>
                    <th>Dirección</th>
                    <th>Inicia</th>
                    <th>Hora</th>
                    <th>Termina</th>
                    <th>Hora</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                <tr/>
            </thead>
            <tbody>
HTML;
        foreach ($eventos as $key => $e) {
            $e = (object) $e;
            $imgName = "evento-" . str_pad($e->id, 10, "0", STR_PAD_LEFT); // promocion-000000000X
            $src = $_Storage_Images . $_Storage_Images_Prefix . $e->empresa_id_fk . "/eventos/" . $imgName;
            $src = substr($src, 0, (strlen($src))-(strlen(strrchr($src, '.')))) . '_256x256.jpg';


            $html .= <<<HTML
                <tr>
                    <td><img width="128" height="128" src="{$src}" alt="{$e->nombre}"></td>
                    <td>{$e->descripcion}</td>
                    <td>{$e->direccion}</td>
                    <td>{$e->fecha_inicio}</td>
                    <td>{$e->hora_inicio}</td>
                    <td>{$e->fecha_fin}</td>
                    <td>{$e->hora_fin}</td>
                    <td>{$e->tipo_evento}</td>
                    <td>{$e->estado}</td>
                </tr>
HTML;
        }
        $html .= <<<HTML
            </tbody>
        </table>
HTML;
        return $html;
    }

}
