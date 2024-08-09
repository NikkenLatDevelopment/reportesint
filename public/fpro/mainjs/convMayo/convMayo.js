var associateid = $("#associateid").val();
var flags = { PER: 'peru.png', LAT: 'mexico.png', COL: 'colombia.png', CHL: 'chile.png', ECU: 'ecuador.png', PAN: 'panama.png', SLV: 'salvador.png', GTM: 'guatemala.png', CRI: 'costarica.png'};
var rango = $("#rango").val();
var AvanceR = $("#AvanceR").val();
var nAvances = 0;
$("#genealogiaPersonalVP").hide();

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

function loadTabDirExe(){
    $('#puntosVPTB').DataTable({
        destroy: true,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        ajax: '/coMyGetGen?associateid=' + associateid,
        buttons: {
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                    text:"<img src='http://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                },
                {
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel',
                    text:"<span class='flaticon-view'></span> Ocultar Genealogía",
                    action: function ( e, dt, node, config ) {
                        $('#genealogiaPersonalVP').hide(1000);
                        $("#btn2").removeClass('btnInActive');
                        $("#btn2").addClass('btn-conv');
                    }
                }
            ]
        },
        columns: [
            { 
                'data': 'ownerID', 
                className: 'text-center ',
            },
            { 'data': 'associateName' },
            { 
                'data': 'Rango',
                className: 'text-center ',
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            { 
                'data': 'Ordernum',
                className: 'text-center ',
            },
            { 
                'data': 'orderDate',
                className: 'text-center ',
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var tipoOrden = "";
                    if(row.TipDoc == 'OV'){
                        tipoOrden = "Orden de venta";
                    }
                    else if(row.TipDoc == 'NC'){
                        tipoOrden = "Nota de crédito";
                    }
                    return tipoOrden;
                }
            },
            { 
                'data': 'ItemCode',
                className: 'text-center ',
            },
            { 
                'data': 'Descripcion',
                className: 'text-center ',
            },
            { 
                'data': 'Qty',
                className: 'text-center ',
            },
            { 
                'data': 'Puntos',
                className: 'text-center ',
            },
        ],
        select: 'single',
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            paginate: {
                previous: "<i class='flaticon-arrow-left-1'></i>",
                next: "<i class='flaticon-arrow-right'></i>"
            },
        }
    });
}

function loadTableGenPla(){
    $('#PersonalGroup').DataTable({
        destroy: true,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        ajax: '/coMyGetGenPla?associateid=' + associateid,
        columns: [
            { 
                'data': 'Associateid', 
                className: 'text-center ',
            },
            { 'data': 'associateName' },
            { 
                'data': 'Rango',
                className: 'text-center ',
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var dato = number_format(row.VP_Mes, 0, '.', ',');
                    return dato;
                }
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var dato = number_format(row.VGP_Mes, 0, '.', ',');
                    return dato;
                }
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var dato = number_format(row.VGP_Pimag, 0, '.', ',');
                    return dato;
                }
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var dato = number_format(row.VO_LDP, 0, '.', ',');
                    return dato;
                }
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var dato = number_format(row.VO_LDPyS, 0, '.', ',');
                    return dato;
                }
            },
            { 
                'data': null,
                className: 'text-center ',
                render: function(data, type, row){
                    var dato  = "<span class='flaticon-close' style='color: red;'></span> <span hidden>NO</span>";
                    if(row.AvanceR.trim() == 'PLA' || row.AvanceR.trim() == 'ORO'){
                        dato  = "<span class='flaticon-single-circle-tick' style='color: green;'></span> <span hidden>SI</span>";
                    }
                    return dato;
                }
            },
        ],
        select: 'single',
        buttons: {
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                    text:"<img src='http://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                },
                {
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel',
                    attr:  {
                        id: 'btnhide'
                    },
                    text:"<span class='flaticon-view'></span> Ocultar Genealogía",
                    action: function ( e, dt, node, config ) {
                        $('#genealogiaPersonal').hide(1000);
                        $("#btn1").removeClass('btnInActive');
                        $("#btn1").addClass('btn-conv');
                    }
                }
            ]
        },
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            paginate: {
                previous: "<i class='flaticon-arrow-left-1'></i>",
                next: "<i class='flaticon-arrow-right'></i>"
            },
        }
    });

}

if(rango == 'DIR' || rango == 'EXE'){
    loadTabDirExe();
    loadTableGenPla();
    $("#genealogiaPersonal").hide();
    showGenealogy();
}
else{
    loadTableGenPla();
}

if(AvanceR.trim() != 'NO'){
    alertaAvance();
}

function alertaAvance(){
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
    }

    swal({
        title: '¡¡Felicitaciones!!',
        text: 'Haz logrado avanzar a rango PLATA',
        imageUrl: '../fpro/img/convMayo/winner.png',
        imageWidth: 400,
        imageHeight: 220,
        imageAlt: 'Avance de Rango',
        animation: false,
        customClass: 'animated wobble',
        padding: '2em',
        footer: '<span class="flaticon-danger-line" style="font-size: 20px;"></span> Recuerda que el avance de rango se reflejará el día 15 de junio.',
    });
    $(".swal2-modal").css('border-radius', '25px');
}

function showGenealogy(){
    $("#genealogiaPersonalVP").show(1000);
    $("#genealogiaPersonal").hide(1000);
    $("#btn1").removeClass('btnInActive');
    $("#btn1").addClass('btn-conv');

    $("#btn2").removeClass('btn-conv');
    $("#btn2").addClass('btnInActive');
}

function showGenealogyGP(){
    $("#genealogiaPersonal").show(1000);
    $('#genealogiaPersonalVP').hide(1000);
    $("#btn1").removeClass('btn-conv');
    $("#btn1").addClass('btnInActive');

    $("#btn2").removeClass('btnInActive');
    $("#btn2").addClass('btn-conv');
}

$("#puntosVPTB-").DataTable({
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
    buttons: {
        buttons: [
            { 
                extend: 'excel', 
                className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                text:"<img src='http://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            },
            {
                className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel',
                text:"<span class='flaticon-view'></span> Ocultar Genealogía",
                action: function ( e, dt, node, config ) {
                    $('#genealogiaPersonalVP').hide(1000);
                    $("#btn2").removeClass('btnInActive');
                    $("#btn2").addClass('btn-conv');
                }
            }
        ]
    },
    language: {
        url: "http://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
        info: "Mostrando paguina _PAGE_ a _PAGES_"
    },
    responsive: true
});

$("#PersonalGroup-").DataTable({
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
    buttons: {
        buttons: [
            { 
                extend: 'excel', 
                className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                text:"<img src='http://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            },
            {
                className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel',
                text:"<span class='flaticon-view'></span> Ocultar Genealogía",
                action: function ( e, dt, node, config ) {
                    $('#genealogiaPersonalVP').hide(1000);
                    $("#btn2").removeClass('btnInActive');
                    $("#btn2").addClass('btn-conv');
                }
            }
        ]
    },
    language: {
        url: "http://services.nikken.com.mx/fproh/mainjs/regactivinf/Spanish.json",
        info: "Mostrando paguina _PAGE_ a _PAGES_"
    },
    responsive: true
});