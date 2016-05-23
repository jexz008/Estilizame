<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author Joel.Corona
 */
class Usuario {
    public $db;

    function __construct() {
        $this->db = new DB();
    }

    public function setUsuario($email, $password, $nombre, $empresaId = NULL) {
        $sql = <<<SQL
INSERT INTO `usuario` (`email`, `contrasena`, `empresa_id_fk`, `nombre`) VALUES
('{$email}', SHA1({$password}), {$empresaId}, '{$nombre}')
SQL;
        $this->db->execute_sql($sql);
        $usuarioId = $this->db->last_insert();

        $sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('usuario', {$usuarioId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
        $this->db->execute_sql($sql);
         return $usuarioId;
    }

    public function updateUsuario($usuarioId, $email = NULL, $password = NULL, $nombre = NULL, $empresaId = NULL) {
        $args = get_defined_vars();
        $condiciones = array();

        if($args):foreach ($args as $var => $val) {
            if($key != 'usuarioId'){
                if(!empty($val)) $condiciones[] = $var . "= '" . $val . "'";
            }
        }endif;

        if($condiciones){
            $condicion = implode(", ", $condiciones);
            $sql = "UPDATE `usuario` SET ".$condicion." WHERE id=".$usuarioId;
            $this->db->execute_sql($sql);
        }
    }

    public function getUsuarios($empresaId = NULL, $usuarioId = NULL){
        $condiciones = array();
        if(!empty($empresaId)){ $condiciones[] = ' U.empresa_id_fk = '.$empresaId; }
        if(!empty($empresaId)){ $condiciones[] = ' U.id = '.$usuarioId; }
        if($condiciones){
            $condicion = " WHERE " . implode("AND ", $condiciones);
        }
        $sql = <<<SQL
SELECT U.* FROM usuarios AS U
INNER JOIN entidad AS ENT ON ENT.entidad_id_fk = U.id AND ENT.estatus = 1 ENT.tipo='usuario'
{$condicion}
SQL;
        return crearArraySQL($this->db->execute_sql($sql));
    }

    public function getUsuario($usuarioId){
        return $this->getUsuarios(NULL, $usuarioId);
    }


}
