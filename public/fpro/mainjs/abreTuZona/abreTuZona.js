$("#divZonaMEX, #divZonaCOL, #divZonaPER, #divZonaECU, #divZonaCHL, #divZonaGTM, #divZonaSLV, #divZonaCRI, #divZonaPAN").hide();
$("#divZonaMEX").show();
$("#countryEquipo").val('MEX');
$("#nameP1, #rangoP1, #countryP1").val('');
$("#nameP2, #rangoP2, #countryP2").val('');
$("#sap_codeP1, #sap_codeP2").val('');
var zonaRepeat = $("#zonaEquipoForm2").val();
$("#loader_div_ajax").hide();

function getZonaByCountry(element){
    $("#divZonaMEX, #divZonaCOL, #divZonaPER, #divZonaECU, #divZonaCHL, #divZonaGTM, #divZonaSLV, #divZonaCRI, #divZonaPAN").hide();
    $("#divZona" + element).show();
}

function getDataP1(element){
    var sap_code = element;
    $.ajax({
        type: "GET",
        url: "/getDataPaticipante",
        data: {sap_code: sap_code},
        beforeSend: function(){
            $("#nameP1, #rangoP1, #countryP1").val('Cargando...');
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            $("#nameP1").val(response[0]['ApFirstName']);
            $("#rangoP1").val(response[0]['Rango']);
            var pais = response[0]['Pais'];
            if(response[0]['Pais'].trim() == 'LAT'){
                pais = "MEX";
            }
            $("#countryP1").val(pais);
            $("#loader_div_ajax").hide();
        }
    });
}

function getDataP2(element){
    var sap_code = element;
    $.ajax({
        type: "GET",
        url: "/getDataPaticipante",
        data: {sap_code: sap_code},
        beforeSend: function(){
            $("#nameP2, #rangoP2, #countryP2").val('Cargando...');
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            $("#nameP2").val(response[0]['ApFirstName']);
            $("#rangoP2").val(response[0]['Rango']);
            var pais = response[0]['Pais'];
            if(response[0]['Pais'].trim() == 'LAT'){
                pais = "MEX";
            }
            $("#countryP2").val(pais);
            $("#loader_div_ajax").hide();
        }
    });
}

function getEquipos(associateid){
    $('#nombreEquipoSlct option').remove();
    $('#nombreEquipoSlct').append(new Option('Selecciona tu equipo', '-'));
    $.ajax({
        type: "GET",
        url: "/getEquipos",
        data: {associateid: associateid},
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            var equipos = parseInt(response['totalEquipos']);
            var html = "";
            for (let x = 0; x < equipos; x++) {
                $('#nombreEquipoSlct').append(new Option('Equipo ' + (parseInt(x) + 1), (parseInt(x) + 1)));
            }
            $("#resumenEquipos").html(html);
            $("#nEquipos").val((parseInt(equipos) + 1));
            $("#loader_div_ajax").hide();
        }
    });
}
getEquipos($("#associateid").val());

function loadDatatableEquipos(associateid){
    $('#resumenEquiposTable').DataTable( {
        destroy: true,
        paging: false,
        searching: false,
        ordering:  false,
        info: false,
        ajax: '/loadDatatableEquipos?associateid=' + associateid,
        columns: [
            { data: 'NumEquipo' },
            { data: 'Associateid' },
            { data: 'AssociateName' },
            { data: 'Rango' },
            { data: 'Pais_Registro' },
            {
                data: 'ZonaC_Registro',
                render: function(data, type, row){
                    var zona_text = row.ZonaC_Registro;
                    if(row.ZonaC_Registro.trim() == 'Caldas'){
                        zona_text = "Eje Cafetero";
                    }
                    else if(row.ZonaC_Registro.trim() == 'Meta'){
                        zona_text = "Llanos Orientales";
                    }
                    return zona_text;
                }
            },
            { data: 'Fecha_Registro' },
        ],
        order: [[0, 'asc']],
        rowGroup: {
            dataSrc: 'nombreEquipo'
        }
    } );
}
loadDatatableEquipos($("#associateid").val());

function limpiaForm(){
    $("#divZonaMEX, #divZonaCOL, #divZonaPER, #divZonaECU, #divZonaCHL, #divZonaGTM, #divZonaSLV, #divZonaCRI, #divZonaPAN").hide();
    $("#divZonaMEX").show();
    $("#countryEquipo").val('MEX');
    $("#sap_codeP1, #sap_codeP2").val('');
    $("#nameP1, #rangoP1, #countryP1").val('');
    $("#nameP2, #rangoP2, #countryP2").val('');
}

$('#sap_codeP1').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        if($("#sap_codeP1").val().trim() === ''){
            required('Todos los campos requeridos');
        }
        else if($("#sap_codeP1").val().trim() === $("#associateid").val() || $("#sap_codeP1").val().trim() === $("#sap_codeP2").val().trim()){
            required('Intenta con un código diferente, este es tu número de influencer y no puedes registrar dos veces el mismo código');
        }
        else{
            getDataP1($("#sap_codeP1").val());
        }
    }
});

$('#sap_codeP2').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        if($("#sap_codeP2").val().trim() === ''){
            required('Todos los campos requeridos');
        }
        else if($("#sap_codeP1").val().trim() === $("#associateid").val() || $("#sap_codeP1").val().trim() === $("#sap_codeP2").val().trim()){
            required('Intenta con un código diferente, este es tu número de influencer y no puedes registrar dos veces el mismo código');
        }
        else{
            getDataP2($("#sap_codeP2").val());
        }
    }
});

function getDataRegister(associateid, name, incDate, status){
    var sap_code = associateid;
    $.ajax({
        type: "GET",
        url: "/getDataPaticipante",
        data: {sap_code: sap_code},
        beforeSend: function(){
            $("#" + name + ", #" + incDate + ", #" + status).val('Cargando...');
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            if(response.length > 0){
                $("#" + name).val(response[0]['ApFirstName']);
                $("#" + incDate).val(response[0]['Entered']);
                $("#" + status).val("En proceso");
            }
            else{
                required('No se encontraron datos');
                $("#" + name + ", #" + incDate + ", #" + status).val('');
            }
            $("#loader_div_ajax").hide();
        }
    });
}

function required(mensaje){
    swal({
        title: 'Ups',
        text: mensaje,
        type: 'error',
        padding: '2em'
    });
}

