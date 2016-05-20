<?php

require("config.inc.php");
require("conexion/conexion.php");
require("includes/funciones.inc.php");
require("libs/class.upload/src/class.upload.php");
$_GET = sanitize($_GET);
$_POST = sanitize($_POST);
/*require("class/db.class.php");
require("class/sitio.class.php");
require("class/sendmail.class.php");
require("class/categoria.class.php");
require("class/especialidad.class.php");
require("class/empresa.class.php");
require("class/paisestados.class.php");
require("class/login.class.php");
spl_autoload_register(function ($nombre_clase) {
    include 'class/'.$nombre_clase . '.php';
});
*/
spl_autoload_register(function ($nombre) {
    //echo "Intentando cargar $nombre.\n";
    throw new Exception("Imposible cargar $nombre.");
});
/*
try {
    $obj = new ClaseNoCargable();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}*/
?>