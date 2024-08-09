$("#kintai, #kinya, #sponsorsr, #consolidado, #kinya2").val(0);
function getRreport(periodo, id, link, periodo2, country){
    if(link == 'periodolinkavances'){
        $("#" + link).attr('href', '/getReportReconocimientos?periodo=' + periodo + '&periodo2=' + periodo2 + '&country=' + country + '&reporte=' + id);
    }
    else if(link == 'periodolinkconsolidado'){
        $("#" + link).attr('href', '/getReportReconocimientos?periodo=' + periodo + '&periodo2=' + periodo2 + '&country=' + country + '&reporte=' + id);
    }
    else if(link == 'avancesPerlink'){
        $("#" + link).attr('href', '/getReportReconocimientos?periodo=' + periodo + '&periodo2=' + periodo2 + '&country=' + country + '&reporte=' + id);
    }
    else if(link == 'posibleAvancelink'){
        $("#" + link).attr('href', '/getReportReconocimientos?periodo=' + periodo + '&periodo2=' + periodo2 + '&country=' + country + '&reporte=' + id);
    }
    else if(link == 'periodolinkkinya' || link == 'detalleTransformLink' || link == 'periodolinksponsorsr'){
        $("#" + link).attr('href', '/getReportReconocimientos?periodo=' + periodo + '&periodo2=' + periodo2 + '&reporte=' + id);
    }
    else{
        $("#" + link).attr('href', '/getReportReconocimientos?periodo=' + periodo + '&reporte=' + id);
    }
}

function getRreportTest(periodo, id, link, periodo2, country){
    if(link == 'periodolinkavances'){
        $("#" + link).attr('href', '/getReportReconocimientosTest?periodo=' + periodo + '&periodo2=' + periodo2 + '&country=' + country + '&reporte=' + id);
    }
    else if(link == 'periodolinkconsolidado'){
        $("#" + link).attr('href', '/getReportReconocimientosTest?periodo=' + periodo + '&periodo2=' + periodo2 + '&country=' + country + '&reporte=' + id);
    }
    else if(link == 'avancesPerlink'){
        $("#" + link).attr('href', '/getReportReconocimientosTest?periodo=' + periodo + '&periodo2=' + periodo2 + '&country=' + country + '&reporte=' + id);
    }
    else if(link == 'posibleAvancelink'){
        $("#" + link).attr('href', '/getReportReconocimientosTest?periodo=' + periodo + '&periodo2=' + periodo2 + '&country=' + country + '&reporte=' + id);
    }
    else if(link == 'periodolinkkinya' || link == 'detalleTransformLink' || link == 'periodolinksponsorsr' || link == 'influencerPlusLink'){
        $("#" + link).attr('href', '/getReportReconocimientosTest?periodo=' + periodo + '&periodo2=' + periodo2 + '&reporte=' + id);
    }
    else{
        $("#" + link).attr('href', '/getReportReconocimientosTest?periodo=' + periodo + '&reporte=' + id);
    }
}

function getReportSeguimiento(element){
    var trimestre = $("#trimestre").val();
    var anio = $("#anio").val();
    var country = $("#country").val();
    var type = $("#type").val();
    var parametros = trimestre + ":" + anio + ":" + country + ":" + type;

    $("#" + element).attr('href', '/getReportReconocimientos?reporte=getReportSeguimiento&parametros=' + parametros);
}
getReportSeguimiento('getReportSeguimiento');

function getReportSeguimientokaizen(element){
    var anio = $("#aniokaizen").val();
    var country = $("#countrykaizen").val();
    var parametros = anio + ":" + country;

    $("#" + element).attr('href', '/getReportReconocimientos?reporte=getReportSeguimientokaizen&parametros=' + parametros);
}
getReportSeguimientokaizen('getReportSeguimientokaizen');

function getreporteganadorestaishi(elemnt){
    var anio = $("#aniotaishi").val();
    var country = $("#countrytaishi").val();
    var parametros = anio + ":" + country;

    $("#" + elemnt).attr('href', '/getReportReconocimientos?reporte=getreporteganadorestaishi&parametros=' + parametros);
}
getreporteganadorestaishi('getreporteganadorestaishi');

