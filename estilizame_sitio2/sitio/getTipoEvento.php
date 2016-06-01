<?php
try {
    $categoriaId = $_REQUEST['categoriaId'];

    $Evento = new Evento();
    echo $selectEventos = $Evento->selectEventos();

} catch (Exception $e) {
    echo 'Excepción capturada: ' . $e->getMessage() . "\n";
}
?>