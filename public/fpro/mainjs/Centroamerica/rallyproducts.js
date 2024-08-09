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
var meses = {'202101': 'Enero 2021', '202102': 'Febrero 2021', '202103': 'Marzo 2021', '202104': 'Abril 2021', '202105': 'Mayo 2021', '202106': 'Junio 2021', '202107': 'Julio 2021', '202108': 'Agosto 2021', '202109': 'Septiembre', '202110': 'Octubre 2021', '202111': 'Noviembre 2021', '202112': 'Diciembre 2021'};
var flag = {'PER': 'peru.png', 'MEX': 'mexico.png', 'LAT': 'mexico.png', 'COL': 'colombia.png', 'CHL': 'chile.png', 'ECU': 'ecuador.png', 'PAN': 'panama.png', 'SLV': 'salvador.png', 'GTM': 'guatemala.png', 'CRI': 'costarica.png'};
var mainCode = $("#associateid").val();
$("#rankingTabCHL").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/vpGetRankCHL",
    columns: [
        { 
            data: 'Ranking', 
            className: 'text-center'
           
        },

        { data: 'AssociateName', className: 'text-center' },
        { data: 'Associateid', className: 'text-center' },
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

        { data: 'Rango', className: 'text-center' },
        { data: 'Period', className: 'text-center' },

         { 
            data: 'VP_Junio',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.Cumple_VPJunio;
                if(vp == 'YES'){
                    vp = formatMoney(row.VP_Junio) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.VP_Junio) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },
        
        { 
            data: 'Total_MKReactivados',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.Cumple_MKReactivados;
                if(vp == 'YES'){
                    vp = formatMoney(row.Total_MKReactivados) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.Total_MKReactivados) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },

     
        
        {
            data: 'VGP_Acumulado',
            className: 'text-center',
            "render": function(data, type, row){
                var VGP = row.VGP_Acumulado;
                return formatMoney(VGP);
            }

        },
        
        
        
        
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});

$("#rankingTabCHLLIDERES").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/vpGetRankCHLLIDERES",
    columns: [
        { 
            data: 'Ranking', 
            className: 'text-center'
           
        },

        { data: 'AssociateName', className: 'text-center' },
        { data: 'Associateid', className: 'text-center' },
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

        { data: 'Rango', className: 'text-center' },
        { data: 'Period', className: 'text-center' },

         { 
            data: 'VP_Junio',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.Cumple_VPJunio;
                if(vp == 'YES'){
                    vp = formatMoney(row.VP_Junio) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.VP_Junio) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },
        
        { 
            data: 'Total_MKReactivados',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.Cumple_MKReactivados;
                if(vp == 'YES'){
                    vp = formatMoney(row.Total_MKReactivados) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.Total_MKReactivados) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },

     
        
        {
            data: 'VGP_Acumulado',
            className: 'text-center',
            "render": function(data, type, row){
                var VGP = row.VGP_Acumulado;
                return formatMoney(VGP);
            }

        },
        
        
        
        
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});
/*
$("#rankingTabCRILID").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/vpGetRankCRILID",
    columns: [
        { 
            data: 'Ranking', 
            className: 'text-center'
           
        },

        { data: 'AssociateName', className: 'text-center' },
        { data: 'Associateid', className: 'text-center' },
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
            data: 'VP_Febrero',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.Cumple_VPFebrero;
                if(vp == 'YES'){
                    vp = formatMoney(row.VP_Febrero) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.VP_Febrero) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },
        { 
            data: 'VP_Marzo',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.Cumple_VPMarzo;
                if(vp == 'YES'){
                    vp = formatMoney(row.VP_Marzo) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.VP_Marzo) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },
        { 
            data: 'Total_MKReactivados',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.Cumple_MKReactivados;
                if(vp == 'YES'){
                    vp = formatMoney(row.Total_MKReactivados) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.Total_MKReactivados) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },

     
        
        {
            data: 'VP_Marzo',
            className: 'text-center',
            "render": function(data, type, row){
                var VGP = row.VGP_Acumulado;
                return formatMoney(VGP);
            }

        },
        
        
        
        
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});
*/
$("#MokutekiTab").dataTable({
    lengthChange: false,
    ordering: true,
    info: false,
    destroy: true,
    ajax: "/MokutekiInactivo?associateid="+mainCode,
    columns: [
        { 
            data: 'Associateid', 
            className: 'text-center'
           
        },

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
        { 
            data: 'VP_Junio',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.Cumple_VP;
                if(vp == 'YES'){
                    vp = formatMoney(row.VP_Junio) +'<br><span class="badge badge-success badge-pill"><i class="flaticon-single-circle-tick"></i> Cumple</span>';
                }
                else{
                    vp = formatMoney(row.VP_Junio) + '<br><span class="badge badge-danger badge-pill"><i class="flaticon-close"></i> No cumple</span>';
                }
                return vp;
            }
        },
        

         
        
        { data: 'Email', className: 'text-center' },
        { data: 'Telefono', className: 'text-center' },
        

        
        
        
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    }
});
