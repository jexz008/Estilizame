<?php
try {
    $categoria = new Categoria();
    $selectCategorias = $categoria->selectCategorias();
    $checkboxCategoriaEspecialidad = $categoria->checkboxCategoriaEspecialidad();
} catch (Exception $e) {
    echo 'Excepción capturada: ' . $e->getMessage() . "\n";
}
?>
<form class="form-horizontal" action="#" id="formRegistro" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />

    <div>
        <div class="alert alert-default h1-verde hidden-xs">REGÍSTRATE GRATIS 
            <h5>Los campos marcados en <span class="rojo">rojo</span> son obligatorios</h5>
        </div>
    </div>


    <div class="form-group">
        <label for="registro_empresa" class="col-sm-4 control-label">
            <i class="fa fa-building-o i-rojo"></i> Empresa ó Negocio:
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="registro_empresa" id="registro_empresa" required placeholder="Ingresa el nombre de tu empresa o negocio">
        </div>
    </div>

    <div class="form-group">
        <label for="registro_categoria" class="col-sm-4 control-label">
            <i class="fa fa-tasks i-rojo"></i> Categoria:
        </label>
        <div class="col-sm-8">
<?= $selectCategorias ?>
        </div>
    </div>

    <div class="form-group">
        <label for="registro_especialidades" class="col-sm-4 control-label">
            <i class="fa fa-list-alt i-rojo"></i> Especialidades:
        </label>
        <div class="col-sm-8">
<?= $checkboxCategoriaEspecialidad ?>
        </div>
    </div>

    <div class="form-group">
        <label for="registro_descripcion" class="col-sm-4 control-label">
            <i class="fa fa-pencil-square-o i-rojo"></i> Describe tu empresa:
        </label>
        <div class="col-sm-8">
            <textarea name="registro_descripcion" class="form-control" rows="4" cols="80" size="200" required="required" placeholder="Ingresa una descripción de tu empresa o negocio maximo 200 caracteres"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="registro_estado" class="col-sm-4 control-label">
            <i class="fa fa-globe i-rojo"></i> Estado:
        </label>
        <div class="col-sm-8">
