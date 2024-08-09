AOS.init();
var footer = '<span class="flaticon-danger-line" style="font-size: 20px;"></span> Recuerda que puedes obtener mas semanas de descuento.';
var estatus = $("#status").val();
var txtDesde = $("#dateIni").val();
var txtHasta = $("#dateFin").val();
var meses = {'00': '00', '08': 'Agosto', '09': 'Septiembre'};

if(txtDesde == '0' || txtHasta == '0'){
    txtDesde = '0000-00-00';
    txtHasta = '0000-00-00';
}
txtDesde = txtDesde.split('-');
txtHasta = txtHasta.split('-');
associateType = $("#associateType").val();

if(estatus == 1){
    footer = '';
    alertaAvance('Has ganado el descuento en repuestos a apartir del ' + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' y hasta el dia ' + txtHasta[2] + ' de ' + meses[txtHasta[1]] + ' (Nuevo Influencer)');
}
if(estatus == 2){
    footer = '';
    alertaAvance('Has ganado el descuento en repuestos a apartir del ' + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' y hasta el dia ' + txtHasta[2] + ' de ' + meses[txtHasta[1]] + ' (Nuevo Influencer)');
}
if(estatus == 9){
    footer = '';
    alertaAvance('Has ganado el descuento en repuestos a apartir del ' + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' y hasta el dia ' + txtHasta[2] + ' de ' + meses[txtHasta[1]] + ' (Nuevo Influencer)');
}
if(estatus == 11){
    footer = '';
    alertaAvance('Has ganado el descuento en repuestos a apartir del ' + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' y hasta el dia ' + txtHasta[2] + ' de ' + meses[txtHasta[1]] + ' (Rifa)');
}
if(estatus == 10){
    footer = '';
    alertaAvance('Has ganado el descuento en repuestos a apartir del ' + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' y hasta el dia ' + txtHasta[2] + ' de ' + meses[txtHasta[1]] + ' (Rifa)');
}
if(estatus == 8 && associateType == 100){
    footer = '';
    alertaAvance('Has ganado el descuento en repuestos a apartir del ' + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' y hasta el dia ' + txtHasta[2] + ' de ' + meses[txtHasta[1]]);
}
if(estatus == 8 && associateType == 100 && txtHasta[2] == '2020-09-30'){
    footer = '';
    alertaAvance('Has ganado el descuento en repuestos a apartir del ' + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' y hasta el dia ' + txtHasta[2] + ' de ' + meses[txtHasta[1]] + ' (Nuevo Influencer)');
}
if(estatus == 8 && associateType != 100 && txtHasta[2] == '2020-09-30'){
    footer = '';
    alertaAvance('Has ganado el descuento en repuestos a apartir del ' + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' y hasta el dia ' + txtHasta[2] + ' de ' + meses[txtHasta[1]]);
}
if(estatus == 7){
    footer = '';
    alertaAvance("Has ganado 7 semanas de descuento en repuestos, desde el " + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' al ' + txtHasta[2] + ' de ' + meses[txtHasta[1]]);
}
if(estatus == 6 || estatus == 5 || estatus == 4 || estatus == 3){
    alertaAvance("Has ganado " + estatus + " semanas de descuento en repuestos, desde el " + txtDesde[2] + ' de ' + meses[txtDesde[1]] + ' al ' + txtHasta[2] + ' de ' + meses[txtHasta[1]]);
}

function alertaAvance(mensaje){
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
        text: mensaje,
        imageUrl: '../fpro/img/convMayo/winner.png',
        imageWidth: 400,
        imageHeight: 220,
        imageAlt: 'Ganador',
        animation: false,
        padding: '2em',
        footer: footer,
    })
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

var flag = {'PER': 'peru.png', 'MEX': 'mexico.png', 'LAT': 'mexico.png', 'COL': 'colombia.png', 'CHL': 'chile.png', 'ECU': 'ecuador.png', 'PAN': 'panama.png', 'SLV': 'salvador.png', 'GTM': 'guatemala.png', 'CRI': 'costarica.png'};
$("#genealogy").dataTable({
    info: false,
    destroy: true,
    ajax: '/ptsConnectGenealogy?associateid=' + $("#associateid").val(),
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
        { data: 'Associateid', className: 'text-center' },
        { data: 'AssociateName', className: 'text-center' },
        {
            data: 'AssociateType',
            className: 'text-center',
            "render": function(data, type, row){
                var AssociateType = row.AssociateType;
                if(AssociateType == 100){
                    return "Asesor B.";
                }
                else{
                    return "Club B.";
                }
            }
        },
        { data: 'nivel', className: 'text-center' },
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
        { 
            data: 'VP',
            className: 'text-center',
            "render": function(data, type, row){
                var vp = row.VP;
                vp = formatMoney(row.VP);
                return vp;
            }
        },
        { data: 'Incorp_Influencers', className: 'text-center' },
        { data: 'Kinya', className: 'text-center' },
        {
            data: 'Estatus',
            className: 'text-center',
            "render": function(data, type, row){
                var Estatus = row.Estatus;
                var semanas = "";
                if(Estatus == 1 && row.AssociateType == 100 || Estatus == 9 && row.AssociateType == 100 ){
                    semanas = "7 Semanas (Nuevo Influencer)";
                }
                else if(Estatus == 1 && row.AssociateType != 100 || Estatus == 9 && row.AssociateType != 100 ){
                    semanas = "7 Semanas";
                }
                else if(Estatus == 7){
                    semanas = "7 Semanas";
                }
                else if(Estatus == 2 && row.AssociateType != 100){
                    semanas = "7 Semanas";
                }
                else if(Estatus == 2 && row.AssociateType == 100){
                    semanas = "7 Semanas (Nuevo Influencer)";
                }
                else if(Estatus == 8 && row.AssociateType != 100){
                    semanas = "7 Semanas";
                }
                else if(Estatus == 8 && row.AssociateType == 100){
                    semanas = "7 Semanas (Nuevo Influencer)";
                }
                else if(Estatus == 10){
                    semanas = "7 Semanas (Rifa)";
                }
                else if(Estatus == 11){
                    semanas = "7 Semanas (Rifa)";
                }
                else{
                    semanas = Estatus + " Semanas";
                }
                return semanas;
            }
        },
        { data: 'Email', className: 'text-center' },
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }
});