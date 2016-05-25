<?php

class Categoria {

    public $db;
    
    function __construct() {
        $this->db = new db();
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////	
    private function setCategoria($nombre, $usuarioId) {
        $sql = <<<SQL
INSERT INTO categoria (nombre) VALUES ('{$nombre}')
SQL;
        $this->db->execute_sql($sql);
        $categoriaId = $this->db->last_insert();

        $sql = <<<SQL
INSERT INTO `entidad` (`tipo`, `entidad_id_fk`, `estatus`, `fecha_creacion`, `usuario_id_fk`, `usuario_mod_id_fk`) VALUES
('categoria', {$categoriaId}, 1, CURRENT_TIMESTAMP, {$usuarioId}, {$usuarioId})
SQL;
        $this->db->execute_sql($sql);

        return $categoriaId;
    }

    private function getCategorias() {
        $sql = <<<SQL
SELECT C.id, C.nombre FROM categoria AS C
INNER JOIN entidad EN ON EN.entidad_id_fk = C.id AND EN.estatus = 1 AND EN.tipo='categoria'
ORDER BY C.nombre
SQL;
        return $data = $this->db->execute_sql($sql);
    }

    private function getCategoriaEspecialidad($categoriaId = "") {
        $condicion = (!empty($categoriaId)) ? " WHERE C.id='{$categoriaId}' " : "";
        $sql = <<<SQL
SELECT E.id especialidad_id, E.nombre especialidad_nombre, C.id categoria_id, C.nombre categoria_nombre FROM especialidad AS E
INNER JOIN categoria_especialidad CE ON CE.especialidad_id_fk = E.id
INNER JOIN categoria C ON CE.categoria_id_fk = C.id
INNER JOIN entidad EN ON EN.entidad_id_fk = E.id AND EN.estatus = 1 AND EN.tipo='especialidad'
INNER JOIN entidad ENT ON ENT.entidad_id_fk = C.id AND EN.estatus = 1 AND ENT.tipo='categoria'
{$condicion}
ORDER BY C.nombre, E.nombre
SQL;
        return $data = $this->db->execute_sql($sql);
    }

    public function selectCategorias($current = NULL, $name = 'registro') {
        $data = crearArraySQL($this->getCategorias());
        $html = '';
        if ($data) {
            $html .= '<select name="'.$name.'_categoria" id="'.$name.'_categoria" class="form-control">';
            $html .= '<option value="">-Selecciona Categoría-</option>';
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

    public function selectEspecialidades($name, $categoriaId = "", $current = "", $required = FALSE) {
        $data = crearArraySQL($this->getCategoriaEspecialidad($categoriaId));
        $required = ($required) ? 'required="required"' : '';
        $html = '';
        if ($data) {
            $html .= '<select class="form-control" name="' . $name . '" id="' . $name . '" ' . $required . ' >';
            $html .= '<option value="">-Selecciona Especialidad-</option>';
            foreach ($data as $key => $value) {
                $selected = ($value['especialidad_id'] == $current) ? ' selected="selected" ' : '';
                $html .= <<<HTML
			<option value="{$value['especialidad_id']}" {$selected} >{$value['especialidad_nombre']}</option>
HTML;
            }
            $html .= '</select>';
        }
        return $html;
    }
    
    public function checkboxCategoriaEspecialidad($categoriaId = NULL, $checkeds = array(), $prefix = 'registro') {
        $data = crearArraySQL($this->getCategoriaEspecialidad());
        $html = '';
        if ($data) {
            $categoriaEspecialidad = array();
            foreach ($data as $key => $value) {
                $categoriaEspecialidad[$value['categoria_id']][] = array(
                    'especialidad_id' => $value['especialidad_id'],
                    'especialidad_nombre' => $value['especialidad_nombre']
                );
            }
        }

#		echo "<xmp>";var_dump($categoriaEspecialidad);echo "</xmp>";
        if ($categoriaEspecialidad) {
            //$html .= '<select name="categoria" id="categoria" class="form-control">';
            foreach ($categoriaEspecialidad as $key => $especialidad) {
                $style = ($key == $categoriaId) ? : 'style="display:none"';
                $html .= '<div class="checkbox" id="categoria_especialidad_' . $key . '" '.$style.'>';
                $i = 0;
                $j = 0;
                $numEspecialidades = count($especialidad);

                foreach ($especialidad as $k => $value) {
                    $checked = (in_array($value['especialidad_id'], $checkeds)) ? ' checked="checked" ' : '';
                    if ($i == 0) {
                        $html .= '<div class="row" >';
                    }
                    //$html .= $k ."=>". $value;
                    $html .= <<<HTML
                    <div class="col-xs-6">
			<label for="{$prefix}_{$key}_{$value['especialidad_id']}" >
                            <input type="checkbox" id="{$prefix}_{$key}_{$value['especialidad_id']}" value="{$value['especialidad_id']}" name="{$prefix}_especialidad[{$key}][{$value['especialidad_id']}]" {$checked}> {$value['especialidad_nombre']} 
			</label>
                    </div>
HTML;
                    if ($i > 0 || $j >= $numEspecialidades - 1) {
                        $html .= '</div>';
                        $i = 0;
                    } else {
                        $i++;
                    }
                    $j++;
                }
                $html .= '</div>';
            }
        }
        return $html;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////	
}

//Fin class categoria
?>