function getSeguimientokaizen(element){
    var anio = $("#aniokaizen").val();
    var country = $("#countrykaizen").val();
    var parametros = anio + ":" + country;

    $("#" + element).attr('href', '/getReportReconocimientos?reporte=getSeguimientokaizen&parametros=' + parametros);
}
getSeguimientokaizen('getSeguimientokaizen');

function getSeguimientoserpro(element){
    var anio = $("#anioserpro").val();
    var country = $("#countryserpro").val();
    var parametros = anio + ":" + country;

    $("#" + element).attr('href', '/getReportReconocimientos?reporte=getSeguimientoserpro&parametros=' + parametros);
}
getSeguimientoserpro('getSeguimientoserpro');

function getGanadoresserpro(element){
    var anio = $("#anioserpro").val();
    var country = $("#countryserpro").val();
    var parametros = anio + ":" + country;

    $("#" + element).attr('href', '/getReportReconocimientos?reporte=getGanadoresserpro&parametros=' + parametros);
}
getGanadoresserpro('getGanadoresserpro');

function getGanadoresViajerosPremium(element){
    var anio = $("#anioviajprem").val();
    var country = $("#countryviajprem").val();
    var parametros = anio + ":" + country;

    $("#" + element).attr('href', '/getReportReconocimientos?reporte=getGanadoresViajerosPremium&parametros=' + parametros);
}

function getSeguimientoViajerosPremium(element){
    var anio = $("#anioviajprem").val();
    var country = $("#countryviajprem").val();
    var parametros = anio + ":" + country;

    $("#" + element).attr('href', '/getReportReconocimientos?reporte=getSeguimientoViajerosPremium&parametros=' + parametros);
}
getGanadoresViajerosPremium('getGanadoresViajerosPremium');

function getSeguimientoTaishi(elemnt){
    var anio = $("#aniotaishi").val();
    var country = $("#countrytaishi").val();
    var parametros = anio + ":" + country;

    $("#" + elemnt).attr('href', '/getReportReconocimientos?reporte=getSeguimientoTaishi&parametros=' + parametros);
}
getSeguimientoTaishi('getSeguimientoTaishi');

function getReportSeguimiento4t(){
    var anio = $("#anio4t").val();
    var country = $("#country4t").val();
    $("#getReportSeguimiento4t").attr('href', '/getReportReconocimientos?periodo=' + anio + '&country=' + country + '&reporte=getReportSeguimiento4t');
}
getReportSeguimiento4t();

function getWinTrimViaje(){
    var anio = $("#winViajeroAnio").val();
    var country = $("#winViajeroCountry").val();
    var trimestre = $("#winViajeroTrimestre").val();
    $("#winViajeroLink").attr('href', '/getReportReconocimientos?periodo=' + anio + '&country=' + country + '&trimestre=' + trimestre + '&reporte=getWinTrimViaje');
}
getWinTrimViaje();

function getWinViajero(){
    var anio = $("#anio4t").val();
    var country = $("#country4t").val();
    $("#getWinViajero").attr('href', '/getReportReconocimientos?periodo=' + anio + '&country=' + country + '&reporte=getWinViajero');
}
getWinViajero();

function seguimeintoVpro(link){
    var anio = $("#anioSegVpro").val();
    var country = $("#countrySegVpro").val();
    $("#seguimeintoVproLink").attr('href', '/getReportReconocimientos?periodo=' + anio + '&country=' + country + '&reporte=seguimeintoVpro');
}
seguimeintoVpro('seguimeintoVproLink');

function getReportSegEmprendedor(){
    var semestre = $("#semestreEmprendedor").val();
    var pais = $("#countryEmprendedor").val();
    $("#getReportSegEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportSegEmprendedor&parametros=' + semestre + '|' + pais);
}
getReportSegEmprendedor();

function getReportWinEmprendedor(){
    var semestre = $("#semestreEmprendedor").val();
    var pais = $("#countryEmprendedor").val();
    $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportWinEmprendedor&parametros=' + semestre + '|' + pais);
}
getReportWinEmprendedor();