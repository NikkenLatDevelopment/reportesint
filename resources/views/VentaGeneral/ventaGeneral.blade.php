<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Ventas Regional - Premium Light</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/ventaGeneral/ventaGeneral.css') }}">
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-premium mb-4 d-flex justify-content-between align-items-center">
            <img src="{{ asset('img/logo-nikken.png') }}" alt="Logo" class="logo-img">
            <div class="text-center">
                <h4 class="m-0 fw-bold">Control de Venta Pendiente</h4>
                <small id="lastUpdate" class="text-muted fw-semibold" style="font-size: 0.7rem;">
                    Esperando sincronización...
                </small>
            </div>
            <div class="text-end" style="width: 150px">
                <button class="btn btn-premium btn-sm rounded-pill px-4" onclick="ActualizarDatos()">
                    <i class="bi bi-arrow-repeat me-2"></i>Sincronizar
                </button>
            </div>
        </nav>

        <div class="row g-3" id="countryContainer">
        </div>

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">Reporte Consolidado de Ventas</h5>
            </div>
            <div class="table-responsive">
                <table id="ventasTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/ventaGeneral/ventaGeneral.js') }}"></script>


</body>

</html>