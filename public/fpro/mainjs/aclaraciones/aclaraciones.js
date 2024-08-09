$(document).ready(function() {
    $('#nuevaNumFactura, #verEditarNumFactura').keypress(solonumeros);
    $("#loader_div_ajax").hide();
    $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
    loadResumenAclaraciones();
    loadCardDataAclaraciones();
    $("#filesSeccion").hide();
    $("#diasDescpacho").val('');
    $('.dropify').dropify();
    $("#nuevaIncidencia").val('');
});
var guia = "";

function solonumeros(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } 
    else if (key < 48 || key > 57) {
        return false;
    }
    else {
        return true;
    }
}

$('#nuevaNumFactura').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        if($("#nuevaNumFactura").val().trim() === ''){
            alert('Ups', 'Todos los campos requeridos', 'error');
        }
        else{
            loadDatoEnvio($('#nuevaNumFactura').val());
        }
    }
});

function alert(title, mensaje, type){
    swal({
        title: title,
        html: mensaje,
        type: type,
        padding: '2em',
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
    $(".swal2-popup").css('border-radius', '30px');
}

function loadDatoEnvio(nuevaNumFactura){
    var associateid = $("#nuevaCodigoPropietario").val();
    $("#filesSeccion").hide();
    $.ajax({
        type: "GET",
        url: "/loadDatoEnvio",
        data: {
            associateid: associateid,
            nuevaNumFactura: nuevaNumFactura,
        },
        beforeSend: function(){
            $("#nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion").val('Cargando...');
            $("#loader_div_ajax").show();
            $("#nuevaIncidencia").val('');
        },
        success: function (response) {
            var largo = response['ordenInfo'].length;
            if(largo > 0){
                var noGuia = response['ordenInfo'][0]['Guia'];
                if(noGuia != 'KIT MOKUTEKI'){
                    $("#nuevaNumGuia").val(response['ordenInfo'][0]['Guia']);
                    $("#nuevaDirEnvio").val(response['ordenInfo'][0]['direccion_envio']);
                    $("#nuevaRecepcion").val(response['ordenInfo'][0]['U_Nombre_Destinatari']);
                    $("#diasDescpacho").val(response['dias']);
                    $("#horasRecepcion").val(response['horas']);
                    guia = response['ordenInfo'][0]['Guia'];
                    $("#nuevaFechaRecep").val(response['ordenInfo'][0]['U_Fecha_Recep']);
                }
                else{
                    alert('Ups', 'La factura corresponde a una incorporación por MOKUTEKI, intenta con una factura diferente.', 'info');
                    $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep").val('');
                }
            }
            else{
                alert('Ups', 'No hay información con el dato indicado', 'info')
                $("#nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion").val('');
            }
            $("#loader_div_ajax").hide();
        },
      	error: function (){
            alert('Ups', 'No se pudo cargar la información, intenta de nuevo', 'error');
            $("#loader_div_ajax").hide();
            $("#nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion").val('');
        }
    });
}

$('#nuevaAclaracionPost').on('submit', function(e) {
    // evito que propague el submit
    e.preventDefault();
    //deshabilitamos el boton para que solo se haga una peticion de registro
    $("#btneventc").attr('disabled', true);

    // agrego la data del form a formData
    var formData = new FormData(this);
    formData.append('_token', $('input[name=_token]').val());
    $.ajax({
        type:'POST',
        url: '/guardarAclaracion',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#btnGuardarNueva").attr('disabled', 'disabled');
            $("#loader_div_ajax").show();
        },
        success:function(data){
            if(data.trim() != 'Error'){
                alertsByCase($("#nuevaIncidencia").val());
                $(".dropify-clear").trigger("click");
                $("#btnGuardarNueva").attr('disabled', false);
                $("#creaAclaracionModal").modal("toggle");
                limpiarForm();
                loadResumenAclaraciones();
            }
            else{
                alert('Ups', "No fue posible registrar la solicitud, la factura ya esta registrada en una solicitud de aclaración", "error");
                $("#btnGuardarNueva").attr('disabled', false);
            }
            $("#loader_div_ajax").hide();
        },
        error: function(){
            alert('Ups', "No fue posible registrar la solicitud, intente de nuevo", "error");
            $("#btnGuardarNueva").attr('disabled', false);
            $("#loader_div_ajax").hide();
        }
    });
});

function limpiarForm(){
    $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
    $("#nuevaIncidencia").val("Fuera del tiempo de entrega.");
    $(".dropify-clear").trigger("click");
}

var estatus = {
    0: '<span class="badge badge-info shadow-none badge-pill">Abierto</span>',
    1: '<span class="badge badge-danger shadow-none badge-pill">Cancelada por el Usuario</span>',
    2: '<span class="badge badge-secondary shadow-none badge-pill">Pendiente</span>',
    3: '<span class="badge badge-success shadow-none badge-pill">Resuelto</span>',
}
function loadResumenAclaraciones(){
    var associateid = $("#nuevaCodigoPropietario").val();
    $('#resumenAclaraciones').DataTable({
        destroy: true,
        info: false,
        paging: false,
        deferRender: true,
        ajax: "/loadResumenAclaraciones?associateid=" + associateid,
        columns: [
            { data: 'Num_Factura', className: 'text-center', },
            { data: 'NúmeroDeguia', className: 'text-center', },
            { data: 'Recepción_WMS', className: 'text-center', },
            { data: 'Tipo_Incidencia', className: 'text-center', },
            { data: 'Descripción_Incidencia', className: 'text-center', },
            {
                data: 'estatus',
                className: 'text-center',
                render: function(data, type, row) {
                    return estatus[row.estatus];
                }
            },
            {
                data: 'Num_Factura',
                className: 'text-center',
                render: function(data, type, row){
                    var html = '<ul class="table-controls">';
                        html += '<li><a href="javascript:void(0);" onclick="verEditarAclaracion(\'ver\', ' + row.Num_Factura + '); getNuwToken(\'_token\'); navigationTracking(' + associateid + ', \'Aclaracion de envios\', \'Abre modal de detalles aclaracion ' + row.Num_Factura + ' \');""><i class="flaticon-view-1 bg-primary p-1 text-white br-6 mb-1"></i></a> </li>';
                        (row.estatus.trim() != 3) ? html += '<li><a href="javascript:void(0);" onclick="verEditarAclaracion(\'editar\', ' + row.Num_Factura + '); getNuwToken(\'_token\'); navigationTracking(' + associateid + ', \'Aclaracion de envios\', \'Abre modal de edicion aclaracion ' + row.Num_Factura + ' \');"><i class="flaticon-edit bg-success p-1 text-white br-6 mb-1"></i></a></li>': null;
                        (row.estatus.trim() != 3) ? html += '<li><a href="javascript:void(0);" onclick="elimiarAclaracion(' + row.Num_Factura + ')"><i class="flaticon-delete bg-danger p-1 text-white br-6 mb-1"></i></a></li>': null;
                    html += '</ul>';
                    return html;
                }
            },
        ],
        dom: '<"row"<"col s12 m12 l12 xl12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        language:{
            "paginate": {
                "previous": "<i class='material-icons dp48'>chevron_left</i></div>",
                "next": "<i class='material-icons dp48'>chevron_right</i></div>"
            },
            "search": "Buscar" ,
            "searchPlaceholder": "Buscar por nombre o por código...",
            "loadingRecords": '<center><div class="box">Cargando datos...</div></center>',
            'sEmptyTable': 'No se encontraron registros',
            "sZeroRecords": "No se encontraron coincidencias",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "",
        },
        buttons: {
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                    text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                },
            ]
        },
    });
}

