<?php

class sitio{
	#public static $db;
	public $db;

	function __construct(){
		$this->db = new DB();
	}


//////////////////////////////////////////////////////////////////////////////////////
	public function getBanners($celda = 1, $fila = 1, $jerarquia = ""){
		if(empty($jerarquia)){
			$sql = <<<SQL
				SELECT B.imagen_url, B.nombre, B.empresa_id_fk FROM banner AS B
				INNER JOIN entidad EN ON EN.entidad_id_fk = B.id AND EN.estatus = 1 AND EN.tipo='banner'
				WHERE 
				B.celda = {$celda}
				AND B.fila = {$fila}
				AND B.empresa_id_fk <= 0 		
SQL;
		}else{
			$sql = <<<SQL
				SELECT E.id, E.nombre, B.imagen_url, B.nombre, B.empresa_id_fk FROM banner AS B
				INNER JOIN empresa E ON B.empresa_id_fk = E.id 
				INNER JOIN jerarquia J ON E.jerarquia_id_fk = J.id 
				INNER JOIN entidad EN ON EN.entidad_id_fk = B.id AND EN.estatus = 1 AND EN.tipo='banner'
				INNER JOIN entidad ENT ON ENT.entidad_id_fk = E.id AND ENT.estatus = 1 AND ENT.tipo='empresa'
				WHERE 
				B.celda = {$celda}
				AND B.fila = {$fila}		
				AND J.nombre = '{$jerarquia}'
SQL;
		} 
		try{
			return $data = $this->db->execute_sql($sql);
		}catch(Exception $e){
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////
	public function createBanners(){
		$bannersArray = array();

		$bannersPremium = crearArraySQL($this->getBanners(1, 1, 'Premium'));
		$bannersArray[] = $this->createHtmlSlider($bannersPremium, 'cabecera');

		$banners = crearArraySQL($this->getBanners(2, 1));
		$html = '';
		foreach ($banners as $key => $value) {
			$html .= <<<HTML
				      <img src="{$value['imagen_url']}" alt="{$value['nombre']}">
HTML;
		}
		$bannersArray[] = $html;

		$banners = crearArraySQL($this->getBanners(3, 1));
		$html = '';
		foreach ($banners as $key => $value) {
			$html .= <<<HTML
				      <img src="{$value['imagen_url']}" alt="{$value['nombre']}" >
HTML;
		}
		$bannersArray[] = $html;

		return $bannersArray;
	}
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////
	public function getSliders($tipo){
		$sql = <<<SQL
SELECT S.id, S.imagen_url FROM slider AS S
INNER JOIN entidad E ON E.entidad_id_fk = S.id AND E.estatus = 1 AND E.tipo='slider'
WHERE S.tipo='{$tipo}'
SQL;
		try{
		return $data = $this->db->execute_sql($sql);
		}catch(Exception $e){
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////	
	public function createSliders(){
		$slidersArray = array();

		$slidersPrincipal = crearArraySQL($this->getSliders('principal'));
		$slidersArray[] = $this->createHtmlSlider($slidersPrincipal, 'slider');

		return $slidersArray;
	}
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////
	public function getLogos(){
		$sql = <<<SQL
SELECT E.id, E.logo FROM empresa AS E
INNER JOIN entidad EN ON EN.entidad_id_fk = E.id AND E.estatus = 1 AND E.tipo='empresa'
INNER JOIN categoria AS C ON C.id = E.categoria_id_fk 
INNER JOIN entidad ENT ON ENT.entidad_id_fk = C.id AND E.tipo = 'categoria'
WHERE C.nombre = '{$categoria}'
SQL;
		try{
		return $data = $this->db->execute_sql($sql);
		}catch(Exception $e){
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}		
	}
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////	
	public function createLogos(){
		$logosArray = array();

		$logos = crearArraySQL($this->getLogos());
		$logosArray[] = $this->createHtmlLogos($logos);

		return $logosArray;
	}
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////
	private function createHtmlSlider($data, $carpeta = ""){
                global $_Storage_Images, $_Storage_Images_Prefix;

                $path       = $_Storage_Images.$_Storage_Images_Prefix;
                $carpeta    = ($carpeta == "") ? : "/".$carpeta;

                $i      = 0;
		$html   = '';
		foreach ($data as $key => $value) {
			$active = ($i++ == 0) ? "active" : "";
                        $src = ($value['empresa_id_fk'] == 0) ? $value['imagen_url'] : $path.$value['empresa_id_fk'].$carpeta."/".$value['imagen_url'];
			$html .= <<<HTML
				    <div class="item {$active}">
				      <img src="{$src}" alt="{$value['nombre']}">
				      <div class="carousel-caption">
				        &nbsp;
				      </div>
				    </div>
HTML;
		}
		return $html;
	}		
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////
	
}//Fin class sitio

?>