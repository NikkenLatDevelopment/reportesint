function getReportInactivos(){
    validateDomElement($("#inactivosTable"), function() {
        $("#inactivosDiv").empty();
        var html = '<table class="table align-items-center mb-0 text-center" id="inactivosTable">' +
            '<thead>' +
                '<tr>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">Código</th>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">Nombre</th>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">Rango</th>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">País</th>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">Telefono</th>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">Correo</th>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">VP Noviembre</th>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">Código Patrocinador</th>' +
                    '<th class="text-uppercase text-xxs font-weight-bolder text-black">Nombre Patrocinador</th>' +
                '</tr>' +
            '</thead>' +
        '</table>';
        $("#inactivosDiv").html(html);
        $("#inactivosTable").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: 'https://services.nikken.com.mx/api_service?s=getDataInactivosTable',
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'codAsociado', className: 'text-xxs' },
                { data: 'nombreAsociado', className: 'text-xxs' },
                { data: 'Rango', className: 'text-xxs' },
                { data: 'pais', className: 'text-xxs' },
                { data: 'telefono', className: 'text-xxs' },
                { data: 'E_mail', className: 'text-xxs' },
                {  
                    data: 'vpNoviembre2023',
                    className: 'text-xxs',
                    render: function(data, type, row){
                        var vpNoviembre2023 = row.vpNoviembre2023;
                        return formatMoney(vpNoviembre2023, 0);
                    }
                },
                { data: 'SponsorId', className: 'text-xxs' },
                { data: 'sponsorname', className: 'text-xxs' },
            ],
            language: {
                url: window.location.pathname + 'assets/plugins/table/datatable/es-ES.json',
            },
            buttons: {
                buttons: [
                    { 
                        extend: 'excel', 
                        className: 'btn bg-gradient-primary', 
                        text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                        title: 'Inactivos 2023',
                    },
                ]
            },
        });
    });
}