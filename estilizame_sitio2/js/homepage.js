
$( document ).ajaxStart(function() {
    html = '<div id="ajax-loader" style="position:fixed; z-index:10000000; top:1px; left:1px; "><div style="margin:auto; text-align:center;  "><img src="img/ajax-loader.gif" alt="LOADING" /></div></div>';
    $("html").append(html);
});
$( document ).ajaxStop(function() {
    $("#ajax-loader").remove();
});

$(document).ready(function(){
    modales();
    setRegistro();
});

// Carousel Bootstrap 
$('.carousel').carousel({
  interval: 2000
})  

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///// Modales
function modales(){
    $('#myModal').on('shown.bs.modal', function(event){
        var html = '';
        var title = '';
        var footer = '';
        var action = '';
        var large = false;

        var boton = $(event.relatedTarget);
        var id = boton.attr('id');

        switch(id){
            case 'btnModalContacto':
                title = 'Contáctanos';
                html = ' \n\
                          <div class="form-group"><div class="col-sm-12"><input type="text" name="contacto_nombre" class="form-control" placeholder="Nombre" required></div></div> \n\
                          <div class="form-group"><div class="col-sm-12"><input type="email" name="contacto_mail" class="form-control" placeholder="Email" required></div></div> \n\
                          <div class="form-group"><div class="col-sm-12"><input type="tel" name="contacto_telefono" class="form-control" placeholder="Teléfono" required></div></div> \n\
                          <div class="form-group"><div class="col-sm-12"><textarea name="name" name="contacto_mensaje" class="form-control" placeholder="Escribenos un comentario" required></textarea></div></div> \n\
                    ';            
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnSendMailContact">Enviar</button>\
                    ';
                formContactanos();   
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
            case 'btnLogin':
                title = 'INICIAR SESION';
                html = ' \n\
                          <div class="form-group"><div class="col-sm-12"><input type="email" name="login_mail" class="form-control" placeholder="Email" required></div></div> \n\
                          <div class="form-group"><div class="col-sm-12"><input type="password" name="login_password" class="form-control" placeholder="Contraseña" required></div></div> \n\
                        '; 
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnLogin">Iniciar Sesión</button>\
                    ';
            break;
            case 'btnFormSigIn':
                title = 'REGISTRATE';
                html = getFormRegistro();
                footer = '\
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Salir</button>\
                    <button class="btn btn-success" type="submit" id="btnSigInUp">Registrarme</button>\
                    ';
                large = true;
            break;            
        }
        $(".modal-body").html(html);
        $(".modal-title").html(title);
        $(".modal-footer").html(footer); 
        $("#myModal form input:enabled:visible:first").focus();  
        if(large){
            $("#myModal").addClass('bs-example-modal-lg');
            $(".modal-dialog").addClass('modal-lg'); 
        }else{
            $("#myModal").removeClass('bs-example-modal-lg');
            $(".modal-dialog").removeClass('modal-lg');            
        }  

    });
    $('#myModal').on('hidden.bs.modal', function(event){
        $(".modal-body").empty();        
    });       
}

