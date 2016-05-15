<?php

class categoria{

	public $db;

	function __construct(){
		$this->db = new db();
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////	

	private function getCategorias(){
			$sql = <<<SQL
				SELECT C.id, C.nombre FROM categoria AS C
				INNER JOIN entidad EN ON EN.entidad_id_fk = C.id AND EN.estatus = 1 AND EN.tipo='categoria'
				ORDER BY C.nombre
SQL;
		return $data = $this->db->execute_sql($sql);

	}

	private function getCategoriaEspecialidad($categoriaId = ""){
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

	public function selectCategorias($current = ""){
		$data = crearArraySQL($this->getCategorias());
		$html = '';
		if($data){
			$html .= '<select name="registro_categoria" id="registro_categoria" class="form-control">';
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
        
	public function selectEspecialidades($name, $categoriaId = "", $current = "", $required = FALSE){
		$data = crearArraySQL($this->getCategoriaEspecialidad($categoriaId));
                $required = ($required) ? 'required="required"' : '';
		$html = '';
		if($data){
			$html .= '<select class="form-control" name="'.$name.'" id="'.$name.'" '.$required.' >';
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

        function checkboxCategoriaEspecialidad(){
		$data = crearArraySQL($this->getCategoriaEspecialidad());
		$html = '';
		if($data){
			$categoriaEspecialidad = array();
			foreach ($data as $key => $value) {
				$categoriaEspecialidad[$value['categoria_id']][] = array(
					'especialidad_id' => $value['especialidad_id'], 
					'especialidad_nombre' => $value['especialidad_nombre'] 
					);
			}
		}

#		echo "<xmp>";var_dump($categoriaEspecialidad);echo "</xmp>";
		if($categoriaEspecialidad){
			//$html .= '<select name="categoria" id="categoria" class="form-control">';
			foreach ($categoriaEspecialidad as $key => $especialidad) {
				$html .= '<div class="checkbox" id="categoria_especialidad_'.$key.'" style="display:none">';
				$i = 0;
				$j = 0;
				$numEspecialidades = count($especialidad);

				foreach ($especialidad as $k => $value) { 
					if($i == 0) { $html .= '<div class="row" >'; }
					//$html .= $k ."=>". $value;
					$html .= <<<HTML
					<div class="col-xs-6">
					    <label for="registro_{$key}_{$value['especialidad_id']}" >
					      <input type="checkbox" id="registro_{$key}_{$value['especialidad_id']}" value="{$value['especialidad_id']}" name="registro_especialidad[{$key}][{$value['especialidad_id']}]"> {$value['especialidad_nombre']} 
					    </label>
					</div>
HTML;
					if($i > 0 || $j >= $numEspecialidades-1){
						$html .= '</div>';
						$i = 0;
					}else{
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
	
	
}//Fin class categoria

?>