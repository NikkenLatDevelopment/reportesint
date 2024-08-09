var meses = {'202101': 'Enero 2021', '202102': 'Febrero 2021', '202103': 'Marzo 2021', '202104': 'Abril 2021', '202105': 'Mayo 2021', '202106': 'Junio 2021', '202107': 'Julio 2021', '202108': 'Agosto 2021', '202109': 'Septiembre', '202110': 'Octubre 2021', '202111': 'Noviembre 2021', '202112': 'Diciembre 2021'};

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

function formatMoney(amount, decimalCount, decimal = ".", thousands = ",") {
    try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 0 : decimalCount;
        const negativeSign = amount < 0 ? "-" : "";
        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;
        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    }
    catch (e) {
        console.log(e)
    }
};



var contador = 0;
var flag = {'PER': 'peru.png', 'MEX': 'mexico.png', 'LAT': 'mexico.png', 'COL': 'colombia.png', 'CHL': 'chile.png', 'ECU': 'ecuador.png', 'PAN': 'panama.png', 'SLV': 'salvador.png', 'GTM': 'guatemala.png', 'CRI': 'costarica.png'};
var mainCode = $("#associateid").val();
$("#rankingTabPlatas").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/vpGetRankPlatasv2",
    columns: [
        { 
            data: 'posicion', 
            className: 'text-center',
           
        },
        { data: 'AssociateName', className: 'text-center' },
        { data: 'Rango', className: 'text-center' },
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
        {
            data: 'VGP_Acumul',
            className: 'text-center',
            "render": function(data, type, row){
                var VGP_Acumulado = row.VGP_Acumul;
                return formatMoney(VGP_Acumulado);
            }

        },
        {
            data: 'VGP_Acumul_Ptos',
            className: 'text-center',
            "render": function(data, type, row){
                var VGP_Acumul_Ptos = row.VGP_Acumul_Ptos;
                return formatMoney(VGP_Acumul_Ptos);
            }

        },
        
        { data: 'VP_Acumul', className: 'text-center' },
        { data: 'Total_Incorp', className: 'text-center' },
        { data: 'Total_Kinya', className: 'text-center' },
        { data: 'ptosViaje1', className: 'text-center' },
        { data: 'ptosViaje2', className: 'text-center' },
        { data: 'ptosJulioVP', className: 'text-center' },
        { data: 'ptosJulioVP3000', className: 'text-center' },
        /*{
            data: 'Opcion',
            className: 'text-center',
            "render": function(data, type, row){

                return '<span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Opción ' + row.Opcion + '</span>';
            }
        },*/
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});
/*position  Associateid AssociateName   RangoInicio RangoFinal  Pais    VGPAcumulado    VpAcumulado Total_Incorp    Kinya   pts1    pts2
1   38266003    ELIPSIS EN ORDENADORES SAPI DE CV                   DIR DIR MEX 14555.00    14555.00    0   0   0   14555*/

var contador = 0;
var flag = {'PER': 'peru.png', 'MEX': 'mexico.png', 'LAT': 'mexico.png', 'COL': 'colombia.png', 'CHL': 'chile.png', 'ECU': 'ecuador.png', 'PAN': 'panama.png', 'SLV': 'salvador.png', 'GTM': 'guatemala.png', 'CRI': 'costarica.png'};
var mainCode = $("#associateid").val();
$("#rankingTabDirectos").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    
    ajax: "/vpGetRankDirectos",
    columns: [
        { 
            data: 'position', 
            className: 'text-center',
           
        },
        { data: 'AssociateName', className: 'text-center' },
        { data: 'RangoInicio', className: 'text-center' },
        { data: 'RangoFinal', className: 'text-center' },
        { 
            data: 'Pais', 
            className: 'text-center',
            "render": function(data, type, row){
                var paisTexts = row.Pais;
                //alert(row.Pais);
                if(paisTexts == 'LAT'){
                    paisTexts = "MEX";
                }else if(paisTexts == null){
                    paisTexts = "MEX";
                }
                return "<img src='../fpro/img/flags/" +  flag[paisTexts.trim()] + "' width=25px'> <br> " + paisTexts;
            }
        },
        {
            data: 'VGPAcumulado',
            className: 'text-center',
            "render": function(data, type, row){
                var VGP_Acumulado = row.VGPAcumulado;
                return formatMoney(VGP_Acumulado);
            }

        },
        {
            data: 'Vgp_Acumul_Pts',
            className: 'text-center',
            "render": function(data, type, row){
                var Vgp_Acumul_Pts = row.Vgp_Acumul_Pts;
                return formatMoney(Vgp_Acumul_Pts);
            }

        },
        
        { data: 'VpAcumulado', className: 'text-center' },
        { data: 'Total_Incorp', className: 'text-center' },
        { data: 'Kinya', className: 'text-center' },
        { data: 'pts1', className: 'text-center' },
        { data: 'pts2', className: 'text-center' },
        { data: 'ptosJulioVP', className: 'text-center' },
        { data: 'ptosJulioVP3000', className: 'text-center' },
        /*{
            data: 'Opcion',
            className: 'text-center',
            "render": function(data, type, row){

                return '<span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Opción ' + row.Opcion + '</span>';
            }
        },*/
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});