function formContactanos(){
        $("#myModal form").on("submit", function(event){
            event.stopPropagation();
            event.preventDefault();
            $("#btnSendMailContact").hide();
            $.ajax({
                url:'index.php?module=mail_contacto&action=mail_contacto&format=raw',
                type:'POST',
                data: $( this ).serialize(),
                dataType:'JSON',
                success:function(data){
                    if ( data.success ){
                        console.log(data);
                        alert("Mensaje enviado correctamente.");
                        $('#myModal').modal('hide');
                        //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    }else{
                        alert("ERROR: " + data.message);
                        //alert("ERROR: Error when trying to change status");
                    }
                }
            });
            return false;         
        });    
}
function getFormRegistro(){
    var html
    $("form-horizontal").attr("enctype","multipart/form-data");
            $.ajax({
                url:'index.php?module=registro_form&action=registro_form&format=raw',
                type:'POST',
                dataType:'html',
                success:function(data){
                    if ( data ){
                        html = data;
                        $(".modal-body").html(html);
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

                    }else{
                        alert("ERROR: al intentar obtener el formulario de registro.");
                    }
                }
            });
    return html;
}
function changeCategoria(){
    $("#registro_categoria").on("change",function(){
        var categoriaId = $(this).val();
        $("div.checkbox[id^='categoria_especialidad_']").hide();
        $("#categoria_especialidad_" + categoriaId).show();
    });
}
function changeEstado(){
    $("#registro_estado").on("change",function(){
        $("#registro_estado_nombre").val($("#registro_estado option:selected").text());
        var estado = $("#registro_estado").val(); console.log('estado:'+estado);
            $.ajax({
                url:'index.php?module=pais_estados&action=getMunicipios&format=raw',
                type:'POST',
                data: {'estado':estado},
                dataType:'JSON',             
                success:function(data){
                    if ( data.success ){
                        console.log(data);
                        $('#div_registro_municipio').html(data.html);
                    }else{
                        alert("ERROR: " + data.message);
                    }
                }
            });
    });
}
function setRegistro(){
        $("#myModal form").on("submit", function(event){
            event.stopPropagation();
            event.preventDefault();
            $("#btnSigInUp").hide();
            var formData = new FormData(this);
            //var formData = new FormData(document.getElementById('form_modal'));
                        //formData.append("dato", "valor");
            $.ajax({
                url:'index.php?module=registro_registrar&action=registro_registrar&format=raw',
                type:'POST',
                data: formData,///$( this ).serialize(),
                dataType:'JSON',
                cache: false,
                contentType: false,
                processData: false,                
                success:function(data){
                    if ( data.success ){
                        console.log(data);
                        alert(data.message);
                        $('#myModal').modal('hide');
                        //$("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                    }else{
                        alert("ERROR: " + data.message);
                        //alert("ERROR: Error when trying to change status");
                    }
                    $("#btnSigInUp").show();
                }
            });
            return false;         
        });    
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getModulo(){
    
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////Reportes

// Aprobar 
function aprobar(){
    $("button[id^='aprobar_']").on("click",function(){
        var id = this.id.slice(8);
        console.log(id);

        $.ajax({
            url:'/editar.php?action=aprobar',
            type:'POST',
            data: { "reporte_id": id },
            dataType:'JSON',
            success:function(data){
                if ( data.success ){
                    console.log(id);
                    $("#row_"+id).removeClass("info").removeClass("danger").addClass("success");
                }else{
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });    
}
// Aprobar Todo
function aprobarTodo(){
    $("#aprobarTodo").on("click",function(){
        //var ids = new Array();
        var ids = ""
        $("#tblReportes > tbody > tr").each(function(index){
            var id = $(this).attr('id').slice(4);
            //ids.push(id);
            ids += id+",";
        });
        console.log(ids);

        $.ajax({
            url:'/editar.php?action=aprobar',
            type:'POST',
            data: {"reporte_ids":ids},//{ "reporte_id": id },
            dataType:'JSON',
            success:function(data){
                if ( data.success ){
                    $("#tblReportes > tbody > tr[id!='row_0']").each(function(index){
                        $(this).removeClass("info").removeClass("danger").addClass("success");
                    });
                }else{
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });    
}

// Rechazar 
function rechazar(){
    $("button[id^='rechazar_']").on("click",function(){
        var id = this.id.slice(9);
        console.log(id);
        
        $.ajax({
            url:'/editar.php?action=rechazar',
            type:'POST',
            data: { "reporte_id": id },
            dataType:'JSON',
            success:function(data){
                if ( data.success ){
                    console.log(id);
                    $("#row_"+id).removeClass("info").addClass("danger");
                }else{
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });    
}

// Rechazar Todo
function rechazarTodo(){
    $("#rechazarTodo").on("click",function(){
        //var ids = new Array();
        var ids = ""
        $("#tblReportes > tbody > tr").each(function(index){
            var id = $(this).attr('id').slice(4);
            //ids.push(id);
            ids += id+",";
        });
        console.log(ids);

        $.ajax({
            url:'/editar.php?action=rechazar',
            type:'POST',
            data: {"reporte_ids":ids},//{ "reporte_id": id },
            dataType:'JSON',
            success:function(data){
                if ( data.success ){
                    $("#tblReportes > tbody > tr[id!='row_0']").each(function(index){
                        $(this).removeClass("info").addClass("danger");
                    });
                }else{
                    alert("ERROR: Error when trying to change status");
                }
            }
        });

    });    
}

// Borrar 
function borrar(){
    $("button[id^='borrar_']").on("click",function(){
        var id = this.id.slice(7);
        console.log(id);
        var confirmar = confirm("You sure you want to delete?");
        if(confirmar){
            $.ajax({
                url:'/editar.php?action=borrar',
                type:'POST',
                data: { "reporte_id": id },
                dataType:'JSON',
                success:function(data){
                    if ( data.success ){
                        console.log(id);
                        $("#row_"+id).hide();
                    }else{
                        alert("ERROR: Error when trying to delete");
                    }
                }
            });
        }
    });    
}

// Borrar Todo
function borrarTodo(){
    $("#borrarTodo").on("click",function(){
        //var ids = new Array();
        var ids = ""
        $("#tblReportes > tbody > tr").each(function(index){
            var id = $(this).attr('id').slice(4);
            //ids.push(id);
            ids += id+",";
        });
        console.log(ids);

        var confirmar = confirm("You sure you want to delete?");
        if(confirmar){
            $.ajax({
                url:'/editar.php?action=borrar',
                type:'POST',
                data: {"reporte_ids":ids},//{ "reporte_id": id },
                dataType:'JSON',
                success:function(data){
                    if ( data.success ){
                        $("#tblReportes > tbody > tr").each(function(index){
                            $(this).hide();
                        });
                    }else{
                        alert("ERROR: Error when trying to delete");
                    }
                }
            });
        }  

    });    
}

// Editar 
function editar(){
    $("span[id^='editar_']").on("click",function(){
        var id = this.id.slice(7);
        console.log(id);
        var numeroSemanaActual = $("#numeroSemanaActual").val();
        var numeroAnoActual = $("#numeroAnoActual").val();
        $("#reporte_id").val(id);
        $("#myModalLabel").text( $("#row_"+id+">td").eq(1).text() );
        $("#ano").val($("#numeroAnoActual").val());
        $("#semana").val($("#numeroSemanaActual").val());

        $("#reporte_horas_lunes").val( $("#row_"+id+">td").eq(3).text() );
        $("#reporte_proyecto_lunes").val( $("#row_"+id+">td").eq(4).text() );
		
        $("#reporte_horas_martes").val( $("#row_"+id+">td").eq(5).text() );
        $("#reporte_proyecto_martes").val( $("#row_"+id+">td").eq(6).text() );
		
        $("#reporte_horas_miercoles").val( $("#row_"+id+">td").eq(7).text() );
        $("#reporte_proyecto_miercoles").val( $("#row_"+id+">td").eq(8).text() );
		
        $("#reporte_horas_jueves").val( $("#row_"+id+">td").eq(9).text() );
        $("#reporte_proyecto_jueves").val( $("#row_"+id+">td").eq(10).text() );
		
        $("#reporte_horas_viernes").val( $("#row_"+id+">td").eq(11).text() );
        $("#reporte_proyecto_viernes").val( $("#row_"+id+">td").eq(12).text() );
		
        $("#reporte_horas_sabado").val( $("#row_"+id+">td").eq(13).text() );
        $("#reporte_proyecto_sabado").val( $("#row_"+id+">td").eq(14).text() );
		
        $("#reporte_horas_domingo").val( $("#row_"+id+">td").eq(15).text() );
        $("#reporte_proyecto_domingo").val( $("#row_"+id+">td").eq(16).text() );
		

        $("#myModal").modal('show');
        //$("#"+this.id).modal('show');

    });

    $("#frm_editar_registro").on("submit",function(event){

            $.ajax({
                url:'/editar.php?action=update',
                type:'POST',
                data: $( this ).serialize(),
                dataType:'JSON',
                success:function(data){
                    if ( data.success ){
                        $("#row_"+data.reporte_id+">td").eq(3).text( $("#reporte_horas_lunes").val() );
                        $("#row_"+data.reporte_id+">td").eq(4).text( $("#reporte_proyecto_lunes").val() );
                        $("#row_"+data.reporte_id+">td").eq(5).text( $("#reporte_horas_martes").val() );
                        $("#row_"+data.reporte_id+">td").eq(6).text( $("#reporte_proyecto_martes").val() );
                        $("#row_"+data.reporte_id+">td").eq(7).text( $("#reporte_horas_miercoles").val() );
                        $("#row_"+data.reporte_id+">td").eq(8).text( $("#reporte_proyecto_miercoles").val() );
                        $("#row_"+data.reporte_id+">td").eq(9).text( $("#reporte_horas_jueves").val() );
                        $("#row_"+data.reporte_id+">td").eq(10).text( $("#reporte_proyeco_jueves").val() );
                        $("#row_"+data.reporte_id+">td").eq(11).text( $("#reporte_horas_viernes").val() );
                        $("#row_"+data.reporte_id+">td").eq(12).text( $("#reporte_proyecto_viernes").val() );
                        $("#row_"+data.reporte_id+">td").eq(13).text( $("#reporte_horas_sabado").val() );
                        $("#row_"+data.reporte_id+">td").eq(14).text( $("#reporte_proyecto_sabado").val() );
                        $("#row_"+data.reporte_id+">td").eq(15).text( $("#reporte_horas_domingo").val() );
                        $("#row_"+data.reporte_id+">td").eq(16).text( $("#reporte_proyecto_domingo").val() );
                        $("#row_"+data.reporte_id+">td").eq(17).text( data.total );
                        $("#row_"+data.reporte_id).removeClass("danger").addClass("info");

                        $("#myModal").modal('hide');

                    }else{
                        alert("ERROR: Error when trying to change status");
                    }
                }
            });

        event.preventDefault();
        console.log( $( this ).serialize() );
    });
}



//Exportar Excel
function exportExcel(){
	$("#exportarExcel").on("submit",function(event){
		var data = $("#frmFiltro").serialize();
		console.log(data);
		$("#exportarExcel").attr('action','/exportar.php?'+data);
	    //event.preventDefault();

	});
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////Supervisor

// Editar 
function editarSupervisor(){
    $("span[id^='editar_']").click(function(event){
    //$("span[id^='editar_']").on("click",function(){
 		event.stopPropagation();
        
        var id = this.id.slice(7);
        console.log(id);
        var numeroSemanaActual = $("#numeroSemanaActual").val();
        var numeroAnoActual = $("#numeroAnoActual").val();
        $("#usuario_id").val(id);
        $("#myModalLabel").text( $("#row_"+id+">td").eq(1).text() );

        $("#usuario_email").val( $("#row_"+id+">td").eq(0).text() );
        $("#usuario_nombre").val( $("#row_"+id+">td").eq(1).text() );

        $("#myModal").modal('show');
   		$(".checkbox").show();

        $("#divChangePass").hide();
        $("#chkChangePass").on("click",function(){
            if($(this).is(':checked')){
              $("#divChangePass").show();
            }else{
              $("#divChangePass").hide();
            }
        });
        //$("#"+this.id).modal('show');

//    });

    $("#frm_editar_registro").off("submit");
    $("#frm_editar_registro").submit(function(event){
    //$("#frm_editar_registro").on("submit",function(event){
 		event.stopPropagation();

            $.ajax({
                url:'../editar.php?action=updateSupervisor',
                type:'POST',
                data: $( this ).serialize(),
                dataType:'JSON',
                success:function(data){
                    if ( data.success ){
                        $("#row_"+data.usuario_id+">td").eq(0).text( $("#usuario_email").val() );
                        $("#row_"+data.usuario_id+">td").eq(1).text( $("#usuario_nombre").val() );

                        $("#myModal").modal('hide');

                    }else{
                        alert("ERROR: Error when trying to change status");
                    }
                }
            });

        event.preventDefault();
        console.log( $( this ).serialize() );
    });
    });
}

// Nuevo Supervisor
function nuevoSupervisor(){
	$("#addNewSupervisor").click(function(event){
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
    $("#frm_editar_registro").submit(function(event){
    //$("#frm_editar_registro").on("submit",function(event){
 		event.stopPropagation();

            $.ajax({
                url:'../editar.php?action=newSupervisor',
                type:'POST',
                data: $( this ).serialize(),
                dataType:'JSON',
                success:function(data){
                    if ( data.success ){
                    	$("#tblSupervisores tbody").append(data.html);
						editarSupervisor();
						activarSupervisor();
                        $("#myModal").modal('hide');

                    }else{
                        alert("ERROR: Error when trying to change status");
                    }
                }
            });

        event.preventDefault();
        console.log( $( this ).serialize() );
    });	
	});
}

// Rechazar 
function activarSupervisor(){
    $("button[id^='activar_']").on("click",function(){
        var id = this.id.slice(8);
        console.log(id);
        var status = $("#row_"+id+">td").eq(2).text();

        $.ajax({
            url:'../editar.php?action=activarSupervisor',
            type:'POST',
            data: { "usuario_id": id, "usuario_status": status},
            dataType:'JSON',
            success:function(data){
                if ( data.success ){
                    if(data.usuario_status==1){
                        $("#row_"+data.usuario_id+">td").eq(2).text("Active");
                        $("#activar_"+data.usuario_id).html('<span class="glyphicon glyphicon-remove"></span> Deactivate');
                    }else{
                        $("#row_"+data.usuario_id+">td").eq(2).text("Inactive");
                        $("#activar_"+data.usuario_id).html('<span class="glyphicon glyphicon-ok"></span> Activate');
                  }
                }else{
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
function editarEmpleado(){
    $("span[id^='editar_']").on("click",function(){
        var id = this.id.slice(7);
        console.log(id);
        var numeroSemanaActual = $("#numeroSemanaActual").val();
        var numeroAnoActual = $("#numeroAnoActual").val();
        $("#empleado_id").val(id);
        $("#myModalLabel").text( $("#row_"+id+">td").eq(1).text() );


        $("#empleado_no").val( $("#row_"+id+">td").eq(0).text() );
        $("#empleado_nombre").val( $("#row_"+id+">td").eq(1).text() );


        $("#myModal").modal('show');

        $("#divChangePass").hide();
        $("#chkChangePass").on("click",function(){
            if($(this).is(':checked')){
              $("#divChangePass").show();
            }else{
              $("#divChangePass").hide();
            }
        });
        //$("#"+this.id).modal('show');

    });

    $("#frm_editar_registro").on("submit",function(event){

            $.ajax({
                url:'../editar.php?action=updateEmpleado',
                type:'POST',
                data: $( this ).serialize(),
                dataType:'JSON',
                success:function(data){
                    if ( data.success ){
                        $("#row_"+data.empleado_id+">td").eq(0).text( $("#empleado_no").val() );
                        $("#row_"+data.empleado_id+">td").eq(1).text( $("#empleado_nombre").val() );

                        $("#myModal").modal('hide');

                    }else{
                        alert("ERROR: Error when trying to change status");
                    }
                }
            });

        event.preventDefault();
        console.log( $( this ).serialize() );
    });
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function changeYear(element){
    $("#action").val('');    
    element.form.submit();

}