<?= PaisEstados::selectEstados("registro_estado") ?>
            <input type="hidden" name="registro_estado_nombre" id="registro_estado_nombre" >
        </div>
    </div>

    <div class="form-group">
        <label for="registro_municipio" class="col-sm-4 control-label">
            <i class="fa fa-globe i-rojo"></i> Municipio:
        </label>
        <div class="col-sm-8" id="div_registro_municipio">

        </div>
    </div>

    <div class="form-group">
        <label for="registro_direccion" class="col-sm-4 control-label">
            <i class="fa fa-globe i-rojo"></i> Dirección:
        </label>
        <div class="col-sm-8">
            <textarea name="registro_direccion" id="registro_direccion" class="form-control" rows="4" cols="80" required="required" placeholder="Ingresa tu domicilio Completo Ejemplo: Calle, Número y Colonia."></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="registro_telefono_1" class="col-sm-4 control-label">
            <i class="fa fa-phone i-rojo"></i> Teléfono:
        </label>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-xs-4">
                    <input type="tel" class="form-control" name="registro_telefono[]" id="registro_telefono_1" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>
                </div>  
                <div class="col-xs-4">
                    <input type="tel" class="form-control" name="registro_telefono[]" id="registro_telefono_2" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>
                </div>  
                <div class="col-xs-4">
                    <input type="tel" class="form-control" name="registro_telefono[]" id="registro_telefono_3" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>
                </div>  						  		
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="registro_foto_perfil" class="col-sm-4 control-label">
            <i class="fa fa-file-image-o i-rojo"></i> Foto de Perfil:
        </label>
        <div class="col-sm-4">
            <input type="file" class="form-control" name="registro_foto_perfil" id="registro_foto_perfil" accept="image/jpg" required="required"> 
            <p class="help-block">Agrega una fotografía para tu perfil.</p>
        </div>
    </div>

    <div class="form-group">
        <label for="registro_foto_cabecera" class="col-sm-4 control-label">
            <i class="fa fa-file-image-o i-rojo"></i> Foto de cabecera:
        </label>
        <div class="col-sm-4">
            <input type="file" class="form-control" name="registro_foto_cabecera" id="registro_foto_cabecera" accept="image/jpg" required="required"> 
            <p class="help-block">Debe medir Ancho 1200px , Alto 250px</p>
        </div>
    </div>  


    <div class="form-group">
        <label for="registro_foto_galeria" class="col-sm-4 control-label">
            <i class="fa fa-picture-o"></i> Galeria de Fotos:
        </label>
        <div class="col-sm-4">
            <input type="file" class="form-control" name="registro_foto_galeria" id="registro_galeria" accept="image/jpg"> 
            <p class="help-block">(Puedes agregar más fotos a tu galeria en tu Perfil)</p>
        </div>
    </div> 

    <div class="form-group">
        <label for="registro_email" class="col-sm-4 control-label">
            <i class="fa fa-envelope i-rojo"></i> Email:
        </label>
        <div class="col-sm-8">
            <input type="mail" class="form-control" name="registro_email" id="registro_email" placeholder="Ingresa un email válido" required="required"> 
        </div>
    </div> 


    <div class="form-group">
        <label for="registro_password" class="col-sm-4 control-label">
            <i class="fa fa-lock i-rojo"></i> Contraseña:
        </label>
        <div class="col-sm-4">
            <input type="password" class="form-control" name="registro_password" id="registro_password" placeholder="Contraseña minimo de 8 caracteres" required="required"> 
        </div>
    </div>

    <div class="form-group">
        <label for="registro_password2" class="col-sm-4 control-label">
            <i class="fa fa-lock i-rojo"></i> Confirma Contraseña:
        </label>
        <div class="col-sm-4">
            <input type="password" class="form-control" name="registro_password2" id="registro_password2" placeholder="Confirma tu contraseña" required="required"> 
        </div>
    </div>

    <div class="form-group">
        <label for="registro_ubicacion" class="col-sm-4 control-label">
            <i class="fa fa-map-marker"></i> Ubicación en google maps:
        </label>
        <div class="col-sm-8">
            <textarea class="form-control" name="registro_ubicacion" id="registro_ubicacion" placeholder="Introduce el enlance de Google Maps"></textarea>
            <p class="help-block"><button type="button" class="btn btn-warning" data-toggle="popover-maps" title="Ubicación en google maps"><i class="fa fa-info-circle"></i></button></p>
        </div>
    </div>
    <div id="content-popover-maps" class="my-popover-content">
        <h4>Completa los siguientes pasos para subir tu Ubicación</h4>
        <ol>
            <li>Ingresa a : www.google.com</li>
            <li>Escribe tu dirección en la barra del buscador</li>
            <li>Cuando obtengas el resultado de tu búsqueda selecciona la opción de MAPS. (Esta opción se encuentra justo debajo de la barra de búsquedas en donde escribiste tu dirección)</li>
            <li>Despliega las opciones de Google Maps. (Es el botón de menú que está ubicado dentro de la barra de búsqueda de google maps en la parte izquierda)</li>
            <li>Selecciona la opción de Compartir o Insertar Mapa lo que te abrirá una pequeña ventana de color blanco en donde tendrás dos opciones compartir enlace o insertar mapa.</li>
            <li>Da click en la opción de insertar mapa, esto cambiara el aspecto de la ventana que tenías abierta mostrándote una imagen de tu mapa.</li>
            <li>Copia el texto que aparece en la barra y pégalo en la sección de Ingresa tu nueva ubicación.</li>
            <li>Presiona el botón de Guardar Cambios para concretar la operación.</li>
        </ol>
    </div>

    <div class="form-group">
        <label for="registro_video" class="col-sm-4 control-label">
            <i class="fa fa-youtube-square"></i> Video de tus trabajos:
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="registro_video" id="registro_video" placeholder="Introduce el ID de tu video de Youtube">
            <p class="help-block"><button type="button" class="btn btn-warning" data-toggle="popover-video" title="Video de tus trabajos"><i class="fa fa-info-circle"></i></button></p>
        </div>
    </div>
    <div id="content-popover-video" class="my-popover-content">
        <h4>Completa los siguientes pasos para subir tu Video</h4>
        <ol>
            <li>Ingresa en: www.youtube.com</li>
            <li>Busca tu video</li>
            <li>Copia el ID de la URL de tu video. (el ID de la URL es el texto consecutivo al signo “=“ ejemplo: en la URL https://www.youtube.com/watch?v=4n4FBVX59Kc el ID es 4n4FBVX59Kc</li>
            <li>Pega unicamente el ID de tu video y presiona el boton de Guardar Cambios.</li>
        </ol>
    </div>

    <div class="form-group">
        <label for="registro_facebook" class="col-sm-4 control-label">
            <i class="fa fa-facebook-official"></i> Facebook:
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="registro_facebook" id="registro_facebook" placeholder="Introduce la URL de Facebook"> 
        </div>
    </div>

    <div class="form-group">
        <label for="registro_twitter" class="col-sm-4 control-label">
            <i class="fa fa-twitter-square"></i> Twitter:
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="registro_twitter" id="registro_twitter" placeholder="Introduce la URL de Twitter"> 
        </div>
    </div>

    <div class="form-group">
        <label for="registro_google" class="col-sm-4 control-label">
            <i class="fa fa-google-plus-square"></i> Google+:
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="registro_google" id="registro_google" placeholder="Introduce la URL de Google Plus"> 
        </div>
    </div>  

    <div class="form-group">
        <label for="registro_instagram" class="col-sm-4 control-label">
            <i class="fa fa-instagram"></i> Instagram:
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="registro_instagram" id="registro_instagram" placeholder="Introduce la URL de Instagram"> 
        </div>
    </div> 

    <div class="form-group">
        <label for="registro_terminos" class="col-sm-4 control-label">
            <a href="terminos_condiciones_estilizame.pdf"><i class="fa fa-download i-rojo"></i> Descargar aquí. Terminos, condiciones y politicas de privacidad:</a>
        </label>
        <div class="col-sm-8">
            <input type="checkbox" class="check" name="registro_terminos" id="registro_terminos" value="tyce" required="required"> Acepto Terminos, condiciones y politicas de privacidad 
        </div>
    </div> 
</form>

<!--
<div class="row"> \n\
        <div class="col-md-6"> \n\
                <div class="form-group"><input type="email" name="login_mail" class="form-control" placeholder="Email" required></div> \n\
                <div class="form-group"><input type="password" name="login_password" class="form-control" placeholder="Contraseña" required></div> \n\
        </div> \n\
</div>';-->