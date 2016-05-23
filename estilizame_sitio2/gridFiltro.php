<?php
$Categoria = new Categoria();
?>
<div class="panel panel-default">
    <div class="panel-heading c-panel-header">
        <h3 class="panel-title">Filtra tu bùsqueda</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="" name="form_filtro_grid" id="form_filtro_grid">
            <input type="hidden" name="categoriaId" id="categoriaId" value="<?= $categoriaId ?>" />
            <input type="hidden" name="filtro_estado_nombre" id="filtro_estado_nombre" >
            <div class="form-group">
                <label for="filtro_estado">Estado</label>
                <?= PaisEstados::selectEstados('filtro_estado') ?>
            </div>          
            <div class="form-group">
                <label for="filtro_especialidad">Especialidad</label>
                <?= $Categoria->selectEspecialidades('filtro_especialidad', $categoriaId) ?>
            </div>
            <input class="btn" type="submit" value="buscar">
        </form>
    </div>
</div>
