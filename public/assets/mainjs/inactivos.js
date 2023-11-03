validateDomElement($("#inactivosTable"), function() {
    $("#inactivosTable").DataTable({
        destroy: true,
        lengthChange: false,
        info: false,
        ajax: 'getDataInactivos',
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        language: {
            url: window.location.pathname + 'assets/plugins/table/datatable/es-ES.json',
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
});