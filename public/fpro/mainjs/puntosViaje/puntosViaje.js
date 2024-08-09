function pupUp(){

    
    var cumple = $("#cumpleptomes").val();
    if (cumple == 1) {
    //popupsecondpoint
    Swal.fire({
  //title: 'Sweet!',
  //text: 'Modal with a custom image.',
  imageUrl: 'http://services.test/dtox/images/popupsecondpoint.png',
  imageWidth: 1000,
  imageHeight: 400,
  imageAlt: 'Custom image',
    })
    }else{
        console.log("no cumple");
    }
}

pupUp();

var flag = {'PER': 'peru.png', 'MEX': 'mexico.png', 'LAT': 'mexico.png', 'COL': 'colombia.png', 'CHL': 'chile.png', 'ECU': 'ecuador.png', 'PAN': 'panama.png', 'SLV': 'salvador.png', 'GTM': 'guatemala.png', 'CRI': 'costarica.png'};
var meses = {'202101': 'Enero 2021', '202102': 'Febrero 2021', '202103': 'Marzo 2021', '202104': 'Abril 2021', '202105': 'Mayo 2021', '202106': 'Junio 2021', '202107': 'Julio 2021', '202108': 'Agosto 2021', '202109': 'Septiembre', '202110': 'Octubre 2021', '202111': 'Noviembre 2021', '202112': 'Diciembre 2021'};
var rangos = { 1: 'Directo', 3: 'Ejecutivo', 5: 'Plata', 6: 'ORO', 7: 'Platino', 8: 'Diamante', 9: 'Diamante Real' };
$("#slcTypeGen").val(1);

