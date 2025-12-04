function getReportInactivos() {
    validateDomElement($("#inactivosTable"), function () {
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
                    render: function (data, type, row) {
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
                        text: "<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                        title: 'Inactivos 2023',
                    },
                ]
            },
        });
    });
}

function getMplinksData() {
    var date_ini = $("#date_ini").val();
    var date_end = $("#date_end").val();
    if (date_end.trim() == "" || date_ini.trim() == "") {
        alert('Ups', 'Fechas requeridas', 'error');
    }
    else {
        $("#getMplinksTable").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/getMplinksData?date_ini=' + date_ini + '&date_end=' + date_end,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'id', className: 'text-xxs' },
                { data: 'sale_id', className: 'text-xxs' },
                { data: 'pais', className: 'text-xxs' },
                { data: 'payment_method', className: 'text-xxs' },
                { data: 'payment_provider', className: 'text-xxs' },
                {
                    data: 'payment_amount',
                    className: 'text-xxs',
                    render: function (data, type, row) {
                        var payment_amount = row.payment_amount;
                        return 's./ ' + formatMoney(payment_amount, 0);
                    }
                },
                { data: 'status', className: 'text-xxs' },
                { data: 'created_at', className: 'text-xxs' },
                { data: 'updated_at', className: 'text-xxs' },
            ],
            language: {
                url: 'https://reportesint.nikkenlatam.com//assets/plugins/table/datatable/es-ES.json',
            },
            buttons: {
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn bg-gradient-primary',
                        text: "<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                        title: 'Links de Pago Generados con Mercado Pago Perú',
                    },
                ]
            },
        });
    }
}


function setMonthsSlct(slct, anios) {
    var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    $('#' + slct).empty(); // Asegúrate de que el select esté vacío antes de agregar opciones.
    var today = new Date();
    var currentYear = today.getFullYear();
    var currentMonth = today.getMonth() + 1; // getMonth() es 0-index, por lo tanto +1.

    var startYear = currentYear - parseInt(anios);
    var currentValue = currentYear.toString() + (currentMonth < 10 ? '0' : '') + currentMonth.toString();

    for (var year = currentYear; year >= startYear; year--) {
        var startMonth = (year === currentYear) ? currentMonth : 12; // Comenzar en el mes actual si es el año en curso.
        for (var month = startMonth; month > 2; month--) { // Decrementa el mes.
            var formattedMonth = month < 10 ? '0' + month : month.toString();
            var value = year.toString() + formattedMonth;
            var text = monthNames[month - 1] + ' ' + year;
            var option = $('<option>', {
                value: value,
                text: text
            });

            // Añade la opción al principio del select para que estén en orden descendente.
            $('#' + slct).prepend(option);

            // Si es el valor del mes y año actual, lo selecciona por defecto.
            if (value === currentValue) {
                option.prop('selected', true);
            }
        }
    }
}

function setMonthsSelect() {
    var select = $("#periodSlct");
    $.ajax({
        url: '/GetMonths',
        method: 'GET',
        beforeSend: function () {

        },
        success: function (data) {
            select.empty();

            data.forEach(function (item) {
                select.append(
                    `<option value="${item.Id}">${item.Fechas}</option>`
                );
            });
        },
        error: function (error) {
            console.log(error);
        },
        complete: function () {
            $("#loader").hide();

        }
    })
}