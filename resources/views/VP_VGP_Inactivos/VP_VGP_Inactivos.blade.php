@extends('layouts.master')
 
@section('title', 'VP_VGP_Inactivos')
 
@section('sidebar')
    <aside class="sidenav blur navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="javascript:void(0)" target="_blank">
            <img src="https://storage.googleapis.com/proyectos_latam/tv_rep_dom/min-logo-nikken-black.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">NIKKEN</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Inactivos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mplinks">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mercado Pago Perú</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="mplinks">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">VP_VGP_Inactivos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="homeCheckBonos">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Check Bonos</span>
                    </a>
                </li>
            </ul>
        </div>
        
    </aside>
@stop
 
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header text-center pt-4 pb-3">
                        <h1 class="font-weight-bold mt-2">
                            <img src="https://storage.googleapis.com/proyectos_latam/reportes/1055644.png" width="90%">
                        </h1>
                    </div>
                    <div class="card-body text-lg-left text-center pt-0">
                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                            <div>
                                <span class="ps-3">Periodo de medición:</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control " aria-label="Default select" id="periodSlct" name="periodSlct"></select>
                        </div>
                        <hr>
                        <a href="javascript:;" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0" onclick="VP_VGP_InactivosTable();">
                            Generar Reporte
                            <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>            
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="table-responsive pb-4 mt-3" id="inactivosDiv">
                        <table class="table align-items-center mb-0 text-center" id="VP_VGP_Inactivosreport">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">AssociateID</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">AssociateName</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Sponsor_id</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Distributor_Status</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Email</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Mobile_Number</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Country</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Addres_1</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Signup_Date</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black" id="vp_1">___</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black" id="vgp_1">___</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black" id="vp_2">___</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black" id="vgp_2">___</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black" id="vp_3">___</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black" id="vgp_3">___</th>
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
<script src="{{ asset('assets/mainjs/inactivos.js?v=' . Date('YmdHis')) }}"></script>
<script>
    setMonthsSlct('periodSlct', 1);

    function VP_VGP_InactivosTable(){
        var periodSlct = $("#periodSlct").val();
        $("#VP_VGP_Inactivosreport").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            deferRender: true,
            ajax: '/VP_VGP_InactivosData?periodSlct=' + periodSlct,
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
            columns: [
                { data: 'AssociateID', className: 'text-xxs' },
                { data: 'AssociateName', className: 'text-xxs' },
                { data: 'Sponsor_id', className: 'text-xxs' },
                { data: 'Distributor_Status', className: 'text-xxs' },
                { data: 'Email', className: 'text-xxs' },
                { data: 'Mobile_Number', className: 'text-xxs' },
                { data: 'Pais', className: 'text-xxs' },
                { data: 'Addres_1', className: 'text-xxs' },
                { data: 'SignupDate', className: 'text-xxs' },
                { 
                    data: 'vp_1',
                    className: 'text-xxs',
                    render: function(data, type, row){
                        var vp_1 = row.vp_1;
                        return "<b>" + formatMoney(vp_1, 0) + "</b>";
                    }
                },
                { 
                    data: 'vgp_1',
                    className: 'text-xxs',
                    render: function(data, type, row){
                        var vgp_1 = row.vgp_1;
                        return "<b>" + formatMoney(vgp_1, 0) + "</b>";
                    }
                },
                { 
                    data: 'vp_2',
                    className: 'text-xxs',
                    render: function(data, type, row){
                        var vp_2 = row.vp_2;
                        return "<b>" + formatMoney(vp_2, 0) + "</b>";
                    }
                },
                { 
                    data: 'vgp_2',
                    className: 'text-xxs',
                    render: function(data, type, row){
                        var vgp_2 = row.vgp_2;
                        return "<b>" + formatMoney(vgp_2, 0) + "</b>";
                    }
                },
                { 
                    data: 'vp_3',
                    className: 'text-xxs',
                    render: function(data, type, row){
                        var vp_3 = row.vp_3;
                        return "<b>" + formatMoney(vp_3, 0) + "</b>";
                    }
                },
                { 
                    data: 'vgp_3',
                    className: 'text-xxs',
                    render: function(data, type, row){
                        var vgp_3 = row.vgp_3;
                        return "<b>" + formatMoney(vgp_3, 0) + "</b>";
                    }
                },
            ],
            language: {
                url: 'https://reportesint.nikkenlatam.com//assets/plugins/table/datatable/es-ES.json',
            },
            buttons: {
                buttons: [
                    { 
                        extend: 'excel', 
                        className: 'btn bg-gradient-primary', 
                        text:"<img src='https://services.nikken.com.mx/retos/img/excel.png' width='15px'></img> Exportar a Excel",
                        title: 'Inactivos VP y VGP',
                    },
                ]
            },
            drawCallback: function (settings) {
                setPeriodsTable(periodSlct);
            }
        });
    }

    function setPeriodsTable(periodo){
        var txtMeses = {
        "01": "Enero",
        "02": "Febrero",
        "03": "Marzo",
        "04": "Abril",
        "05": "Mayo",
        "06": "Junio",
        "07": "Julio",
        "08": "Agosto",
        "09": "Septiembre",
        "10": "Octubre",
        "11": "Noviembre",
        "12": "Diciembre",
        "1": "Enero",
        "2": "Febrero",
        "3": "Marzo",
        "4": "Abril",
        "5": "Mayo",
        "6": "Junio",
        "7": "Julio",
        "8": "Agosto",
        "9": "Septiembre",
        }
        var periodo = String(periodo);
        var anio = periodo.substr(0,4);
        var mes = periodo.substr(4,5);
        $("#vp_1").text("VP " + txtMeses[mes] + " del " + anio);
        $("#vgp_1").text("VGP " + txtMeses[mes] + " del " + anio);

        var date = new Date(anio, mes - 1);
        date.setMonth(date.getMonth() - 1);
        var previousYear = date.getFullYear();
        var previousMonth = date.getMonth() + 1;

        $("#vp_2").text("VP " + txtMeses[previousMonth] + " del " + previousYear);
        $("#vgp_2").text("VGP " + txtMeses[previousMonth] + " del " + previousYear);

        var date = new Date(anio, mes - 1);
        date.setMonth(date.getMonth() - 2);
        var previousYear = date.getFullYear();
        var previousMonth = date.getMonth() + 1;

        $("#vp_3").text("VP " + txtMeses[previousMonth] + " del " + previousYear);
        $("#vgp_3").text("VGP " + txtMeses[previousMonth] + " del " + previousYear);
    }
</script>
@stop