<?php

$server = 'localhost';
$user   = $_appDatos['usuario'];
$psswd  = $_appDatos['pass'];
$bd     = $_appDatos['db'];

$dbconecta = mysql_connect($server, $user, $psswd) or die('Error al conectarse');
mysql_set_charset("utf8", $dbconecta);
mysql_select_db($bd, $dbconecta) or die('Error al seleccionar BD');
?>