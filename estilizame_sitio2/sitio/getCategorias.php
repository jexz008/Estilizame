<?php
try {
    $categoriaId = $_REQUEST['categoriaId'];

    $categoria = new Categoria();
    echo $selectCategorias = $categoria->selectCategorias($categoriaId, 'perfil');
        
} catch (Exception $e) {
    echo 'Excepción capturada: ' . $e->getMessage() . "\n";
}
?>