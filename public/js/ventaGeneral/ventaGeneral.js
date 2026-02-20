
let globalDetalles = [];

$(document).ready(function () {
    ActualizarDatos();
});

function ActualizarDatos() {
    let loadingAlert = Swal.fire({
        title: 'Sincronizando...',
        text: 'Consultando servidores regionales, por favor espere.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: 'ventaGeneralData', // <-- AJUSTA ESTA URL
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            Swal.close();

            const ahora = new Date();
            const fechaHoraStr = ahora.toLocaleDateString() + ' ' + ahora.toLocaleTimeString();
            $('#lastUpdate').html(`<i class="bi bi-clock-history me-1"></i> Última ejecución: ${fechaHoraStr}`);

            // Guardamos el detalle de órdenes globalmente para filtrarlo después
            globalDetalles = response.detalles || [];

            // 1. Renderizar las tarjetas de países (Banderas)
            renderBanderas(response.usuarios || []);

            // 2. Renderizar la tabla de ventas
            renderTablaVentas(response.ventas || []);
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error de Conexión',
                text: 'No se pudo recuperar la información del SP: ' + error,
                confirmButtonColor: '#4318ff'
            });
        }
    });
}

/**
 * Crea las tarjetas de estado de cada país
 * @param {Array} usuariosData - ResultSet 1 del SP
 */
function renderBanderas(usuariosData) {
    const container = $('#countryContainer');
    container.empty();

    const listaPaises = ["MEX", "PER", "COL", "CHL", "SLV", "PAN", "CRI", "GTM", "ECU"];

    if (usuariosData.length === 0) {
        container.append('<div class="col-12 text-center text-muted p-4">No hay información de bloqueo de venta.</div>');
        return;
    }

    listaPaises.forEach(p => {

        const tieneBloqueo = usuariosData.some(u => u.Pais === p && u.Bloqueado === 'Y');

        const icono = tieneBloqueo
            ? '<i class="bi bi-x-circle-fill text-danger animate__animated animate__pulse animate__infinite"></i>'
            : '<i class="bi bi-check-circle-fill text-success"></i>';

        const cardHtml = `
            <div class="col">
                <div class="country-card animate__animated animate__fadeIn">
                    <div class="flag-wrapper mb-2">
                        <img src="https://storage.googleapis.com/proyectos_latam/retos_especiales_2026/flags/${p}.png" 
                            alt="${p}" 
                            class="img-fluid shadow-sm rounded-1" 
                            style="width: 45px; height: auto; border: 1px solid #eee;">
                    </div>
            
                    <div class="status-badge">${icono}</div>
                </div>
            </div>`;
        container.append(cardHtml);
    });
}

/**
 * Inicializa o actualiza la DataTable con la data de ventas
 * @param {Array} ventasData - ResultSet 2 del SP
 */
function renderTablaVentas(ventasData) {
    if ($.fn.DataTable.isDataTable('#ventasTable')) {
        $('#ventasTable').DataTable().destroy();
    }

    // Definimos las columnas y su mapeo al código de país para el filtro
    const colConfig = [
        { data: 'Fecha', title: 'Fecha', country: null },
        { data: 'Chile', title: 'Chile', country: 'CHL' },
        { data: 'Colombia', title: 'Colombia', country: 'COL' },
        { data: 'Costa_Rica', title: 'Costa Rica', country: 'CRI' },
        { data: 'Ecuador', title: 'Ecuador', country: 'ECU' },
        { data: 'Guatemala', title: 'Guatemala', country: 'GTM' },
        { data: 'Mexico', title: 'México', country: 'MEX' },
        { data: 'Panama', title: 'Panamá', country: 'PAN' },
        { data: 'Peru', title: 'Perú', country: 'PER' },
        { data: 'El_Salvador', title: 'El Salvador', country: 'SLV' }
    ];

    const mappedColumns = colConfig.map(col => {
        return {
            data: col.data,
            title: col.title,
            render: function (data, type, row) {
                // Si es fecha o el valor es 0, devolver texto plano
                if (col.data === 'Fecha' || data == 0) return data;

                // Si hay valor > 0, creamos un badge clickeable
                return `
                    <span class="badge bg-primary rounded-pill click-detail" 
                          onclick="verDetalleOrdenes('${row.Fecha}', '${col.country}')"
                          style="cursor: pointer; padding: 0.5em 0.8em; transition: 0.2s;">
                        ${data}
                    </span>`;
            }
        };
    });

    $('#ventasTable').DataTable({
        data: ventasData,
        searching: false,
        columns: mappedColumns,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            emptyTable: "No se encontraron ventas pendientes de creación de orden"
        },
        order: [[0, "desc"]], // Fecha más reciente arriba
        responsive: true,
        pageLength: 10,
        dom: '<"d-flex justify-content-between mb-3"f>rtip'
    });
}

/**
 * Filtra los detalles y los muestra en un SweetAlert
 * @param {string} fecha - Fecha de la fila seleccionada
 * @param {string} pais - Código del país de la columna seleccionada
 */
function verDetalleOrdenes(fecha, pais) {
    // Filtrar el array global de detalles (ResultSet 3)
    // Asegúrate que los nombres 'DocDate' y 'CardCountry' coincidan con tu SELECT final del SP
    const filtrados = globalDetalles.filter(d => {
        return d.DocDate.split(' ')[0] === fecha.split(' ')[0] && d.CardCountry === pais;
    });

    if (filtrados.length === 0) {
        Swal.fire('Info', `No hay detalles específicos para ${pais} en la fecha ${fecha}`, 'info');
        return;
    }

    // Construcción de la tabla HTML para el Pop-up
    let tableHtml = `
        <div class="alert alert-info p-2 mb-3" style="font-size: 0.75rem; border-left: 4px solid #0dcaf0;">
            <i class="bi bi-info-circle-fill me-2"></i> 
            La hora mostrada corresponde al ingreso en la <strong>Base Intermedia</strong>. 
            El procesamiento hacia <strong>EXIGO/SAP</strong> puede presentar un ligero desfase.
        </div>
        <div class="table-responsive" style="max-height: 450px; text-align: left; border-radius: 8px;">
            <table class="table table-sm table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="font-size: 0.75rem;">ORDEN / NUMATCARD</th>
                        <th style="font-size: 0.75rem;">FECHA BASE INTERMEDIA</th>
                        <th style="font-size: 0.75rem; text-align: center;">PAÍS</th>
                    </tr>
                </thead>
                <tbody>
                    ${filtrados.map(item => `
                        <tr>
                            <td style="font-family: 'Courier New', monospace; font-weight: 600; font-size: 0.85rem;">
                                ${item.NumAtCard}
                            </td>
                            <td style="font-size: 0.8rem; color: #4a5568;">
                                ${item.fecha_en_stgin.split('.')[0]} </td>
                            <td style="text-align: center;">
                                <span class="badge bg-light text-dark border" style="font-size: 0.7rem;">${item.CardCountry}</span>
                            </td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="badge bg-primary">Total: ${filtrados.length} registros</span>
            <span class="text-muted" style="font-size: 0.7rem;">Filtro: ${pais} | ${fecha}</span>
        </div>
    
    `;

    Swal.fire({
        title: `<small class="text-muted fw-light">Detalle de Pendientes</small><br><strong>${pais} - ${fecha}</strong>`,
        html: tableHtml,
        width: '900px',
        confirmButtonText: 'Entendido',
        confirmButtonColor: '#4318ff',
        showClass: {
            popup: 'animate__animated animate__fadeInUp animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutDown animate__faster'
        }
    });
}