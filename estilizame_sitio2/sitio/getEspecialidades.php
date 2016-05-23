<?php
try {
    $categoriaId = $_REQUEST['categoriaId'];
    $empresaId = $_REQUEST['empresaId'];

    $Empresa = new Empresa();
    $empresaEspcialidades = crearArraySQLJSON($Empresa->getEmpresaEspecialidades($empresaId));
    $eEspecialidades = array();
    foreach($empresaEspcialidades as $key => $val){
        $eEspecialidades[] = $val['id'];
    }

    $categoria = new categoria();
    echo $checkboxCategoriaEspecialidad = $categoria->checkboxCategoriaEspecialidad($categoriaId, $eEspecialidades, 'perfil');
    
} catch (Exception $e) {
    echo 'Excepción capturada: ' . $e->getMessage() . "\n";
}
?>