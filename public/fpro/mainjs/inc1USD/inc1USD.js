var timer;
var flags = { MEX: 'mexico.png', PER: 'peru.png', LAT: 'mexico.png', COL: 'colombia.png', CHL: 'chile.png', ECU: 'ecuador.png', PAN: 'panama.png', SLV: 'salvador.png', GTM: 'guatemala.png', CRI: 'costarica.png'};
$("#releaseKitMK").hide();

function getTicket(){
    getCountKits();
    inc1USDGetticketsIncorp();
    inc1USDGetticketsVenta();
    TotalKitsCedidos();
    inc1USDGetticketsCeder();
    $("#releaseKitMK").hide(1000);
    $('#shareLinkIW').hide(1000);
}

function inc1USDGetticketsIncorp(){
    $('#summaryTicketsInc').DataTable({
        destroy: true,
        lengthChange: false,
        ordering: true,
        info: false,
        ajax: '/inc1USDGetticketsIncorp?associateid=' + $("#associateid").val(),
        columns: [
            { data: 'CodigoBoleto', className: 'text-center' },
            { data: 'Influencer', className: 'text-center' },
            { data: 'Fecha_Influencer', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            {
                data: 'Pais',
                className: 'text-center',
                render: function(data, type, row){
                    var pais = row.Pais;
                    if(pais == 'LAT'){
                        pais = 'MEX';
                    }
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            {
                data: 'AssociateName',
                className: 'text-center',
                "render": function(data, type, row){
                    var href = "javascript:void(0);";
                    var text = "Redimir Kit";
                    var attrLink = "";
                    var attrButton = "";
                    var btn_class = "btn-success";

                    if(row.Estatus == 2){
                        text = "Incorporación pendiente";
                        attrButton = "disabled='true'";
                        href = "javascript:void(0);";
                        attrLink = "";
                        btn_class = "btn-dark";
                    }
                    else if(row.Estatus == 1){
                        text = "Kit redimido";
                        attrButton = "disabled='true'";
                        href = "javascript:void(0);";
                        attrLink = "";
                        btn_class = "btn-dark";
                    }
                    else if(row.Estatus == 4){
                        text = "Liberación solicitada";
                        attrButton = "disabled='true'";
                        href = "javascript:void(0);";
                        attrLink = "";
                        btn_class = "btn-dark";
                    }
                    else if(row.Estatus == 0){
                        text = "Redimir Kit";
                        attrLink = 'target="_new"';
                    }

                    if(row.existe == 1){
                        return '<button class="btn btn-outline-dark btn-rounded mb-4 mr-2">' + text + '</button>'
                    }
                    else{
                        return '<div class="btn-group dropup ">' +
                                    '<button id="' + row.CodigoBoleto.trim() + '-Button" class="chlBtn btn btn-success dropdown-toggle br-left-30 br-right-30 ' + btn_class + '" ' + attrButton + ' type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="validaExistencia(\'' + row.CodigoBoleto.trim() + '\')">' + text + '</button>' +
                                    '<div class="dropdown-menu text-center">' +
                                        '<a href="javascript:void(0);" class="dropdown-item text-black"><b><span id="logBTN">Elegir País</span></b></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="COL">Colombia &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['COL'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=mexico/login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) +'" class="dropdown-item" id="LAT">México &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['LAT'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=peru/login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="PER">Perú &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['PER'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="ECU">Ecuador &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['ECU'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="PAN">Panamá &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['PAN'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="GTM">Guatemala &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['GTM'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="SLV">El Salvador &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['SLV'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=costarica/login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="CRI">Costa Rica &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['CRI'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://signup.nikkenlatam.com:8989/profile/ch/spa/kitoneusd/' + window.btoa(row.SponsorId.trim()) + "/" + window.btoa(5002) + "/" + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="CHL">Chile &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['CHL'] + '" width="20px"></a>' +
                                    '</div>' +
                                '</div>';
                    }
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: function(data, type, row){
                    if(row.Estatus == 1){
                        return "<span>Kit redimido </span>";
                    }
                    else if(row.payment >= 0 && row.Estatus  == 2){
                        return "<span>Pago pendiente</span><br><a href='javascript:void(0);' id='" + row.CodigoBoleto.trim() + "' onclick='getKituserInfo(this.id); slideTo();' class='btn btn-outline-success btn-rounded mb-4 mr-2'>Liberar kit</a>";
                    }
                    else if(row.payment >= 0 && row.Estatus == 4){
                        return "<span>Solicitud de liberación enviada</span>";
                    }
                    else if(row.payment >= 1 && row.Estatus == 1){
                        return "<span>Kit redimido</span>";
                    }
                    else{
                        return "<span>kit disponible</span>";
                    }
                }
            },
            {
                data: 'TypeInflu',
                className: 'text-center',
                render: function(data, type, row){
                    if(row.TypeInflu == 1){
                        return "KIT INFLUENCER";
                    }
                    else if(row.TypeInflu == 2){
                        return "TRANSFORMACION 5002";
                    }
                    else if(row.TypeInflu == 3){
                        return "POR KENKO AIR";
                    }
                    else if(row.TypeInflu == 4){
                        return "POR VENTA";
                    }
                    else if(row.TypeInflu == 5){
                        return "TRANSFORMADO 5006";
                    }
                    else{
                        return "KIT INFLUENCER";
                    }
                }
            },
            { data: 'CodigoInfluencer_1USD', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "La tabla se recargara cada 05:00 minutos.",
            "search": "Buscar",
        }
    });
    getCountKits()
}

function inc1USDGetticketsVenta(){
    $('#summaryTicketsSale').DataTable({
        destroy: true,
        lengthChange: false,
        ordering: true,
        info: false,
        ajax: '/inc1USDGetticketsVenta?associateid=' + $("#associateid").val(),
        columns: [
            { data: 'CodigoBoleto', className: 'text-center' },
            { data: 'Influencer', className: 'text-center' },
            { data: 'Fecha_Influencer', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            {
                data: 'Pais',
                className: 'text-center',
                render: function(data, type, row){
                    var pais = row.Pais;
                    if(pais == 'LAT'){
                        pais = 'MEX';
                    }
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            {
                data: 'AssociateName',
                className: 'text-center',
                "render": function(data, type, row){
                    var href = "javascript:void(0);";
                    var text = "Redimir Kit";
                    var attrLink = "";
                    var attrButton = "";
                    var btn_class = "btn-success";

                    if(row.Estatus == 2){
                        text = "Incorporación pendiente";
                        attrButton = "disabled='true'";
                        href = "javascript:void(0);";
                        attrLink = "";
                        btn_class = "btn-dark";
                    }
                    else if(row.Estatus == 1){
                        text = "Kit redimido";
                        attrButton = "disabled='true'";
                        href = "javascript:void(0);";
                        attrLink = "";
                        btn_class = "btn-dark";
                    }
                    else if(row.Estatus == 0){
                        text = "Redimir Kit";
                        attrLink = 'target="_new"';
                    }

                    if(row.existe == 1){
                        return '<button class="btn btn-outline-dark btn-rounded mb-4 mr-2">' + text + '</button>'
                    }
                    else{
                        return '<div class="btn-group dropup ">' +
                                    '<button id="' + row.CodigoBoleto.trim() + '-Button" class="chlBtn btn btn-success dropdown-toggle br-left-30 br-right-30 ' + btn_class + '" ' + attrButton + ' type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="validaExistencia(\'' + row.CodigoBoleto.trim() + '\')">' + text + '</button>' +
                                    '<div class="dropdown-menu text-center">' +
                                        '<a href="javascript:void(0);" class="dropdown-item text-black"><b><span id="logBTN">Elegir País</span></b></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="COL">Colombia &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['COL'] + '" width="20px"></a>' +
                                        // '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=mexico/login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) +'" class="dropdown-item" id="LAT">México &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['LAT'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=mexico/login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) +'" class="dropdown-item" id="LAT">México &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['LAT'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=peru/login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="PER">Perú &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['PER'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="ECU">Ecuador &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['ECU'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="PAN">Panamá &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['PAN'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="GTM">Guatemala &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['GTM'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="SLV">El Salvador &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['SLV'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://services.nikken.com.mx/mkshare?data=costarica/login-cupon-incorporate.php|sponsorid=' + window.btoa(row.SponsorId.trim()) + '|kit=' + window.btoa(5002) + '|boleto=' + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="CRI">Costa Rica &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['CRI'] + '" width="20px"></a>' +
                                        '<a onclick="disableButton(\'' + row.CodigoBoleto.trim() + '\', compartirLink(this, \'' + row.CodigoBoleto.trim() + '\'), slideToShare())" href="https://signup.nikkenlatam.com:8989/profile/ch/spa/kitoneusd/' + window.btoa(row.SponsorId.trim()) + "/" + window.btoa(5002) + "/" + window.btoa(row.CodigoBoleto.trim()) + '" class="dropdown-item" id="CHL">Chile &nbsp;&nbsp;<img src="../fpro/img/flags/' + flags['CHL'] + '" width="20px"></a>' +
                                    '</div>' +
                                '</div>';
                    }
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: function(data, type, row){
                    if(row.Estatus == 1){
                        return "<span>Kit redimido </span>";
                    }
                    else if(row.payment == 0 && row.status == 2){
                        return "<span>Pago pendiente</span><br><a href='javascript:void(0);' id='" + row.CodigoBoleto.trim() + "' onclick='getKituserInfo(this.id); slideTo();' class='btn btn-outline-success btn-rounded mb-4 mr-2'>Liberar kit</a>";
                    }
                    else if(row.payment >= 1 && row.status == 4){
                        return "<span>Solicitud de liberación enviada</span>";
                    }
                    else if(row.payment >= 1 && row.status == 1){
                        return "<span id='" + row.CodigoBoleto.trim() + "-colStatus'>Kit redimido</span>";
                    }
                    else{
                        return "<span id='" + row.CodigoBoleto.trim() + "-colStatus'>kit disponible</span>";
                    }
                }
            },
            {
                data: 'TypeInflu',
                className: 'text-center',
                render: function(data, type, row){
                    if(row.TypeInflu == 1){
                        return "KIT INFLUENCER";
                    }
                    else if(row.TypeInflu == 2){
                        return "TRANSFORMACION 5002";
                    }
                    else if(row.TypeInflu == 3){
                        return "POR KENKO AIR";
                    }
                    else if(row.TypeInflu == 4){
                        return "POR VENTA";
                    }
                    else if(row.TypeInflu == 5){
                        return "TRANSFORMADO 5006";
                    }
                    else{
                        return "KIT INFLUENCER";
                    }
                }
            },
            { data: 'CodigoInfluencer_1USD', className: 'text-center' },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "La tabla se recargara cada 05:00 minutos.",
            "search": "Buscar",
        }
    });
    getCountKits()
}
getTicket();

// https://services.nikken.com.mx/mkshare?data=mexico/login-cupon-incorporate.php|sponsorid=NDU4MjU0MDM=|kit=NTAwMg==|boleto=Q09ELTQ0NTc1MDAzLVA=
setInterval('getTicket()', 600000);

$('#detailTickets').DataTable({
    destroy: true,
    lengthChange: false,
    ordering: true,
    info: false,
    ajax: '/inc1USDGetDetails?associateid=' + $("#associateid").val(),
    columns: [
        { data: 'AssociateId', className: 'text-center' },
        { data: 'AssociateName', className: 'text-center' },
        { data: 'AssociateName', className: 'text-center' },
        { 
            data: 'Pais',
            className: 'text-center',
            render: function(data, type, row){
                var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                return dato;
            }
        },
        { data: 'Orderdate', className: 'text-center' },
        { data: 'Fecha_Vencimiento', className: 'text-center' },
        { data: 'Transformacion', className: 'text-center' },
        { data: 'Sponsorid', className: 'text-center' }
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
        "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
        "info": "Showing page _PAGE_ of _PAGES_",
        "search": "Buscar",
    }
});

$("#type").val(1);
function getReport(){
    var type = $("#type").val();
    $('#mainGenealogy').DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        ajax: '/inc1USDGetGenealogy?associateid=' + $("#associateid").val() + '&type=' + type,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'associateid', className: 'text-center' },
            { data: 'associateName', className: 'text-center' },
            { data: 'nivel', className: 'text-center' },
            {
                data: 'AssociateType',
                className: 'text-center',
                render: function(data, type, row){
                    if(row.AssociateType == 100){
                        return "Influencer";
                    }
                    else{
                        return "Cliente";
                    }
                }
            },
            {
                data: 'Pais',
                className: 'text-center',
                render: function(data, type, row){
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            { data: 'Rango', className: 'text-center' },
            { data: 'Total_Incorpor', className: 'text-center' },
            { data: 'Incorpo_Redimidas', className: 'text-center' },
            { data: 'Incorpo_Pendientes', className: 'text-center' },
            { data: 'Incorpo_Transformadas', className: 'text-center' },
            { data: 'Email', className: 'text-center' },
            { data: 'Telefono', className: 'text-center' },
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
    navigationTracking($("#associateid").val(), 'Mokuteki PLUS', 'Estatus de mi red: ' + type)
}
getReport()

function loadEstatusIniPerfRed(type){
    if(type == null || type == ''){
        type = 1;
    }
    $('#miRedInicioPerfecto').DataTable({
        destroy: true,
        lengthChange: false,
        ordering: false,
        info: false,
        ajax: '/inc1USDsegPerfectoGen?associateid=' + $("#associateid").val() + '&type=' + type,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                    text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                },
            ]
        },  
        columns: [
            { data: 'associateid', className: 'text-center' },
            { data: 'nivel', className: 'text-center' },
            { data: 'associateName', className: 'text-center' },
            { 
                data: 'AssociateType',
                className: 'text-center',
                render: function(data, type, row){
                    if(row.AssociateType == 100){
                        return "Influencer";
                    }
                    else{
                        return "Cliente";
                    }
                }
            },
            { 
                data: 'Pais',
                className: 'text-center',
                render: function(data, type, row){
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            { data: 'Rango', className: 'text-center' },
            { data: 'Incorp_Oct', className: 'text-center' },
            { data: 'Incorp_Nov', className: 'text-center' },
            { data: 'Incorp_Dic', className: 'text-center' },
            { data: 'Incorp_Ene', className: 'text-center' },
            { data: 'Total_Incorp', className: 'text-center' },
            { data: 'Email', className: 'text-center' },
            { data: 'Telefono', className: 'text-center' },
            {
                data: 'Telefono',
                className: 'text-center',
                render: function(data, type, row){
                    return '<span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
            }
        ],  
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_",
            "search": "Buscar",
        }
    });
}

function disableButton(button){
    $("#" + button + '-Button').attr('disabled', true);
}

function formatMoney(amount, decimalCount, decimal = ".", thousands = ",") {
    try {
        if(amount == '.00'){
            amount = 0;
        }
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
        const negativeSign = amount < 0 ? "-" : "";
        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;
        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    }
    catch (e) {
        console.log(e)
    }
};

function inc1USDsegPerfectoPers(){
    var data = { associateid: $("#associateid").val() }
    $.ajax({
        type: 'GET',
        url: '/inc1USDsegPerfectoPers',
        data: data,
        success: function(Res){
            if(Res != '' || Res.length > 0){
                $("#cantOctubre").text(Res[0]['Incorp_Oct']);
                $("#cantNoviembre").text(Res[0]['Incorp_Nov']);
                $("#cantDiciembre").text(Res[0]['Incorp_Dic']);
                $("#cantEnero").text(Res[0]['Incorp_Ene']);
                
                if(Res[0]['Incorp_Oct'] >= 3){
                    $("#chkcantOctubre").parent().removeClass('badge-danger');
                    $("#chkcantOctubre").parent().addClass('badge-success');
                    $("#chkcantOctubre").removeClass('flaticon-circle-cross');
                    $("#chkcantOctubre").addClass('flaticon-single-circle-tick');
                    $("#txtCantOctubre").text('Cumple');
                }
                if(Res[0]['Incorp_Nov'] >= 3){
                    $("#chkcantNoviembre").parent().removeClass('badge-danger');
                    $("#chkcantNoviembre").parent().addClass('badge-success');
                    $("#chkcantNoviembre").removeClass('flaticon-circle-cross');
                    $("#chkcantNoviembre").addClass('flaticon-single-circle-tick');
                    $("#txtCantNoviembre").text('Cumple');
                }
                if(Res[0]['Incorp_Dic'] >= 3){
                    $("#chkcantDiciembre").parent().removeClass('badge-danger');
                    $("#chkcantDiciembre").parent().addClass('badge-success');
                    $("#chkcantDiciembre").removeClass('flaticon-circle-cross');
                    $("#chkcantDiciembre").addClass('flaticon-single-circle-tick');
                    $("#txtCantDiciembre").text('Cumple');
                }
                if(Res[0]['Incorp_Ene'] >= 3){
                    $("#chkcantEnero").parent().removeClass('badge-danger');
                    $("#chkcantEnero").parent().addClass('badge-success');
                    $("#chkcantEnero").removeClass('flaticon-circle-cross');
                    $("#chkcantEnero").addClass('flaticon-single-circle-tick');
                    $("#txtCantEnero").text('Cumple');
                }
                if(Res[0]['Incorp_Feb'] >= 3){
                    $("#chkcantDiciembre").parent().removeClass('badge-danger');
                    $("#chkcantDiciembre").parent().addClass('badge-success');
                    $("#chkcantDiciembre").removeClass('flaticon-circle-cross');
                    $("#chkcantDiciembre").addClass('flaticon-single-circle-tick');
                    $("#txtCantDiciembre").text('Cumple');
                }
                if(Res[0]['Incorp_Mar'] >= 3){
                    $("#chkcantEnero").parent().removeClass('badge-danger');
                    $("#chkcantEnero").parent().addClass('badge-success');
                    $("#chkcantEnero").removeClass('flaticon-circle-cross');
                    $("#chkcantEnero").addClass('flaticon-single-circle-tick');
                    $("#txtCantEnero").text('Cumple');
                }

                $("#cantOctubreVP").text(formatMoney(Res[0]['VP_Oct'], 0));
                $("#cantNoviembreVP").text(formatMoney(Res[0]['VP_Nov'], 0));
                $("#cantDiciembreVP").text(formatMoney(Res[0]['VP_Dic'], 0));
                $("#cantEneroVP").text(formatMoney(Res[0]['VP_Ene'], 0));
                $("#cantFebreroVP").text(formatMoney(Res[0]['VP_Ene'], 0));
                $("#cantMarzoVP").text(formatMoney(Res[0]['VP_Ene'], 0));

                if(Res[0]['VP_Oct'] >= 600){
                    $("#chkcantOctubreVP").parent().removeClass('badge-danger');
                    $("#chkcantOctubreVP").parent().addClass('badge-success');
                    $("#chkcantOctubreVP").removeClass('flaticon-circle-cross');
                    $("#chkcantOctubreVP").addClass('flaticon-single-circle-tick');
                    $("#txtCantOctubreVP").text('Cumple');
                }
                if(Res[0]['VP_Nov'] >= 600){
                    $("#chkcantNoviembreVP").parent().removeClass('badge-danger');
                    $("#chkcantNoviembreVP").parent().addClass('badge-success');
                    $("#chkcantNoviembreVP").removeClass('flaticon-circle-cross');
                    $("#chkcantNoviembreVP").addClass('flaticon-single-circle-tick');
                    $("#txtCantNoviembreVP").text('Cumple');
                }
                if(Res[0]['VP_Dic'] >= 600){
                    $("#chkcantDiciembreVP").parent().removeClass('badge-danger');
                    $("#chkcantDiciembreVP").parent().addClass('badge-success');
                    $("#chkcantDiciembreVP").removeClass('flaticon-circle-cross');
                    $("#chkcantDiciembreVP").addClass('flaticon-single-circle-tick');
                    $("#txtCantDiciembreVP").text('Cumple');
                }
                if(Res[0]['VP_Ene'] >= 600){
                    $("#chkcantEneroVP").parent().removeClass('badge-danger');
                    $("#chkcantEneroVP").parent().addClass('badge-success');
                    $("#chkcantEneroVP").removeClass('flaticon-circle-cross');
                    $("#chkcantEneroVP").addClass('flaticon-single-circle-tick');
                    $("#txtCantEneroVP").text('Cumple');
                }
                if(Res[0]['VP_Feb'] >= 600){
                    $("#chkcantFebreroVP").parent().removeClass('badge-danger');
                    $("#chkcantFebreroVP").parent().addClass('badge-success');
                    $("#chkcantFebreroVP").removeClass('flaticon-circle-cross');
                    $("#chkcantFebreroVP").addClass('flaticon-single-circle-tick');
                    $("#txtCantFebreroVP").text('Cumple');
                }
                if(Res[0]['VP_Mar'] >= 600){
                    $("#chkcantMarzoVP").parent().removeClass('badge-danger');
                    $("#chkcantMarzoVP").parent().addClass('badge-success');
                    $("#chkcantMarzoVP").removeClass('flaticon-circle-cross');
                    $("#chkcantMarzoVP").addClass('flaticon-single-circle-tick');
                    $("#txtCantMarzoVP").text('Cumple');
                }
            }
        }
    })
}
inc1USDsegPerfectoPers();

function getCountKits(){
    var data = { associateid: $("#associateid").val(), Pais: $("#Pais").val() }

    $.ajax({
        type: 'GET',
        url: '/getCountKits',
        data: data, 
        beforeSend: function(){
            $("#totalKits").text(0);
            $("#kistUsados").text(0);
            $("#kitsLibres").text(0);
            if($("#kitsCHL").length > 0){
                $("#kitsCHL").text(0);
            }
        },
        success: function(result){
            var total = parseInt(result['nkitsUsed'][0]['usados']) + parseInt(result['nkitsDisp'][0]['disponibles']);
            $("#totalKits").text(total);
            $("#kistUsados").text(result['nkitsUsed'][0]['usados']);
            $("#kitsLibres").text(result['nkitsDisp'][0]['disponibles']);
            if($("#kitsCHL").length > 0){
                $("#kitsCHL").text(result['nkitsDispCHL'][0]['DispKenkoAir']);
            }
        }
    })
}
getCountKits();

function validaExistencia(boleto){
    var data = { associateid: $("#associateid").val(), boleto: boleto, _token: $("#_token").val() };

    $.ajax({
        type: 'POST',
        url: '/inc1USDValidaTicket',
        data: data,
        beforeSend: function(){
            $("#logBTN").text('Cargando...');
            $("#COL, #LAT, #PER, #ECU, #PAN, #GTM, #SLV, #CRI, #CHL").hide();
        },
        success: function(Res){
            if(Res > 0){
                $("#" + boleto + "-Button").text("Kit Redimido");
                $("#" + boleto + "-colStatus").text("Kit Redimido");
                $("#" + boleto + '-slctPais').remove();
                $("#" + boleto + '-Button').removeClass('btn-success');
                $("#" + boleto + '-Button').removeClass('dropdown-toggle');
                $("#" + boleto + '-Button').addClass('btn-outline-dark');
                $("#" + boleto + '-Button').attr('disabled', true);
            }
            else{
                $("#logBTN").text('Elegir País');
                $("#COL, #LAT, #PER, #ECU, #PAN, #GTM, #SLV, #CRI, #CHL").show();
            }
        }
    })
}

$("#typeGen").val(1);
function getReportMkPlus(){
    var type = $("#typeGen").val();
    $('#mainMkPlus').DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        ajax: '/inc1USDGetGenealogyMkPlus?associateid=' + $("#associateid").val() + '&type=' + type,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'associateid', className: 'text-center' },
            { data: 'nivel', className: 'text-center' },
            { data: 'associateName', className: 'text-center' },
            {
                data: 'Pais',
                className: 'text-center',
                render: function(data, type, row){
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais; 
                    return dato;
                }
            },
            { data: 'Fecha_Incorporacion', className: 'text-center' },
            { data: 'TotalSistemas', className: 'text-center' },
            { data: 'Patrocinador', className: 'text-center' },
            { data: 'Email', className: 'text-center' },
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
//getReportMkPlus();

function getKituserInfo(boleto){
    $("#noKitBoleto").text(boleto);
    $.ajax({
        type: "get",
        url: "/getKituserInfo",
        data: { boleto: boleto },
        beforeSend: function(){
            $("#noKitBoletoLoading").text('Cargando...');
            $("#userInfo").hide();
            $("#sap_code, #nameUserMK, #emaiUserMK, #paisUserMK, #registUserMK, #idVentaMK, #paymenVentaMK").text('');
            $("#releaseKitMK").show(1000);
        },
        success: function (response) {
            if(response != 'null' && response != 'liberado'){
                $("#noKitBoletoLoading").text('');
                $("#userInfo").show(1000);
                $("#sap_code").text(response[0]['sap_code']);
                $("#nameUserMK").text(response[0]['nombre']);
                $("#emaiUserMK").text(response[0]['email']);
                $("#paisUserMK").text(response[0]['country_id']);
                $("#registUserMK").text(response[0]['created_at']);
                $("#idVentaMK").text(response[0]['id']);
                $("#paymenVentaMK").text(response[0]['status_venta']);
                if(response[0]['status_venta'] == 'pagada'){
                    $("#paymenVentaMK").css('background-color', '#b6fff1');
                }
                else if(response[0]['status_venta'] == 'cancelada'){
                    $("#paymenVentaMK").css('background-color', '#e7515a');
                }
                else if(response[0]['status_venta'] == 'standby'){
                    $("#paymenVentaMK").css('background-color', '#e9b02b');
                }
                else if(response[0]['status_venta'] == 'abierta'){
                    $("#paymenVentaMK").css('background-color', '#00b1f4');
                }
                $("#btnLiberarKit").attr('disabled', false);
            }
            else if(response != 'liberado'){
                swal({
                    title: '',
                    icon: 'ok',
                    html:'Se libero el kit ' + boleto + " correctamente." ,
                    type: 'success',
                    padding: '2em',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })
                getTicket();
            }
            else{
                $("#userInfo").hide();
                $("#releaseKitMK").hide(1000);
                swal({
                    title: '',
                    icon: 'ok',
                    html:'Se libero el kit ' + boleto + ' correctamente.',
                    type: 'success',
                    padding: '2em',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })
            }
        }
    });
}

function liberarKitMK(boleto){
    var sale_id = $("#idVentaMK").text();
    if($("#paymenVentaMK").text() != 'pagada' && $("#paymenVentaMK").text() != 'standby'){
        swal({
            title: boleto,
            text: "¿Desea liberar el kit?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Liberar',
            cancelButtonText: 'Cancelar',
            padding: '2em',
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                var sponsor = $("#associateid").val();
                var boleto = $("#noKitBoleto").text();
                var sale_id = $("#idVentaMK").text();
                var status_payment = $("#paymenVentaMK").text();
                var code_redeem = $("#sap_code").text();
                $.ajax({
                    type: "get",
                    url: "/liberarKitMK",
                    data: {
                        sponsor: sponsor,
                        code_redeem: code_redeem,
                        boleto: boleto,
                        sale_id: sale_id,
                        status_payment: status_payment,
                        origen: 1,
                    },
                    beforeSend: function(){
                        $("#btnLiberarKit").attr('disabled', true);
                        $("#noKitBoletoLoading").text('liberando kit...');
                    },
                    success: function (response) {
                        $("#btnLiberarKit").attr('disabled', false);
                        swal({
                            title: '',
                            icon: 'ok',
                            html:'Se libero el kit ' + boleto + " correctamente." ,
                            type: 'success',
                            padding: '2em',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        })
                        getTicket();
                        $("#noKitBoletoLoading").text('');
                    },
                    fail: function (){
                        $("#btnLiberarKit").attr('disabled', false);
                        swal({
                            title: '',
                            icon: 'info',
                            html:'Ocurrio un error al liberar el kit: ' + boleto + ", intente nuevamente.",
                            type: 'error',
                            padding: '2em',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        })
                    }
                });
            }
        })
    }
    else if($("#paymenVentaMK").text() == 'pagada'){
        swal({
            title: boleto,
            text: "El estatus de la incoporación con este kit ya esta concluida, ¿Desea solicitar la depuración para liberar este kit?",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Solicitar liberación',
            cancelButtonText: 'Cancelar',
            padding: '2em',
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                var sponsor = $("#associateid").val();
                var boleto = $("#noKitBoleto").text();
                var sale_id = $("#idVentaMK").text();
                var status_payment = $("#paymenVentaMK").text();
                var code_redeem = $("#sap_code").text();
                $.ajax({
                    type: "get",
                    url: "/mksolLibrearKit",
                    data: {
                        sponsor: sponsor,
                        code_redeem: code_redeem,
                        boleto: boleto,
                        sale_id: sale_id,
                        status_payment: status_payment,
                        origen: 1,
                    },
                    beforeSend: function(){
                        $("#noKitBoletoLoading").text("Enviando solicitud");
                    },
                    success: function (response) {
                        $("#noKitBoletoLoading").text("");
                        getTicket();
                        swal({
                            title: '',
                            icon: 'info',
                            html:'se ha solicitado a Servicio al Cliente la evalución de tu solicitud',
                            type: 'info',
                            padding: '2em',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        })
                    }
                });
            }
            else{
                getTicket(); $("#releaseKitMK").hide(1000);
            }
        })
    }
    else if($("#paymenVentaMK").text() == 'standby'){
        swal({
            title: boleto,
            text: "El estatus de la incoporación con este kit tiene un pago pendiente por validar, desea solicitar la liberación?",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Solicitar liberación',
            cancelButtonText: 'Cancelar',
            padding: '2em',
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                var sponsor = $("#associateid").val();
                var boleto = $("#noKitBoleto").text();
                var sale_id = $("#idVentaMK").text();
                var status_payment = $("#paymenVentaMK").text();
                var code_redeem = $("#sap_code").text();
                $.ajax({
                    type: "get",
                    url: "/mksolLibrearKit",
                    data: {
                        sponsor: sponsor,
                        code_redeem: code_redeem,
                        boleto: boleto,
                        sale_id: sale_id,
                        status_payment: status_payment,
                        origen: 1,
                    },
                    beforeSend: function(){
                        $("#noKitBoletoLoading").text("Enviando solicitud");
                    },
                    success: function (response) {
                        $("#noKitBoletoLoading").text("");
                        getTicket();
                        swal({
                            title: '',
                            icon: 'info',
                            html:'se ha solicitado a Servicio al Cliente la evalución de tu solicitud',
                            type: 'info',
                            padding: '2em',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        })
                    }
                });
            }
            else{
                getTicket(); $("#releaseKitMK").hide(1000);
            }
        })
    }
}

function slideTo() {
    var element = document.getElementById('releaseKitMK');
    document.getElementById('bd-estatusper-modal-xl').scrollTo({
        top: element.offsetTop,
        behavior: 'smooth'
    });
}

function compartirLink(link, boleto){
    $("#shareLinkIW").show(1000);
    event.preventDefault(); 
    var liga = link.getAttribute("href");
    $("#noKitBoletoShare").text(boleto);
    $("#shareBTN").attr('href', 'https://wa.me/?text=Únete+a+NIKKEN+aquí:+' + liga);
    //$("#shareBTN").attr('href', liga);
    $("#redimeBTN").attr('href', liga);
    $("#linkCopy").val(liga);
}

function slideToShare() {
    var element = document.getElementById('shareLinkIW');
    document.getElementById('bd-estatusper-modal-xl').scrollTo({
        top: element.offsetTop,
        behavior: 'smooth'
    });
}

$("#copyLinkBtn").click(function() {
    $("#linkCopy").select();
    document.execCommand("copy");
    $('#shareLinkIW').hide(1000);
    swal({
        title: '',
        icon: 'ok',
        html:"Link copiado" ,
        type: 'success',
        padding: '2em',
        allowOutsideClick: false,
        allowEscapeKey: false,
    })
});

// ### Inicia Ceder Kit
//# Cesar Lima 28-03-20022
//# Funcion 
//#---------- Total - Kits Cedidos ----------
function TotalKitsCedidos() {

    var opkitced = "0";
    var lblcode = $("#lbl-code").val();
    var token = $('#_token').val();

    $.ajax({
        data: {
            "opkitced": opkitced,
            "lblcode": lblcode,
            "_token": token
        },
        url: "/TotalKitsCedidos",
        type: 'GET',
        beforeSend: function () {

        },
        success: function (response) {

            $("#Totkistced").html(response);
            GenealogiasCK();

        }
    });


}

function GenealogiasCK() {

    var lblcode = $("#lbl-code").val();
    var token = $('#_token').val();

    $.ajax({
        data: {
            "lblcode": lblcode,
            "_token": token
        },
        url: "/TotalAsrsMorganiza",
        type: 'GET',
        beforeSend: function () {

        },
        success: function (response) {


        }
    });


}

//# Cesar Lima 28-03-20022
//# Funcion 
//#---------- Llenar GRID - Kits Cedidos ----------
function ListKitsCeds(opciones) {

    var opc = opciones;

    switch (opciones){

        case 0:
        ListKitCedidos();
        getCountKits();
        TotalKitsCedidos();
        $("#form-cederkit").hide();
        $("#table-kitscedidos").show();
        break;

        case 1:
        ListKitCedidos();
        $("#btn-lsktcedi").hide();
        $("#table-cederkit").hide();
        $("#btn-grktcedi").show();
        $("#table-kitscedidos").show();
        break;

        case 2:
        $("#btn-grktcedi").hide();
        $("#table-kitscedidos").hide();
        $("#btn-lsktcedi").show();
        $("#table-cederkit").show();
        break;

    }

}


function ListKitCedidos(){

    $('#ListaKitCedidos').DataTable({
        destroy: true,
        lengthChange: false,
        ordering: true,
        info: false,
        ajax: '/DetailsKitsCedidos?associateid=' + $("#lbl-code").val(),
        columns: [{
                data: 'CodigosBoletoVenta',
                className: 'text-center'
            },
            {
                data: 'associate_new',
                className: 'text-center'
            },
            {
                data: 'date_given',
                className: 'text-center'
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": {
                "previous": "<i class='flaticon-arrow-left-1'></i>",
                "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "La tabla se recargara cada 05:00 minutos.",
            "search": "Buscar",
        }
    });

}


function inc1USDGetticketsCeder() {

    $('#summaryTicketsCeder').DataTable({
        destroy: true,
        lengthChange: false,
        ordering: true,
        info: false,
        ajax: '/inc1USDGetticketsCeder?associateid=' + $("#associateid").val(),
        columns: [{
                data: 'CodigoBoleto',
                className: 'text-center'
            },
            {
                data: 'Influencer',
                className: 'text-center'
            },
            {
                data: 'Fecha_Influencer',
                className: 'text-center'
            },
            {
                data: 'AssociateName',
                className: 'text-center'
            },
            {
                data: 'Pais',
                className: 'text-center',
                render: function (data, type, row) {
                    var pais = row.Pais;
                    if (pais == 'LAT') {
                        pais = 'MEX';
                    }
                    var dato = "<img src='../fpro/img/flags/" + flags[row.Pais] + "' width='15px'> <br>" + row.Pais;
                    return dato;
                }
            },
            {
                data: 'AssociateName',
                className: 'text-center',
                "render": function (data, type, row) {
                    var href = "javascript:void(0);";
                    var text = "Redimir Kit";
                    var attrLink = "";
                    var attrButton = "";
                    var btn_class = "btn-success";

                    if(row.Estatus == 2){
                        text = "Incorporación pendiente";
                        attrButton = "disabled='true'";
                        href = "javascript:void(0);";
                        attrLink = "";
                        btn_class = "btn-dark";
                    }
                    else if(row.Estatus == 1){
                        text = "Kit Cedido / Redimido";
                        attrButton = "disabled='true'";
                        href = "javascript:void(0);";
                        attrLink = "";
                        btn_class = "btn-dark";
                    }
                    else if(row.Estatus == 0){
                        text = "Ceder Kit";
                        attrLink = 'target="_new"';
                    }

                    if (row.Estatus == 1) {
                        return '<button class="btn btn-outline-dark btn-rounded mb-4 mr-2">' + text + '</button>'
                    }
                    else if (row.Estatus == 2) {
                        return '<button class="btn btn-outline-dark btn-rounded mb-4 mr-2">' + text + '</button>'
                    }
                    else {
                        return '<button class="btn btn-success btn-rounded mb-4 mr-2" onclick="CederKitButton(\'' + $("#associateid").val().trim() + '\',\'' + row.CodigoBoleto.trim() + '\')" > Ceder Kit </button>';
                    }
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: function (data, type, row) {
                    if(row.Estatus == 1){
                        return "<span>Kit redimido </span>";
                    }
                    else if (row.payment == 0 && row.status == 2) {
                        return "<span>Pago pendiente</span><br><a href='javascript:void(0);' id='" + row.CodigoBoleto.trim() + "' onclick='getKituserInfo(this.id); slideTo();' class='btn btn-outline-success btn-rounded mb-4 mr-2'>Liberar kit</a>";
                    } else if (row.payment >= 1 && row.status == 4) {
                        return "<span>Solicitud de liberación enviada</span>";
                    } else if (row.payment >= 1 && row.status == 1) {
                        return "<span id='" + row.CodigoBoleto.trim() + "-colStatus'>Kit redimido</span>";
                    } else {
                        return "<span id='" + row.CodigoBoleto.trim() + "-colStatus'>kit disponible</span>";
                    }
                }
            },
            /*
            {
                data: 'TypeInflu',
                className: 'text-center',
                render: function(data, type, row){
                    if(row.TypeInflu == 1){
                        return "KIT INFLUENCER";
                    }
                    else if(row.TypeInflu == 2){
                        return "TRANSFORMACION 5002";
                    }
                    else if(row.TypeInflu == 3){
                        return "POR KENKO AIR";
                    }
                    else if(row.TypeInflu == 4){
                        return "POR VENTA";
                    }
                    else if(row.TypeInflu == 5){
                        return "TRANSFORMADO 5006";
                    }
                    else{
                        return "KIT INFLUENCER";
                    }
                }
            },
            { data: 'CodigoInfluencer_1USD', className: 'text-center' },*/
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
            "paginate": {
                "previous": "<i class='flaticon-arrow-left-1'></i>",
                "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "La tabla se recargara cada 05:00 minutos.",
            "search": "Buscar",
        }
    });
    getCountKits();
}

//# Cesar Lima 28-03-20022
//# Funcion 
//#---------- Mostrar Formulario - Ceder Kits ----------

function CederKitButton(Influencer, CodigoBoleto) {

    $("#key").val("");
    $("#ciname").val("");
    $("#txt-cederkit").html('kit por Ceder');
    $("#lbl-code").val(Influencer);
    $("#lbl-boleto").val(CodigoBoleto);
    $("#table-cederkit").hide();
    $("#form-cederkit").show();
    $("#btn-lsktcedi").hide();
}

//# Cesar Lima 28-03-20022
//# Funcion 
//#---------- Mostrar Grid - Ceder Kits ----------

function ListCedKit() {
    $("#txt-cederkit").html('kits disponibles por Ceder');
    $("#form-cederkit").hide();
    $("#form-aceptarkit").hide();
    $("#table-kitscedidos").hide();
    $("#btn-lsktcedi").show();
    $("#table-cederkit").show();
    getTicket();
}

//# Cesar Lima 28-03-20022
//# Funcion 
//#-------- Autocompletar - Codigo - Nombre - Apellido - Ceder Kits --------
$(document).ready(function () {

    $('#key').on('keyup', function () {
        var key = $('#key').val();
        var dataString = 'key=' + key;

        $.ajax({
            type: "GET",
            url: "/AutocomGetkitsCeder?lblcode=" + $("#lbl-code").val(),
            data: dataString,
            success: function (data) {

                if (data == 0 || $("#key").val().length < 3) {

                    $("#btn-aceptar").prop('disabled', true);
                    $('#ciname').val('');
                    $('#suggestions').fadeIn(1000).html(data);

                } else {

                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestions').fadeIn(1000).html(data);
                    //Al hacer click en alguna de las sugerencias
                    $('.suggest-element').on('click', function () {
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#key').val($('#' + id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions').fadeOut(1000);
                        const sepVal = id.split("-");
                        $('#key').val(sepVal[0]);
                        $('#ciname').val(sepVal[1]);
                        $("#btn-aceptar").prop('disabled', false);
                        return false;

                    });
                }
            }
        });
    });
});

//# Cesar Lima 28-03-20022
//# Funcion 
//#-------- Confirmar - Ceder Kits --------

function AcepCederKit() {

    var lblcode = $("#lbl-code").val();
    var lblboleto = $("#lbl-boleto").val();
    var key = $("#key").val();
    var ciname = $("#ciname").val();
    var token = $('#_token').val();

    $.ajax({
        data: {
            "lblcode": lblcode,
            "lblboleto": lblboleto,
            "key": key,
            "_token": token
        },
        url: "/CederKitAutorizado",
        type: 'GET',
        beforeSend: function () {
            // $("#btn-aceptar").prop('disabled',true);
            //$("#key").prop('disabled',true);
            $('#load-cederkit').html('<img src="https://c.tenor.com/8ZhQShCQe9UAAAAC/loader.gif" width="50%">');
        },
        success: function (response) {
            
            $("#btn-lsktcedi").hide();  
            TotalKitsCedidos();
            $("#txt-cederkit").html('kit Cedido');
            inc1USDGetticketsCeder();
            $("#lbl-asesor").html(lblcode);
            $("#lbl-boletos").html(lblboleto);
            $("#lbl-cdcedido").html(key);
            $("#lbl-nombre").html(ciname);
            $('#load-cederkit').html('');
            $("#form-cederkit").hide();
            $("#form-aceptarkit").show();
            getTicket();

        }
    });

}
//# Fin Ceder Kits