<?php
// Funciones PHP
/* Ing. Joel Corona Izazaga */
/* jcorona@sisneting.com.mx */

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////// FUNCIONES GENERALES /////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function diferenciaFechas($fechai,$fechaf){
	$s = strtotime($fechai)-strtotime($fechaf);
	$d = intval($s/86400);
	$s -= $d*86400;
	$h = intval($s/3600);
	$s -= $h*3600;
	$m = intval($s/60);
	$s -= $m*60;
	
	$dif= (($d*24)+$h).hrs." ".$m."min";//horas
	$dif2= $d.$space.dias." ".$h.hrs." ".$m."min";//dias
	$difh = (($d*24)+$h);
	return $difh;
}

function esMayorADosHoras($horai,$horaf){
	list($hi,$mi,$si)=explode(":",$horai);
	list($hf,$mf,$sf)=explode(":",$horaf);
	$horaInicio = mktime($hi,$mi,$si,0,0,0); //hora, minutos, segundos, mes, dia, año
	$horaFin = mktime($hf,$mf,$sf,0,0,0);
	$tsdh=abs(mktime(02,0,0,0,0,0) - mktime(0,0,0,0,0,0));
	$dif=abs($horaInicio-$horaFin);
	if($dif>$tsdh){//Es mayor a 2 horas
		return true;
	}else{
		return false;
	}

}
function diaSemana($parametro){
	switch($parametro){
	 	case 0: $dia="Domingo"; break;
		case 1: {$dia = "Lunes"; break; }
		case 2: {$dia = "Martes"; break; }
		case 3: {$dia = "Miercoles"; break; }
		case 4: {$dia = "Jueves"; break;}
		case 5: {$dia = "Viernes"; break;}
	 	case 6: $dia="Domingo"; break;
		default: {$dia = "No asignado"; break;}
	}
	return ($dia);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función encargada de crear los <option> de un select
function creaOptions($arrayOptions,$actual){
	/*print_r($arrayOptions);
	ksort($arrayOptions);*/
	foreach($arrayOptions as $key => $value){ 
		$selected=($actual==$value)?"selected":"";
		$option.="<option value=\"".$value."\" ".$selected.">".$key."</option>
"; 
	}
	return $option;
}// Fin función creaOptions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función encargada de imprimir en pantalla elementos de un array
function verArray($array){
	$array=(empty($array))?$_REQUEST:$array;
	echo "<xmp>";
	print_r($array); 
	echo "</xmp>";
}// Fin función verArray
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función encargada de crear un arreglo de la consulta
	function crearArraySQL($sql){
	$array=array();
	$query=array();
		set_time_limit(0);
		while($dato=mysql_fetch_array($sql)){
		   foreach($dato as $key => $value) {
		     $query[$key]=$value; // echo "$key: $value | "; 
		   }
		   $array[]=$query;	
		}
		mysql_free_result($sql);
		//mysql_close(); 
		return $array;
	}// Fin función crearArraySQL
	
	function crearArraySQLJSON($sql){
	$array=array();
	$query=array();
		set_time_limit(0);
		while($dato=mysql_fetch_assoc($sql)){
		   foreach($dato as $key => $value) {
		     $query[$key]=$value; // echo "$key: $value | "; 
		   }
		   $array[]=$query;	
		}
		mysql_free_result($sql);
		//mysql_close(); 
		return $array;
	}// Fin función crearArraySQL
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función encargada de borrar variables
function unsetValores($val){ //$val = array
	foreach($val as $value){
		#echo $value."<br>\n";
		unset($_POST[$value]);
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función encargada de calcular el número de días habiles entre dos fechas 

function DiasFechas($fecha_inicial,$fecha_final){ 
	/*list($dia,$mes,$year) = explode("-",$fecha_inicial); 
	$ini = mktime(0, 0, 0, $mes , $dia, $year); 
	list($diaf,$mesf,$yearf) = explode("-",$fecha_final); 
	$fin = mktime(0, 0, 0, $mesf , $diaf, $yearf); */
	list($year,$mes,$dia) = explode("-",$fecha_inicial); 
	$ini = mktime(0, 0, 0, $mes , $dia, $year); 
	list($yearf,$mesf,$diaf) = explode("-",$fecha_final); 
	$fin = mktime(0, 0, 0, $mesf , $diaf, $yearf); 

	$r = 1; 
	while($ini != $fin){ 
		$ini = mktime(0, 0, 0, $mes , $dia+$r, $year); 
		$newArray[] .=$ini;  
		$r++; 
	} 
	return $newArray; 
}


function EvaluaNoHablies($arregloFechas,$arregloFeriados=NULL) { 
	if(empty($arregloFeriados)){
		$arregloFeriados        = array( 
		'1-1',  //  Año Nuevo (irrenunciable) 
		'10-4',  //  Viernes Santo (feriado religioso) 
		'11-4',  //  Sábado Santo (feriado religioso) 
		'1-5',  //  Día Nacional del Trabajo (irrenunciable) 
		'21-5',  //  Día de las Glorias Navales 
		'29-6',  //  San Pedro y San Pablo (feriado religioso) 
		'16-7',  //  Virgen del Carmen (feriado religioso) 
		'15-8',  //  Asunción de la Virgen (feriado religioso) 
		'18-9',  //  Día de la Independencia (irrenunciable) 
		'19-9',  //  Día de las Glorias del Ejército 
		'12-10',  //  Aniversario del Descubrimiento de América 
		'31-10',  //  Día Nacional de las Iglesias Evangélicas y Protestantes (feriado religioso) 
		'1-11',  //  Día de Todos los Santos (feriado religioso) 
		'8-12',  //  Inmaculada Concepción de la Virgen (feriado religioso) 
		'13-12',  //  elecciones presidencial y parlamentarias (puede que se traslade al domingo 13) 
		'25-12',  //  Natividad del Señor (feriado religioso) (irrenunciable) 
		); 
	}

	$j= count($arregloFechas); 

	for($i=0;$i<=$j;$i++){ 
		$dia = $arregloFechas[$i]; 
        $fecha = getdate($dia); 
        $feriado = $fecha['mday']."-".$fecha['mon']; 
        if($fecha["wday"]==0 or $fecha["wday"]==6){ 
			$dia_ ++; 
      	}elseif(in_array($feriado,$arregloFeriados)){    
			$dia_++; 
        } 
	} 
	$rlt = $j - $dia_; 
	return $rlt; 
}
function diasHabiles($fechaInicio,$fechaFin){
	return EvaluaNoHablies(DiasFechas($fechaInicio,$fechaFin)); 
} //Fin function diasHabiles
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función encargada de crear un arreglo de la consulta
	function valores($tabla) {
	    $sql = mysql_query("DESCRIBE ".$tabla) or die("No se encuentra la tabla:".$tabla);
	    while ($posiciones = mysql_fetch_array($sql)){
	        $valores[] = $posiciones[0];
	    }
    return $valores;
	} //fin funcion valores
	function tabla ($arreglo, $tabla) {
		$numarr = count ($arreglo);
		echo "<strong>Valores de la tabla $tabla<br></strong>";
		for ($i=0; $i<$numarr; $i++){
			echo "$i=>$arreglo[$i]<br>";
		}
	}	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función encargada de limpiar cadena
function cleanString($string){
    $string=trim($string);
    $string=mysql_escape_string($string);
    $string=htmlentities($string);
    return $string;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Funciones para crear parte de los querys
function creaValsQuery($val){
	$dato="";
	$count=count($val);
	foreach($val as $key => $value){
		#$coma=($key<$count-1)?",":"";
		#$dato.=$val[$key].$coma;
		$dato.=$val[$key].",";
	}
	#return $dato;
	return substr($dato,0,-1);
}
function creaValuesQuery($val,$datos){
	$pr=array("CURDATE()","CURTIME()","NULL","NOW()");//Palabras reservadas para no poner comillas
	$dato="";
	$count=count($val);
	foreach($val as $key => $value){
#		$coma=($key<$count-1)?",":"";
		#$datos[$value]=(empty($datos[$value]))?"NULL":$datos[$value];// si no trae valor
		$datos[$value]=(empty($datos[$value]))?"":$datos[$value];// si no trae valor
		#$comi=($datos[$value]==$pr[0] or $datos[$value]==$pr[2])?"":"'";// poner COMILLAS
		//foreach($pr as $reserv){ $comi=($datos[$value]==$reserv)?"":"'"; }// poner COMILLAS 
		foreach($pr as $reserv){ if($datos[$value]==$reserv){$comi=""; break;}else{$comi="'";} }// poner COMILLAS 
#		$dato.=$comi.$datos[$value].$comi.$coma."\n";
		$dato.=$comi.$datos[$value].$comi.",";
	}
#	return $dato;	
	return substr($dato,0,-1);
}

function creaValsUpdate($val,$datos){
	$pr=array("CURDATE()","CURTIME()","NULL");//Palabras reservadas para no poner comillas
	unset($val[0]); //borra id que es el primer elemento del array
	$dato="";
	$count=end($val);// ultimo dato
	foreach($val as $key => $value){
		$coma=($value!=$count)?",":"";
		$datos[$value]=(empty($datos[$value]))?"NULL":$datos[$value];// si no trae valor
		$comi=($datos[$value]==$pr[0] or $datos[$value]==$pr[2])?"":"'";// poner COMILLAS
		$dato.=$value."=".$comi.$datos[$value].$comi.$coma."\n";
	}
	return $dato;
}
function creaValsBusqueda($val,$datos){
	$dato="";
	foreach($val as $key => $value){
		if(!empty($datos[$value])){
			$dato.=$value." LIKE '".$datos[$value]."%' AND \n";
		}
	}
	$dato=substr($dato,0,-5);//quita el ultimo AND
	return $dato;		
}
function creaValsForm($valtbl,$arraySql){
	foreach($valtbl as $key=>$value){
		$_POST[$value]=$arraySql[0][$value];
	}
}
function cleanupArray($arr){
	foreach($arr as $key=> $value){
		if(empty($value)) unset($arr[$key]);
	}
    return $arr;
} 

function getWeeks($d) 
{ 
    foreach(array(1=>'Monday',7=>'Sunday')as$a=>$b) 
#    $c[$b]=date('d-m-Y',strtotime('last '.$b,strtotime($d.'+'.$a.'day'))); 
    $c[$b]=date('Y-m-d',strtotime('last '.$b,strtotime($d.'+'.$a.'day'))); 
    return $c; 
} #print_r(getWeeks('29-05-2012'));

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function correo($destinatario, $subject, $mensaje, $Bcc){
	$header = "Content-Type: text/html;  charset=utf-8 \r\n"; 
	$header .= 'From: system@estilizame.com ';
	#$header=$header."X-Mailer:PHP/".phpversion()."\r\n"; 
	#$header=$header."Mime-Version: 1.0\n"; 
	#$header=$header."MIME-Version: 1.0\r\n";
	#$header=$header."Content-Type: text/html"; 
	#$headers .= "From: ".$full_name." <".$sfrom."> \n";
	$header .= "Bcc: ".$Bcc;
	@mail($destinatario,$subject,$mensaje,$header);
}

function fechaHoraMexico($timestamp){
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
$hora = strftime("%I:%M:%S %p",strtotime($timestamp));
setlocale(LC_TIME, 'spanish');
$fecha = utf8_encode(strftime("%A %d de %B del %Y",strtotime($timestamp)));
return $fecha." ".$hora;
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// SANITIZAR
function cleanInput($input) {
  $search = array(
    '@<script [^>]*?>.*?@si',            // Strip out javascript
    '@< [/!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style [^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@< ![sS]*?--[ tnr]*>@'         // Strip multi-line comments
  );
    $output = preg_replace($search, '', $input);
    return $output;
}

function sanitize($input) {
	$output = array();
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}
/* EJEMPLO
<?php
$_GET = sanitize($_GET);
$_POST = sanitize($_POST);
$cadena_final = sanitize($cadena_original);
?>*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function NumeroSemanasTieneUnAno($ano){
    $date = new DateTime;
    # Establecemos la fecha segun el estandar ISO 8601 (numero de semana)
    $date->setISODate("$ano", 53);
    # Si estamos en la semana 53 devolvemos 53, sino, es que estamos en la 52
    if($date->format("W")=="53")
        return 53;
    else
        return 52;
}

function elimina_acentos($text)
    {
        $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $text = strtolower($text);
        $patron = array (
            // Espacios, puntos y comas por guion
            //'/[\., ]+/' => ' ',
 
            // Vocales
            '/\+/' => '',
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',
 
            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',
 
            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',
 
            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',
 
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
 
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
 
            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',
 
            // Agregar aqui mas caracteres si es necesario
 
        );
 
        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////// FUNCIONES  ///////////////////////////////////////////////////////////////////////////////////////////////


/*
**********************************************************************************************
*       								SISNETING v4.0	 									 *
**********************************************************************************************
*	Autores:						            											 *
*	- Ing. Joel Corona Izazaga	jcorona@sisneting.com.mx									 *
**********************************************************************************************
*/

 