$(document).ajaxStart(function () {
    //html = '<div id="ajax-loader" style="position:fixed; z-index:10000000; top:1px; left:1px; "><div style="margin:auto; text-align:center;  "><img src="img/ajax-loader.gif" alt="LOADING" /></div></div>';
    var html = '<div id="ajax-loader" style="position:fixed; z-index:999999999999999; top:1px; left:1px; text-shadow:0 0 10px #08088A, 0 0 14px #81bef7; color:white "><div style="margin:auto; text-align:center;  "><i class="fa fa-spinner fa-5x fa-spin fa-fw" aria-hidden="true"></i><span class="sr-only">Cargando...</span></div></div>';
    //$("html").append(html);
    $("body").append(html);
});
$(document).ajaxStop(function () {
    $("#ajax-loader").remove();
});



$(document).ready(function () {
    modales();
    //setRegistro();
    //formContactanos();
    //formLogin();
    filtroEmpresas();

    $("a.grouped_elements").fancybox({
		/*'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'	:	600,
		'speedOut'	:	200,
		//'overlayShow'	:	false*/
                'showCloseButton': false,
        	'titlePosition' : 'inside',
                'titleFormat'	: function(title, currentArray, currentIndex, currentOpts) { console.log("fancy");
    return '<div id="tip7-title"><span><a href="javascript:;" onclick="$.fancybox.close();"><img src="/data/closelabel.gif" /></a></span>' + (title && title.length ? '<b>' + title + '</b>' : '' ) + 'Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</div>';
                }
    });
});

// Carousel Bootstrap
$('.carousel').carousel({
    interval: 2000
});

