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

    switch(anio){
        case "2023":
            $("#" + element).attr('href', '/getReportReconocimientos2023?reporte=getSeguimientoserpro&parametros=' + parametros);
        break;
        default:
            $("#" + element).attr('href', '/getReportReconocimientos?reporte=getSeguimientoserpro&parametros=' + parametros);
        break;
     }
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

    var anio     = $("#aniio").val();
    var semestre = $("#semestreEmprendedor").val();
    var pais     = $("#countryEmprendedor").val();

    if(anio == '2023'){              
        switch(semestre){
            case "1":
                $("#semestreEmprendedor").html('<option value="1" selected="">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendedores?reporte=getReportSegEmprendedor&parametros=' + 1 + '|' + pais + '|' + anio);
            break;
            case "2":
                $("#semestreEmprendedor").html('<option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendedos?reporte=getReportSegEmprendedor&parametros=' + 2 + '|' + pais + '|' + anio);
            break;
            case "3":
                $("#semestreEmprendedor").html('<option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendtres?reporte=getReportSegEmprendedor&parametros=' + 3 + '|' + pais + '|' + anio);
            break; 
            case "4":
                $("#semestreEmprendedor").html('<option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendcuatro?reporte=getReportSegEmprendedor&parametros=' + 4 + '|' + pais + '|' + anio);
            break;   
            case "5":
                $("#semestreEmprendedor").html('<option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendcinco?reporte=getReportSegEmprendedor&parametros=' + 5 + '|' + pais + '|' + anio);
            break;
            case "6":
                $("#semestreEmprendedor").html('<option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendseis?reporte=getReportSegEmprendedor&parametros=' + 6 + '|' + pais + '|' + anio);
            break; 
            case "7":
                $("#semestreEmprendedor").html('<option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendsiete?reporte=getReportSegEmprendedor&parametros=' + 7 + '|' + pais + '|' + anio);
            break; 
            case "8":
                $("#semestreEmprendedor").html('<option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendtres?reporte=getReportSegEmprendedor&parametros=' + 8 + '|' + pais + '|' + anio);
            break; 
            case "9":
                $("#semestreEmprendedor").html('<option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendtres?reporte=getReportSegEmprendedor&parametros=' + 9 + '|' + pais + '|' + anio);
            break;
            case "10":
                $("#semestreEmprendedor").html('<option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option>');  
                $("#getReportSegEmprendedor").attr('href', '/getReportRecemprendtres?reporte=getReportSegEmprendedor&parametros=' + 10 + '|' + pais + '|' + anio);
            break;                                                  
         }
           

         } else {
         
         if(semestre<4){    
         switch(semestre){
            case "1":
                $("#semestreEmprendedor").html('<option value="1" selected="">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option><option value="3">Semestre 3</option>');  
            break;
            case "2":
                $("#semestreEmprendedor").html('<option value="2" selected="">Semestre 2</option><option value="3">Semestre 3</option><option value="1">semestre</option><option value="1">Semestre 1</option>');  
            break;
            case "3":
                $("#semestreEmprendedor").html('<option value="3" selected="">Semestre 3</option><option value="1">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option>');
            break;                    
         } 
        } else {
            $("#semestreEmprendedor").html('<option value="1" selected="">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option><option value="3">Semestre 3</option>');
        }

           $("#getReportSegEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportSegEmprendedor&parametros=' + semestre + '|' + pais);
    }
  
}
getReportSegEmprendedor();

