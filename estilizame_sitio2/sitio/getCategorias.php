<?php
try {
    $categoriaId = $_REQUEST['categoriaId'];
    $prefijoSelectName = $_REQUEST['prefijoSelectName'];

    $categoria = new Categoria();
    echo $selectCategorias = $categoria->selectCategorias($categoriaId, $prefijoSelectName);

} catch (Exception $e) {
    echo 'Excepción capturada: ' . $e->getMessage() . "\n";
}
?>