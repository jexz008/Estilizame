$(document).ajaxStart(function () {
    //html = '<div id="ajax-loader" style="position:fixed; z-index:10000000; top:1px; left:1px; "><div style="margin:auto; text-align:center;  "><img src="img/ajax-loader.gif" alt="LOADING" /></div></div>';
    var html = '<div id="ajax-loader" style="position:fixed; z-index:999999999999999; top:1px; left:1px; "><div style="margin:auto; text-align:center;  "><i class="fa fa-spinner fa-5x fa-spin fa-fw" aria-hidden="true"></i><span class="sr-only">Cargando...</span></div></div>';
    $("html").append(html);
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
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateNombre" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="perfil_empresa" required placeholder="Ingresa el nombre de tu empresa o negocio"></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateNombre" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateCategoria':
                title = 'Cambia de categoria';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateCategoria" method="post">\n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateCategoria" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateEspecialidades':
                var getEspecialidades =  function(){
                        var categoriaId = $("#hdnPerfilCategoriaId").val();
                        var empresaId = $("#hdnPerfilId").val();
                        $.get('index.php?module=getEspecialidades&format=raw', {'categoriaId':categoriaId, 'empresaId':empresaId}, function(data){
                            $('#formPerfilUpdateEspecialidades').html(data);
                        });
                };
                getEspecialidades();
                title = 'Cambiar especialidades';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateEspecialidades" method="post">\n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateEspecialidades" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateDescripcion':
                title = 'Cambiar descripción';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateDescripcion" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><textarea name="descripcion_descripcion" class="form-control" rows="4" cols="80" size="200" required="required" placeholder="Ingresa una descripción de tu empresa o negocio maximo 200 caracteres"></textarea></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateDescripcion" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateEstado':
                title = 'Cambiar estado';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateEstado" method="post">\n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateEstado" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateMunicipio':
                title = 'Cambiar municipio';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateMunicipio" method="post">\n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateMunicipio" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateDireccion':
                title = 'Cambiar dirección';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateDireccion" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><textarea name="perfil_direccion" class="form-control" rows="4" cols="80" required="required" placeholder="Ingresa tu domicilio Completo Ejemplo: Calle, Número y Colonia."></textarea></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateDireccion" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;                
            case 'btnFormPerfilUpdateTelefono':
                title = 'Cambiar teléfonos';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateTelefono" method="post">\n\
                          <div class="form-group"><div class="col-sm-12">\n\
                            <div class="row">\n\
                                <div class="col-xs-4">\n\
                                    <input type="tel" class="form-control" name="perfil_telefono[]" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>\n\
                                </div> \n\
                                <div class="col-xs-4">\n\
                                    <input type="tel" class="form-control" name="perfil_telefono[]" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>\n\
                                </div>  \n\
                                <div class="col-xs-4"> \n\
                                    <input type="tel" class="form-control" name="perfil_telefono[]" placeholder="Coloca tu numero de teléfono a 10 dígitos"/>\n\
                                </div>\n\
                          </div></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateTelefono" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateFPerfil':
                title = 'Cambiar foto de perfil';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateFPerfilno" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="file" class="form-control" name="perfil_foto_perfil" accept="image/jpg" required="required"> </div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateFPerfil" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateFCabecera':
                title = 'Cambiar foto de Cabecera';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateFCabecera" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="file" class="form-control" name="perfil_foto_cabecera" accept="image/jpg" required="required"></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateFCabecera" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
            case 'btnFormPerfilUpdateGaleria':
                title = 'Cambiar fotos de Galeria';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateGaleria" method="post">\n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateGaleria" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
           case 'btnFormPerfilUpdateEmail':
                title = 'Cambiar email';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateEmail" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="mail" name="perfil_email" class="form-control" placeholder="Email" required /></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateEmail" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
           case 'btnFormPerfilUpdatePass':
                title = 'Cambiar contraseña';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdatePass" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="password" name="perfil_contrasena" class="form-control" placeholder="Contraseña" required /></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdatePass" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
           case 'btnFormPerfilUpdateUbicacion':
                title = 'Cambiar ubicacion';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateUbicacion" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><textarea class="form-control" name="perfil_ubicacion" placeholder="Introduce el enlance de Google Maps"></textarea></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateUbicacion" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
          case 'btnFormPerfilUpdateVideo':
                title = 'Cambiar Video';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateVideo" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="perfil_video" placeholder="Introduce el ID de tu video de Youtube"></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateVideo" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
          case 'btnFormPerfilUpdateFacebook':
                title = 'Cambiar Facebook';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateFacebook" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="perfil_facebook" placeholder="Introduce la URL de Facebook"> </div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateFacebook" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
          case 'btnFormPerfilUpdateTwitter':
                title = 'Cambiar Twitter';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateTwitter" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="perfil_twitter" placeholder="Introduce la URL de Twitter"></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateTwitter" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
         case 'btnFormPerfilUpdateGoogle':
                title = 'Cambiar Google';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateGoogle" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="perfil_google" placeholder="Introduce la URL de Google Plus"></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateGoogle" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
         case 'btnFormPerfilUpdateInstagram':
                title = 'Cambiar Instagram';
                html = ' \n\
                          <form class="form-horizontal" action="#" id="formPerfilUpdateInstagram" method="post">\n\
                          <div class="form-group"><div class="col-sm-12"><input type="text" class="form-control" name="perfil_instagram" placeholder="Introduce la URL de Instagram"></div></div> \n\
                          </form>\n\
                        ';
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnPerfilUpdateInstagram" data-loading-text="Loading...">Guardar</button>\
                    ';
                break;
        }
        $("#modalPerfilUpdate .modal-body").html(html);
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
            case 'btnFormPerfilUpdateNombreEmpresa':
                $("#btnSendMailContact").on("click", formUpdatePerfil);
            break;
            case 'btnFormPerfilUpdateCategoria':
                $("#btnSigIn").on("click", formUpdatePerfil);
            break;
            case 'btnFormPerfilUpdateEspecialidades':
                $("#btnPerfilUpdateEspecialidades").on("click", formUpdatePerfil);
            break;
        }
        /*
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
    'btnFormPerfilUpdateInstagram': 'Instragram',*/
        
        
    });
    $('#modalPerfilUpdate').on('hidden.bs.modal', function (event) {
        $("#modalPerfilUpdate .modal-body").empty();
    });

}