function getDataGenealogy(associateid,type){
    
$("#rankingTabEstatusRedGP").dataTable({
    
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/getStatusRed/"+associateid+"/"+type,
    columns: [
        { 
            data: 'posicion', 
            className: 'text-center',
           
        },
        { 
            data: 'associateid', 
            className: 'text-center',
            
        },
        { data: 'AssociateName', className: 'text-center' },
        { 
            data: 'pais', 
            className: 'text-center',
            "render": function(data, type, row){
                var paisText = row.pais;
                //alert(row.Pais);
                if(paisText == 'LAT'){
                    paisText = "MEX";
                }else if(paisText == null){
                    paisText = "MEX";
                }
                return "<img src='../fpro/img/flags/" +  flag[paisText.trim()] + "' width=25px'> <br> " + paisText;
            }
        },
        { 
            data: 'Email', 
            className: 'text-center',
            
        },
        { 
            data: 'Telefono', 
            className: 'text-center',
            
        },
        
        { data: 'RangoInicio', className: 'text-center' },
        { data: 'RangoFinal', className: 'text-center' },
        
        {
            data: 'VGPacumulado',
            className: 'text-center',
            "render": function(data, type, row){
                var VGP_Acumulado = row.VGPacumulado;
                return formatMoney(VGP_Acumulado);
            }

        },
        
        { data: 'VpAcumulado', className: 'text-center' },
        { data: 'IncorpAcumulado', className: 'text-center' },
        { data: 'KinyaAcumulado', className: 'text-center' },
        /*{
            data: 'Opcion',
            className: 'text-center',
            "render": function(data, type, row){

                return '<span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Opción ' + row.Opcion + '</span>';
            }
        },*/
    ],
    dom: '<"row"<"col s12 m12 l12 xl12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                    text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                },
            ]
        },
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});
}

function getDetailOrders(associateid,period){
$("#detailorderstab").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/getOrdersdetail/"+associateid+"/"+period,
    columns: [
        { 
            data: 'associateid', 
            className: 'text-center',
           
        },
        { data: 'OrderNum', className: 'text-center' },
        { data: 'OrderDate', className: 'text-center' },
        { data: 'ValorImpuestos', className: 'text-center' },
        
        {
            data: 'ValorTotal',
            className: 'text-center',
           

        },
        
        { 
            data: 'Period', 
            className: 'text-center',
            "render": function(data, type, row){
                var Periodo = '<b>' + meses[row.Period] + '</b>';
                return Periodo;
            }
        },
        { data: 'TipDoc', className: 'text-center' },
        { data: 'Puntos', className: 'text-center' },
        { data: 'VC', className: 'text-center' },
        { data: 'Moneda', className: 'text-center' },
        { 
            data: 'PaisAsesor', 
            className: 'text-center',
            "render": function(data, type, row){
                var paisText = row.PaisAsesor;
                //alert(row.Pais);
                if(paisText == 'LAT'){
                    paisText = "MEX";
                }else if(paisText == null){
                    paisText = "MEX";
                }
                return "<img src='../fpro/img/flags/" +  flag[paisText.trim()] + "' width=25px'> <br> " + paisText;
            }
        },
        /*{
            data: 'Opcion',
            className: 'text-center',
            "render": function(data, type, row){

                return '<span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Opción ' + row.Opcion + '</span>';
            }
        },*/
    ],
    dom: '<"row"<"col s12 m12 l12 xl12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                    text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                },
            ]
        },
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});
}
var mainCode = $("#associateid").val();
$("#signuppi").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/getIcorporadosPI/"+mainCode,
    columns: [
        
        { data: 'Associateid', className: 'text-center' },
        { data: 'NameIncorporado', className: 'text-center' },
        { 
            data: 'Fecha_incorporacion', 
            className: 'text-center',
           
        },
        { data: 'Patrocinador', className: 'text-center' },
        
    ],
    dom: '<"row"<"col s12 m12 l12 xl12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                    text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                },
            ]
        },
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});
function stopVideo(){
    $('video')[0].pause();
}


var mainCode = $("#associateid").val();
$("#puntos").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/getPuntosEstrategia/"+mainCode,
   // ajax: "/getPuntosTurquia/"+mainCode,
    columns: [
        /*Associateid
9845903*/
        { data: 'ptosMayoAscPlata', className: 'text-center' },
        { data: 'ptosJunio500', className: 'text-center' },
        { 
            data: 'ptosJulioVP', 
            className: 'text-center',
           
        },
        { data: 'ptosJulioVP1000', className: 'text-center' },
        
    ],
    dom: '<"row"<"col s12 m12 l12 xl12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'btn btn-fill btn-fill-dark btn-rounded mb-4 mr-3 btnExcel', 
                    text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                },
            ]
        },
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});