function loadGen(gen){
    $("#estatusGen").dataTable({
        lengthChange: false,
        ordering: true,
        info: false,
        destroy: true,
        paging: true,
        ajax: '/loadStatusRedPuntosV?associateid=' + encryptData($("#associateid").val()) + '&type=' + encryptData(gen),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { data: 'Nivel', className: 'text-center' },
            { data: 'Rango', className: 'text-center' },
            {
                data: 'Pais', className: 'text-center',
                render: function(data, type, row){
                    var html = '<img src="../fpro/img/flags/' + flag[row.Pais] + '" width="15px"><br>' + row.Pais;
                    return html;
                }
            },  
            {
                data: 'VGP_Enero',
                className: 'text-center',
                render: function(data, type, row){
                    return formatMoney(row.VGP_Enero, 0);
                }
            },
            {
                data: 'VGPEnero_Faltante',
                className: 'text-center',
                render: function(data, type, row){
                    return formatMoney(row.VGPEnero_Faltante, 0);
                }
            },
            {
                data: 'Cumple_Punto1',
                className: 'text-center',
                render: function(data, type, row){
                    var cumple = row.Cumple_Punto1;
                    var html = "";
                    switch (cumple) {
                        case 'YES':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Cumple</span>';
                            break;
                        case 'YES':
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                        default:
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                    }
                    return html;
                }
            },
            {
                data: 'Cumple_PuntoExtra1',
                className: 'text-center',
                render: function(data, type, row){
                    var cumple = row.Cumple_PuntoExtra1;
                    var html = "";
                    switch (cumple) {
                        case 'YEST':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Cumple</span>';
                            break;
                        case 'YESK':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Cumple</span>';
                            break;
                        case 'NO':
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                        default:
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                    }
                    return html;
                }
            },
            { data: 'VP_Febrero', className: 'text-center' },
            { data: 'VPFebrero_Faltante', className: 'text-center' },
            { data: 'Incorporados_Feb', className: 'text-center' },
            { data: 'IncorpoFaltantes_Feb', className: 'text-center' },
            {
                data: 'Cumple_Punto2',
                className: 'text-center',
                render: function(data, type, row){
                    var cumple = row.Cumple_Punto2;
                    var html = "";
                    switch (cumple) {
                        case '1':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Cumple</span>';
                            break;
                        case '0':
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                        default:
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                    }
                    return html;
                }
            },

            { data: 'TotalUnidades_KinyaMarzo', className: 'text-center' },
            { data: 'UnidadesFaltantes_KinyaMarzo', className: 'text-center' },
            {
                data: 'Cumple_Punto3',
                className: 'text-center',
                render: function(data, type, row){
                    var cumple = row.Cumple_Punto3;
                    var html = "";
                    switch (cumple) {
                        case '1':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Cumple</span>';
                            break;
                        case '0':
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                        default:
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                    }
                    return html;
                }
            },

            { data: 'UnidadesAgua_Abril', className: 'text-center' },
            { data: 'UnidadesFaltantesAgua_Abril', className: 'text-center' },
            { data: 'UnidadesAire_Abril', className: 'text-center' },
            { data: 'UnidadesFaltantesAire_Abril', className: 'text-center' },
            {
                data: 'CumplePunto4',
                className: 'text-center',
                render: function(data, type, row){
                    var cumple = row.CumplePunto4;
                    var html = "";
                    switch (cumple) {
                        case '1':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Cumple</span>';
                            break;
                        case '0':
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                        default:
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                    }
                    return html;
                }
            },
            
            { data: 'Total_Punto4', className: 'text-center' },

            { data: 'UnidadesAire_BeneficioAbril', className: 'text-center' },
            {
                data: 'CumpleBeneficio_ExtraAbril',
                className: 'text-center',
                render: function(data, type, row){
                    var cumple = row.CumpleBeneficio_ExtraAbril;
                    var html = "";
                    switch (cumple) {
                        case '2000':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Obtuvo<br>'+cumple+' VGP</span>';
                            break;
                        case '0':
                            html = 0;
                            break;
                        default:
                            html = 0;
                            break;
                    }
                    return html;
                }
            },
            
            

            { data: 'Incorporaciones_MayoVP', className: 'text-center' },
            { data: 'IncorporacionesFaltantes_MayoVP', className: 'text-center' },
            {
                data: 'CumplePunto5',
                className: 'text-center',
                render: function(data, type, row){
                    var cumple = row.CumplePunto5;
                    var html = "";
                    switch (cumple) {
                        case '1':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Cumple</span>';
                            break;
                        case '0':
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                        default:
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                    }
                    return html;
                }
            },

            { data: 'IncorporacionesPI_Junio', className: 'text-center' },
            { data: 'IncorporacionesFaltantes_PIJunio', className: 'text-center' },
            {
                data: 'Cumple_Punto6',
                className: 'text-center',
                render: function(data, type, row){
                    var cumple = row.Cumple_Punto6;
                    var html = "";
                    switch (cumple) {
                        case '1':
                            html = '<span class="badge badge-success" style="border-radius: 25px !important;">Cumple</span>';
                            break;
                        case '0':
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                        default:
                            html = '<span class="badge badge-danger" style="border-radius: 25px !important;">No cumple</span>';
                            break;
                    }
                    return html;
                }
            },
            //{ data: 'Total_Punto5', className: 'text-center' },








            { data: 'Sponsorid', className: 'text-center' },
            { data: 'SponsorName', className: 'text-center' },
            { data: 'Telefono', className: 'text-center' },
            { data: 'Email', className: 'text-center' },
        ],
        order: [[ 2, "asc" ]],
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
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
}
loadGen(1);

function formatMoney(amount, decimalCount, decimal = ".", thousands = ",") {
    try {
        if(amount == '.00'){
            amount = 0;
        }
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


function detailkinya(){
    
$("#detailkinya").dataTable({
        lengthChange: false,
        ordering: true,
        info: false,
        destroy: true,
        paging: true,
        ajax: '/detailkinya?associateid=' + encryptData($("#associateid").val()),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { data: 'Ordernum', className: 'text-center' },
            { data: 'Itemcode', className: 'text-center' },
            { data: 'Descripcion', className: 'text-center' },
            { data: 'Qty', className: 'text-center' },
            {
                data: 'Pais', className: 'text-center',
                render: function(data, type, row){
                    var html = '<img src="../fpro/img/flags/' + flag[row.Pais] + '" width="15px"><br>' + row.Pais;
                    return html;
                }
            }, 
            { data: 'OrderDate', className: 'text-center' },
            { data: 'Period', className: 'text-center' },
            { data: 'TipDoc', className: 'text-center' }
    
        ],
        order: [[ 2, "asc" ]],
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
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
}
detailkinya();

function detailmokuteki(){
    
$("#detailaire").dataTable({
        lengthChange: false,
        ordering: true,
        info: false,
        destroy: true,
        paging: true,
        ajax: '/detailaire?associateid=' + encryptData($("#associateid").val()),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { data: 'Orderdate', className: 'text-center' },
            { data: 'Period_Incorp', className: 'text-center' },
            {
             data: 'Itemcode', className: 'text-center' },
             { data: 'Descripcion', className: 'text-center' },
             {
             data: 'Transformado', className: 'text-center' },
             { data: 'Pais', className: 'text-center' },
            

            
    
        ],
        order: [[ 2, "asc" ]],
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
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
}
detailmokuteki();


/*
function detailincorporate(){
$("#detalleincorporaciones").dataTable({
        lengthChange: false,
        ordering: true,
        info: false,
        destroy: true,
        paging: true,
        ajax: '/detailincorporate?associateid=' + encryptData($("#associateid").val()),
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
            { data: 'Associateid', className: 'text-center' },
            { data: 'AssociateName', className: 'text-center' },
            { data: 'Orderdate', className: 'text-center' },
            { data: 'Itemcode', className: 'text-center' },
            { data: 'Descripcion', className: 'text-center' },
            { data: 'Transformado', className: 'text-center' },
            { data: 'Periodo', className: 'text-center' },
    
        ],
        order: [[ 2, "asc" ]],
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
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
}
detailincorporate();*/