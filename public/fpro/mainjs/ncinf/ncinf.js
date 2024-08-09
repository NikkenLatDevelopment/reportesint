$(document).ready(function(){
    $('body').on('click', '#Genealogy', function(){
        $("#modalGenealogy").modal({backdrop: 'static', keyboard: false});
    });

    $('body').on('click', '#DetailKinya', function(){
        $("#modalTable").modal({backdrop: 'static', keyboard: false});
    });

    $('body').on('click', '#DetailKinyaPlus', function(){
        $("#modalCart").modal({backdrop: 'static', keyboard: false});
    });

    $('body').on('click', '#DetailKintai', function(){
        $("#modalKintai").modal({backdrop: 'static', keyboard: false});
    });

    $('body').on('click', '#detailsInfluencia', function(){
        $("#modalInfluencia").modal({backdrop: 'static', keyboard: false});
    });
    $("#period").val('-')
});

//GRAFICAS TEMPLATE

pie_short_Kinya_3_3();
function pie_short_Kinya_3_3() {
    var sort = true;
    var associateid = $("#associateid").val();
    $.ajax({
        type: "get",
        url: "/getChartInfluencia30",
        data: {
            associateid: associateid
        },
        success: function (response) {
            var venta = 0;
            var incorporacion = 0;
            if(response['venta'].length > 0){
                venta = response['venta'][0]['venta'];
            }
            if(response['incorporacion'].length > 0){
                incorporacion = response['incorporacion'][0]['incorp'];
            }
            var cien = (parseInt(venta) + parseInt(incorporacion));
            venta = (venta/cien) * 100;
            incorporacion = (incorporacion/cien) * 100;
            var generate = function () {
                return c3.generate({
                    bindto: '#NikkenChallengeChart_Kinya_3_3',
                    data: {
                        columns: [
                            ["Venta", venta],
                            ["Incorporación", incorporacion],
                        ],
                        type: 'pie',
                    },
                    color: {
                        pattern: ['#70ad47', '#4472c4']
                    },
                    axis: {
                        x: {
                            label: 'Sepal.Width'
                        },
                        y: {
                            label: 'Petal.Width'
                        }
                    },
                });
            }, chart = generate();
        }
    });
}

function number_format(number, decimals, dec_point, thousands_point) {
    if (number == null || !isFinite(number)) {
        throw new TypeError("number is not valid");
    }
    if (!decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }
    if (!dec_point) {
        dec_point = '.';
    }
    if (!thousands_point) {
        thousands_point = ',';
    }
    number = parseFloat(number).toFixed(decimals);
    number = number.replace(".", dec_point);
    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);
    return number;
}
//END GRAFICAS TEMPLATE

//MODAL WINNER
var ganador = $("#kintaiWinner").val();

if (ganador != '0') {
    winner();
}

function winner() {
    var end = Date.now() + (15 * 1000);

    var interval = setInterval(function() {
        if (Date.now() > end) {
            return clearInterval(interval);
        }

        confetti({
            startVelocity: 30,
            spread: 360,
            ticks: 60,
            origin: {
                x: Math.random(),
                y: Math.random() - 0.2
            }
        });
    }, 200);

    var duration = 15 * 1000;
    var end = Date.now() + duration;

    function frame() {
        confetti({
        particleCount: 15,
        angle: 60,
        spread: 55,
        origin: { x: 0 }
        });
        
        confetti({
        particleCount: 15,
        angle: 120,
        spread: 55,
        origin: { x: 1 }
        });

        if (Date.now() < end) {
            requestAnimationFrame(frame);
        }
    };

    swal({
        title: '¡¡FELICIDADES HAS COMPLETADO EL KINTAI!!',
        text: 'HAS GANADO ' + $("#amountWinn").val(),
        imageUrl: '../fpro/img/NCINF/winner.png',
        imageWidth: 400,
        imageHeight: 220,
        imageAlt: 'Has ganado el kintai',
        animation: false,
        customClass: 'animated wobble',
        padding: '2em',
        footer: 'Reconocemos tu esfuerzo, recuerda que aún puedes obtener más ganancias.',
    })
}

