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
                    <a class="nav-link active" href="mplinks">
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
            </ul>
        </div>
        
    </aside>
@stop
 
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-4 mb-4">
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
                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                            <div>
                                <span class="ps-3">País</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control " aria-label="Default select" id="countySlct" name="countySlct">
                                <option value="1">Colombia </option>
                                <option value="2">México</option>
                                <option value="3">Perú</option>
                                <option value="4">Ecuador</option>
                                <option value="5">Panamá</option>
                                <option value="6">Guatemala</option>
                                <option value="7">El Salvador</option>
                                <option value="8">Costa Rica</option>
                                <option value="10">Chile</option>
                                <option value="0">Nikken Latinoamérica</option>
                            </select>
                        </div>
                        <a href="javascript:;" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0" onclick="VP_VGP_InactivosTable()">
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
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Pais</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Addres_1</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">SignupDate</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">vp_202312</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">vgp_202312</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">vp_202401</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">vgp_202401</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">vp_202402</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">vgp_202402</th>
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
        var countySlct = $("#countySlct").val();
        $("#VP_VGP_Inactivosreport").DataTable({
            destroy: true,
            lengthChange: false,
            info: false,
            ajax: '/VP_VGP_InactivosData?periodSlct=' + periodSlct + '&countySlct=' + countySlct,
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
                { data: 'vp_202312', className: 'text-xxs' },
                { data: 'vgp_202312', className: 'text-xxs' },
                { data: 'vp_202401', className: 'text-xxs' },
                { data: 'vgp_202401', className: 'text-xxs' },
                { data: 'vp_202402', className: 'text-xxs' },
                { data: 'vgp_202402', className: 'text-xxs' },
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
                        title: 'Links de Pago Generados con Mercado Pago Perú',
                    },
                ]
            },
        });
    }
</script>
@stop