function getReportWinEmprendedor(){
    var semestre = $("#semestreEmprendedor").val();
    var pais = $("#countryEmprendedor").val();
    var anio = $("#anio").val();

    if(anio == '2023'){ 

        switch(semestre){

            case "1":
                $("#semestreEmprendedor").html('<option value="1" selected="">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 1 + '|' + pais + '|' + anio);
            break;
            case "2":
                $("#semestreEmprendedor").html('<option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 2 + '|' + pais + '|' + anio);
            break;
            case "3":
                $("#semestreEmprendedor").html('<option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 3 + '|' + pais + '|' + anio);
            break; 
            case "4":
                $("#semestreEmprendedor").html('<option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 4 + '|' + pais + '|' + anio);
            break;   
            case "5":
                $("#semestreEmprendedor").html('<option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 5 + '|' + pais + '|' + anio);
            break;
            case "6":
                $("#semestreEmprendedor").html('<option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 6 + '|' + pais + '|' + anio);
            break; 
            case "7":
                $("#semestreEmprendedor").html('<option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 7 + '|' + pais + '|' + anio);
            break; 
            case "8":
                $("#semestreEmprendedor").html('<option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 8 + '|' + pais + '|' + anio);
            break; 
            case "9":
                $("#semestreEmprendedor").html('<option value="9">Septiembre-Noviembre</option><option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 9 + '|' + pais + '|' + anio);
            break;
            case "10":
                $("#semestreEmprendedor").html('<option value="10">Octubre- Diciembre</option><option value="1">Enero-Marzo</option><option value="2">Febrero-Abril</option><option value="3">Marzo-Mayo</option><option value="4">Abril-Junio</option><option value="5">Mayo-Julio</option><option value="6">Junio-Agosto</option><option value="7">Julio-Septiembre</option><option value="8">Agosto-Octubre</option><option value="9">Septiembre-Noviembre</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportSegEmprendedor&parametros=' + 10 + '|' + pais + '|' + anio);
            break;
               
          }
            

         } else {
         
         if(semestre<4){    
         switch(semestre){
            case "1":
                $("#semestreEmprendedor").html('<option value="1" selected="">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option><option value="3">Semestre 3</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportWinEmprendedor&parametros=' + 1 + '|' + pais);
            break;
            case "2":
                $("#semestreEmprendedor").html('<option value="2" selected="">Semestre 2</option><option value="3">Semestre 3</option><option value="1">semestre</option><option value="1">Semestre 1</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportWinEmprendedor&parametros=' + 2 + '|' + pais);
            break;
            case "3":
                $("#semestreEmprendedor").html('<option value="3" selected="">Semestre 3</option><option value="1">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option>');
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportWinEmprendedor&parametros=' + 3 + '|' + pais);
            break;                    
           } 
          } else {
            $("#semestreEmprendedor").html('<option value="1" selected="">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option><option value="3">Semestre 3</option>');
        }

           
    }
}
getReportWinEmprendedor();

/* ###########-+-############## */

function semReportWinEmprendedor(){
    var semestre = $("#trimEmprendedor").val();
    var pais = $("#countryEmprendedor").val();
    var anio = $("#antrim").val();

    $("#getrimReportWinEmprendedor").attr('href', '/getReptrimReconocimietosgcve?reporte=getReportWincbEmprendedores&parametros=' + semestre + '|' + pais + '|' +  anio);


    /*
    if(anio == '2023'){ 

            switch(semestre){
        case "1":
            $("#semestreEmprendedor").html('<option value="1" selected="">Enero - Junio</option><option value="2">Febrero - Julio</option><option value="3">Marzo - Agosto</option><option value="4">Abril - Septiembre</option><option value="5">Mayo - Octubre</option><option value="6">Junio - Noviembre</option><option value="7">Julio - Diciembre</option>');  
            $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportWincbEmprendedores&parametros=' + 1 + '|' + pais + '|' +  anio); 
        break;
        case "2":
            $("#semestreEmprendedor").html('<option value="2" selected="">Febrero - Julio</option><option value="3">Marzo - Agosto</option><option value="4">Abril - Septiembre</option><option value="5">Mayo - Octubre</option><option value="6">Junio - Noviembre</option><option value="7">Julio - Diciembre</option><option value="1">Enero - Junio</option>');  
            $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportWincbEmprendedores&parametros=' + 2 + '|' + pais + '|' +  anio); 
        break;
        case "3":
            $("#semestreEmprendedor").html('<option value="3" selected="">Marzo - Agosto</option><option value="4">Abril - Septiembre</option><option value="5">Mayo - Octubre</option><option value="6">Junio - Noviembre</option><option value="7">Julio - Diciembre</option><option value="1">Enero - Junio</option><option value="2">Febrero - Julio</option>');  
            $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportWincbEmprendedores&parametros=' + 3 + '|' + pais + '|' +  anio);
        break; 
        case "4":
            $("#semestreEmprendedor").html('<option value="4" selected="">Abril - Septiembre</option><option value="5">Mayo - Octubre</option><option value="6">Junio - Noviembre</option><option value="7">Julio - Diciembre</option><option value="1">Enero - Junio</option><option value="2">Febrero - Julio</option><option value="3">Marzo - Agosto</option>');  
            $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientosgcve?reporte=getReportWincbEmprendedores&parametros=' + 4 + '|' + pais + '|' +  anio);
        break;   
        case "5":
            $("#semestreEmprendedor").html('<option value="5" selected="">Mayo - Octubre</option><option value="6">Junio - Noviembre</option><option value="7">Julio - Diciembre</option><option value="1">Enero - Junio</option><option value="2">Febrero - Julio</option><option value="3">Marzo - Agosto</option><option value="4">Abril - Septiembre</option>');  
        break;
        case "6":
            $("#semestreEmprendedor").html('<option value="6" selected="">Junio - Noviembre</option><option value="7">Julio - Diciembre</option><option value="1">Enero - Junio</option><option value="2">Febrero - Julio</option><option value="3">Marzo - Agosto</option><option value="4">Abril - Septiembre</option><option value="5">Mayo - Octubre</option>');  
        break; 
        case "7":
            $("#semestreEmprendedor").html('<option value="7" selected="">Julio - Diciembre</option><option value="1">Enero - Junio</option><option value="2">Febrero - Julio</option><option value="3">Marzo - Agosto</option><option value="4">Abril - Septiembre</option><option value="5">Mayo - Octubre</option><option value="6">Junio - Noviembre</option>');  
        break;                
      }
            

         } else {
         
         if(semestre<4){    
         switch(semestre){
            case "1":
                $("#semestreEmprendedor").html('<option value="1" selected="">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option><option value="3">Semestre 3</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportWinEmprendedor&parametros=' + 1 + '|' + pais);
            break;
            case "2":
                $("#semestreEmprendedor").html('<option value="2" selected="">Semestre 2</option><option value="3">Semestre 3</option><option value="1">semestre</option><option value="1">Semestre 1</option>');  
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportWinEmprendedor&parametros=' + 2 + '|' + pais);
            break;
            case "3":
                $("#semestreEmprendedor").html('<option value="3" selected="">Semestre 3</option><option value="1">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option>');
                $("#getReportWinEmprendedor").attr('href', '/getReportReconocimientos?reporte=getReportWinEmprendedor&parametros=' + 3 + '|' + pais);
            break;                    
           } 
          } else {
            $("#semestreEmprendedor").html('<option value="1" selected="">semestre</option><option value="1">Semestre 1</option><option value="2">Semestre 2</option><option value="3">Semestre 3</option>');
        }    
    }
    */
}
trimReportWinEmprendedor();