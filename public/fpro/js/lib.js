function alert(title, html, type){
    Swal.fire({
        title: title,
        html: html,
        type: type,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
    });
    $('.swal2-popup').css('border-radius', '25px');
}

$(".loader_div").hide();

function formatMoney(amount, decimalCount = 0, decimal = ".", thousands = ",") {
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
}

function confirmCookies(site){
    var sap_code = $("#sap_code").val();
    $.ajax({
        type: "get",
        url: "/confirmCookies", 
        data: {
            sap_code: sap_code,
            site: site,
        },
        success: function (response) {
            var exist_reg = response[0]['regist'];
            if(parseInt(exist_reg) < 1){
                Swal.fire({ 
                    title: '',
                    html: '<p style="text-align: justify">Utilizamos cookies propias durante la navegación por el sitio web, con la finalidad de permitir el acceso a las funcionalidades de la página web, extraer estadísticas de tráfico y mejorar la experiencia del usuario. Para más información, puede consultar nuestros: <h4>Términos y Condiciones</h4></p><embed src="https://nikkenlatam.com/Aviso_de_Privacidad.pdf" type="application/pdf" width="80%" height="400px">',
                    footer: '',
                    type: '',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: 'Aceptar y continuar navegando'
                }).then((result) => {
                    if (result.value == true) {

                        $.getJSON('https://api.db-ip.com/v2/free/self', function(data) {
                            ip = data['ipAddress'];
                            $.ajax({
                                type: "get",
                                url: "/saveConfirmCookies",
                                data: {
                                    ip: ip,
                                    sap_code: sap_code,
                                    site: site,
                                },
                            });
                        });
                    }
                });
                $('.swal2-popup').css({
                    'align-items': 'flex-end',
                    'bottom': '25px',
                    'position': 'absolute',
                    'padding': '0',
                    'margin': '0',
                    'min-width': '80%',
                    'padding': '15px',
                    'border-radius': '25px'
                });
                
                $(".swal2-content").css({
                    'margin-left': '50px',
                    'margin-right': '50px',
                });
            }
        }
    });
}

if ($(".dropify").length > 0) {
    $('.dropify').dropify({
        messages: {
            'default': 'Arrastra y suelta tu archivo',
            'replace': 'Arrastra y suelta para remplazar tu archivo',
            'remove':  'Remover',
            'error':   'Ooops, aglo ha ido mal.'
        }
    });
}

function base64_decode(string){
    string = atob(string);
    return string;
}

function base64_encode(string){
    string = btoa(string);
    return string;
}

function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 13) {
        var funcion = event;
        return console.log(funcion);
    } 
    else if (key < 48 || key > 57) {
        return false;
    }
    else {
        return true;
    }
}

function disabled(control){
    control.attr('disabled', true);
}

function enabled(control){
    control.attr('disabled', false);
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

function showLoadDiv(){
    $("#loader_div_ajax").show();
}

function hideLoadDiv(){
    jQuery("#loader_div_ajax").hide();
}

function ValidaEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function isNum(val){
    var regex = /^[0-9]*$/;
    var onlyNumbers = regex.test(val);
    return onlyNumbers;
}

function returnMonth(dato){
    var mes = dato[4] + dato[5];
    var mesenteros = {
        "01": "Enero",
        "02": "Febrero",
        "03": "Marzo",
        "04": "Abril",
        "05": "Mayo",
        "06": "Junio",
        "07": "Julio",
        "08": "Agosto",
        "09": "Septiembre",
        "10": "Octubre",
        "11": "Noviembre",
        "12": "Diciembre",
    }
    mes = mesenteros[mes];
    var anio = dato[0] + dato[1] + dato[2] + dato[3];
    return mes + ' ' + anio;
}