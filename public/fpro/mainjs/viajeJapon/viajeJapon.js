$("#estatusMes2").hide();

$("#divLockLoading").hide();

function getDeailIncorp(){
    $("#detail_incorp").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        rowReorder: false,
        ajax: '/getDeailIncorp?associateid=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns:[
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { data: 'Ordernum', className: 'text-center' },
            { data: 'ItemCode', className: 'text-center' },
            { data: 'Descripcion', className: 'text-center' },
            { data: 'Qty', className: 'text-center' },
            { data: 'Pais', className: 'text-center' },
            { data: 'OrderDate', className: 'text-center' },
            { data: 'Period', className: 'text-center' },
            { data: 'Transformado', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

function detailVP(){
    $("#detailVP").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        rowReorder: false,
        ajax: '/getDetailVP?associateid=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { 
                data: 'VP',
                className: 'text-center',
                render: function(data, type, row) {
                    var VP = row.VP;
                    return formatMoney(VP);
                },
            },
            { 
                data: 'Cumple_Vp_Mes',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_Vp_Mes  = row.Cumple_Vp_Mes;
                    if(Cumple_Vp_Mes.trim() === 'YES' || Cumple_Vp_Mes.trim() === 'SI'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                }
            },
            { 
                data: 'VP_Acumulado',
                className: 'text-center',
                render: function(data, type, row) {
                    var VP_Acumulado = row.VP_Acumulado;
                    return formatMoney(VP_Acumulado);
                },
            },
            { data: 'Periodo', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

function detailVPCoTitular(){
    $("#detailVP").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        rowReorder: false,
        ajax: '/getDetailVPcoTitular?associateid=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { 
                data: 'VP_Cotitular',
                className: 'text-center',
                render: function(data, type, row) {
                    var VP_Cotitular = row.VP_Cotitular;
                    return formatMoney(VP_Cotitular);
                },
            },
            { 
                data: 'CumpleVPMes_Cotitular',
                className: 'text-center',
                render: function(data, type, row){
                    var CumpleVPMes_Cotitular  = row.CumpleVPMes_Cotitular;
                    if(CumpleVPMes_Cotitular.trim() === 'YES' || CumpleVPMes_Cotitular.trim() === 'SI'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                }
            },
            { 
                data: 'VPAcumulado_Cotitular',
                className: 'text-center',
                render: function(data, type, row) {
                    var VPAcumulado_Cotitular = row.VPAcumulado_Cotitular;
                    return formatMoney(VPAcumulado_Cotitular);
                },
            },
            { data: 'Periodo', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

function detailVGP(){
    $("#detailVGP").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        rowReorder: false,
        ajax: '/getDetailVGP?associateid=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { 
                data: 'VGP',
                className: 'text-center',
                render: function(data, type, row) {
                    var VGP = row.VGP;
                    return formatMoney(VGP);
                },
            },
            { 
                data: 'VGP_Acumulado',
                className: 'text-center',
                render: function(data, type, row) {
                    var VGP_Acumulado = row.VGP_Acumulado;
                    return formatMoney(VGP_Acumulado);
                },
            },
            { 
                data: 'Total_Millas',
                className: 'text-center',
                render: function(data, type, row) {
                    var Total_Millas = row.Total_Millas;
                    return formatMoney(Total_Millas);
                },
            },
            {
                data: 'Cumple_millas',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_millas = row.Cumple_millas;
                    if(Cumple_millas.trim() === 'YES' || Cumple_millas.trim() === 'SI'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
            { data: 'Periodo', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

function detailVGPgrupo1(){
    $("#detailVGP").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        rowReorder: false,
        ajax: '/detailVGPgrupo1?associateid=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { 
                data: 'VGP',
                className: 'text-center',
                render: function(data, type, row) {
                    var VGP = row.VGP;
                    return formatMoney(VGP);
                },
            },
            { 
                data: 'VGP_Acumulado',
                className: 'text-center',
                render: function(data, type, row) {
                    var VGP_Acumulado = row.VGP_Acumulado;
                    return formatMoney(VGP_Acumulado);
                },
            },
            { data: 'Periodo', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

function detailVGPCoTitular(){
    $("#detailVGP").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        rowReorder: false,
        ajax: '/getDetailVGPcoTitular?associateid=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { 
                data: 'VGP_Cotitular',
                className: 'text-center',
                render: function(data, type, row) {
                    var VGP_Cotitular = row.VGP_Cotitular;
                    return formatMoney(VGP_Cotitular);
                },
            },
            { 
                data: 'VGPAcumulado_Cotitular',
                className: 'text-center',
                render: function(data, type, row) {
                    var VGPAcumulado_Cotitular = row.VGPAcumulado_Cotitular;
                    return formatMoney(VGPAcumulado_Cotitular);
                },
            },
            { 
                data: 'Total_Millas',
                className: 'text-center',
                render: function(data, type, row) {
                    var Total_Millas = row.Total_Millas;
                    return formatMoney(Total_Millas);
                },
            },
            {
                data: 'Cumple_millas',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_millas = row.Cumple_millas;
                    if(Cumple_millas.trim() === 'YES' || Cumple_millas.trim() === 'SI'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
            { data: 'Periodo', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

function getDetailKinya(){
    $("#detailKinya").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        rowReorder: false,
        ajax: '/getDetailKinya?associateid=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { data: 'Sponsorid', className: 'text-center' },
            {
                data: 'Cumple_Kinya',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_Kinya = row.Cumple_Kinya;
                    if(Cumple_Kinya.trim() != '0'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
            { data: 'Periodo', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

function getRankinGral(){
    var now = new Date();
    var mes = (now.getMonth()+1 < 10) ? '0' + (now.getMonth()+1) : (now.getMonth()+1);
    var fecha_actual = now.getFullYear() + "-" + mes + "-" + now.getDate();
    fecha_actual = Date.parse(fecha_actual);

    var fechainicialW1 = Date.parse('2022-10-03');
    var fechainicialW2 = Date.parse('2022-10-10');
    var fechainicialW3 = Date.parse('2022-10-18');

    var fechafinalW1 = Date.parse('2022-10-09');
    var fechafinalW2 = Date.parse('2022-10-17');
    var fechafinalW3 = Date.parse('2022-10-30');

    $("#rankGraltest").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        ajax: '/getRankinGral',
        ordering: false,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Ranking', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            {
                data: 'Pais',
                className: 'text-center',
                render: function(data, type, row) {
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            { 
                data: 'MillasRanking',
                className: 'text-center',
                render: function(data, type, row) {
                    var MillasRanking = row.MillasRanking;
                    return formatMoney(MillasRanking);
                },
            },
            { 
                data: 'Millas',
                className: 'text-center',
                render: function(data, type, row) {
                    var Millas = row.Millas;
                    return formatMoney(Millas);
                },
            },
            { 
                data: 'OctSem300',
                className: 'text-center',
                render: function(data, type, row) {
                    var OctSem300 = row.OctSem300;
                    return formatMoney(OctSem300);
                },
            },
            { 
                data: 'OctSem600',
                className: 'text-center',
                render: function(data, type, row) {
                    var OctSem600 = row.OctSem600;
                    return formatMoney(OctSem600);
                },
            },
            { 
                data: 'OctSem900',
                className: 'text-center',
                render: function(data, type, row) {
                    var OctSem900 = row.OctSem900;
                    return formatMoney(OctSem900);
                },
            },
            { 
                data: 'Millas_PuntoViaje',
                className: 'text-center',
                render: function(data, type, row) {
                    var Millas_PuntoViaje = row.Millas_PuntoViaje;
                    return formatMoney(Millas_PuntoViaje);
                },
            },
            { 
                data: 'PuntosAbril',
                className: 'text-center',
                render: function(data, type, row) {
                    var PuntosAbril = row.PuntosAbril;
                    return formatMoney(PuntosAbril);
                },
            },
            { 
                data: 'VGP_Acumulado',
                className: 'text-center',
                render: function(data, type, row) {
                    var VGP_Acumulado = row.VGP_Acumulado;
                    return formatMoney(VGP_Acumulado);
                },
            },
            { 
                data: 'Milla_Adicional',
                className: 'text-center',
                render: function(data, type, row) {
                    var Milla_Adicional = row.Milla_Adicional;
                    return formatMoney(Milla_Adicional);
                },
            },
            { 
                data: 'Milla_Adicional_Semana2',
                className: 'text-center',
                render: function(data, type, row) {
                    var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                    return formatMoney(Milla_Adicional_Semana2);
                },
            },
            { 
                data: 'Meses_CumpleVP',
                className: 'text-center',
                render: function(data, type, row) {
                    var Meses_CumpleVP = row.Meses_CumpleVP;
                    return formatMoney(Meses_CumpleVP);
                },
            },
            { 
                data: 'VP_Acumulado',
                className: 'text-center',
                render: function(data, type, row) {
                    var VP_Acumulado = row.VP_Acumulado;
                    return formatMoney(VP_Acumulado);
                },
            },
            {
                data: 'Cumple_VPAcumulado',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                    if(Cumple_VPAcumulado.trim() === 'YES'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
            { data: 'Total_incorp', className: 'text-center' },
            {
                data: 'Cumple_Incorp',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_Incorp = row.Cumple_Incorp;
                    if(Cumple_Incorp.trim() === 'YES'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
            { data: 'Total_Kinya', className: 'text-center' },
            {
                data: 'Cumple_Kinya',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_Kinya = row.Cumple_Kinya;
                    if(Cumple_Kinya.trim() === 'YES'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

    /*if(fecha_actual > fechainicialW1 && fecha_actual < fechafinalW1) {
        console.log("semana 1");
        $("#rankGraltest").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getRankinGralTest',
            ordering: false,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'Ranking', className: 'text-center' },
                { data: 'AssociateName', className: 'text-center' },
                {
                    data: 'Pais',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                        return dato;
                    }
                },
                { 
                    data: 'MillasRanking',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var MillasRanking = row.MillasRanking;
                        return formatMoney(MillasRanking);
                    },
                },
                { 
                    data: 'Millas',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas = row.Millas;
                        return formatMoney(Millas);
                    },
                },
                { 
                    data: 'OctSem300',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem300 = row.OctSem300;
                        return formatMoney(OctSem300);
                    },
                },
                { 
                    data: 'Millas_PuntoViaje',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas_PuntoViaje = row.Millas_PuntoViaje;
                        return formatMoney(Millas_PuntoViaje);
                    },
                },
                { 
                    data: 'PuntosAbril',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var PuntosAbril = row.PuntosAbril;
                        return formatMoney(PuntosAbril);
                    },
                },
                { 
                    data: 'VGP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VGP_Acumulado = row.VGP_Acumulado;
                        return formatMoney(VGP_Acumulado);
                    },
                },
                { 
                    data: 'Milla_Adicional',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional = row.Milla_Adicional;
                        return formatMoney(Milla_Adicional);
                    },
                },
                { 
                    data: 'Milla_Adicional_Semana2',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                        return formatMoney(Milla_Adicional_Semana2);
                    },
                },
                { 
                    data: 'Meses_CumpleVP',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Meses_CumpleVP = row.Meses_CumpleVP;
                        return formatMoney(Meses_CumpleVP);
                    },
                },
                { 
                    data: 'VP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VP_Acumulado = row.VP_Acumulado;
                        return formatMoney(VP_Acumulado);
                    },
                },
                {
                    data: 'Cumple_VPAcumulado',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                        if(Cumple_VPAcumulado.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_incorp', className: 'text-center' },
                {
                    data: 'Cumple_Incorp',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Incorp = row.Cumple_Incorp;
                        if(Cumple_Incorp.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_Kinya', className: 'text-center' },
                {
                    data: 'Cumple_Kinya',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Kinya = row.Cumple_Kinya;
                        if(Cumple_Kinya.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_",
                "search": "Buscar",
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
    else if(fecha_actual > fechainicialW2 && fecha_actual < fechafinalW2) {
        console.log("semana 2");
        $("#rankGraltest").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getRankinGral',
            ordering: false,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'Ranking', className: 'text-center' },
                { data: 'AssociateName', className: 'text-center' },
                {
                    data: 'Pais',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                        return dato;
                    }
                },
                { 
                    data: 'MillasRanking',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var MillasRanking = row.MillasRanking;
                        return formatMoney(MillasRanking);
                    },
                },
                { 
                    data: 'Millas',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas = row.Millas;
                        return formatMoney(Millas);
                    },
                },
                { 
                    data: 'OctSem300',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem300 = row.OctSem300;
                        return formatMoney(OctSem300);
                    },
                },
                { 
                    data: 'OctSem600',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem600 = row.OctSem600;
                        return formatMoney(OctSem600);
                    },
                },
                { 
                    data: 'Millas_PuntoViaje',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas_PuntoViaje = row.Millas_PuntoViaje;
                        return formatMoney(Millas_PuntoViaje);
                    },
                },
                { 
                    data: 'PuntosAbril',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var PuntosAbril = row.PuntosAbril;
                        return formatMoney(PuntosAbril);
                    },
                },
                { 
                    data: 'VGP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VGP_Acumulado = row.VGP_Acumulado;
                        return formatMoney(VGP_Acumulado);
                    },
                },
                { 
                    data: 'Milla_Adicional',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional = row.Milla_Adicional;
                        return formatMoney(Milla_Adicional);
                    },
                },
                { 
                    data: 'Milla_Adicional_Semana2',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                        return formatMoney(Milla_Adicional_Semana2);
                    },
                },
                { 
                    data: 'Meses_CumpleVP',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Meses_CumpleVP = row.Meses_CumpleVP;
                        return formatMoney(Meses_CumpleVP);
                    },
                },
                { 
                    data: 'VP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VP_Acumulado = row.VP_Acumulado;
                        return formatMoney(VP_Acumulado);
                    },
                },
                {
                    data: 'Cumple_VPAcumulado',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                        if(Cumple_VPAcumulado.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_incorp', className: 'text-center' },
                {
                    data: 'Cumple_Incorp',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Incorp = row.Cumple_Incorp;
                        if(Cumple_Incorp.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_Kinya', className: 'text-center' },
                {
                    data: 'Cumple_Kinya',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Kinya = row.Cumple_Kinya;
                        if(Cumple_Kinya.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_",
                "search": "Buscar",
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
    else if(fecha_actual > fechainicialW3 && fecha_actual < fechafinalW3) {
        console.log("semana 3");
        $("#rankGraltest").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getRankinGral',
            ordering: false,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'Ranking', className: 'text-center' },
                { data: 'AssociateName', className: 'text-center' },
                {
                    data: 'Pais',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                        return dato;
                    }
                },
                { 
                    data: 'MillasRanking',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var MillasRanking = row.MillasRanking;
                        return formatMoney(MillasRanking);
                    },
                },
                { 
                    data: 'Millas',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas = row.Millas;
                        return formatMoney(Millas);
                    },
                },
                { 
                    data: 'OctSem300',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem300 = row.OctSem300;
                        return formatMoney(OctSem300);
                    },
                },
                { 
                    data: 'OctSem600',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem600 = row.OctSem600;
                        return formatMoney(OctSem600);
                    },
                },
                { 
                    data: 'OctSem900',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem900 = row.OctSem900;
                        return formatMoney(OctSem900);
                    },
                },
                { 
                    data: 'Millas_PuntoViaje',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas_PuntoViaje = row.Millas_PuntoViaje;
                        return formatMoney(Millas_PuntoViaje);
                    },
                },
                { 
                    data: 'PuntosAbril',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var PuntosAbril = row.PuntosAbril;
                        return formatMoney(PuntosAbril);
                    },
                },
                { 
                    data: 'VGP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VGP_Acumulado = row.VGP_Acumulado;
                        return formatMoney(VGP_Acumulado);
                    },
                },
                { 
                    data: 'Milla_Adicional',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional = row.Milla_Adicional;
                        return formatMoney(Milla_Adicional);
                    },
                },
                { 
                    data: 'Milla_Adicional_Semana2',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                        return formatMoney(Milla_Adicional_Semana2);
                    },
                },
                { 
                    data: 'Meses_CumpleVP',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Meses_CumpleVP = row.Meses_CumpleVP;
                        return formatMoney(Meses_CumpleVP);
                    },
                },
                { 
                    data: 'VP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VP_Acumulado = row.VP_Acumulado;
                        return formatMoney(VP_Acumulado);
                    },
                },
                {
                    data: 'Cumple_VPAcumulado',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                        if(Cumple_VPAcumulado.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_incorp', className: 'text-center' },
                {
                    data: 'Cumple_Incorp',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Incorp = row.Cumple_Incorp;
                        if(Cumple_Incorp.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_Kinya', className: 'text-center' },
                {
                    data: 'Cumple_Kinya',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Kinya = row.Cumple_Kinya;
                        if(Cumple_Kinya.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_",
                "search": "Buscar",
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
    else{
        console.log("sin semana");
        $("#rankGraltest").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getRankinGralTest',
            ordering: false,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'Ranking', className: 'text-center' },
                { data: 'AssociateName', className: 'text-center' },
                {
                    data: 'Pais',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                        return dato;
                    }
                },
                { 
                    data: 'MillasRanking',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var MillasRanking = row.MillasRanking;
                        return formatMoney(MillasRanking);
                    },
                },
                { 
                    data: 'Millas',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas = row.Millas;
                        return formatMoney(Millas);
                    },
                },
                { 
                    data: 'Millas_PuntoViaje',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas_PuntoViaje = row.Millas_PuntoViaje;
                        return formatMoney(Millas_PuntoViaje);
                    },
                },
                { 
                    data: 'PuntosAbril',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var PuntosAbril = row.PuntosAbril;
                        return formatMoney(PuntosAbril);
                    },
                },
                { 
                    data: 'VGP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VGP_Acumulado = row.VGP_Acumulado;
                        return formatMoney(VGP_Acumulado);
                    },
                },
                { 
                    data: 'Milla_Adicional',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional = row.Milla_Adicional;
                        return formatMoney(Milla_Adicional);
                    },
                },
                { 
                    data: 'Milla_Adicional_Semana2',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                        return formatMoney(Milla_Adicional_Semana2);
                    },
                },
                { 
                    data: 'Meses_CumpleVP',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Meses_CumpleVP = row.Meses_CumpleVP;
                        return formatMoney(Meses_CumpleVP);
                    },
                },
                { 
                    data: 'VP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VP_Acumulado = row.VP_Acumulado;
                        return formatMoney(VP_Acumulado);
                    },
                },
                {
                    data: 'Cumple_VPAcumulado',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                        if(Cumple_VPAcumulado.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_incorp', className: 'text-center' },
                {
                    data: 'Cumple_Incorp',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Incorp = row.Cumple_Incorp;
                        if(Cumple_Incorp.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_Kinya', className: 'text-center' },
                {
                    data: 'Cumple_Kinya',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Kinya = row.Cumple_Kinya;
                        if(Cumple_Kinya.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_",
                "search": "Buscar",
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
    }*/
}

function getRankinGralTest(){
    var now = new Date();
    var mes = (now.getMonth()+1 < 10) ? '0' + (now.getMonth()+1) : (now.getMonth()+1);
    var fecha_actual = now.getFullYear() + "-" + mes + "-" + now.getDate();
    fecha_actual = Date.parse(fecha_actual);

    var fechainicialW1 = Date.parse('2022-10-03');
    var fechainicialW2 = Date.parse('2022-10-11');
    var fechainicialW3 = Date.parse('2022-10-18');

    var fechafinalW1 = Date.parse('2022-10-10');
    var fechafinalW2 = Date.parse('2022-10-17');
    var fechafinalW3 = Date.parse('2022-10-30');

    if(fecha_actual > fechainicialW1 && fecha_actual < fechafinalW1) {
        $("#rankGraltest").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getRankinGralTest',
            ordering: false,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'Ranking', className: 'text-center' },
                { data: 'AssociateName', className: 'text-center' },
                {
                    data: 'Pais',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                        return dato;
                    }
                },
                { 
                    data: 'MillasRanking',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var MillasRanking = row.MillasRanking;
                        return formatMoney(MillasRanking);
                    },
                },
                { 
                    data: 'Millas',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas = row.Millas;
                        return formatMoney(Millas);
                    },
                },
                { 
                    data: 'OctSem300',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem300 = row.OctSem300;
                        return formatMoney(OctSem300);
                    },
                },
                { 
                    data: 'Millas_PuntoViaje',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas_PuntoViaje = row.Millas_PuntoViaje;
                        return formatMoney(Millas_PuntoViaje);
                    },
                },
                { 
                    data: 'PuntosAbril',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var PuntosAbril = row.PuntosAbril;
                        return formatMoney(PuntosAbril);
                    },
                },
                { 
                    data: 'VGP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VGP_Acumulado = row.VGP_Acumulado;
                        return formatMoney(VGP_Acumulado);
                    },
                },
                { 
                    data: 'Milla_Adicional',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional = row.Milla_Adicional;
                        return formatMoney(Milla_Adicional);
                    },
                },
                { 
                    data: 'Milla_Adicional_Semana2',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                        return formatMoney(Milla_Adicional_Semana2);
                    },
                },
                { 
                    data: 'Meses_CumpleVP',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Meses_CumpleVP = row.Meses_CumpleVP;
                        return formatMoney(Meses_CumpleVP);
                    },
                },
                { 
                    data: 'VP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VP_Acumulado = row.VP_Acumulado;
                        return formatMoney(VP_Acumulado);
                    },
                },
                {
                    data: 'Cumple_VPAcumulado',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                        if(Cumple_VPAcumulado.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_incorp', className: 'text-center' },
                {
                    data: 'Cumple_Incorp',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Incorp = row.Cumple_Incorp;
                        if(Cumple_Incorp.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_Kinya', className: 'text-center' },
                {
                    data: 'Cumple_Kinya',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Kinya = row.Cumple_Kinya;
                        if(Cumple_Kinya.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_",
                "search": "Buscar",
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
    else if(fecha_actual > fechainicialW2 && fecha_actual < fechafinalW2) {
        $("#getRankinGralTest").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getRankinGral',
            ordering: false,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'Ranking', className: 'text-center' },
                { data: 'AssociateName', className: 'text-center' },
                {
                    data: 'Pais',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                        return dato;
                    }
                },
                { 
                    data: 'MillasRanking',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var MillasRanking = row.MillasRanking;
                        return formatMoney(MillasRanking);
                    },
                },
                { 
                    data: 'Millas',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas = row.Millas;
                        return formatMoney(Millas);
                    },
                },
                { 
                    data: 'OctSem300',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem300 = row.OctSem300;
                        return formatMoney(OctSem300);
                    },
                },
                { 
                    data: 'OctSem600',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem600 = row.OctSem600;
                        return formatMoney(OctSem600);
                    },
                },
                { 
                    data: 'Millas_PuntoViaje',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas_PuntoViaje = row.Millas_PuntoViaje;
                        return formatMoney(Millas_PuntoViaje);
                    },
                },
                { 
                    data: 'PuntosAbril',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var PuntosAbril = row.PuntosAbril;
                        return formatMoney(PuntosAbril);
                    },
                },
                { 
                    data: 'VGP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VGP_Acumulado = row.VGP_Acumulado;
                        return formatMoney(VGP_Acumulado);
                    },
                },
                { 
                    data: 'Milla_Adicional',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional = row.Milla_Adicional;
                        return formatMoney(Milla_Adicional);
                    },
                },
                { 
                    data: 'Milla_Adicional_Semana2',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                        return formatMoney(Milla_Adicional_Semana2);
                    },
                },
                { 
                    data: 'Meses_CumpleVP',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Meses_CumpleVP = row.Meses_CumpleVP;
                        return formatMoney(Meses_CumpleVP);
                    },
                },
                { 
                    data: 'VP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VP_Acumulado = row.VP_Acumulado;
                        return formatMoney(VP_Acumulado);
                    },
                },
                {
                    data: 'Cumple_VPAcumulado',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                        if(Cumple_VPAcumulado.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_incorp', className: 'text-center' },
                {
                    data: 'Cumple_Incorp',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Incorp = row.Cumple_Incorp;
                        if(Cumple_Incorp.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_Kinya', className: 'text-center' },
                {
                    data: 'Cumple_Kinya',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Kinya = row.Cumple_Kinya;
                        if(Cumple_Kinya.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_",
                "search": "Buscar",
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
    else if(fecha_actual > fechainicialW3 && fecha_actual < fechafinalW3) {
        $("#getRankinGralTest").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getRankinGral',
            ordering: false,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'Ranking', className: 'text-center' },
                { data: 'AssociateName', className: 'text-center' },
                {
                    data: 'Pais',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                        return dato;
                    }
                },
                { 
                    data: 'MillasRanking',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var MillasRanking = row.MillasRanking;
                        return formatMoney(MillasRanking);
                    },
                },
                { 
                    data: 'Millas',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas = row.Millas;
                        return formatMoney(Millas);
                    },
                },
                { 
                    data: 'OctSem300',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem300 = row.OctSem300;
                        return formatMoney(OctSem300);
                    },
                },
                { 
                    data: 'OctSem600',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem600 = row.OctSem600;
                        return formatMoney(OctSem600);
                    },
                },
                { 
                    data: 'OctSem900',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var OctSem900 = row.OctSem900;
                        return formatMoney(OctSem900);
                    },
                },
                { 
                    data: 'Millas_PuntoViaje',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas_PuntoViaje = row.Millas_PuntoViaje;
                        return formatMoney(Millas_PuntoViaje);
                    },
                },
                { 
                    data: 'PuntosAbril',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var PuntosAbril = row.PuntosAbril;
                        return formatMoney(PuntosAbril);
                    },
                },
                { 
                    data: 'VGP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VGP_Acumulado = row.VGP_Acumulado;
                        return formatMoney(VGP_Acumulado);
                    },
                },
                { 
                    data: 'Milla_Adicional',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional = row.Milla_Adicional;
                        return formatMoney(Milla_Adicional);
                    },
                },
                { 
                    data: 'Milla_Adicional_Semana2',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                        return formatMoney(Milla_Adicional_Semana2);
                    },
                },
                { 
                    data: 'Meses_CumpleVP',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Meses_CumpleVP = row.Meses_CumpleVP;
                        return formatMoney(Meses_CumpleVP);
                    },
                },
                { 
                    data: 'VP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VP_Acumulado = row.VP_Acumulado;
                        return formatMoney(VP_Acumulado);
                    },
                },
                {
                    data: 'Cumple_VPAcumulado',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                        if(Cumple_VPAcumulado.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_incorp', className: 'text-center' },
                {
                    data: 'Cumple_Incorp',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Incorp = row.Cumple_Incorp;
                        if(Cumple_Incorp.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_Kinya', className: 'text-center' },
                {
                    data: 'Cumple_Kinya',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Kinya = row.Cumple_Kinya;
                        if(Cumple_Kinya.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_",
                "search": "Buscar",
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
    else{
        $("#rankGraltest").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getRankinGralTest',
            ordering: false,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'Ranking', className: 'text-center' },
                { data: 'AssociateName', className: 'text-center' },
                {
                    data: 'Pais',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                        return dato;
                    }
                },
                { 
                    data: 'MillasRanking',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var MillasRanking = row.MillasRanking;
                        return formatMoney(MillasRanking);
                    },
                },
                { 
                    data: 'Millas',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas = row.Millas;
                        return formatMoney(Millas);
                    },
                },
                { 
                    data: 'Millas_PuntoViaje',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Millas_PuntoViaje = row.Millas_PuntoViaje;
                        return formatMoney(Millas_PuntoViaje);
                    },
                },
                { 
                    data: 'PuntosAbril',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var PuntosAbril = row.PuntosAbril;
                        return formatMoney(PuntosAbril);
                    },
                },
                { 
                    data: 'VGP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VGP_Acumulado = row.VGP_Acumulado;
                        return formatMoney(VGP_Acumulado);
                    },
                },
                { 
                    data: 'Milla_Adicional',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional = row.Milla_Adicional;
                        return formatMoney(Milla_Adicional);
                    },
                },
                { 
                    data: 'Milla_Adicional_Semana2',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Milla_Adicional_Semana2 = row.Milla_Adicional_Semana2;
                        return formatMoney(Milla_Adicional_Semana2);
                    },
                },
                { 
                    data: 'Meses_CumpleVP',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var Meses_CumpleVP = row.Meses_CumpleVP;
                        return formatMoney(Meses_CumpleVP);
                    },
                },
                { 
                    data: 'VP_Acumulado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        var VP_Acumulado = row.VP_Acumulado;
                        return formatMoney(VP_Acumulado);
                    },
                },
                {
                    data: 'Cumple_VPAcumulado',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                        if(Cumple_VPAcumulado.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_incorp', className: 'text-center' },
                {
                    data: 'Cumple_Incorp',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Incorp = row.Cumple_Incorp;
                        if(Cumple_Incorp.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
                { data: 'Total_Kinya', className: 'text-center' },
                {
                    data: 'Cumple_Kinya',
                    className: 'text-center',
                    render: function(data, type, row){
                        var Cumple_Kinya = row.Cumple_Kinya;
                        if(Cumple_Kinya.trim() === 'YES'){
                            return '<span class="badge badge-success ml-3">Cumple</span>';
                        }
                        else{
                            return '<span class="badge badge-danger ml-3">No Cumple</span>';
                        }
                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
                "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
                "info": "Showing page _PAGE_ of _PAGES_",
                "search": "Buscar",
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
}

function getArraydata(data){
    if(Date.parse(fechafinalW1) > Date.parse(fechainicialW1)) {

    }
}

function getRankinGralCotitular(){
    $("#rankGralCotitular").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        ordering: false,
        ajax: '/getRankinGralCotitular',
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Ranking', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            {
                data: 'Pais',
                className: 'text-center',
                render: function(data, type, row) {
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            { 
                data: 'Millas',
                className: 'text-center',
                render: function(data, type, row) {
                    var Millas = row.Millas;
                    return formatMoney(Millas);
                },
            },
            { 
                data: 'Millas_Abril',
                className: 'text-center',
                render: function(data, type, row) {
                    var Millas_Abril = row.Millas_Abril;
                    return formatMoney(Millas_Abril);
                },
            },
            { 
                data: 'Milla_KaizenTaishi',
                className: 'text-center',
                render: function(data, type, row) {
                    var Milla_KaizenTaishi = row.Milla_KaizenTaishi;
                    return formatMoney(Milla_KaizenTaishi);
                },
            },
            { 
                data: 'PuntosAbril',
                className: 'text-center',
                render: function(data, type, row) {
                    var PuntosAbril = row.PuntosAbril;
                    return formatMoney(PuntosAbril);
                },
            },
            { 
                data: 'VGP_Acumulado',
                className: 'text-center',
                render: function(data, type, row) {
                    var VGP_Acumulado = row.VGP_Acumulado;
                    return formatMoney(VGP_Acumulado);
                },
            },
            { 
                data: 'Meses_CumpleVP',
                className: 'text-center',
                render: function(data, type, row) {
                    var Meses_CumpleVP = row.Meses_CumpleVP;
                    return formatMoney(Meses_CumpleVP);
                },
            },
            { 
                data: 'VP_Acumulado',
                className: 'text-center',
                render: function(data, type, row) {
                    var VP_Acumulado = row.VP_Acumulado;
                    return formatMoney(VP_Acumulado);
                },
            },
            {
                data: 'Cumple_VPAcumulado',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_VPAcumulado = row.Cumple_VPAcumulado;
                    if(Cumple_VPAcumulado.trim() === 'YES'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
            { data: 'Total_incorp', className: 'text-center' },
            {
                data: 'Cumple_Incorp',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_Incorp = row.Cumple_Incorp;
                    if(Cumple_Incorp.trim() === 'YES'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
            { data: 'Total_Kinya', className: 'text-center' },
            {
                data: 'Cumple_Kinya',
                className: 'text-center',
                render: function(data, type, row){
                    var Cumple_Kinya = row.Cumple_Kinya;
                    if(Cumple_Kinya.trim() === 'YES'){
                        return '<span class="badge badge-success ml-3">Cumple</span>';
                    }
                    else{
                        return '<span class="badge badge-danger ml-3">No Cumple</span>';
                    }
                },
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

function getDetailPuntosViaje(){
    $.ajax({
        type: "GET",
        url: "/getDetailPuntosViaje",
        data: {
            associateid: $("#associateid").val(),
            action: 'table'
        },
        beforeSend: function(){
            $("#tablePuntosV").hide();
        },
        success: function (response) {
            $("#tablePuntosV").show(1000);
            var Cumple_PuntoExtra1 = response[0]['Cumple_PuntoExtra1'];
            var PuntoEnero = response[0]['PuntoEnero'];
            var PuntoFebrero = response[0]['PuntoFebrero'];
            var PuntoMarzo = response[0]['PuntoMarzo'];
            var PuntoAbril = response[0]['PuntoAbril'];
            var PuntoAbril2 = response[0]['PuntoAbril2'];
            var PuntoMayo = response[0]['PuntoMayo'];
            var PuntoJunio = response[0]['PuntoJunio'];
            (parseInt(Cumple_PuntoExtra1) == 1) ? $("#extrap").removeClass("badge-danger").addClass("badge-success").text("Cumple") : $("#extrap").removeClass("badge-success").addClass("badge-danger").text("No Cumple");
            (parseInt(PuntoEnero) == 1) ? $("#mes1").removeClass("badge-danger").addClass("badge-success").text("Cumple") : $("#mes1").removeClass("badge-success").addClass("badge-danger").text("No Cumple");
            (parseInt(PuntoFebrero) == 1) ? $("#mes2").removeClass("badge-danger").addClass("badge-success").text("Cumple") : $("#mes2").removeClass("badge-success").addClass("badge-danger").text("No Cumple");
            (parseInt(PuntoMarzo) == 1) ? $("#mes3").removeClass("badge-danger").addClass("badge-success").text("Cumple") : $("#mes3").removeClass("badge-success").addClass("badge-danger").text("No Cumple");
            (parseInt(PuntoAbril) == 1) ? $("#mes4").removeClass("badge-danger").addClass("badge-success").text("Cumple") : $("#mes4").removeClass("badge-success").addClass("badge-danger").text("No Cumple");
            (parseInt(PuntoAbril2) == 1) ? $("#mes4_2").removeClass("badge-danger").addClass("badge-success").text("Cumple") : $("#mes4_2").removeClass("badge-success").addClass("badge-danger").text("No Cumple");
            (parseInt(PuntoMayo) == 1) ? $("#mes5").removeClass("badge-danger").addClass("badge-success").text("Cumple") : $("#mes5").removeClass("badge-success").addClass("badge-danger").text("No Cumple");
            (parseInt(PuntoJunio) == 1) ? $("#mes6").removeClass("badge-danger").addClass("badge-success").text("Cumple") : $("#mes6").removeClass("badge-success").addClass("badge-danger").text("No Cumple");
        },
        error: function () {
            $("#tablePuntosV").hide(1000);
        }
    });
}

function sharPDF(element){
    var sahrepdf = $("#" + element).attr("data-ref-ws");
    var downloadpdf = $("#" + element).attr("data-ref");
    $("#downloadPDFbtn").attr('href', downloadpdf);
    $("#sharePDFbtn").attr('href', sahrepdf);
}

function stopVideo(){
    $('video')[0].pause();
}

function getDetailSemanas(){
    $("#detailWeek1").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        ordering: false,
        ajax: '/getDetailSemanas?s=1&a=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'OrderNum', className: 'text-center' },
            { data: 'OrderDate', className: 'text-center' },
            { 
                data: 'SumPuntos',
                className: 'text-center',
                render: function(data, type, row) {
                    var SumPuntos = row.SumPuntos;
                    return formatMoney(SumPuntos);
                },
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

    $("#detailWeek2").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        ordering: false,
        ajax: '/getDetailSemanas?s=2&a=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'OrderNum', className: 'text-center' },
            { data: 'OrderDate', className: 'text-center' },
            { 
                data: 'SumPuntos',
                className: 'text-center',
                render: function(data, type, row) {
                    var SumPuntos = row.SumPuntos;
                    return formatMoney(SumPuntos);
                },
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

    $("#detailWeek3").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        ordering: false,
        ajax: '/getDetailSemanas?s=3&a=' + $("#associateid").val(),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'OrderNum', className: 'text-center' },
            { data: 'OrderDate', className: 'text-center' },
            { 
                data: 'SumPuntos',
                className: 'text-center',
                render: function(data, type, row) {
                    var SumPuntos = row.SumPuntos;
                    return formatMoney(SumPuntos);
                },
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
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

getDetailSemanas();