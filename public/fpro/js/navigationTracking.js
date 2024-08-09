function navigationTracking(associateid, plataforma, accion){
    (associateid == '') ? associateid = encryptData(123456): associateid = encryptData(associateid);
    (plataforma == '') ? plataforma = encryptData('Indefinido'): plataforma = encryptData(plataforma);
    (accion == '') ? accion = encryptData('Indefinido'): accion = encryptData(accion);
    var data = {
        associateid: associateid,
        plataforma: plataforma,
        accion: accion,
    };
    $.ajax({
        type: "get",
        url: "/navigationTracking",
        data: data,
        success: function(response){
            console.log('acción guardada');
        }
    });
}

function encryptData(data){
    var encoded = "";
    str = btoa(data);
    str = btoa(str);
    for (i=0; i<str.length;i++) {
        var a = str.charCodeAt(i);
        var b = a ^ 10;
        encoded = encoded+String.fromCharCode(b);
    }
    encoded = btoa(encoded);
    return encoded;
}

function getNuwToken(target){
    $.ajax({
        type: "GET",
        url: "/getNuwToken",
        success: function (response) {
            $("#" + target).val(response);
        }
    });
}

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

var flags = { PER: 'peru.png', LAT: 'mexico.png', MEX: 'mexico.png', COL: 'colombia.png', CHL: 'chile.png', ECU: 'ecuador.png', PAN: 'panama.png', SLV: 'salvador.png', GTM: 'guatemala.png', CRI: 'costarica.png'};