<?php
session_start();
/*if (!isset($_SESSION['xc_usuario_id']) or $_SESSION['xc_usuario_tipo']!="S"){
	header ("Location: ../index.php");
}*/
require "load.php";

$format = isset($_REQUEST['format']) ? $_REQUEST['format'] : "";
$module = isset($_REQUEST['module']) ? $_REQUEST['module'] : "";
$option = isset($_GET['option']) ? $_GET['option'] : "inicio";
$action = isset($_POST['action']) ? $_POST['action'] : "";

$sesion_id = (!isset($_SESSION['xc_usuario_id'])) ? NULL : $_SESSION['xc_usuario_id'];

$sections = array('uploadfw','reports','mydata','mail_contacto', 'registro_form','registro_registrar','pais_estados','academias');

if($module=="inicio"){
	$include = "main.php"; 
}elseif($module=="mydata"){
	$include = "mydata.php"; 		
}else{
	if(in_array($module, $sections))
	$include = "sitio/".$module.".php";
	else
	$include = "main.php";
}

if($format == "raw"){
	include $include;
}else{
?>

<!doctype html>
<html>
<?php
include "head.php";
?>

<body>
<?php
include "social.php";
include "menu.php";
?>


<?php
include $include;
?>

<!--<div style="padding-top:400px"></div>
<center><div class="ui basic button" >
<a href="mapa_de_sitio.html" class="">Mapa de Sitio</a> &nbsp;&nbsp; <a href="sitemap.xml" class="">Sitemap</a>
</div></center>-->

</body>
</html>
<?php
}
?>