var attrsPerfil = {
    'btnFormPerfilUpdateNombreEmpresa': 'Nombre Empresa',
    'btnFormPerfilUpdateCategoria': 'Categoria',
    'btnFormPerfilUpdateEspecialidades': 'Especialidades',
    'btnFormPerfilUpdateDescripcion': 'Descripción',
    'btnFormPerfilUpdateEstado': 'Estado',
    'btnFormPerfilUpdateMunicipio': 'Municipio',
    'btnFormPerfilUpdateDireccion': 'Dirección',
    'btnFormPerfilUpdateTelefono': 'Teléfonos',
    'btnFormPerfilUpdateFPerfil': 'Foto de perfil',
    'btnFormPerfilUpdateFCabecera': 'Foto de cabecera',
    'btnFormPerfilUpdateGaleria': 'Galeria de imagenes',
    'btnFormPerfilUpdateEmail': 'Email',
    'btnFormPerfilUpdatePass': 'Contraseña',
    'btnFormPerfilUpdateUbicacion': 'Ubicación',
    'btnFormPerfilUpdateVideo': 'Video',
    'btnFormPerfilUpdateFacebook': 'Facebook',
    'btnFormPerfilUpdateTwitter': 'Twitter',
    'btnFormPerfilUpdateGoogle': 'Google+',
    'btnFormPerfilUpdateInstagram': 'Instragram',
};

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///// Modales
function modales() {
    $('#myModal').on('shown.bs.modal', function (event) {
        var html = '';
        var title = '';
        var footer = '';
        var action = '';
        var large = false;

        var boton = $(event.relatedTarget);
        var id = boton.attr('id');

        switch (id) {
            case 'btnFormContactUs':
                title = 'Contáctanos';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formContactanos" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="text" name="contacto_nombre" class="form-control" placeholder="Nombre" required></div></div> \n\
                          <div class="form-group"><div class="col-sm-12"><input type="email" name="contacto_mail" class="form-control" placeholder="Email" required></div></div> \n\
                          <div class="form-group"><div class="col-sm-12"><input type="tel" name="contacto_telefono" class="form-control" placeholder="Teléfono" required></div></div> \n\
                          <div class="form-group"><div class="col-sm-12"><textarea name="name" name="contacto_mensaje" class="form-control" placeholder="Escribenos un comentario" required></textarea></div></div> \n\
                       </form>\n\
                    ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" id="btnSendMailContact" data-loading-text="Loading...">Enviar</button>\
                    ';
                break;
            case 'btnModalNosotros':
                title = 'SOBRE NOSOTROS';
                html = ' \n\
                    <p>Somos el promotor más importante de profesionistas, marcas, distribuidores y eventos dedicados a la belleza. </p>\n\
                    <p>Damos a conocer las últimas y más importantes tendencias en la industria, ofreciendo a nuestros usuarios una red proveedores, consumidores y profesionistas por medio de la web.</p>\n\
                    <p>Te invitamos a formar parte de ESTILIZAME y darte a conocer en el medio.</p>';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    ';
                break;
            case 'btnFormSignIn':
                title = 'INICIAR SESION';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formLogin" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="email" name="login_mail" class="form-control" placeholder="Email" required></div></div> \n\
                          <div class="form-group"><div class="col-sm-12"><input type="password" name="login_password" class="form-control" placeholder="Contraseña" required></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnSigIn" data-loading-text="Loading...">Iniciar Sesión</button>\
                    ';
                break;
            case 'btnFormSignUp':
                title = 'REGISTRATE';
                html = getFormRegistro();
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnSignUp">Registrarme</button>\
                    ';
                large = true;
                break;
            case 'btnFormUpdatePerfil':
                title = 'ELIGE UNA SECCION A EDITAR';
                html = '';
                for (var key in attrsPerfil) {
                    html += ' \n\
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPerfilUpdate" id="'+key+'" style="margin:10px"> \n\
                        '+attrsPerfil[key]+' \n\
                    </button>';
                }
                large = true
                break;
        }
        $("#myModal .modal-body").html(html);
        $("#myModal .modal-title").html(title);
        $("#myModal .modal-footer").html(footer);
        $("#myModal form input:enabled:visible:first").focus();
        if (large) {
            $("#myModal").addClass('bs-example-modal-lg');
            $("#myModal .modal-dialog").addClass('modal-lg');
        } else {
            $("#myModal").removeClass('bs-example-modal-lg');
            $("#myModal .modal-dialog").removeClass('modal-lg');
        }
        // Eventos
        switch (id) {
            case 'btnFormContactUs':
                $("#btnSendMailContact").on("click", formContactanos);
            break;
            case 'btnFormSignIn':
                $("#btnSigIn").on("click", formLogin);
            break;
            case 'btnFormSignUp':
                $("#btnSignUp").on("click", setRegistro);
            break;
        }

    });
    $('#myModal').on('hidden.bs.modal', function (event) {
        $("#myModal .modal-body").empty();
    });
// modal 2
    $('#modalPerfilUpdate').on('shown.bs.modal', function (event) {
        var html = '';
        var title = '';
        var footer = '';
        var action = '';
        var large = false;

        var boton = $(event.relatedTarget);
        var id = boton.attr('id');
        switch(id){
            case 'btnFormPerfilUpdateNombreEmpresa':
                title = 'Cambia el nombre de tu empresa';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="text" class="form-control" name="perfil_empresa" id="perfil_empresa" value="' + $("#hdnPerfilNombre").val() + '" required placeholder="Ingresa el nombre de tu empresa o negocio"> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdateCategoria':
                var getCategorias =  function(){
                        var categoriaId = $("#hdnPerfilCategoriaId").val();
                        $.get('index.php?module=getCategorias&format=raw', {'categoriaId':categoriaId, 'prefijoSelectName':'perfil'}, function(data){
                            $('#formPerfilUpdate').html(data);
                        });
                };
                getCategorias();
                title = 'Cambia de categoria';
                html = '<i class="fa fa-spinner fa-spin"></i>';
                break;
            case 'btnFormPerfilUpdateEspecialidades':
                var getEspecialidades =  function(){
                        var categoriaId = $("#hdnPerfilCategoriaId").val();
                        var empresaId = $("#hdnPerfilId").val();
                        $.get('index.php?module=getEspecialidades&format=raw', {'categoriaId':categoriaId, 'empresaId':empresaId}, function(data){
                            $('#formPerfilUpdate').html(data);
                        });
                };
                getEspecialidades();
                title = 'Cambiar especialidades';
                html = '<i class="fa fa-spinner fa-spin"></i>';
                break;
            case 'btnFormPerfilUpdateDescripcion':
                title = 'Cambiar descripción';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <textarea name="perfil_descripcion" id="perfil_descripcion" class="form-control" rows="4" cols="80" size="200" required="required" placeholder="Ingresa una descripción de tu empresa o negocio maximo 200 caracteres">' + $('#hdnPerfilDescripcion').val() +'</textarea> \n\
                        </div></div>\n\ ';
                break;
            case 'btnFormPerfilUpdateEstado':
                var getEstados =  function(){
                        var estadoId = $("#hdnPerfilEstado").val();
                        $.get('index.php?module=pais_estados&action=getEstados&format=raw&selectNameEstado=perfil_estado', {'estado':estadoId}, function(data){
                            var html = '<input type="hidden" name="perfil_estado_nombre" id="perfil_estado_nombre" > \n\
                                        <input type="hidden" name="perfil_municipio_nombre" id="perfil_municipio_nombre" >';
                            var htmlMun = '<div id="div_perfil_municipio"></div>';
                            $('#formPerfilUpdate').html(html + data.html + htmlMun );
                            changeEstado('perfil', true);
                        }, 'json');
                };
                getEstados();
                title = 'Cambiar estado';
                html = '<i class="fa fa-spinner fa-spin"></i>';
                break;
            case 'btnFormPerfilUpdateMunicipio':
                var getMunicipios =  function(){
                        var estado = $("#hdnPerfilEstado").val();
                        var municipio = $("#hdnPerfilMunicipio").val();
                        $.get('index.php?module=pais_estados&action=getMunicipios&format=raw&selectNameMunicipio=perfil_municipio', {'estado':estado, 'municipio':municipio}, function(data){
                            $('#formPerfilUpdate').html(data.html);
                        }, 'json');
                };
                getMunicipios();
                title = 'Cambiar municipio';
                html = '<i class="fa fa-spinner fa-spin"></i>';
                break;
            case 'btnFormPerfilUpdateDireccion':
                title = 'Cambiar dirección';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <textarea name="perfil_direccion" id="perfil_direccion" class="form-control" rows="4" cols="80" required="required" placeholder="Ingresa tu domicilio Completo Ejemplo: Calle, Número y Colonia.">' + $("#hdnPerfilDireccion").val() + '</textarea> \n\
                        </div></div>\n\ ';
                break;
            case 'btnFormPerfilUpdateTelefono':
                title = 'Cambiar teléfonos';
                html = '<div class="form-group"><div class="col-sm-12">\n\
                            <div class="row">\n\
                                <div class="col-xs-4">\n\
                                    <input type="tel" class="form-control" name="perfil_telefono[]" value="' + $("#hdnPerfilTelefono1").val() + '" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>\n\
                                </div> \n\
                                <div class="col-xs-4">\n\
                                    <input type="tel" class="form-control" name="perfil_telefono[]" value="' + $("#hdnPerfilTelefono2").val() + '" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>\n\
                                </div>  \n\
                                <div class="col-xs-4"> \n\
                                    <input type="tel" class="form-control" name="perfil_telefono[]" value="' + $("#hdnPerfilTelefono3").val() + '" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>\n\
                                </div>\n\
                          </div></div></div> \n\ ';
                break;

            case 'btnFormPerfilUpdateFPerfil':
                title = 'Cambiar foto de perfil';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                            <input type="hidden" name="perfil_foto_perfil_actual" id="perfil_foto_perfil_actual" value="' + $("#hdnPerfilFoto").val() + '" > \n\
                            <img class="img-responsive img-rounded center-block" src="' + $("#hdnPerfilFotoSrc").val() + '"> \n\
                            <input type="file" class="form-control" name="perfil_foto_perfil" accept="image/jpg" required="required"> \n\
                        </div></div> \n\  ';
                break;
            case 'btnFormPerfilUpdateFCabecera':
                title = 'Cambiar foto de Cabecera';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                            <input type="hidden" name="perfil_foto_cabecera_actual" id="perfil_foto_cabecera_actual" value="' + $("#hdnPerfilCabecera").val() + '" > \n\
                            <img class="img-responsive img-rounded center-block" src="' + $("#hdnPerfilCabeceraSrc").val() + '"> \n\
                            <input type="file" class="form-control" name="perfil_foto_cabecera" accept="image/jpg" required="required"> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdateGaleria':
                title = 'Cambiar fotos de Galeria';
                html =  $("#perfilGaleria").html()+ ' \n <input type="file" class="form-control" name="perfil_foto_galeria" accept="image/jpg" required="required"> \n\ ';
                large = true;
                break;

            case 'btnFormPerfilUpdateEmail':
                title = 'Cambiar email';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="email" name="perfil_email" id="perfil_email" value="' + $("#hdnPerfilEmail").val() + '" class="form-control" placeholder="Email" required /> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdatePass':
                title = 'Cambiar contraseña';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="password" name="perfil_contrasena3" id="perfil_contrasena3" class="form-control" placeholder="Contraseña actual" required /> \n\
                          <input type="password" name="perfil_contrasena" id="perfil_contrasena" class="form-control" placeholder="Contraseña nueva" required /> \n\
                          <input type="password" name="perfil_contrasena2" id="perfil_contrasena2" class="form-control" placeholder="Repetir Contraseña" required /> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdateUbicacion':
                title = 'Cambiar ubicacion';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <textarea class="form-control" name="perfil_ubicacion" id="perfil_ubicacion" value="' + $("#hdnPerfilUbicacion").val() + '" placeholder="Introduce el enlance de Google Maps"></textarea> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdateVideo':
                title = 'Cambiar Video';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="text" class="form-control" name="perfil_video" id="perfil_video" value="' + $("#hdnPerfilVideo").val() + '" placeholder="Introduce el ID de tu video de Youtube"> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdateFacebook':
                title = 'Cambiar Facebook';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="text" class="form-control" name="perfil_facebook" id="perfil_facebook" value="' + $("#hdnPerfilFacebook").val() + '" placeholder="Introduce la URL de Facebook">  \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdateTwitter':
                title = 'Cambiar Twitter';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="text" class="form-control" name="perfil_twitter" id="perfil_twitter" value="' + $("#hdnPerfilTwitter").val() + '" placeholder="Introduce la URL de Twitter"> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdateGoogle':
                title = 'Cambiar Google';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="text" class="form-control" name="perfil_google" id="perfil_google" value="' + $("#hdnPerfilGoogle").val() + '" placeholder="Introduce la URL de Google Plus"> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPerfilUpdateInstagram':
                title = 'Cambiar Instagram';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="text" class="form-control" name="perfil_instagram" id="perfil_instagram" value="' + $("#hdnPerfilInstagram").val() + '" placeholder="Introduce la URL de Instagram"> \n\
                        </div></div> \n\ ';
                break;
            case 'btnFormPromociones':
                var getCategorias =  function(){
                        var categoriaId = $("#hdnPerfilCategoriaId").val();
                        $.get('index.php?module=getCategorias&format=raw', {'categoriaId':categoriaId, 'prefijoSelectName':'promocion'}, function(data){
                            $('#divPromocionCategoria').html(data);
                        });
                };
                getCategorias();
                title = 'Registrar Promoción';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="text" class="form-control" name="promocion_nombre" id="promocion_nombre" placeholder="Nombre promoción" required="required"> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12" id="divPromocionCategoria"> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12"> \n\
                            <input type="file" class="form-control" name="promocion_imagen" id="promocion_imagen" accept="image/jpg" required="required" placeholder="Imagen"> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12"> \n\
                            <textarea class="form-control" name="promocion_descripcion" id="promocion_descripcion" required="required" placeholder="Descripción"></textarea> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12"> \n\
                            <input type="date" class="form-control" name="promocion_fecha_fin" id="promocion_fecha_fin" placeholder="Finaliza en"> \n\
                        </div></div> \n\
                        ';
                break;
            case 'btnFormEventos':
                var getEstados =  function(){
                        $.get('index.php?module=pais_estados&action=getEstados&format=raw&selectNameEstado=evento_estado', function(data){
                            var html = '<input type="hidden" name="evento_estado_nombre" id="evento_estado_nombre" > \n\
                                        <input type="hidden" name="evento_municipio_nombre" id="evento_municipio_nombre" >';
                            $('#eventoSelectEstado').html(html + data.html );
                            changeEstado('evento', true);
                        }, 'json');
                };
                var getTiposEvento =  function(){
                        $.get('index.php?module=getTipoEvento&action=getSelectTiposEventos&format=raw', function(data){
                            $('#eventoSelectTipoEvento').html( data );
                        });
                };
                getEstados();
                getTiposEvento();

                title = 'Registrar Evento';
                html = '<div class="form-group"><div class="col-sm-12"> \n\
                          <input type="text" class="form-control" name="evento_nombre" id="evento_nombre" placeholder="Nombre evento"> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12"> \n\
                            <textarea class="form-control" name="evento_descripcion" id="evento_descripcion" required="required" placeholder="Descripción"></textarea> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-6"> \n\
                            <input type="date" class="form-control" name="evento_fecha_ini" id="evento_fecha_ini" placeholder="Fecha de inicio"> \n\
                        </div><div class="col-sm-6">\n\
                            <input type="time" class="form-control" name="evento_hora_ini" id="evento_hora_ini" placeholder="Hora de inicio"> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-6"> \n\
                            <input type="date" class="form-control" name="evento_fecha_fin" id="evento_fecha_fin" placeholder="Fecha de termino"> \n\
                        </div><div class="col-sm-6"> \n\
                            <input type="date" class="form-control" name="evento_hora_fin" id="evento_hora_fin" placeholder="Hora de termino"> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12" id="eventoSelectTipoEvento"> \n\
                            <i class="fa fa-spinner fa-spin"></i> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12" id="eventoSelectEstado"> \n\
                            <i class="fa fa-spinner fa-spin"></i> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12" id="div_evento_municipio"> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12"> \n\
                            <textarea class="form-control" name="evento_direccion" id="evento_direccion" required="required" placeholder="Dirección"></textarea> \n\
                        </div></div> \n\
                        <div class="form-group"><div class="col-sm-12"> \n\
                            <input type="file" class="form-control" name="evento_imagen" id="evento_imagen" accept="image/jpg" > \n\
                        </div></div> \n\
                        ';
                break;
        }

        var htmlForm  = '<form class="form-horizontal" action="#" id="formPerfilUpdate" method="post" enctype="multipart/form-data">' + html + '</form>';
        footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdate" data-loading-text="Loading...">Guardar</button>\
                    ';
        $("#modalPerfilUpdate .modal-body").html(htmlForm);
        $("#modalPerfilUpdate .modal-title").html(title);
        $("#modalPerfilUpdate .modal-footer").html(footer);
        $("#modalPerfilUpdate form input:enabled:visible:first").focus();
        if (large) {
            $("#modalPerfilUpdate").addClass('bs-example-modal-lg');
            $("#modalPerfilUpdate .modal-dialog").addClass('modal-lg');
        } else {
            $("#modalPerfilUpdate").removeClass('bs-example-modal-lg');
            $("#modalPerfilUpdate .modal-dialog").removeClass('modal-lg');
        }
        // Eventos
        switch (id) {
            case 'btnFormPromociones':
                $(function() { $( "#promocion_fecha_fin" ).datepicker(); });
                $("#btnPerfilUpdate").on("click", formPromocion);
            break;
            case 'btnFormEventos':
                $(function() { $( "#evento_fecha_ini" ).datepicker(); });
                $(function() { $( "#evento_fecha_fin" ).datepicker(); });
                $("#btnPerfilUpdate").on("click", formEvento);
            break;
            case 'btnFormPerfilUpdateGaleria':
                $("#formPerfilUpdate .ico-del-img").show();
            //    break;
            default:
                $("#btnPerfilUpdate").on("click", formUpdatePerfil);
            break;
        }
    });
    $('#modalPerfilUpdate').on('hidden.bs.modal', function (event) {
        $("#modalPerfilUpdate .modal-body").empty();
    });

}