function loadCardDataAclaraciones(){
    var associateid = $("#nuevaCodigoPropietario").val();
    $.ajax({
        type: "GET",
        url: "/loadCardDataAclaraciones",
        data: {
            associateid: associateid
        },
        success: function (response) {
            $("#cardAbiertas").text(response['abiertas']);
            $("#cardCerrado").text(response['cerrado']);
            $("#cardPendiente").text(response['pendiente']);
            $("#cardCancelado").text(response['cancelado']);
        }
    });
}

function verEditarAclaracion(option, factura){
    $("#verEditarAclaracionModal").modal("toggle");
    var associateid = $("#nuevaCodigoPropietario").val();
    validaDias($("#verEditarIncidencia").val());
    if(option.trim() == 'ver'){
        $("#btnGuardarVerEditar, #btnCencelarVerEditar, #disclamerAviso, #disclamerRequerido").hide();
        $("#btnCerrarVerEditar").show();
        $("#modalTitle").text('Ver detalles de aclaración');
        $("#editFilesSeccion").hide();
        $.ajax({
            type: "GET",
            url: "/verAclaracion",
            data: {
                associateid: associateid,
                factura: factura,
            },
            beforeSend: function(){
                $("#loader_div_ajax").show();
            },
            success: function (response) {
                var largo = response.length;
                if(largo > 0){
                    $("#verEditarNumFactura").val(response[0]['Num_Factura']).attr('readonly', 'readonly');
                    $("#verEditarNumGuia").val(response[0]['NúmeroDeguia']).attr('readonly', 'readonly');
                    $("#verEditarDirEnvio").val(response[0]['DireccionDeEnvio']).attr('readonly', 'readonly');
                    $("#verEditarRecepcion").val(response[0]['Recepción_WMS']).attr('readonly', 'readonly');
                    $("#verEditarIncidencia").val(response[0]['Tipo_Incidencia']).attr('readonly', 'readonly');
                    $("#verEditarDescripcion").val(response[0]['Descripción_Incidencia']).attr('disabled', 'disabled');
                    if(response[0]['guia'] == 'indefinido'){
                        $("#viewFiles").hide();
                    }
                    else{
                        $("#viewFiles").show(); 
                    }
                    $("#fileGuiaVerEditar").attr('src', response[0]['guia']);
                    $("#fileEmpaqueExtVerEditar").attr('src', response[0]['exterior']);
                    $("#fileEmpaqueIntVerEditar").attr('src', response[0]['interior']);
                    $("#fileProductVerEditar").attr('src', response[0]['recibido']);
                    $("#fileVideoVerEditar").attr('src', response[0]['video']);
                }
                else{
                    alert('Ups', 'No se pudo cargar la información, intenta de nuevo', 'error');
                }
                $("#loader_div_ajax").hide();
            },
            error: function (){
                alert('Ups', 'No se pudo cargar la información, intenta de nuevo', 'error');
                $("#loader_div_ajax").hide();
            }
        });
    }
    else{
        $("#btnGuardarVerEditar, #btnCencelarVerEditar, #disclamerAviso, #disclamerRequerido").show();
        $("#btnCerrarVerEditar").hide();
        $("#editFilesSeccion").show();
        $("#modalTitle").text('Editar detalles de aclaración');
        validaDias($("#verEditarIncidencia").val());
        $.ajax({
            type: "GET",
            url: "/verAclaracion",
            data: {
                associateid: associateid,
                factura: factura,
            },
            beforeSend: function(){
                $("#loader_div_ajax").show();
            },
            success: function (response) {
                var largo = response.length;
                if(largo > 0){
                    $("#verEditarNumFactura").val(response[0]['Num_Factura']).attr('readonly', 'readonly');
                    $("#verEditarNumGuia").val(response[0]['NúmeroDeguia']).attr('readonly', 'readonly');
                    $("#verEditarDirEnvio").val(response[0]['DireccionDeEnvio']).attr('readonly', 'readonly');
                    $("#verEditarRecepcion").val(response[0]['Recepción_WMS']).attr('readonly', 'readonly');
                    $("#verEditarIncidencia").val(response[0]['Tipo_Incidencia']).removeAttr('readonly', 'readonly');
                    $("#verEditarDescripcion").val(response[0]['Descripción_Incidencia']).removeAttr('readonly', 'readonly');
                    $("#fileGuiaVerEditar").attr('src', response[0]['guia']);
                    $("#fileEmpaqueExtVerEditar").attr('src', response[0]['exterior']);
                    $("#fileEmpaqueIntVerEditar").attr('src', response[0]['interior']);
                    $("#fileProductVerEditar").attr('src', response[0]['recibido']);
                    $("#fileVideoVerEditar").attr('src', response[0]['video']);
                    $("#verEditarAclaracionID").val(response[0]['ID_aclaracion']).attr('readonly', 'readonly');;
                }
                else{
                    alert('Ups', 'No se pudo cargar la información, intenta de nuevo', 'error');
                }
                $("#loader_div_ajax").hide();
            },
            error: function (){
                alert('Ups', 'No se pudo cargar la información, intenta de nuevo', 'error');
                $("#loader_div_ajax").hide();
            }
        });
    }
}