/// Update Perfil
function formUpdatePerfil(){
      $("#formPerfilUpdateEspecialidades").on("submit", function(event){
        event.stopPropagation();
        event.preventDefault();
        $("#btnPerfilUpdateEspecialidades").button('loading');//.hide();
        $.ajax({
            url: 'index.php?module=registro_actualizar&format=raw&empresaId=' + $("#hdnPerfilId").val() + '&categoriaId='+$("#hdnPerfilCategoriaId").val(),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.success) {
                    alert(data.message);
                    //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    $("modalPerfilUpdate .modal-body").empty();
                    $("modalPerfilUpdate .modal-title").empty();
                    $("modalPerfilUpdate .modal-footer").empty();
                    $('#modalPerfilUpdate').modal('hide');
                } else {
                    alert("ERROR: " + data.message);
                    $("#btnSendMailContact").button('reset');//show();
                    $("#btnPerfilUpdateEspecialidades").off();
                }
            }
        });
    });
    $("#formPerfilUpdateEspecialidades").submit();
}
// Fin Update Perfil
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
                changeEstado();
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
function changeEstado() {
    $("#registro_estado").on("change", function () {
        $("#registro_estado_nombre").val($("#registro_estado option:selected").text());
        var estado = $("#registro_estado").val();
        $.ajax({
            url: 'index.php?module=pais_estados&action=getMunicipios&format=raw',
            type: 'POST',
            data: {'estado': estado},
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    console.log(data);
                    $('#div_registro_municipio').html(data.html);
                } else {
                    alert("ERROR: " + data.message);
                }
            }
        });
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
            ursetRegistrol: 'index.php?module=registro_registrar&action=registro_registrar&format=raw',
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
    $("#formContactanos").submit();    
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