function deleteImg(imagen, id){

    if (confirm("¿Seguro que quieres eliminar esta foto? \n Una vez eliminada no podrá recuperarse.")) {
        var empresaId = $("#hdnPerfilId").val();
        var id = 'galeria_' + empresaId + '_' + id;
        $.ajax({
            url: 'index.php?module=registro_actualizar&format=raw',
            type: 'POST',
            data: {'borra_foto_galeria':imagen, 'empresaId':empresaId},
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.success) {
                    //$('#' + id).remove();
                    $('div[id^=' + id + ']').remove();
                    alert(data.message);
                } else {
                    alert("ERROR: " + data.message);
                    $("#btnPerfilUpdate").button('reset');
                    $("#formPerfilUpdate").off();
                }
            }
        });
    }
}

/// Evento
function formEvento(){
      $("#formPerfilUpdate").on("submit", function(event){
        event.stopPropagation();
        event.preventDefault();
        $("#btnPerfilUpdate").button('loading');//.hide();
        var formData = new FormData(this);

        $.ajax({
            //url: 'index.php?module=registro_actualizar&format=raw&empresaId=' + $("#hdnPerfilId").val() + '&categoriaId='+$("#hdnPerfilCategoriaId").val(),
            url: 'index.php?module=registro_evento&format=raw&empresaId=' + $("#hdnPerfilId").val() + '&categoriaId='+$("#hdnPerfilCategoriaId").val() + '&perfil_nombre_actual='+$("#hdnPerfilNombre").val(),
            type: 'POST',
            //data: $(this).serialize(),
            dataType: 'JSON',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data.success) {
                    alert(data.message);
                    //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    $("modalPerfilUpdate .modal-body").empty();
                    $("modalPerfilUpdate .modal-title").empty();
                    $("modalPerfilUpdate .modal-footer").empty();
                    $('#modalPerfilUpdate').modal('hide');
                    location.reload();
                } else {
                    alert("ERROR: " + data.message);
                    $("#btnPerfilUpdate").button('reset');//show();
                    $("#formPerfilUpdate").off();
                }
            }
        });
    });
    $("#formPerfilUpdate").submit();
}

