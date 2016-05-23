<?php
session_start();
/* if (!isset($_SESSION['xc_usuario_id']) or $_SESSION['xc_usuario_tipo']!="S"){
  header ("Location: ../index.php");
  } */

require "load.php";

$format = isset($_REQUEST['format']) ? $_REQUEST['format'] : "";
$module = isset($_REQUEST['module']) ? $_REQUEST['module'] : "";
//$option = isset($_GET['option']) ? $_GET['option'] : "inicio";
$action = isset($_POST['action']) ? $_POST['action'] : "";

$sesion_id = (!isset($_SESSION[$_app->prefijo.'_usuario_id'])) ? NULL : $_SESSION[$_app->prefijo.'_usuario_id'];

$sections = array('uploadfw', 'reports', 'mydata', 'mail_contacto', 'registro_form', 'registro_registrar', 'pais_estados', 'academias'
    , 'distribuidores', 'marcas', 'salones', 'getGrid', 'login', 'perfil', 'getEspecialidades', 'registro_actualizar');

if ($module == "inicio") {
    $include = "main.php";
} elseif ($module == "mydata") {
    $include = "mydata.php";
} else {
    if (in_array($module, $sections)) {
        $_Modulo = ucwords(strtolower($module));
        $include = "sitio/" . $module . ".php";
    } else {
        $include = "main.php";
    }
}

if ($format == "raw") {
    include $include;
} else {
    ?>

    <!doctype html>
    <html>
        <?php
        include "head.php";
        ?>

        <body>
            <div class="blur-background"></div>
            <?php
            include "social.php";

            include "menu.php";

            include $include;

            include 'foot.php';
            ?>

        </body>
    </html>
    <?php
}
?>