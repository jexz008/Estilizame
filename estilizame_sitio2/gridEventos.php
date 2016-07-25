<?php

$estado = ($_POST['filtro_estado_nombre']) ? : NULL;
$tipoEventoId = ($_POST['filtro_tipo_evento']) ? : NULL;

$Evento = new Evento();
$gridEvento = $Evento->createGridEventos($tipoEventoId, $estado);

echo $gridEvento;
?>