/// Promocion
function formPromocion(){
      $("#formPerfilUpdate").on("submit", function(event){
        event.stopPropagation();
        event.preventDefault();
        $("#btnPerfilUpdate").button('loading');//.hide();
        var formData = new FormData(this);

        $.ajax({
            //url: 'index.php?module=registro_actualizar&format=raw&empresaId=' + $("#hdnPerfilId").val() + '&categoriaId='+$("#hdnPerfilCategoriaId").val(),
            url: 'index.php?module=registro_promocion&format=raw&empresaId=' + $("#hdnPerfilId").val() + '&categoriaId='+$("#hdnPerfilCategoriaId").val() + '&perfil_nombre_actual='+$("#hdnPerfilNombre").val(),
            type: 'POST',
            //data: $(this).serialize(),
            dataType: 'JSON',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data.success) {
                    alert(data.message);
                    //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    $("modalPerfilUpdate .modal-body").empty();
                    $("modalPerfilUpdate .modal-title").empty();
                    $("modalPerfilUpdate .modal-footer").empty();
                    $('#modalPerfilUpdate').modal('hide');
                    location.reload();
                } else {
                    alert("ERROR: " + data.message);
                    $("#btnPerfilUpdate").button('reset');//show();
                    $("#formPerfilUpdate").off();
                }
            }
        });
    });
    $("#formPerfilUpdate").submit();
}
//  Update Perfil
function formUpdatePerfil(){
      $("#formPerfilUpdate").on("submit", function(event){
        event.stopPropagation();
        event.preventDefault();
        $("#btnPerfilUpdate").button('loading');//.hide();
        var formData = new FormData(this);

        $.ajax({
            url: 'index.php?module=registro_actualizar&format=raw&empresaId=' + $("#hdnPerfilId").val() + '&categoriaId='+$("#hdnPerfilCategoriaId").val()+ '&perfil_nombre_actual='+$("#hdnPerfilNombre").val(),
            type: 'POST',
            //data: $(this).serialize(),
            dataType: 'JSON',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data.success) {
                    alert(data.message);
                    //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    $("modalPerfilUpdate .modal-body").empty();
                    $("modalPerfilUpdate .modal-title").empty();
                    $("modalPerfilUpdate .modal-footer").empty();
                    $('#modalPerfilUpdate').modal('hide');
                    location.reload();
                    /*// Actualizando
                    $('.' + data.content + ':not(a)').text(data.value);
                    $('#' + data.hdnField).val(data.value);
                    $('a .' + data.content).attr('href',data.value);
                    if(data.value != ""){ $('.' + data.content).css('visibility',''); alert();}else{ $('.' + data.content).css('visibility','hidden'); }
                    */
                } else {
                    alert("ERROR: " + data.message);
                    $("#btnPerfilUpdate").button('reset');//show();
                    $("#formPerfilUpdate").off();
                }
            }
        });
    });
    $("#formPerfilUpdate").submit();
}