function elimiarAclaracion(factura){
    swal({
        title: "Cancelar",
        text: "¿Desea cancelar la revision de la aclaración?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Si, cancelar',
        cancelButtonText: "No deseo cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then(function(result) {
        if (result.value) {
            var associateid = $("#nuevaCodigoPropietario").val();
            $.ajax({
                type: "GET",
                url: "/elimiarAclaracion",
                data: {
                    associateid: associateid,
                    factura: factura,
                },
                beforeSend: function(){
                    $("#loader_div_ajax").show();
                },
                success: function (response) {
                    if(response){
                        alert('Ok', 'Se cancelo la solicitud de aclaración correctamente', 'success');
                        navigationTracking(associateid, 'Aclaracion de envios', 'Abre modal de edición aclaracion ' + factura);
                    }
                    else{
                        alert('Ups', 'No se pudo actualizar la información de la aclaración, intenta de nuevo', 'error');
                    }
                    $("#loader_div_ajax").hide();
                    loadResumenAclaraciones()
                },
                error: function (){
                    alert('Ups', 'No se pudo actualizar la información de la aclaración, intenta de nuevo', 'error');
                    $("#loader_div_ajax").hide();
                }
            });
        }
    });
}

$('#verEditarAclaracionPost').on('submit', function(e) {
    // evito que propague el submit
    e.preventDefault();
    //deshabilitamos el boton para que solo se haga una peticion de registro
    $("#btneventc").attr('disabled', true);

    // agrego la data del form a formData
    var formData = new FormData(this);
    formData.append('_token', $('input[name=_token]').val());
    $.ajax({
        type:'POST',
        url: '/editarAclaracion',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success:function(data){
            if(data.trim() != 'Error'){
                alert('Ok', "Ha actualizado su reporte correctamente. En un periodo máximo de 72 hrs su solicitud será atendida", "success");
                $(".dropify-clear").trigger("click");
                $("#verEditarAclaracionModal").modal("toggle");
                loadResumenAclaraciones();
                loadCardDataAclaraciones();
            }
            else{
                alert('Ups', "No fue posible registrar la solicitud, la factura ya esta registrada en una solicitud de aclaración", "error");
            }
            $("#loader_div_ajax").hide();
        },
        error: function(){
            alert('Ups', "No fue posible registrar la solicitud, intente de nuevo", "error");
            $("#loader_div_ajax").hide();
        }
    });
});

