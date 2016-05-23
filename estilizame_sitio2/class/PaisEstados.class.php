<?php

class PaisEstados {

/////////////////////////////////////////////////////////////////////////////////////////////////////////////	

    public static function getEstados() {
        $sql = <<<SQL
SELECT * FROM pais_estados 
SQL;
        return $data = DB::execute_sql($sql);
    }

    public static function getMunicipios($estado) {
        $sql = <<<SQL
SELECT * FROM pais_estados_codigos
WHERE ESTADO = '{$estado}' GROUP BY MUNICIPIO
SQL;
        return $data = DB::execute_sql($sql);
    }

    public static function selectEstados($name, $current = "") {
        $data = crearArraySQL(self::getEstados());
        $html = '';
        if ($data) {
            $html .= '<select class="form-control" name="' . $name . '" id="' . $name . '" required="required">';
            $html .= '<option value="">-Selecciona Estado-</option>';
            foreach ($data as $key => $value) {
                $selected = ($value['CLAVE'] == $current) ? ' selected="selected" ' : '';
                $html .= <<<HTML
		<option value="{$value['CLAVE']}" {$selected} >{$value['ESTADO']}</option>
HTML;
            }
            $html .= '</select>';
        }
        return $html;
    }

    public static function selectMunicipios($estado, $current = "") {
        $data = crearArraySQL(self::getMunicipios($estado));
        $html = '';
        if ($data) {
            $html .= '<select class="form-control" name="registro_municipio" id="registro_municipio" required="required">';
            $html .= '<option value="">-Selecciona Municipio-</option>';
            foreach ($data as $key => $value) {
                $selected = ($value['MUNICIPIO'] == $current) ? ' selected="selected" ' : '';
                $html .= <<<HTML
		<option value="{$value['MUNICIPIO']}" {$selected} >{$value['MUNICIPIO']}</option>
HTML;
            }
            $html .= '</select>';
        }
        return $html;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
}

//Fin class PaisEstados
?>