$("#detailKintai").DataTable({
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
    buttons: {
        buttons: [{ 
            extend: 'excel',
            title: 'Kintai',
            className: 'btn btn-default btn-rounded btn-sm mb-4 aqua-gradient br-50',
            text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
        }]
    },
    language: {
        url: "https://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
        info: "Mostrando paguina _PAGE_ a _PAGES_"
    },
    responsive: true
});

$("#tabDetailKinya").DataTable({
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
    buttons: {
        buttons: [{ 
            extend: 'excel',
            title: 'KinYa!',
            className: 'btn btn-default btn-rounded btn-sm mb-4 btn-influencia-180 br-50',
            text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
        }]
    },
    language: {
        url: "https://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
        info: "Mostrando paguina _PAGE_ a _PAGES_"
    },
    responsive: true
});

function reset(){
    document.getElementById("amount").innerText = '$0';
}

window.addEventListener("load", postSize, false);
function postSize(e){
    var target = parent.postMessage ? parent : (parent.document.postMessage ? parent.document : undefined);
    if (typeof target != "undefined" && document.body.scrollHeight){
        target.postMessage( document.body.scrollHeight, "*");
    }
}

function getEdoCta(periodo){
    var associateid = $("#associateid").val();
    window.open("/edocta?associateid=" + associateid + "&periodo=" + periodo, "width=500,height=300,scrollbars=NO");
    $("#period").val('-');
}

$("#mis_jugadores").val('1');
loadDataModalGenealogy();
$(".jugadoresRedLideres").hide();
function getJugadores(type){
    if(type == 1 || type == '1'){
        $(".jugadoresRed").show(1000);
        $(".jugadoresRedLideres").hide(1000);
        loadDataModalGenealogy();
    }
    else if(type == 2 || type == '2'){
        $(".jugadoresRed").hide(1000);
        $(".jugadoresRedLideres").show(1000);
        loadDataModalLeaders();
    }
}

function loadDataModalGenealogy(){
    $("#jugadoresRed").DataTable({
        destroy: true,
        ajax: '/ctrinfGetGen?abi=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [{ 
                extend: 'excel',
                title: 'Posibles kinYa',
                className: 'btn btn-default btn-rounded btn-sm mb-4 btn-influencia-180 br-50',
                text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            }]
        },
        columns: [
            { 'data': 'Sponsor_id', className: 'text-center ' },
            { 'data': 'associateid', className: 'text-center ' },
            { 'data': 'AssociateName', className: 'text-center ' },
            { 'data': 'Level', className: 'text-center ' },
            { 'data': 'Qty', className: 'text-center ' },
            { 'data': 'Email', className: 'text-center ' },
            { 'data': 'KinYa!', className: 'text-center ' },
            { 'data': 'Rango', },
            { 'data': 'Pais', },
        ],
        language: {
            url: "https://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
            info: "Mostrando paguina _PAGE_ a _PAGES_"
        },
        responsive: true
    });
}

function loadDataModalLeaders(){
    $("#jugadoresRedLideres").DataTable({
        destroy: true,
        ajax: '/ctrinfGetLeaders?abi=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [{ 
                extend: 'excel',
                title: 'Posibles kinYa',
                className: 'btn btn-default btn-rounded btn-sm mb-4 btn-influencia-180 br-50',
                text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            }]
        },
        columns: [
            { 'data': 'Sponsor_id', },
            { 'data': 'associateid', },
            { 'data': 'AssociateName', },
            { 'data': 'Level', },
            { 'data': 'Qty', },
            { 'data': 'Email', },
            { 'data': 'KinYa!', },
            { 'data': 'Rango', },
            { 'data': 'Pais', },
        ],
        processing: true,
        language: {
            url: "https://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
            info: "Mostrando paguina _PAGE_ a _PAGES_"
        },
        responsive: true
    });
}

function slideTo(id) {
    var element = document.getElementById(id);
    document.body.scrollTo({
        top: element.offsetTop,
        behavior: 'smooth'
    });
}