function validaDias(option){
    var dias = $("#diasDescpacho").val();
    var recepcion = $("#nuevaRecepcion").val();
    var horasResepcion = $("#horasRecepcion").val();
    var nuevaNumGuia = $("#nuevaNumGuia").val();
    var nuevaFechaRecep = $("#nuevaFechaRecep").val();
    option = option.trim();
    console.log(dias);
    if(option == 'Fuera del tiempo de entrega' && dias < 2){
        alert('Ups', 'Su pedido se encuentra dentro del tiempo de entrega, de 2 a 5 días hábiles recibirá su producto. <br><br> dias ' + dias + ' <a href="http://www.estafeta.com/Tracking/searchByGet/?wayBillType=1&wayBill=' + guia + '" target="_blank"><span class="flaticon-search"></span> Rastrear mi pedido</a>', 'info');
        $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
        $("#nuevaIncidencia").val('');
        $("#filesSeccion").hide();
    }
    else if(option == 'Fuera del tiempo de entrega' && dias >= 2 && dias <= 5){
        alert('Ups', 'Su pedido se encuentra dentro del tiempo de entrega, de 2 a 5 días hábiles recibirá su producto. <br><br> dias ' + dias + ' <a href="http://www.estafeta.com/Tracking/searchByGet/?wayBillType=1&wayBill=' + guia + '" target="_blank"><span class="flaticon-search"></span> Rastrear mi pedido</a>', 'info');
        $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
        $("#nuevaIncidencia").val('');
        $("#filesSeccion").hide();
    }
    else if(option == 'Fuera del tiempo de entrega' && dias >= 6 && dias <= 40 || nuevaFechaRecep.trim() == ''){
        $("#filesSeccion").hide();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
    }
    if(option == 'Fuera del tiempo de entrega' && dias > 40 || nuevaFechaRecep.trim() == ''){
        alert('Ups', 'Ha expirado el tiempo  para levantar el reporte como <b>Fuera del tiempo de entrega</b> <br><br> <a href="http://www.estafeta.com/Tracking/searchByGet/?wayBillType=1&wayBill=' + guia + '" target="_blank"><span class="flaticon-search"></span> Rastrear mi pedido</a>', 'info');
        $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
        $("#nuevaIncidencia").val('');
        $("#filesSeccion").hide();
    }
    else if(option == 'Entrega Incorrecta de mi pedido (no conozco a la persona que recibió)' && dias >= 10 || nuevaFechaRecep.trim() == '' || option == 'Entrega Incorrecta de mi pedido (Dirección)' && dias >= 10 || nuevaFechaRecep.trim() == 'nuevaFechaRecep'){
        alert('Ups', 'Ha expirado el tiempo para levantar el reporte como entrega incorrecta.', 'info');
        $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
        $("#filesSeccion").hide();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
        $("#nuevaIncidencia").val('');
    }
    else if(option == 'Entrega Incorrecta de mi pedido (no conozco a la persona que recibió)' && dias < 10 || nuevaFechaRecep.trim() == '' || option == 'Entrega Incorrecta de mi pedido (Dirección)' && dias < 10 || nuevaFechaRecep.trim() == ''){
        $("#filesSeccion").hide();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
    }
    else if(option == 'Daño en el empaque y/o producto (agregar evidencia)' && dias > 1 || nuevaFechaRecep.trim() == ''){
        alert('Ups', 'Ha expirado el tiempo para levantar el reporte como Daño en el empaque y/o producto.', 'info');
        $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
        $("#filesSeccion").hide();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
        $("#nuevaIncidencia").val('');
    }
    else if(option == 'Daño en el empaque y/o producto (agregar evidencia)' && dias <= 1 || nuevaFechaRecep.trim() == ''){
        $("#filesSeccion").show();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct").attr("required", "required");
    }
    else if(option == 'Faltante de producto (agregar evidencia)' && dias > 1 || nuevaFechaRecep.trim() == ''){
        alert('Ups', 'Ha expirado el tiempo máximo para levantar el reporte como <b>Faltante de producto.</b>', 'info');
        $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
        $("#filesSeccion").hide();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
        $("#nuevaIncidencia").val('');
    }
    else if(option == 'Faltante de producto (agregar evidencia)' && dias > 1 || nuevaFechaRecep.trim() == ''){
        $("#filesSeccion").show();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct").attr("required", "required");
    }
    else if(option == 'Recepción de producto equivocado (agregar evidencia)' && dias > 1 || nuevaFechaRecep.trim() == ''){
        alert('Ups', 'Ha expirado el tiempo  para levantar el reporte como <b>Recepción de producto equivocado.</b>', 'info');
        $("#nuevaNumFactura, #nuevaNumGuia, #nuevaDirEnvio, #nuevaRecepcion, #nuevaFechaRecep, #horasRecepcion, #diasDescpacho").val('');
        $("#filesSeccion").hide();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
        $("#nuevaIncidencia").val('');
    }
    else if(option == 'Recepción de producto equivocado (agregar evidencia)' && dias > 1 || nuevaFechaRecep.trim() == ''){
        $("#filesSeccion").show();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct").attr("required", "required");
    }
    else if(option == 'Entrega Postergada' && dias > 1 || nuevaFechaRecep.trim() == ''){
        $("#filesSeccion").hide();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
    }
    else{
        $("#filesSeccion").show();
        $("#fileGuia, #fileEmpaqueExt, #fileEmpaqueInt, #fileProduct, #fileVideo").removeAttr("required");
    }
}

function alertsByCase(option){
    if(option == 'Fuera del tiempo de entrega'){
        alert('OK', 'Ha concluido su reporte correctamente. En un periodo máximo de 72 hrs su solictud será atendida.', 'success');
    }
    else{
        alert('OK', 'Ha concluido su reporte correctamente. En un periodo máximo de 72 hrs su solictud será atendida.', 'success');
    }
}