@extends('layouts.master')

@section('title', 'Cumplimiento')

@section('sidebar')
    
@stop

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header text-center pt-4 pb-3">
                        <span class="badge rounded-pill bg-light text-dark">Seguimineto de Cumplimiento</span>
                    </div>
                    <div class="card-body text-lg-left pt-0">
                        <div class="form-group text-lg-left justify-content-lg-start ">
                            <span>Periodo de medición:</span>
                            <select class="form-control" aria-label="Default select" id="periodSlct" name="periodSlct"></select>
                        </div>
                        <div class="form-group text-lg-left justify-content-lg-start ">
                            <span>País:</span>
                            <select class="form-control " aria-label="Default select" id="countrySlct" name="countrySlct">
                                <option value="CO">Colombia</option>
                                <option value="MX">México</option>
                                <option value="PE">Perú</option>
                                <option value="EC">Ecuador</option>
                                <option value="PA">Panamá</option>
                                <option value="GT">Guatemala</option>
                                <option value="SV">El Salvador</option>
                                <option value="CR">Costa Rica</option>
                                <option value="CL">Chile</option>
                            </select>
                        </div>
                        <hr>
                        <a href="javascript:;" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0" onclick="getReportCheckBonos();">
                            Generar Reporte
                            <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="table-responsive pb-4 mt-3">
                        <table class="table align-items-center mb-0 text-center" id="cumplimientoTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Código</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Nombre</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">País</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Fecha Incorporación</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('mainjs')
<script>
    var select = jQuery('#periodSlct');
    select.empty();
    var anioInicio = 2025;
    var anioActual = new Date().getFullYear();

    Array.from({ length: anioActual - anioInicio + 1 }, (_, i) => {
        var anio = anioInicio + i;
        select.append(`<option value="${anio}">Año ${anio}</option>`);
    });

    function generateTableMonths(){
        var table_tr = $("#cumplimientoTable thead tr");
        // Agregar las columnas del mes seleccionado
        var meses = {0: 'Enero', 1: 'Febrero', 2: 'Marzo', 3: 'Abril', 4: 'Mayo', 5: 'Junio', 6: 'Julio', 7: 'Agosto', 8: 'Septiembre', 9: 'Octubre', 10: 'Noviembre', 11: 'Diciembre'};
        for(x = 0; x < 10; x++){
            table_tr.append(`<th class="text-xxs font-weight-bolder text-black">Rango ${meses[x]} ${select.val()}</th>`);
            table_tr.append(`<th class="text-xxs font-weight-bolder text-black">Rango de pago ${meses[x]} ${select.val()}</th>`);
        }
    }

    function deleteColumnsMonths(){
        var table_tr = $("#cumplimientoTable thead tr");
        // Eliminar las columnas del mes si es que existen creadas
        for(x = 14; x > 3; x--){
            table_tr.children(`:eq(${x})`).remove();
        }
        for(x = 14; x > 3; x--){
            table_tr.children(`:eq(${x})`).remove();
        }
    }

    function getReportCheckBonos(){
        deleteColumnsMonths();
        generateTableMonths();
        var table = $("#cumplimientoTable");
        var year = $("#periodSlct").val();
        var pais = $("#countrySlct").val();

        var rangos = {
            10: 'Directo',
            20: 'Superior',
            30: 'Ejecutivo',
            40: 'Plata',
            50: 'Oro',
            60: 'Platino',
            70: 'Diamante',
            80: 'Diamante Real',
        };

        var months_colums = [];
        var contador = months_colums.length + 1;
        for(x = 1; x < 11; x++){
            var nuevoDato = {
                data: `Rank_${x}`,
                className: 'text-xxs'
            };
            months_colums.push(nuevoDato);
            var nuevoDato = {
                data: `PaidRank_${x}`,
                className: 'text-xxs',
            };
            months_colums.push(nuevoDato);
        }
        console.log(months_colums);

        table.DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: `/getReportCheckBonos?year=${year}&pais=${pais}`,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'CustomerID', className: 'text-xxs' },
                { data: 'NombreCompleto', className: 'text-xxs' },
                { data: 'MainCountry', className: 'text-xxs' },
                { data: 'CreatedDate', className: 'text-xxs' },
                // months_colums
                { 
                    data: "1_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_1 = row.Rank_1
                        return rangos[Rank_1];
                    }
                },
                { 
                    data: "1_PaidRank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_1 = row.PaidRank_1
                        return rangos[PaidRank_1];
                    }
                },
                { 
                    data: "2_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_2 = row.Rank_2
                        return rangos[Rank_2];
                    }
                },
                { 
                    data: "PaidRank_2", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_2 = row.PaidRank_2
                        return rangos[PaidRank_2];
                    }
                },
                { 
                    data: "3_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_3 = row.Rank_3
                        return rangos[Rank_3];
                    }
                },
                { 
                    data: "3_PaidRank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_3 = row.PaidRank_3
                        return rangos[PaidRank_3];
                    }
                },
                { 
                    data: "4_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_4 = row.Rank_4
                        return rangos[Rank_4];
                    }
                },
                { 
                    data: "PaidRank_4", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_4 = row.PaidRank_4
                        return rangos[PaidRank_4];
                    }
                },
                { 
                    data: "5_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_5 = row.Rank_5
                        return rangos[Rank_5];
                    }
                },
                { 
                    data: "5_PaidRank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_5 = row.PaidRank_5
                        return rangos[PaidRank_5];
                    }
                },
                { 
                    data: "6_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_6 = row.Rank_6
                        return rangos[Rank_6];
                    }
                },
                { 
                    data: "6_PaidRank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_6 = row.PaidRank_6
                        return rangos[PaidRank_6];
                    }
                },
                { 
                    data: "7_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_7 = row.Rank_7
                        return rangos[Rank_7];
                    }
                },
                { 
                    data: "7_PaidRank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_7 = row.PaidRank_7
                        return rangos[PaidRank_7];
                    }
                },
                { 
                    data: "8_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_8 = row.Rank_8
                        return rangos[Rank_8];
                    }
                },
                { 
                    data: "8_PaidRank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        // var PaidRank_8 = 
                        return rangos[row.PaidRank_8];
                    }
                },
                { 
                    data: "9_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_9 = row.Rank_9
                        return rangos[Rank_9];
                    }
                },
                { 
                    data: "9_PaidRank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_9 = row.PaidRank_9
                        return rangos[PaidRank_9];
                    }
                },
                { 
                    data: "10_Rank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var Rank_10 = row.Rank_10
                        return rangos[Rank_10];
                    }
                },
                { 
                    data: "10_PaidRank", 
                    className: "text-xxs", 
                    render: function(data, type, row){
                        var PaidRank_10 = row.PaidRank_10
                        return rangos[PaidRank_10];
                    }
                },
            ],
            language: {
                "search": `Buscar:` ,
                "searchPlaceholder": `Buscar`,
                "loadingRecords": `<center><div class="box">Cargando Registros... <i class="icn-spinner bi bi-arrow-clockwise"></i></div></center>`,
                'sEmptyTable': `No se encontraron registros`,
                "sZeroRecords": `No se encontraron coincidencias`,
                "info": `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mostrando _START_ a _END_ de _TOTAL_ registros`,
                "infoEmpty": "",
                "paginate": { "previous": "<i class='fa-solid fa-arrow-left'></i>", "next": "<i class='fa-solid fa-arrow-right'></i>" },
            },
            buttons: {
                buttons: [
                    { 
                        extend: 'excel', 
                        className: 'btn bg-gradient-primary', 
                        text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                    },
                ]
            },
        });
    }
</script>
@stop