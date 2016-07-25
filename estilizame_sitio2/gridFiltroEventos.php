<?php
$Evento = new Evento();
?>
<div class="panel panel-default">
    <div class="panel-heading c-panel-header">
        <h3 class="panel-title">Filtra tu bùsqueda</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="" name="form_filtro_grid_eventos" id="form_filtro_grid_eventos">
            <input type="hidden" name="filtro_estado_nombre" id="filtro_estado_nombre" >
            <div class="form-group">
                <label for="filtro_estado">Estado</label>
                <?= PaisEstados::selectEstados('filtro_estado') ?>
            </div>          
            <div class="form-group">
                <label for="filtro_tipo_event">Tipo Evento</label>
                <?= $Evento->selectEventos($tipoEventoId, 'filtro') ?>
            </div>
            <input class="btn" type="submit" value="buscar">
        </form>
    </div>
</div>