function formContactanos() {
      $("#formContactanos").on("submit", function(event){
        event.stopPropagation();
        event.preventDefault();
        $("#btnSendMailContact").button('loading');//.hide();
        $.ajax({
            url: 'index.php?module=mail_contacto&action=mail_contacto&format=raw',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.success) {
                    alert("Mensaje enviado correctamente.");
                    //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    $("#myModal .modal-body").empty();
                    $("#myModal .modal-title").empty();
                    $("#myModal .modal-footer").empty();
                    $('#myModal').modal('hide');
                } else {
                    alert("ERROR: " + data.message);
                    $("#btnSendMailContact").button('reset');//show();
                    $("#formContactanos").off();
                    //alert("ERROR: Error when trying to change status");
                }
            }
        });
        //return false;
    });
    $("#formContactanos").submit();
}
function getFormRegistro() {
    var html;
    $("form-horizontal").attr("enctype", "multipart/form-data");
    $.ajax({
        url: 'index.php?module=registro_form&action=registro_form&format=raw',
        type: 'POST',
        dataType: 'html',
        success: function (data) {
            if (data) {
                html = data;
                $("#myModal .modal-body").html(html);
                changeCategoria();
                changeEstado('registro', true);
                //setRegistro();

                $('[data-toggle="popover-maps"]').popover({
                    html: true,
                    content: function () {
                        return content = $("#content-popover-maps").html();
                    },
                });
                $('[data-toggle="popover-video"]').popover({
                    html: true,
                    content: function () {
                        return content = $("#content-popover-video").html();
                    },
                });

            } else {
                alert("ERROR: al intentar obtener el formulario de registro.");
            }
        }
    });
    return html;
}
function changeCategoria() {
    $("#registro_categoria").on("change", function () {
        var categoriaId = $(this).val();
        $("div.checkbox[id^='categoria_especialidad_']").hide();
        $("#categoria_especialidad_" + categoriaId).show();
    });
}
function changeEstado(selectName, load) {
    var selectName = (selectName == "") ? "registro" : selectName;
    var load = (load) ? true : false;
    $("#" + selectName + "_estado").on("change", function () {

        $("#" + selectName + "_estado_nombre").val($("#" + selectName + "_estado option:selected").text());
        var estado = $("#" + selectName + "_estado").val();

        if(load){
            $('#div_' + selectName + '_municipio').html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                url: 'index.php?module=pais_estados&action=getMunicipios&format=raw&selectNameMunicipio=' + selectName + '_municipio',
                type: 'POST',
                data: {'estado': estado},
                dataType: 'JSON',
                success: function (data) {
                    if (data.success) {
                        console.log(data);
                        $('#div_' + selectName + '_municipio').html(data.html);
                        changeMunicipio(selectName);
                    } else {
                        alert("ERROR: " + data.message);
                    }
                }
            });
        }
    });
}
function changeMunicipio(selectName){
    $("#" + selectName + "_municipio").on("change", function () {
        $("#" + selectName + "_municipio_nombre").val($("#" + selectName + "_municipio option:selected").text());
    });
}

