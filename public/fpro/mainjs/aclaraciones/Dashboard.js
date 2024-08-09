
function Open(){

    $.ajax({
        type: 'get',
        url: 'tksAbiertos',
        dataType: "json",
        data:{ rfc: 123},
        
        success: function(respuesta){
                $("#resultAbiertos").empty();
            $("#operaciones1").empty();
            $("#resultAbiertos").append('<table id="operaciones1" class="table table-hover">'+
                '<thead>'+

                '<tr id="countries">'+
                '<th scope="col">Solicitud</th>'+
                '<th scope="col">Tipo Incidencia</th>'+
                '<th scope="col">Comentario Incidencia</th>'+
                '<th scope="col">Fecha</th>'+
                '<th scope="col">Días Transcurridos</th>'+
                '<th scope="col">Última actualización</th>'+
                '<th scope="col">Asesor</th>'+
                '<th scope="col">Acciones</th>'+
                '</tr>'+
                '</thead>');
            

            $.each(respuesta,function(key, registro) {

                var fecha1 = moment(registro.creación);
                var fecha2 = moment(registro.ultima_actualización);

                console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');

                $("#operaciones1").append('<tbody id="datos">'+
                    '<tr><td>'+registro.ID_aclaracion+'</td>'+
                    '<td>'+registro.Tipo_Incidencia+'</td>'+
                    '<td>'+registro.Descripción_Incidencia+'</td>'+
                    '<td>'+registro.creación+'</td>'+
                    '<td>'+fecha2.diff(fecha1, 'days')+'</td>'+
                    '<td>'+registro.ultima_actualización+'</td>'+
                    '<td>'+registro.Código+'</td>'+
                    '<td><center><a href="detailticket/'+registro.ID_aclaracion+'"  class="form btn btn-primary btn-xs "> <i class="flaticon-view-3"></i></a></center></td>'+                                            
                    '</tbody>'+
                    '</table>');
        //$("#datos").append('<tr><td>'+registro.Total+'</td><td>'+registro.PEriod+'</td><td>'+registro.PAis+'</td><td>'+registro.OrderDate+'</td></tr>');


    });
            $('#operaciones1').DataTable();
        }
    });
    
}

function Close(){

    $.ajax({
        type: 'get',
        url: 'tksCerrados',
        dataType: "json",
        data:{ rfc: 123},
        
        success: function(respuesta){
                $("#resultCerrados").empty();
            $("#operaciones2").empty();
            $("#resultCerrados").append('<table id="operaciones2" class="table table-hover">'+
                '<thead>'+

                '<tr id="countries">'+
                '<th scope="col">Solicitud</th>'+
                '<th scope="col">Tipo Incidencia</th>'+
                '<th scope="col">Comentario Incidencia</th>'+
                '<th scope="col">Fecha</th>'+
                '<th scope="col">Días Transcurridos</th>'+
                '<th scope="col">Última actualización</th>'+
                '<th scope="col">Asesor</th>'+
                '<th scope="col">Acciones</th>'+
                '</tr>'+
                '</thead>');
            

            $.each(respuesta,function(key, registro) {

                var fecha1 = moment(registro.creación);
                var fecha2 = moment(registro.ultima_actualización);

                console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');

                $("#operaciones2").append('<tbody id="datos">'+
                    '<tr><td>'+registro.ID_aclaracion+'</td>'+
                    '<td>'+registro.Tipo_Incidencia+'</td>'+
                    '<td>'+registro.Descripción_Incidencia+'</td>'+
                    '<td>'+registro.creación+'</td>'+
                    '<td>'+fecha2.diff(fecha1, 'days')+'</td>'+
                    '<td>'+registro.ultima_actualización+'</td>'+
                    '<td>'+registro.Código+'</td>'+
                    '<td><center><a href="detailticket/'+registro.ID_aclaracion+'"  class="form btn btn-primary btn-xs "> <i class="flaticon-view-3"></i></a></center></td>'+                                            
                    '</tbody>'+
                    '</table>');
        //$("#datos").append('<tr><td>'+registro.Total+'</td><td>'+registro.PEriod+'</td><td>'+registro.PAis+'</td><td>'+registro.OrderDate+'</td></tr>');


    });
            $('#operaciones2').DataTable();
        }
    });
    
}

function Pending(){

    $.ajax({
        type: 'get',
        url: 'tksPendientes',
        dataType: "json",
        data:{ rfc: 123},
        
        success: function(respuesta){
                $("#resultPendientes").empty();
            $("#operaciones3").empty();
            $("#resultPendientes").append('<table id="operaciones3" class="table table-hover">'+
                '<thead>'+

                '<tr id="countries">'+
                '<th scope="col">Solicitud</th>'+
                '<th scope="col">Tipo Incidencia</th>'+
                '<th scope="col">Comentario Incidencia</th>'+
                '<th scope="col">Fecha</th>'+
                '<th scope="col">Días Transcurridos</th>'+
                '<th scope="col">Última actualización</th>'+
                '<th scope="col">Asesor</th>'+
                '<th scope="col">Acciones</th>'+
                '</tr>'+
                '</thead>');
            

            $.each(respuesta,function(key, registro) {

                var fecha1 = moment(registro.creación);
                var fecha2 = moment(registro.ultima_actualización);

                console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');

                $("#operaciones3").append('<tbody id="datos">'+
                    '<tr><td>'+registro.ID_aclaracion+'</td>'+
                    '<td>'+registro.Tipo_Incidencia+'</td>'+
                    '<td>'+registro.Descripción_Incidencia+'</td>'+
                    '<td>'+registro.creación+'</td>'+
                    '<td>'+fecha2.diff(fecha1, 'days')+'</td>'+
                    '<td>'+registro.ultima_actualización+'</td>'+
                    '<td>'+registro.Código+'</td>'+
                    '<td><center><a href="detailticket/'+registro.ID_aclaracion+'"  class="form btn btn-primary btn-xs "> <i class="flaticon-view-3"></i></a></center></td>'+                                            
                    '</tbody>'+
                    '</table>');
        //$("#datos").append('<tr><td>'+registro.Total+'</td><td>'+registro.PEriod+'</td><td>'+registro.PAis+'</td><td>'+registro.OrderDate+'</td></tr>');


    });
            $('#operaciones3').DataTable();
        }
    });
    
}
function detailticket(idticket){
    alert(idticket);
    $.ajax({
        type: 'get',
        url: 'tksAbiertos',
        dataType: "json",
        data:{ idticket: idticket},
        
        success: function(respuesta){


        }
    });

}