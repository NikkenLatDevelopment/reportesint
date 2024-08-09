$('#downScrollLink, #btnStatusPer').on('click', function(event) {
    var target = $(this.getAttribute('href'));
    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top
        }, 2000);
    }
});

var animateButton = function(e) {
    e.preventDefault;
    e.target.classList.remove('animate');
    e.target.classList.add('animate');
    setTimeout(function(){
        e.target.classList.remove('animate');
    },700);
    $("#status").modal('toggle');
};

var ranking = function(e) {
    e.preventDefault;
    e.target.classList.remove('animate');
    e.target.classList.add('animate');
    setTimeout(function(){
        e.target.classList.remove('animate');
    },700);
    $("#ranking").modal('toggle');
};

var folioBoletosEffect = function(e) {
    e.preventDefault;
    e.target.classList.remove('animate');
    e.target.classList.add('animate');
    setTimeout(function(){
        e.target.classList.remove('animate');
    },700);
    $("#folioBoletos").modal('toggle');
};
  
var classname = document.getElementsByClassName("confetti-button");
  
for (var i = 0; i < classname.length; i++) {
    if(i == 0){
        classname[i].addEventListener('click', animateButton, false);
    }
    else if(i == 1){
        classname[i].addEventListener('click', folioBoletosEffect, false);
    }
    else if(i == 2){
        classname[i].addEventListener('click', ranking, false);
    }
}

var contador = 0;
var flag = {'PER': 'peru.png', 'MEX': 'mexico.png', 'LAT': 'mexico.png', 'COL': 'colombia.png', 'CHL': 'chile.png', 'ECU': 'ecuador.png', 'PAN': 'panama.png', 'SLV': 'salvador.png', 'GTM': 'guatemala.png', 'CRI': 'costarica.png'};
$("#rankingTab").dataTable({
    lengthChange: false,
    ordering: false,
    info: false,
    destroy: true,
    ajax: "/kgGetRank?associateid=" + $("#associateid").val(),
    columns: [
        { data: 'associateid', className: 'text-center' },
        { data: 'NombreMiembro', className: 'text-center' },
        { 
            data: 'Pais', 
            className: 'text-center',
            "render": function(data, type, row){
                var paisText = row.Pais;
                if(paisText == 'LAT'){
                    paisText = "MEX";
                }
                return "<img src='../fpro/img/flags/" + flag[row.Pais.trim()] + "' width=25px'> <br> " + paisText;
            }
        },
        { data: 'TotalBoletos', className: 'text-center' },
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }
});

$("#boletosDetalle").dataTable({
    lengthChange: false,
    ordering: false,
    info: false,
    destroy: true,
    ajax: "/kgGetDetail?associateid=" + $("#associateid").val().trim(),
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
    buttons: {
        buttons: [
            { 
                extend: 'excel', 
                className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                text:"<img src='http://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            },
        ]
    },
    columns: [
        { data: 'Associateid', className: 'text-center' },
        { data: 'AssociateName', className: 'text-center' },
        { 
            data: 'Pais', 
            className: 'text-center',
            "render": function(data, type, row){
                var paisText = row.Pais;
                if(paisText == 'LAT'){
                    paisText = "MEX";
                }
                return "<img src='../fpro/img/flags/" + flag[row.Pais.trim()] + "' width=25px'> <br> " + paisText;
            }
        },
        { data: 'OrderNum', className: 'text-center' },
        { data: 'OrderDate', className: 'text-center' },
        { 
            data: 'TipDoc', 
            className: 'text-center',
            "render": function(data, type, row){
                var tipo = row.TipDoc.trim();
                if(tipo == 'OV'){
                    tipo = "Orden de Venta";
                }
                else{
                    tipo = "Nota de Crédito";
                }
                return tipo;
            }
        },
        { data: 'ItemCode', className: 'text-center' },
        { data: 'Descripcion', className: 'text-center' },
        { data: 'Qty', className: 'text-center' },
        { data: 'TotalBoletos', className: 'text-center' },
        { data: 'TipBoleto', className: 'text-center' },
        { data: 'FolioIni', className: 'text-center' },
        { data: 'FolioFin', className: 'text-center' },
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }					
});

$("#boletosDetalleTest").dataTable({
    lengthChange: false,
    ordering: false,
    info: false,
    destroy: true,
    ajax: "/kgGetDetail?associateid=" + $("#associateid").val().trim(),
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
    buttons: {
        buttons: [
            { 
                extend: 'excel', 
                className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                text:"<img src='http://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            },
        ]
    },
    columns: [
        { data: 'Associateid', className: 'text-center' },
        { data: 'AssociateName', className: 'text-center' },
        { 
            data: 'Pais', 
            className: 'text-center',
            "render": function(data, type, row){
                var paisText = row.Pais;
                if(paisText == 'LAT'){
                    paisText = "MEX";
                }
                return "<img src='../fpro/img/flags/" + flag[row.Pais.trim()] + "' width=25px'> <br> " + paisText;
            }
        },
        { data: 'OrderNum', className: 'text-center' },
        { data: 'OrderDate', className: 'text-center' },
        { 
            data: 'TipDoc', 
            className: 'text-center',
            "render": function(data, type, row){
                var tipo = row.TipDoc.trim();
                if(tipo == 'OV'){
                    tipo = "Orden de Venta";
                }
                else{
                    tipo = "Nota de Crédito";
                }
                return tipo;
            }
        },
        { data: 'ItemCode', className: 'text-center' },
        { data: 'Descripcion', className: 'text-center' },
        { data: 'Qty', className: 'text-center' },
        { data: 'TotalBoletos', className: 'text-center' },
        { data: 'TipBoleto', className: 'text-center' },
        { data: 'FolioIni', className: 'text-center' },
        { data: 'FolioFin', className: 'text-center' },
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }					
});

$("#detalleOrdenes").dataTable({
    lengthChange: false,
    ordering: false,
    info: false,
    destroy: true,
    ajax: "/kgGetordenClub?associateid=" + $("#associateid").val().trim(),
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
    buttons: {
        buttons: [
            { 
                extend: 'excel', 
                className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                text:"<img src='http://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
            },
        ]
    },
    columns: [
        { data: 'Associateid', className: 'text-center' },
        { data: 'AssociateName', className: 'text-center' },
        { 
            data: 'Pais', 
            className: 'text-center',
            "render": function(data, type, row){
                var paisText = row.Pais;
                if(paisText == 'LAT'){
                    paisText = "MEX";
                }
                return "<img src='../fpro/img/flags/" + flag[row.Pais.trim()] + "' width=25px'> <br> " + paisText;
            }
        },
        { data: 'Ordernum', className: 'text-center' },
        { data: 'OrderDate', className: 'text-center' },
        { 
            data: 'TipDoc', 
            className: 'text-center',
            "render": function(data, type, row){
                var tipo = row.TipDoc.trim();
                if(tipo == 'OV'){
                    tipo = "Orden de Venta";
                }
                else{
                    tipo = "Nota de Crédito";
                }
                return tipo;
            }
        },
        { data: 'TotalBoletos', className: 'text-center' },
        { data: 'FolioIni', className: 'text-center' },
        { data: 'FolioFin', className: 'text-center' },
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }					
});