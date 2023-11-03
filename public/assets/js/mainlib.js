function alert(title, html, footer, type){
    Swal.fire({
        title: title,
        html: html,
        footer: footer,
        type: type
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

function alert(tittle, html, type){
    swal({
        title: tittle,
        html: html,
        type: type,
        padding: '2em'
    });
    $(".swal2-popup").css('border-radius', '50px');
}

function disabled(control){
    control.attr('disabled', true);
}

function enabled(control){
    control.attr('disabled', false);
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

function validateDomElement(element, callback){
    if (element.length > 0) {
        callback();
    }
}