for (let i = 1; i < 11; i++) {
    $("#sap_code_RegLider" + i + ", #nameRegLider" + i + ", #inc_dateRegLider" + i + ", #estatusRegLider" + i).val('');
    $("#sap_code_RegInt1" + i + ", #nameRegInt1" + i + ", #inc_dateRegInt1" + i + ", #estatusRegInt1" + i).val('');
    $("#sap_code_RegInt2" + i + ", #nameRegInt2" + i + ", #inc_dateRegInt2" + i + ", #estatusRegInt2" + i).val('');

    $("#zonaRegLider" + i + ", #zonaRegInt1" + i + ", #zonaRegInt2" + i + ", #zonaVPmnkLider" + i + ", #zonaVPmnkInt1" + i + ", #zonaVPmnkInt2" + i + ", #zonaKinyaLider" + i + ", #zonaKinyaInt1" + i + ", #zonaKinyaInt2" + i).val('');

    $('#sap_code_RegLider' + i).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if($("#sap_code_RegLider" + i).val().trim() === ''){
                required('Ingresa un código de influencer');
            }
            else{
                var element = this.id;
                var associateid = $("#" + element).val();
                var elements = $("#" + element).attr('data-elements');
                elements = elements.split(',');
                var name = elements[0];
                var incDate = elements[1];
                var status = elements[2];
                getDataRegister(associateid, name, incDate, status);
            }
        }
    });
    $('#sap_code_RegInt1' + i).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if($("#sap_code_RegInt1" + i).val().trim() === ''){
                required('Ingresa un código de influencer');
            }
            else{
                var element = this.id;
                var associateid = $("#" + element).val();
                var elements = $("#" + element).attr('data-elements');
                elements = elements.split(',');
                var name = elements[0];
                var incDate = elements[1];
                var status = elements[2];
                getDataRegister(associateid, name, incDate, status);
            }
        }
    });
    $('#sap_code_RegInt2' + i).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if($("#sap_code_RegInt2" + i).val().trim() === ''){
                required('Ingresa un código de influencer');
            }
            else{
                var element = this.id;
                var associateid = $("#" + element).val();
                var elements = $("#" + element).attr('data-elements');
                elements = elements.split(',');
                var name = elements[0];
                var incDate = elements[1];
                var status = elements[2];
                getDataRegister(associateid, name, incDate, status);
            }
        }
    });
}

function getDataKinya(id){
    var datos = $("#" + id).attr('data-elements');
    var elements = datos.split(',');
    var sap_code = $("#" + id).val();
    $.ajax({
        type: "get",
        url: "/getDataKinya",
        data: {
            sap_code: sap_code
        },
        beforeSend: function(){
            $("#" + elements[0]).val('Cargando...');
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            $("#" + elements[0]).val(response[0]['ApFirstName']);
            $("#loader_div_ajax").hide();
        }
    });
}

for (let x = 0; x < 4; x++) {
    $("#sap_code_KinyaLider" + x + ", #nameKinyaLider" + x + ", #zonaKinyaLider" + x).val('');
    $("#sap_code_KinyaIntegrante1" + x + ", #nameKinyaIntegrante1" + x + ", #zonaKinyaIntegrante1" + x).val('');
    $("#sap_code_KinyaIntegrante2" + x + ", #nameKinyaIntegrante2" + x + ", #zonaKinyaIntegrante2" + x).val('');
    
    $('#sap_code_KinyaLider' + x).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if($("#sap_code_KinyaLider" + x).val().trim() === ''){
                required('Ingresa un código de influencer');
            }
            else{
                getDataKinya(this.id);
            }
        }
    });
    $('#sap_code_KinyaIntegrante1' + x).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if($("#sap_code_KinyaIntegrante1" + x).val().trim() === ''){
                required('Ingresa un código de influencer');
            }
            else{
                getDataKinya(this.id);
            }
        }
    });
    $('#sap_code_KinyaIntegrante2' + x).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if($("#sap_code_KinyaIntegrante2" + x).val().trim() === ''){
                required('Ingresa un código de influencer');
            }
            else{
                getDataKinya(this.id);
            }
        }
    });
}

function registroGuardado(mensaje){
    swal({
        title: 'Ok',
        text: mensaje,
        type: 'success',
        padding: '2em'
    });
}

function saveEquipo(){
    var sap_codeP1 = $("#sap_codeP1").val();
    var nameP1 = $("#nameP1").val();
    var rangoP1 = $("#rangoP1").val();
    var countryP1 = $("#countryP1").val();
    var sap_codeP2 = $("#sap_codeP2").val();
    var nameP2 = $("#nameP2").val();
    var rangoP2 = $("#rangoP2").val();
    var countryP2 = $("#countryP2").val();
    if(sap_codeP1.trim() != '' && nameP1.trim() != '' && rangoP1.trim() != '' && countryP1.trim() != '' && sap_codeP2.trim() != '' && nameP2.trim() != '' && rangoP2.trim() != '' && countryP2.trim() != ''){
        var zona = "";
        switch ($("#countryEquipo").val()) {
            case 'MEX':
                zona = $("#zonaMEX").val();
                break;
            case 'COL':
                zona = $("#zonaCOL").val();
                break;
            case 'PER':
                zona = $("#zonaPER").val();
                break;
            case 'ECU':
                zona = $("#zonaECU").val();
                break;
            case 'CHL':
                zona = $("#zonaCHL").val();
                break;
            case 'GTM':
                zona = $("#zonaGTM").val();
                break;
            case 'SLV':
                zona = $("#zonaSLV").val();
                break;
            case 'CRI':
                zona = $("#zonaCRI").val();
                break;
            case 'PAN':
                zona = $("#zonaPAN").val();
                break;
            default:
                zona = $("#zonaMEX").val();
                break;
        }
        $.ajax({
            type: "GET",
            url: "/saveEquipo",
            data: {
                nEquipos: $("#nEquipos").val(),
                sap_codeLider: $("#sap_codeLider").val(),
                nameLider: $("#nameLider").val(),
                rangoLider: $("#rangoLider").val(),
                countryLider: $("#countryLider").val(),
                countryEquipo: $("#countryEquipo").val(),
                zona: zona,
                sap_codeP1: $("#sap_codeP1").val(),
                nameP1: $("#nameP1").val(),
                rangoP1: $("#rangoP1").val(),
                countryP1: $("#countryP1").val(),
                sap_codeP2: $("#sap_codeP2").val(),
                nameP2: $("#nameP2").val(),
                rangoP2: $("#rangoP2").val(),
                countryP2: $("#countryP2").val(),
            },
            beforeSend: function(){
                $("#loader_div_ajax").show();
            },
            success: function (response) {
                if(response == 'si'){
                    registroGuardado('Tu equipo se ha registrado correctamente');
                    getEquipos($("#associateid").val());
                    limpiaForm();
                    loadDatatableEquipos($("#associateid").val());
                    $("#loader_div_ajax").hide();
                }
                else{
                    required("Lo siento, el o los influencers ya están registrados en otro equipo");
                    $("#loader_div_ajax").hide();
                }
            }
        });
    }
    else{
        required('Favor de llenar todos los campos');
        $("#loader_div_ajax").hide();
    }
}