pie_short_influencia();
function pie_short_influencia() {
    var associateid = $("#associateid").val();
    var data = {associateid: associateid}
    $.ajax({
        type: 'GET',
        url: '/getInfoInfluencia',
        data: data,
        success: function(Response){
            var tr = "";
            for(var i = 0; i < Response['tabDetalles'].length; i++){
                var tipo = "Transformación Mokuteki";
                if(Response['tabDetalles'][i]['Tipo'] != 1){
                    tipo = "Kit influencer";
                }
                tr += '<tr>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['Associateid'] + '</td>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['apfirstname'] + '</td>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['Ordernum'] + '</td>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['Orderdate'] + '</td>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['itemcode'] + '</td>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['Descripcion'] + '</td>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['Qty_Item'] + '</td>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['Bono_Tres_Unidades_o_Mas'] + '</td>' +
                        '<td scope="row">' + Response['tabDetalles'][i]['owner_country'] + '</td>' +
                        '<td scope="row">' + tipo + '</td>' +
                    '</tr>';
            }
            $("#bodyTabInfluencia").html(tr);
            $("#tabInfluenciaDetail").DataTable({
                dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
                buttons: {
                    buttons: [{ 
                        extend: 'excel',
                        title: 'Influencia 3.0!',
                        className: 'btn btn-default btn-rounded btn-sm mb-4 btn-influencia-180 br-50',
                        text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                    }]
                },
                language: {
                    url: "https://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
                    info: "Mostrando paguina _PAGE_ a _PAGES_"
                },
                responsive: true
            });
        }
    });
}

function getDetailSales(){
    $("#tabDetailKinya").DataTable({
        destroy: true,
        ajax: '/getDetailSales?abi=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [{ 
                extend: 'excel',
                title: 'Posibles kinYa',
                className: 'btn btn-default btn-rounded btn-sm mb-4 btn-influencia-180 br-50',
                text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            }]
        },
        columns: [
            { 'data': 'Associateid', className: 'text-center ' },
            { 'data': 'Nombre', className: 'text-center ' },
            { 'data': 'OrderNum', className: 'text-center ' },
            {
                'data': 'TipDoc', className: 'text-center ',
                render: function(data, type, row) {
                    var TipDoc = row.TipDoc;
                    if(TipDoc.trim() == "OV"){
                        return '<td scope="row">ORDEN DE VENTA</td>';
                    }
                    else if(TipDoc.trim() == "NC"){
                        return '<td scope="row">NOTA DE CREDITO</td>';
                    }
                }
            },
            { 'data': 'OrderDate', className: 'text-center ' },
            { 'data': 'Itemcode', className: 'text-center ' },
            { 'data': 'Descripcion', className: 'text-center ' },
            { 'data': 'Qty', },
            { 'data': 'Bonificacion', },
            { 'data': 'TotalBonificacion', },
        ],
        language: {
            url: "https://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
            info: "Mostrando paguina _PAGE_ a _PAGES_"
        },
        responsive: true
    });
    getBonoBySales()
}

function getBonoBySales(){
    var associateid = $("#associateid").val();
    var data = {associateid: associateid}
    $.ajax({
        type: 'GET',
        url: '/getBonoBySales',
        data: data,
        success: function(Response){
            $("#totalBono").text(Response);
        }
    });
}

function getHistoricoGY(periodo, tipoRed){
    $("#jugadoresRedH").DataTable({
        destroy: true,
        ajax: '/getHistoricoGY?sap_code=' + $("#associateid").val() + '&periodo=' + periodo + '&tipoRed=' + tipoRed,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [{ 
                extend: 'excel',
                title: 'Posibles kinYa',
                className: 'btn btn-default btn-rounded btn-sm mb-4 btn-influencia-180 br-50',
                text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            }]
        },
        columns: [
            { 'data': 'Sponsor_id', },
            { 'data': 'associateid', },
            { 'data': 'AssociateName', },
            { 'data': 'Level', },
            { 'data': 'Total_Unidades', },
            { 'data': 'Email', },
            { 'data': 'KinYa!', },
            { 'data': 'Rango', },
            { 'data': 'Pais', },
        ],
        processing: true,
        language: {
            url: "https://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
            info: "Mostrando paguina _PAGE_ a _PAGES_"
        },
        responsive: true
    });
}