function setRegistro() { 

    $("form#formRegistro").on("submit", function (event) {
        event.stopPropagation();
        event.preventDefault();
        $("#btnSignUp").button('loading');//hide();
        var formData = new FormData(this);
        //var formData = new FormData(document.getElementById('form_modal'));
        //formData.append("dato", "valor");
        $.ajax({
            url: 'index.php?module=registro_registrar&action=registro_registrar&format=raw',
            type: 'POST',
            data: formData, ///$( this ).serialize(),
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data.success) {
                    alert(data.message);
                    //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    $("#myModal .modal-body").empty();
                    $("#myModal .modal-title").empty();
                    $("#myModal .modal-footer").empty();
                    $('#myModal').modal('hide');
                } else {
                    alert("ERROR: " + data.message);
                    //alert("ERROR: Error when trying to change status");
                    $("#btnSignUp").button('reset');;
                    $("#formRegistro").off();                    
                }
            }
        });
        //return false;         
    });
    $("#formRegistro").submit();    
}

function formLogin() {

    $("#formLogin").on("submit", function (event) {
        event.stopPropagation();
        event.preventDefault();
        $("#btnSigIn").button('loading');//.hide();

        $.ajax({
            url: 'index.php?module=login&action=login&format=raw',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.success) {
                    alert(data.message);
                    //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    $("#myModal .modal-body").empty();
                    $("#myModal .modal-title").empty();
                    $("#myModal .modal-footer").empty();
                    $('#myModal').modal('hide');
                    document.location.href = "index.php?module=" + data.target//$(this).serialize();
                } else {
                    alert("ERROR: " + data.message);
                    //alert("ERROR: Error when trying to change status");
                    $("#btnSigIn").button('reset');//show();
                    $("#formLogin").off();
                }
            }
        });
        //return false;         
    });
    $("#formLogin").submit();
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function filtroEmpresas() {
    $("#filtro_estado").on("change", function () {
        $("#filtro_estado_nombre").val($("#filtro_estado option:selected").text());
    });

    $("#form_filtro_grid").on("submit", function (event) {
        event.stopPropagation();
        event.preventDefault();
        $.ajax({
            url: 'index.php?module=getGrid&action=getGrid&format=raw',
            type: 'POST',
            data: $(this).serialize(),
            //dataType:'JSON',
            success: function (data) {
                if (data) {
                    console.log(data);
                    $('#grid-section').html(data);
                } else {
                    alert("ERROR: al intentar obtener los datos");
                }
            }
        });
        return false;
    });
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////Reportes






















// Aprobar 
function aprobar() {
    $("button[id^='aprobar_']").on("click", function () {
        var id = this.id.slice(8);
        console.log(id);

        $.ajax({
            url: '/editar.php?action=aprobar',
            type: 'POST',
            data: {"reporte_id": id},
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    console.log(id);
                    $("#row_" + id).removeClass("info").removeClass("danger").addClass("success");
                } else {
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });
}
// Aprobar Todo
function aprobarTodo() {
    $("#aprobarTodo").on("click", function () {
        //var ids = new Array();
        var ids = ""
        $("#tblReportes > tbody > tr").each(function (index) {
            var id = $(this).attr('id').slice(4);
            //ids.push(id);
            ids += id + ",";
        });
        console.log(ids);

        $.ajax({
            url: '/editar.php?action=aprobar',
            type: 'POST',
            data: {"reporte_ids": ids}, //{ "reporte_id": id },
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    $("#tblReportes > tbody > tr[id!='row_0']").each(function (index) {
                        $(this).removeClass("info").removeClass("danger").addClass("success");
                    });
                } else {
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });
}

// Rechazar 
function rechazar() {
    $("button[id^='rechazar_']").on("click", function () {
        var id = this.id.slice(9);
        console.log(id);

        $.ajax({
            url: '/editar.php?action=rechazar',
            type: 'POST',
            data: {"reporte_id": id},
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    console.log(id);
                    $("#row_" + id).removeClass("info").addClass("danger");
                } else {
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });
}

// Rechazar Todo
function rechazarTodo() {
    $("#rechazarTodo").on("click", function () {
        //var ids = new Array();
        var ids = ""
        $("#tblReportes > tbody > tr").each(function (index) {
            var id = $(this).attr('id').slice(4);
            //ids.push(id);
            ids += id + ",";
        });
        console.log(ids);

        $.ajax({
            url: '/editar.php?action=rechazar',
            type: 'POST',
            data: {"reporte_ids": ids}, //{ "reporte_id": id },
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    $("#tblReportes > tbody > tr[id!='row_0']").each(function (index) {
                        $(this).removeClass("info").addClass("danger");
                    });
                } else {
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });
}

// Borrar 
function borrar() {
    $("button[id^='borrar_']").on("click", function () {
        var id = this.id.slice(7);
        console.log(id);
        var confirmar = confirm("You sure you want to delete?");
        if (confirmar) {
            $.ajax({
                url: '/editar.php?action=borrar',
                type: 'POST',
                data: {"reporte_id": id},
                dataType: 'JSON',
                success: function (data) {
                    if (data.success) {
                        console.log(id);
                        $("#row_" + id).hide();
                    } else {
                        alert("ERROR: Error when trying to delete");
                    }
                }
            });
        }
    });
}

// Borrar Todo
function borrarTodo() {
    $("#borrarTodo").on("click", function () {
        //var ids = new Array();
        var ids = ""
        $("#tblReportes > tbody > tr").each(function (index) {
            var id = $(this).attr('id').slice(4);
            //ids.push(id);
            ids += id + ",";
        });
        console.log(ids);

        var confirmar = confirm("You sure you want to delete?");
        if (confirmar) {
            $.ajax({
                url: '/editar.php?action=borrar',
                type: 'POST',
                data: {"reporte_ids": ids}, //{ "reporte_id": id },
                dataType: 'JSON',
                success: function (data) {
                    if (data.success) {
                        $("#tblReportes > tbody > tr").each(function (index) {
                            $(this).hide();
                        });
                    } else {
                        alert("ERROR: Error when trying to delete");
                    }
                }
            });
        }

    });
}

// Editar 
function editar() {
    $("span[id^='editar_']").on("click", function () {
        var id = this.id.slice(7);
        console.log(id);
        var numeroSemanaActual = $("#numeroSemanaActual").val();
        var numeroAnoActual = $("#numeroAnoActual").val();
        $("#reporte_id").val(id);
        $("#myModalLabel").text($("#row_" + id + ">td").eq(1).text());
        $("#ano").val($("#numeroAnoActual").val());
        $("#semana").val($("#numeroSemanaActual").val());

        $("#reporte_horas_lunes").val($("#row_" + id + ">td").eq(3).text());
        $("#reporte_proyecto_lunes").val($("#row_" + id + ">td").eq(4).text());

        $("#reporte_horas_martes").val($("#row_" + id + ">td").eq(5).text());
        $("#reporte_proyecto_martes").val($("#row_" + id + ">td").eq(6).text());

        $("#reporte_horas_miercoles").val($("#row_" + id + ">td").eq(7).text());
        $("#reporte_proyecto_miercoles").val($("#row_" + id + ">td").eq(8).text());

        $("#reporte_horas_jueves").val($("#row_" + id + ">td").eq(9).text());
        $("#reporte_proyecto_jueves").val($("#row_" + id + ">td").eq(10).text());

        $("#reporte_horas_viernes").val($("#row_" + id + ">td").eq(11).text());
        $("#reporte_proyecto_viernes").val($("#row_" + id + ">td").eq(12).text());

        $("#reporte_horas_sabado").val($("#row_" + id + ">td").eq(13).text());
        $("#reporte_proyecto_sabado").val($("#row_" + id + ">td").eq(14).text());

        $("#reporte_horas_domingo").val($("#row_" + id + ">td").eq(15).text());
        $("#reporte_proyecto_domingo").val($("#row_" + id + ">td").eq(16).text());


        $("#myModal").modal('show');
        //$("#"+this.id).modal('show');

    });

    $("#frm_editar_registro").on("submit", function (event) {

        $.ajax({
            url: '/editar.php?action=update',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    $("#row_" + data.reporte_id + ">td").eq(3).text($("#reporte_horas_lunes").val());
                    $("#row_" + data.reporte_id + ">td").eq(4).text($("#reporte_proyecto_lunes").val());
                    $("#row_" + data.reporte_id + ">td").eq(5).text($("#reporte_horas_martes").val());
                    $("#row_" + data.reporte_id + ">td").eq(6).text($("#reporte_proyecto_martes").val());
                    $("#row_" + data.reporte_id + ">td").eq(7).text($("#reporte_horas_miercoles").val());
                    $("#row_" + data.reporte_id + ">td").eq(8).text($("#reporte_proyecto_miercoles").val());
                    $("#row_" + data.reporte_id + ">td").eq(9).text($("#reporte_horas_jueves").val());
                    $("#row_" + data.reporte_id + ">td").eq(10).text($("#reporte_proyeco_jueves").val());
                    $("#row_" + data.reporte_id + ">td").eq(11).text($("#reporte_horas_viernes").val());
                    $("#row_" + data.reporte_id + ">td").eq(12).text($("#reporte_proyecto_viernes").val());
                    $("#row_" + data.reporte_id + ">td").eq(13).text($("#reporte_horas_sabado").val());
                    $("#row_" + data.reporte_id + ">td").eq(14).text($("#reporte_proyecto_sabado").val());
                    $("#row_" + data.reporte_id + ">td").eq(15).text($("#reporte_horas_domingo").val());
                    $("#row_" + data.reporte_id + ">td").eq(16).text($("#reporte_proyecto_domingo").val());
                    $("#row_" + data.reporte_id + ">td").eq(17).text(data.total);
                    $("#row_" + data.reporte_id).removeClass("danger").addClass("info");

                    $("#myModal").modal('hide');

                } else {
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

        event.preventDefault();
        console.log($(this).serialize());
    });
}



//Exportar Excel
function exportExcel() {
    $("#exportarExcel").on("submit", function (event) {
        var data = $("#frmFiltro").serialize();
        console.log(data);
        $("#exportarExcel").attr('action', '/exportar.php?' + data);
        //event.preventDefault();

    });
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////Supervisor

// Editar 
function editarSupervisor() {
    $("span[id^='editar_']").click(function (event) {
        //$("span[id^='editar_']").on("click",function(){
        event.stopPropagation();

        var id = this.id.slice(7);
        console.log(id);
        var numeroSemanaActual = $("#numeroSemanaActual").val();
        var numeroAnoActual = $("#numeroAnoActual").val();
        $("#usuario_id").val(id);
        $("#myModalLabel").text($("#row_" + id + ">td").eq(1).text());

        $("#usuario_email").val($("#row_" + id + ">td").eq(0).text());
        $("#usuario_nombre").val($("#row_" + id + ">td").eq(1).text());

        $("#myModal").modal('show');
        $(".checkbox").show();

        $("#divChangePass").hide();
        $("#chkChangePass").on("click", function () {
            if ($(this).is(':checked')) {
                $("#divChangePass").show();
            } else {
                $("#divChangePass").hide();
            }
        });
        //$("#"+this.id).modal('show');

//    });

        $("#frm_editar_registro").off("submit");
        $("#frm_editar_registro").submit(function (event) {
            //$("#frm_editar_registro").on("submit",function(event){
            event.stopPropagation();

            $.ajax({
                url: '../editar.php?action=updateSupervisor',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function (data) {
                    if (data.success) {
                        $("#row_" + data.usuario_id + ">td").eq(0).text($("#usuario_email").val());
                        $("#row_" + data.usuario_id + ">td").eq(1).text($("#usuario_nombre").val());

                        $("#myModal").modal('hide');

                    } else {
                        alert("ERROR: Error when trying to change status");
                    }
                }
            });

            event.preventDefault();
            console.log($(this).serialize());
        });
    });
}

// Nuevo Supervisor
function nuevoSupervisor() {
    $("#addNewSupervisor").click(function (event) {
        //$("#addNewSupervisor").on("click",function(event){
        event.stopPropagation();

        $("#myModal").modal('show');
        $(".checkbox").hide();
        $("#divChangePass").show();
        $("#myModalLabel").text("New Supervisor");
        $("#usuario_id").val('');
        $("#usuario_email").val('');
        $("#usuario_nombre").val('');
//	});

        $("#frm_editar_registro").off("submit");
        $("#frm_editar_registro").submit(function (event) {
            //$("#frm_editar_registro").on("submit",function(event){
            event.stopPropagation();

            $.ajax({
                url: '../editar.php?action=newSupervisor',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function (data) {
                    if (data.success) {
                        $("#tblSupervisores tbody").append(data.html);
                        editarSupervisor();
                        activarSupervisor();
                        $("#myModal").modal('hide');

                    } else {
                        alert("ERROR: Error when trying to change status");
                    }
                }
            });

            event.preventDefault();
            console.log($(this).serialize());
        });
    });
}

// Rechazar 
function activarSupervisor() {
    $("button[id^='activar_']").on("click", function () {
        var id = this.id.slice(8);
        console.log(id);
        var status = $("#row_" + id + ">td").eq(2).text();

        $.ajax({
            url: '../editar.php?action=activarSupervisor',
            type: 'POST',
            data: {"usuario_id": id, "usuario_status": status},
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    if (data.usuario_status == 1) {
                        $("#row_" + data.usuario_id + ">td").eq(2).text("Active");
                        $("#activar_" + data.usuario_id).html('<span class="glyphicon glyphicon-remove"></span> Deactivate');
                    } else {
                        $("#row_" + data.usuario_id + ">td").eq(2).text("Inactive");
                        $("#activar_" + data.usuario_id).html('<span class="glyphicon glyphicon-ok"></span> Activate');
                    }
                } else {
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///// Empleados

// Editar 
function editarEmpleado() {
    $("span[id^='editar_']").on("click", function () {
        var id = this.id.slice(7);
        console.log(id);
        var numeroSemanaActual = $("#numeroSemanaActual").val();
        var numeroAnoActual = $("#numeroAnoActual").val();
        $("#empleado_id").val(id);
        $("#myModalLabel").text($("#row_" + id + ">td").eq(1).text());


        $("#empleado_no").val($("#row_" + id + ">td").eq(0).text());
        $("#empleado_nombre").val($("#row_" + id + ">td").eq(1).text());


        $("#myModal").modal('show');

        $("#divChangePass").hide();
        $("#chkChangePass").on("click", function () {
            if ($(this).is(':checked')) {
                $("#divChangePass").show();
            } else {
                $("#divChangePass").hide();
            }
        });
        //$("#"+this.id).modal('show');

    });

    $("#frm_editar_registro").on("submit", function (event) {

        $.ajax({
            url: '../editar.php?action=updateEmpleado',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    $("#row_" + data.empleado_id + ">td").eq(0).text($("#empleado_no").val());
                    $("#row_" + data.empleado_id + ">td").eq(1).text($("#empleado_nombre").val());

                    $("#myModal").modal('hide');

                } else {
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

        event.preventDefault();
        console.log($(this).serialize());
    });
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function changeYear(element) {
    $("#action").val('');
    element.form.submit();

}