function getDataEquipo(opt){
    $.ajax({
        type: "get",
        url: "/getDataEquipo",
        data: { equipo: opt, associateid: $("#associateid").val() },
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            $('#zonaEquipoForm2 option').remove();
            var zonaTexto = response['zona'][0]['ZonaC_Registro'];
            if(response['zona'][0]['ZonaC_Registro'].trim() == 'Caldas'){
                zonaTexto = 'Eje Cafetero';
            }
            else if(response['zona'][0]['ZonaC_Registro'].trim() == 'Meta'){
                zonaTexto = 'Llanos Orientales';
            }
            $('#zonaEquipoForm2').append(new Option(response['zona'][0]['ZonaC_Registro'], response['zona'][0]['ZonaC_Registro']));
            $('#paisEquipo option').remove();
            $('#paisEquipo').append(new Option(response['zona'][0]['Pais_Registro'], response['zona'][0]['Pais_Registro']));
            for (let x = 0; x < 10; x++) {
                $("#zonaRegLider" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
                $("#zonaRegInt1" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
                $("#zonaRegInt2" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
                $("#zonaKinyaLider" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
                $("#zonaKinyaIntegrante1" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
                $("#zonaKinyaIntegrante2" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
                $("#zonaVPmnkLider" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
                $("#zonaVPmnkInt1" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
                $("#zonaVPmnkInt2" + (parseInt(x) + 1)).val(response['zona'][0]['ZonaC_Registro']);
            }
            $("span[class='liderNameSpan']").text(response['lider'][0]['AssociateName']);
            $("span[class='int1NameSpan']").text(response['integrantes'][0]['AssociateName']);
            $("span[class='int2NameSpan']").text(response['integrantes'][1]['AssociateName']);

            $("span[class='liderCodeSpan']").text(response['lider'][0]['Associateid']);
            $("span[class='int1CodeSpan']").text(response['integrantes'][0]['Associateid']);
            $("span[class='int2CodeSpan']").text(response['integrantes'][1]['Associateid']);

            for(let x = 0; x < 11; x++){
                $("#estatusRegLider" + x).val('En proceso');
                $("#estatusRegInt1" + x).val('En proceso');
                $("#estatusRegInt2" + x).val('En proceso');

                $("#deleteIncLider" + x).addClass('hide');
                $("#deleteIncInc1" + x).addClass('hide');
                $("#deleteIncInc2" + x).addClass('hide');

                $("#notaRegLider" + (parseInt(x) + 1)).text('');
                $("#notaRegInt1" + (parseInt(x) + 1)).text('');
                $("#notaRegInt2" + (parseInt(x) + 1)).text('');
            }

            for(let x = 0; x < 4; x++){
                $("#estatusKinyaLider" + x).val('En proceso');
                $("#estatusKinyaIntegrante1" + x).val('En proceso');
                $("#estatusKinyaIntegrante2" + x).val('En proceso');

                $("#deleteKinyaLider" + x).addClass('hide');
                $("#deleteKinyaIntegrante1" + x).addClass('hide');
                $("#deleteKinyaIntegrante2" + x).addClass('hide');

                $("#periodoKinyaLider" + x).removeAttr('disabled');
                $("#periodoKinyaIntegrante1" + x).removeAttr('disabled');
                $("#periodoKinyaIntegrante2" + x).removeAttr('disabled');

                $("#notaKinyaLider" + (parseInt(x) + 1)).text('');
                $("#notaKinyaIntegrante1" + (parseInt(x) + 1)).text('');
                $("#notaKinyaIntegrante2" + (parseInt(x) + 1)).text('');
            }

            loadRegistrosIncoporacionesLider();
            loadRegistrosIncoporacionesInt1();
            loadRegistrosIncoporacionesInt2();

            loadKinyaLider();
            loadKinyaIntegrante1();
            loadKinyaIntegrante2();

            $('.repeater-default').repeater({
                initEmpty: true,
                show: function () { 
                    $(this).slideDown('slow');
                },
                defaultValues: {
                    features: ['abs'],estatus_orden: 'En proceso', zona_orden: zonaRepeat, puntos_orden: 0
                }
            });
            $("#repeaterContainerLider, #repeaterContainerUser1, #repeaterContainerUser2").empty();
            loadOrdenesLider();
            loadOrdenesIntegrante1();
            loadOrdenesIntegrante2();
            $("#loader_div_ajax").hide();
        }
    });
}

function saveIncorporacion(id){
    var dataos = $("#" + id).attr('data-registro');
    var ids = dataos.split(',');
    
    var nequipo = $("#nombreEquipoSlct").val();
    var sap_code = $("#" + ids[0]).val();
    var name = $("#" + ids[1]).val();
    var inc_date = $("#" + ids[2]).val();
    var estatus = $("#" + ids[3]).val();
    var zona = $("#" + ids[4]).val();
    var integrante = $("#" + ids[5]).text();

    if(sap_code.trim() != '' && name.trim() != '' && inc_date.trim() != '' && estatus.trim() != '' && zona.trim() != '' && nequipo.trim() != '-'){
        var data = {
            nequipo: nequipo,
            liderId: $("#associateid").val(),
            integranteId: integrante,
            paisReg: $("#paisEquipo").val(),
            zona: zona,
            fechaReg: inc_date,
            incId: sap_code,
            name: name, 
        }
        $.ajax({
            type: "get",
            url: "/saveIncorporacion",
            data: data,
            beforeSend: function(){
                $("#loader_div_ajax").show();
            },
            success: function (response) {
                if(response.trim() == 'no'){
                    swal({
                        title: 'OK',
                        text: "El registro de incorporación se guardo correctamente",
                        type: 'success',
                        padding: '2em'
                    });
                    loadRegistrosIncoporacionesLider();
                    loadRegistrosIncoporacionesInt1();
                    loadRegistrosIncoporacionesInt2();
                    $("#loader_div_ajax").hide();
                }
                else{
                    required("La incorporación ya esta registrada en otro equipo");
                    $("#loader_div_ajax").hide();
                }
            },
            error: function (){
                required("El usuario ya se encuentra registrado en otro equipo");
                $("#loader_div_ajax").hide();
            }
        });
    }
    else{
        required('los campos son requeridos.');
    }
}

var estatus = {
    0: "En proceso",
    1: "Aprobado",
    2: "No aprobado",
}
function loadRegistrosIncoporacionesLider(){
    var sap_code_Lider = $("#associateid").val();
    $.ajax({
        type: "get",
        url: "/loadRegistrosIncoporacionesLider",
        data: {
            sap_code_Lider: sap_code_Lider,
            zona: $("#zonaEquipoForm2").val(),
        },
        beforeSend: function(){
            for (let x = 0; x < 10; x++) {
                $("#sap_code_RegLider" + (parseInt(x) + 1)).val('');
                $("#sap_code_RegLider" + (parseInt(x) + 1)).attr('readonly', false);
                $("#nameRegLider" + (parseInt(x) + 1)).val('');
                $("#inc_dateRegLider" + (parseInt(x) + 1)).val('');
                $("#estatusRegLider" + (parseInt(x) + 1)).val('');

            }
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            for (let x = 0; x < response.length; x++) {
                $("#sap_code_RegLider" + (parseInt(x) + 1)).val(response[x]['Incorporado_id']);
                $("#sap_code_RegLider" + (parseInt(x) + 1)).attr('readonly', 'readonly');
                $("#nameRegLider" + (parseInt(x) + 1)).val(response[x]['Incorporado_Name']);
                $("#inc_dateRegLider" + (parseInt(x) + 1)).val(response[x]['Fecha_Incorporacion']);
                $("#estatusRegLider" + (parseInt(x) + 1)).val(estatus[response[x]['Estatus']]);
                $("#notaRegLider" + (parseInt(x) + 1)).text(response[x]['Nota']);
                if(parseInt(response[x]['Estatus']) < 2){
                    $("#deleteIncLider" + (parseInt(x) + 1)).addClass('hide');
                }
                else{
                    $("#deleteIncLider" + (parseInt(x) + 1)).removeClass('hide');
                }
                $("#loader_div_ajax").hide();
            }
        }
    });
}

function loadRegistrosIncoporacionesInt1(){
    var sap_code_Lider = $("#associateid").val();
    var sap_code_integrante = $("#int1CodeSpan").text();
    $.ajax({
        type: "get",
        url: "/loadRegistrosIncoporacionesInt1",
        data: {
            sap_code_Lider: sap_code_Lider,
            sap_code_integrante: sap_code_integrante,
            zona: $("#zonaEquipoForm2").val(),
        },
        beforeSend: function(){
            for (let x = 0; x < 10; x++) {
                $("#sap_code_RegInt1" + (parseInt(x) + 1)).val('');
                $("#sap_code_RegInt1" + (parseInt(x) + 1)).attr('readonly', false);
                $("#nameRegInt1" + (parseInt(x) + 1)).val('');
                $("#inc_dateRegInt1" + (parseInt(x) + 1)).val('');
                $("#estatusRegInt1" + (parseInt(x) + 1)).val('');

            }
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            for (let x = 0; x < response.length; x++) {
                $("#sap_code_RegInt1" + (parseInt(x) + 1)).val(response[x]['Incorporado_id']);
                $("#sap_code_RegInt1" + (parseInt(x) + 1)).attr('readonly', 'readonly');
                $("#nameRegInt1" + (parseInt(x) + 1)).val(response[x]['Incorporado_Name']);
                $("#inc_dateRegInt1" + (parseInt(x) + 1)).val(response[x]['Fecha_Incorporacion']);
                $("#estatusRegInt1" + (parseInt(x) + 1)).val(estatus[response[x]['Estatus']]);
                $("#notaRegInt1" + (parseInt(x) + 1)).text(response[x]['Nota']);
                if(parseInt(response[x]['Estatus']) < 2){
                    $("#deleteIncInc1" + (parseInt(x) + 1)).addClass('hide');
                }
                else{
                    $("#deleteIncInc1" + (parseInt(x) + 1)).removeClass('hide');
                }
            }
            $("#loader_div_ajax").hide();
        }
    });
}

function loadRegistrosIncoporacionesInt2(){
    var sap_code_Lider = $("#associateid").val();
    var sap_code_integrante = $("#int2CodeSpan").text();
    $.ajax({
        type: "get",
        url: "/loadRegistrosIncoporacionesInt2",
        data: {
            sap_code_Lider: sap_code_Lider,
            sap_code_integrante: sap_code_integrante,
            zona: $("#zonaEquipoForm2").val(),
        },
        beforeSend: function(){
            for (let x = 0; x < 10; x++) {
                $("#sap_code_RegInt2" + (parseInt(x) + 1)).val('');
                $("#sap_code_RegInt2" + (parseInt(x) + 1)).attr('readonly', false);
                $("#nameRegInt2" + (parseInt(x) + 1)).val('');
                $("#inc_dateRegInt2" + (parseInt(x) + 1)).val('');
                $("#estatusRegInt2" + (parseInt(x) + 1)).val('');

            }
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            for (let x = 0; x < response.length; x++) {
                $("#sap_code_RegInt2" + (parseInt(x) + 1)).val(response[x]['Incorporado_id']);
                $("#sap_code_RegInt2" + (parseInt(x) + 1)).attr('readonly', 'readonly');
                $("#nameRegInt2" + (parseInt(x) + 1)).val(response[x]['Incorporado_Name']);
                $("#inc_dateRegInt2" + (parseInt(x) + 1)).val(response[x]['Fecha_Incorporacion']);
                $("#estatusRegInt2" + (parseInt(x) + 1)).val(estatus[response[x]['Estatus']]);
                $("#notaRegInt2" + (parseInt(x) + 1)).text(response[x]['Nota']);
                if(parseInt(response[x]['Estatus'].trim()) < 2){
                    $("#deleteIncInc2" + (parseInt(x) + 1)).addClass('hide');
                }
                else{
                    $("#deleteIncInc2" + (parseInt(x) + 1)).removeClass('hide');
                }
            }
            $("#loader_div_ajax").hide();
        }
    });
}

function deleteInvalido(id){
    var datos = $("#" + id).attr('data-delete');
    var compuesto = datos.split(',');

    var Ownerid = $("#" + compuesto[0]).val();
    var Associateid = $("#" + compuesto[1]).text();
    var Incorporado_id = $("#" + compuesto[2]).val();
    var ZonaC_Registro = $("#" + compuesto[3]).val();

    data = {
        Ownerid: Ownerid,
        Associateid: Associateid,
        Incorporado_id: Incorporado_id,
        ZonaC_Registro: ZonaC_Registro,
    }

    $.ajax({
        type: "get",
        url: "/deleteInvalido",
        data: data,
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            swal({
                title: 'OK',
                text: "El registro se liberó correctamente",
                type: 'success',
                padding: '2em'
            });
            loadRegistrosIncoporacionesLider();
            loadRegistrosIncoporacionesInt1();
            loadRegistrosIncoporacionesInt2();
            $("#loader_div_ajax").hide();
        },
        error: function (){
            required("No se puede eliminar");
            $("#loader_div_ajax").hide();
        }
    });
}

function registrarKinya(id){
    var datos = $("#" + id).attr('data-register');
    var descompuesto = datos.split(',');
    
    var NumEquipo = $("#nombreEquipoSlct").val();
    var Ownerid = $("#" + descompuesto[0]).val();
    var Associateid = $("#" + descompuesto[1]).text();
    var Pais_Registro = $("#paisEquipo").val();
    var ZonaC_Registro = $("#" + descompuesto[5]).val();
    var Period_RegistroKinya = $("#" + descompuesto[4]).val();
    var Associate_Kinya = $("#" + descompuesto[2]).val();
    var Kinya_Name = $("#" + descompuesto[3]).val();

    if(Associate_Kinya.trim != '' && Kinya_Name.trim() != '' && Period_RegistroKinya.trim() != '' && ZonaC_Registro.trim() != ''){
        var data = {
            NumEquipo: NumEquipo,
            Ownerid: Ownerid,
            Associateid: Associateid,
            Pais_Registro: Pais_Registro,
            ZonaC_Registro: ZonaC_Registro,
            Period_RegistroKinya: Period_RegistroKinya,
            Associate_Kinya: Associate_Kinya,
            Kinya_Name: Kinya_Name,
        }
        $.ajax({
            type: "GET",
            url: "/registrarKinya",
            data: data,
            beforeSend: function(){
                $("#loader_div_ajax").show();
            },
            success: function (response) {
                if(response.trim() == 'no'){
                    swal({
                        title: 'OK',
                        text: "Se guardo el registro correctamente",
                        type: 'success',
                        padding: '2em'
                    });
                    loadKinyaLider();
                    loadKinyaIntegrante1();
                    loadKinyaIntegrante2();
                }
                else{
                    required("El usuario ya se encuentra registrado en otro equipo");
                }
                $("#loader_div_ajax").hide();
            },
            error: function (){
                required("El usuario ya se encuentra registrado en otro equipo");
                $("#loader_div_ajax").hide();
            }
        });
    }
    else{
        required("Todos los campos son obligatorios");
        $("#loader_div_ajax").hide();
    }
}

function loadKinyaLider(){
    var sap_code_Lider = $("#associateid").val();
    $.ajax({
        type: "get",
        url: "/loadKinyaLider",
        data: {
            sap_code_Lider: sap_code_Lider,
            zona: $("#zonaEquipoForm2").val(),
            nEquipo: $("#nombreEquipoSlct").val(),
        },
        beforeSend: function(){
            for (let x = 0; x < 3; x++) {
                $("#sap_code_KinyaLider" + (parseInt(x) + 1)).val('');
                $("#sap_code_KinyaLider" + (parseInt(x) + 1)).attr('readonly', false);
                $("#nameKinyaLider" + (parseInt(x) + 1)).val('');

            }
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            for (let x = 0; x < response.length; x++) {
                $("#sap_code_KinyaLider" + (parseInt(x) + 1)).val(response[x]['Associate_Kinya']);
                $("#sap_code_KinyaLider" + (parseInt(x) + 1)).attr('readonly', 'readonly');
                $("#nameKinyaLider" + (parseInt(x) + 1)).val(response[x]['Kinya_Name']);
                $("#periodoKinyaLider" + (parseInt(x) + 1)).val(response[x]['Period_RegistroKinya']);
                $("#periodoKinyaLider" + (parseInt(x) + 1)).attr('disabled', 'disabled');
                $("#zonaKinyaLider" + (parseInt(x) + 1)).val(response[x]['ZonaC_Registro']);
                $("#estatusKinyaLider" + (parseInt(x) + 1)).val(estatus[response[x]['Estatus']]);
                $("#notaKinyaLider" + (parseInt(x) + 1)).text(response[x]['Nota']);
                if(response[x]['Estatus'] < 2){
                    $("#deleteKinyaLider" + (parseInt(x) + 1)).addClass('hide');
                }
                else{
                    $("#deleteKinyaLider" + (parseInt(x) + 1)).removeClass('hide');
                }
            }
            $("#loader_div_ajax").hide();
        }
    });
}

function loadKinyaIntegrante1(){
    var sap_code_Lider = $("#associateid").val();
    var sap_code_integrante = $("#int1CodeSpan").text();
    $.ajax({
        type: "get",
        url: "/loadKinyaIntegrante1",
        data: {
            sap_code_Lider: sap_code_Lider,
            sap_code_integrante: sap_code_integrante,
            zona: $("#zonaEquipoForm2").val(),
            nEquipo: $("#nombreEquipoSlct").val(),
        },
        beforeSend: function(){
            for (let x = 0; x < 3; x++) {
                $("#sap_code_KinyaIntegrante1" + (parseInt(x) + 1)).val('');
                $("#sap_code_KinyaIntegrante1" + (parseInt(x) + 1)).attr('readonly', false);
                $("#nameKinyaIntegrante1" + (parseInt(x) + 1)).val('');

            }
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            for (let x = 0; x < response.length; x++) {
                $("#sap_code_KinyaIntegrante1" + (parseInt(x) + 1)).val(response[x]['Associate_Kinya']);
                $("#sap_code_KinyaIntegrante1" + (parseInt(x) + 1)).attr('readonly', 'readonly');
                $("#nameKinyaIntegrante1" + (parseInt(x) + 1)).val(response[x]['Kinya_Name']);
                $("#periodoKinyaIntegrante1" + (parseInt(x) + 1)).val(response[x]['Period_RegistroKinya']);
                $("#periodoKinyaIntegrante1" + (parseInt(x) + 1)).attr('disabled', 'disabled');
                $("#zonaKinyaIntegrante1" + (parseInt(x) + 1)).val(response[x]['ZonaC_Registro']);
                $("#estatusKinyaIntegrante1" + (parseInt(x) + 1)).val(estatus[response[x]['Estatus']]);
                $("#estatusKinyaIntegrante1" + (parseInt(x) + 1)).text(response[x]['Nota']);
                if(response[x]['Estatus'] < 2){
                    $("#deleteKinyaIntegrante1" + (parseInt(x) + 1)).addClass('hide');
                }
                else{
                    $("#deleteKinyaIntegrante1" + (parseInt(x) + 1)).removeClass('hide');
                }
            }
            $("#loader_div_ajax").hide();
        }
    });
}

function loadKinyaIntegrante2(){
    var sap_code_Lider = $("#associateid").val();
    var sap_code_integrante = $("#int2CodeSpan").text();
    $.ajax({
        type: "get",
        url: "/loadKinyaIntegrante2",
        data: {
            sap_code_Lider: sap_code_Lider,
            sap_code_integrante: sap_code_integrante,
            zona: $("#zonaEquipoForm2").val(),
            nEquipo: $("#nombreEquipoSlct").val(),
        },
        beforeSend: function(){
            for (let x = 0; x < 3; x++) {
                $("#sap_code_KinyaIntegrante2" + (parseInt(x) + 1)).val('');
                $("#sap_code_KinyaIntegrante2" + (parseInt(x) + 1)).attr('readonly', false);
                $("#nameKinyaIntegrante2" + (parseInt(x) + 1)).val('');

            }
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            for (let x = 0; x < response.length; x++) {
                $("#sap_code_KinyaIntegrante2" + (parseInt(x) + 1)).val(response[x]['Associate_Kinya']);
                $("#sap_code_KinyaIntegrante2" + (parseInt(x) + 1)).attr('readonly', 'readonly');
                $("#nameKinyaIntegrante2" + (parseInt(x) + 1)).val(response[x]['Kinya_Name']);
                $("#periodoKinyaIntegrante2" + (parseInt(x) + 1)).val(response[x]['Period_RegistroKinya']);
                $("#periodoKinyaIntegrante2" + (parseInt(x) + 1)).attr('disabled', 'disabled');
                $("#zonaKinyaIntegrante2" + (parseInt(x) + 1)).val(response[x]['ZonaC_Registro']);
                $("#estatusKinyaIntegrante2" + (parseInt(x) + 1)).val(estatus[response[x]['Estatus']]);
                $("#estatusKinyaIntegrante2" + (parseInt(x) + 1)).text(response[x]['Nota']);
                if(response[x]['Estatus'] < 2){
                    $("#deleteKinyaIntegrante2" + (parseInt(x) + 1)).addClass('hide');
                }
                else{
                    $("#deleteKinyaIntegrante2" + (parseInt(x) + 1)).removeClass('hide');
                }
            }
            $("#loader_div_ajax").hide();
        }
    });
}

function deleteKinyaInvalido(id){
    var datos = $("#" + id).attr('data-delete');
    var descompuesto = datos.split(',');

    var associateid = $("#" + descompuesto[0]).val();
    var liderCodeSpan = $("#" + descompuesto[1]).text();
    var sap_code_KinyaLider1 = $("#" + descompuesto[2]).val();
    var zonaEquipoForm2 = $("#" + descompuesto[3]).val();
    var nombreEquipoSlct = $("#" + descompuesto[4]).val();

    var data = {
        associateid: associateid,
        liderCodeSpan: liderCodeSpan,
        sap_code_KinyaLider1: sap_code_KinyaLider1,
        zonaEquipoForm2: zonaEquipoForm2,
        nombreEquipoSlct: nombreEquipoSlct,
    }

    $.ajax({
        type: "GET",
        url: "/deleteKinyaInvalido",
        data: data,
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            swal({
                title: 'OK',
                text: "El registro se liberó correctamente",
                type: 'success',
                padding: '2em'
            });
            loadKinyaLider();
            loadKinyaIntegrante1();
            loadKinyaIntegrante2();
            $("#loader_div_ajax").hide();
        },
        error: function (){
            required("No se puede eliminar");
            $("#loader_div_ajax").hide();
        }
    });
}

function getDataOrdenLider(name){
    var regex = /(\d+)/g;
    var numeroForm = name.match(regex);

    const formSerialize = formElement => {
        const values = {};
        const inputs = formElement.elements;
      
        for (let i = 0; i < inputs.length; i++) {
          values[inputs[i].name] = inputs[i].value;
        }
        return values;
    }
      
    const dumpValues = form => () => {
        const r = formSerialize(form);
        console.log(r);
        var nequipo = $("#nombreEquipoSlct").val();
        var owner = $("#associateid").val();
        var code_registro_orden = r['lider[' + numeroForm + '][code_registro_orden]'];
        var num_orden_orden = r['lider[' + numeroForm + '][num_orden_orden]'];
        var periodo_orden = r['lider[' + numeroForm + '][periodo_orden]'];
        var estatus_orden = r['lider[' + numeroForm + '][estatus_orden]'];
        var puntos_orden = r['lider[' + numeroForm + '][puntos_orden]'];
        var country = $("#paisEquipo").val();
        var zona = $("#zonaEquipoForm2").val();
        var integrante = $("#liderCodeSpan").text();

        if(code_registro_orden.trim() != '' && num_orden_orden.trim() != '' && estatus_orden.trim() != '' && puntos_orden.trim() != '' && country.trim() != '' && zona.trim() != '' && integrante.trim() != ''){
            var data = {
                nequipo: nequipo,
                owner: owner,
                integrante: integrante,
                code_registro_orden: code_registro_orden,
                num_orden_orden: num_orden_orden,
                country_orden: country,
                periodo_orden: periodo_orden,
                estatus_orden: estatus_orden,
                puntos_orden: puntos_orden,
                zona: zona
            }
            registrarOrden(data);
        }
        else{
            required("Todos los campos son requeridos");
        }
    }
    const form = document.getElementsByName(name)[0];
    dumpValues(form)();
}

function getDataOrdenIntegrante1(name){
    var regex = /(\d+)/g;
    var numeroForm = name.match(regex);
    const formSerialize = formElement => {
        const values = {};
        const inputs = formElement.elements;
      
        for (let i = 0; i < inputs.length; i++) {
          values[inputs[i].name] = inputs[i].value;
        }
        return values;
    }
      
    const dumpValues = form => () => {
        const r = formSerialize(form);
        console.log(r);
        var nequipo = $("#nombreEquipoSlct").val();
        var owner = $("#associateid").val();
        var code_registro_orden = r['integranteUno[' + numeroForm + '][code_registro_orden]'];
        var num_orden_orden = r['integranteUno[' + numeroForm + '][num_orden_orden]'];
        var periodo_orden = r['integranteUno[' + numeroForm + '][periodo_orden]'];
        var estatus_orden = r['integranteUno[' + numeroForm + '][estatus_orden]'];
        var puntos_orden = r['integranteUno[' + numeroForm + '][puntos_orden]'];
        var country = $("#paisEquipo").val();
        var zona = $("#zonaEquipoForm2").val();
        var integrante = $("#int1CodeSpan").text();
        console.log('code_registro_orden: ' + code_registro_orden);
        console.log('num_orden_orden: ' + num_orden_orden);
        console.log('periodo_orden: ' + periodo_orden);
        console.log('estatus_orden: ' + estatus_orden);
        console.log('puntos_orden: ' + puntos_orden);
        console.log('country: ' + country);
        console.log('zona: ' + zona);
        console.log('integrante: ' + integrante);

        if(code_registro_orden.trim() != '' && num_orden_orden.trim() != '' && estatus_orden.trim() != '' && puntos_orden.trim() != '' && country.trim() != '' && zona.trim() != '' && integrante.trim() != ''){
            var data = {
                nequipo: nequipo,
                owner: owner,
                integrante: integrante,
                code_registro_orden: code_registro_orden,
                num_orden_orden: num_orden_orden,
                country_orden: country,
                periodo_orden: periodo_orden,
                estatus_orden: estatus_orden,
                puntos_orden: puntos_orden,
                zona: zona
            }
            registrarOrden(data);
        }
        else{
            required("Todos los campos son requeridos");
        }
    }
    const form = document.getElementsByName(name)[0];
    dumpValues(form)();
}

function getDataOrdenIntegrante2(name){
    var regex = /(\d+)/g;
    var numeroForm = name.match(regex);
    const formSerialize = formElement => {
        const values = {};
        const inputs = formElement.elements;
      
        for (let i = 0; i < inputs.length; i++) {
          values[inputs[i].name] = inputs[i].value;
        }
        return values;
    }
      
    const dumpValues = form => () => {
        const r = formSerialize(form);
        console.log(r);
        var nequipo = $("#nombreEquipoSlct").val();
        var owner = $("#associateid").val();
        var code_registro_orden = r['integranteDos[' + numeroForm + '][code_registro_orden]'];
        var num_orden_orden = r['integranteDos[' + numeroForm + '][num_orden_orden]'];
        var periodo_orden = r['integranteDos[' + numeroForm + '][periodo_orden]'];
        var estatus_orden = r['integranteDos[' + numeroForm + '][estatus_orden]'];
        var puntos_orden = r['integranteDos[' + numeroForm + '][puntos_orden]'];
        var country = $("#paisEquipo").val();
        var zona = $("#zonaEquipoForm2").val();
        var integrante = $("#int2CodeSpan").text();
        console.log('code_registro_orden: ' + code_registro_orden);
        console.log('num_orden_orden: ' + num_orden_orden);
        console.log('periodo_orden: ' + periodo_orden);
        console.log('estatus_orden: ' + estatus_orden);
        console.log('puntos_orden: ' + puntos_orden);
        console.log('country: ' + country);
        console.log('zona: ' + zona);
        console.log('integrante: ' + integrante);

        if(code_registro_orden.trim() != '' && num_orden_orden.trim() != '' && estatus_orden.trim() != '' && puntos_orden.trim() != '' && country.trim() != '' && zona.trim() != '' && integrante.trim() != ''){
            var data = {
                nequipo: nequipo,
                owner: owner,
                integrante: integrante,
                code_registro_orden: code_registro_orden,
                num_orden_orden: num_orden_orden,
                country_orden: country,
                periodo_orden: periodo_orden,
                estatus_orden: estatus_orden,
                puntos_orden: puntos_orden,
                zona: zona
            }
            registrarOrden(data);
        }
        else{
            required("Todos los campos son requeridos");
        }
    }
    const form = document.getElementsByName(name)[0];
    dumpValues(form)();
}

function registrarOrden(data){
    $.ajax({
        type: "GET",
        url: "/registrarOrden",
        data: data,
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            if(response.trim() == 'no'){
                $("#repeaterContainerLider, #repeaterContainerUser1, #repeaterContainerUser2").empty();
                registroGuardado('La orden se guardo correctamente');
                $("#loader_div_ajax").hide();
                loadOrdenesLider();
                loadOrdenesIntegrante1();
                loadOrdenesIntegrante2();
            }
            else{
                required("La orden ya esta registrada en otro equipo");
                $("#loader_div_ajax").hide();
            }
        },
        error: function(){
            required("No se pudo guardar la orden");
            $("#loader_div_ajax").hide();
        }
    });
}

function loadOrdenesLider(){
    var sap_code_Lider = $("#associateid").val();
    $.ajax({
        type: "get",
        url: "/loadOrdenesLider",
        data: {
            sap_code_Lider: sap_code_Lider,
            zona: $("#zonaEquipoForm2").val(),
            nEquipo: $("#nombreEquipoSlct").val(),
        },
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            var tamanio = parseInt(response.length);
            var html = "";
            for(let x = 0; x < tamanio; x++){
                html += '<div class="r-container" data-repeater-item style="margin-bottom: 15px;border-bottom: 2px solid #8a8a8a;">' +
                            '<div class="form-group">' + 
                                '<form name="form_lider">' + 
                                    '<div class="row">' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Código de Influencer</label>' + 
                                            '<input type="text" name="code_registro_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['CardCode'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Número de Orden</label>' + 
                                            '<input type="text" name="num_orden_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['Ordernum'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3" hidden>' + 
                                            '<label>Periodo</label>' + 
                                            '<input type="text" name="periodo_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['Period_Registro'] + '"/> ' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Estatus</label>' + 
                                            '<input type="text" name="estatus_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly readonly value="' + estatus[response[x]['Estatus']] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Puntos</label>' + 
                                            '<input type="text" name="puntos_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly readonly value="' + response[x]['Puntos'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-5">' +
                                            '<label>Nota: </label><br>' +
                                            '<span name="nota_orden" style="color: #ee3d50 !important;">' + response[x]['Nota'] + '</span>' +
                                        '</div>' +
                                        '<div class="col-md-4" hidden>' + 
                                            '<div class="checkbox-inline d-inline-block">' + 
                                                '<button type="button" class="mr-2 mt-3 btn-rounded btn btn-success success" name="form_lider" disabled onclick="getDataOrdenLider(this.name)">Guardar Orden</button>' + 
                                            '</div>' + 
                                        '</div>' + 
                                    '</div>' + 
                                '</form>' + 
                            '</div>' + 
                        '</div>';
            }
            $("#repeaterContainerLider").html(html);
            $("#loader_div_ajax").hide();
        }
    });
}

function loadOrdenesIntegrante1(){
    var sap_code_Lider = $("#associateid").val();
    var sap_code_integrante = $("#int1CodeSpan").text();
    $.ajax({
        type: "get",
        url: "/loadOrdenesIntegrante1",
        data: {
            sap_code_Lider: sap_code_Lider,
            sap_code_integrante: sap_code_integrante,
            zona: $("#zonaEquipoForm2").val(),
            nEquipo: $("#nombreEquipoSlct").val(),
        },
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            var tamanio = parseInt(response.length);
            var html = "";
            for(let x = 0; x < tamanio; x++){
                html += '<div class="r-container" data-repeater-item style="margin-bottom: 15px;border-bottom: 2px solid #8a8a8a;">' +
                            '<div class="form-group">' + 
                                '<form name="form_lider">' + 
                                    '<div class="row">' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Código de Influencer</label>' + 
                                            '<input type="text" name="code_registro_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['CardCode'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Número de Orden</label>' + 
                                            '<input type="text" name="num_orden_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['Ordernum'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3" hidden>' + 
                                            '<label>Periodo</label>' + 
                                            '<input type="text" name="periodo_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['Period_Registro'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Estatus</label>' + 
                                            '<input type="text" name="estatus_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly readonly value="' + estatus[response[x]['Estatus']] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Puntos</label>' + 
                                            '<input type="text" name="puntos_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly readonly value="' + response[x]['Puntos'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-5">' +
                                            '<label>Nota: </label><br>' +
                                            '<span name="nota_orden" style="color: #ee3d50 !important;">' + response[x]['Nota'] + '</span>' +
                                        '</div>' +
                                        '<div class="col-md-4" hidden>' + 
                                            '<div class="checkbox-inline d-inline-block">' + 
                                                '<button type="button" class="mr-2 mt-3 btn-rounded btn btn-success success" name="form_lider" disabled onclick="getDataOrdenLider(this.name)">Guardar Orden</button>' + 
                                            '</div>' + 
                                        '</div>' + 
                                    '</div>' + 
                                '</form>' + 
                            '</div>' + 
                        '</div>';
            }
            $("#repeaterContainerUser1").html(html);
            $("#loader_div_ajax").hide();
        }
    });
}

function loadOrdenesIntegrante2(){
    var sap_code_Lider = $("#associateid").val();
    var sap_code_integrante = $("#int2CodeSpan").text();
    $.ajax({
        type: "get",
        url: "/loadOrdenesIntegrante2",
        data: {
            sap_code_Lider: sap_code_Lider,
            sap_code_integrante: sap_code_integrante,
            zona: $("#zonaEquipoForm2").val(),
            nEquipo: $("#nombreEquipoSlct").val(),
        },
        beforeSend: function(){
            $("#loader_div_ajax").show();
        },
        success: function (response) {
            var tamanio = parseInt(response.length);
            var html = "";
            for(let x = 0; x < tamanio; x++){
                html += '<div class="r-container" data-repeater-item style="margin-bottom: 15px;border-bottom: 2px solid #8a8a8a;">' +
                            '<div class="form-group">' + 
                                '<form name="form_lider">' + 
                                    '<div class="row">' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Código de Influencer</label>' + 
                                            '<input type="text" name="code_registro_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['CardCode'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Número de Orden</label>' + 
                                            '<input type="text" name="num_orden_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['Ordernum'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3" hidden>' + 
                                            '<label>Periodo</label>' + 
                                            '<input type="text" name="periodo_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly value="' + response[x]['Period_Registro'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Estatus</label>' + 
                                            '<input type="text" name="estatus_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly readonly value="' + estatus[response[x]['Estatus']] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-3">' + 
                                            '<label>Puntos</label>' + 
                                            '<input type="text" name="puntos_orden" class="form-control-rounded form-control form-control-sm mb-3" readonly readonly value="' + response[x]['Puntos'] + '"/>' + 
                                        '</div>' + 
                                        '<div class="col-md-5">' +
                                            '<label>Nota:</label><br>' +
                                            '<span name="nota_orden" style="color: #ee3d50 !important;">' + response[x]['Nota'] + '</span>' +
                                        '</div>' +
                                        '<div class="col-md-4" hidden>' + 
                                            '<div class="checkbox-inline d-inline-block">' + 
                                                '<button type="button" class="mr-2 mt-3 btn-rounded btn btn-success success" name="form_lider" disabled onclick="getDataOrdenLider(this.name)">Guardar Orden</button>' + 
                                            '</div>' + 
                                        '</div>' + 
                                    '</div>' + 
                                '</form>' + 
                            '</div>' + 
                        '</div>';
            }
            $("#repeaterContainerUser2").html(html);
            $("#loader_div_ajax").hide();
        }
    });
}