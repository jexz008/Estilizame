<?php

$estado = ($_POST['filtro_estado_nombre']) ? : NULL;
$especialidadId = ($_POST['filtro_especialidad']) ? : NULL;

$Empresa = new Empresa();
$gridEmresas = $Empresa->createGridEmpresas($categoriaId, $estado, $especialidadId);

echo $gridEmresas;
?>