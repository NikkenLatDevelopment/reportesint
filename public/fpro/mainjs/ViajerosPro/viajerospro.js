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

var kinyaPer = 0;
var kinya1lvl = 0;
var rangos = {0: '', 1: 'DIR', 3: 'EXE', 5: 'PLA', 6: 'ORO', 7: 'PLO', 8: 'DIA', 9: 'DRL'}
$("#mainPts").dataTable({
    lengthChange: false,
    ordering: false,
    info: false,
    destroy: true,
    paging: false,
    ajax: '/vpGetMonts?associateid=' + $("#associateid").val(),
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
        { data: 'AssociateName', className: 'text-center' },
        { 
            data: 'Periodo', 
            className: 'text-center',
            "render": function(data, type, row){
                var Periodo = '<b>' + meses[row.Periodo] + '</b>';
                return Periodo;
            }
        },
        { 
            data: 'VP',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.VP;
                if(vp >= 100){
                    vp = formatMoney(row.VP) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.VP) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },
        { 
            data: 'VGPLatam',
            className: 'text-center',
            "render": function(data, type, row){
                var VGPLatam = row.VGPLatam;
                if(VGPLatam >= 1000){
                    VGPLatam = formatMoney(row.VGPLatam) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    VGPLatam = formatMoney(row.VGPLatam) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return VGPLatam;
            }
        },
        { 
            data: 'VGPLatamAcumu',
            className: 'text-center',
            "render": function(data, type, row){
                var VGPLatamAcumu = row.VGPLatamAcumu;
                VGPLatamAcumu = formatMoney(VGPLatamAcumu);
                return VGPLatamAcumu;
            }
        },
        {
            data: 'RangoN',
            className: 'text-center',
            "render": function(data, type, row){
                var rango = row.RangoN;
                rango = rangos[rango];
                return rango;
            }
        },
        {
            data: 'Rango_Pago',
            className: 'text-center',
            "render": function(data, type, row){
                var Rango_Pago = row.Rango_Pago;
                Rango_Pago = rangos[Rango_Pago];
                return Rango_Pago;
            }
        },
        { data: 'kinya', className: 'text-center' },
        { data: 'KinYaL1', className: 'text-center' },
        {
            data: 'Cumple_MesV',
            className: 'text-center',
            "render": function(data, type, row){
                var Cumple_MesV = row.Cumple_MesV.trim();
                if(row.Cumple_MesV == 'YES'){
                    Cumple_MesV = '<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    Cumple_MesV = '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return Cumple_MesV;
            }
        },
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }
});

var contador = 0;
var flag = {'PER': 'peru.png', 'MEX': 'mexico.png', 'LAT': 'mexico.png', 'COL': 'colombia.png', 'CHL': 'chile.png', 'ECU': 'ecuador.png', 'PAN': 'panama.png', 'SLV': 'salvador.png', 'GTM': 'guatemala.png', 'CRI': 'costarica.png'};
var mainCode = $("#associateid").val();
$("#rankingTab").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/vpGetRank",
    order: [ 4, 'DESC' ],
    columns: [
        { 
            data: 'Associateid', 
            className: 'text-center',
            "render": function(data, type, row){
                contador = parseInt(contador) + parseInt(1);
                var length = $("#rankLenght").val();
                if(row.Associateid == mainCode && contador <= length){
                    $("#noRanking").val('# Ranking: ' + contador);
                    $("#noRankinglbl").text('# Ranking: ' + contador);
                }
                if(row.Associateid == mainCode){
                    $("#opcionParttxt").val('Participa por: Opción ' + row.Opcion);
                    $("#opcionPartLabel").text('Participa por: Opción ' + row.Opcion);
                }
                if(row.Associateid == mainCode){
                    var indent = "<span id='mainposition'></span>"
                    $("#mainposition").parent().parent().addClass('mainPosition');
                    return '# ' + contador + indent;
                }
                else{
                    return '# ' + contador;
                }
            }
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
            data: 'VGP_Acumulado',
            className: 'text-center',
            "render": function(data, type, row){
                var VGP_Acumulado = row.VGP_Acumulado;
                return formatMoney(VGP_Acumulado);
            }

        },
        { data: 'NumRangoPagoCumplido', className: 'text-center' },
        { data: 'KinyaAcumulado', className: 'text-center' },
        { data: 'KinyaFrontalAcumulado', className: 'text-center' },
        {
            data: 'Opcion',
            className: 'text-center',
            "render": function(data, type, row){

                return '<span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Opción ' + row.Opcion + '</span>';
            }
        },
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});

function stopVideo(){
    $('video')[0].pause();
}