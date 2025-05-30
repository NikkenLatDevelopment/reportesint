@extends('layouts.master')
 
@section('title', 'Reporte de Volumen Exigo')
 
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
                {{-- <li class="nav-item">
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
                    <a class="nav-link" href="VP_VGP_Inactivos">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">VP_VGP_Inactivos</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link active" href="homeReportVolum">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Volumen Exigo</span>
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
                        <span class="badge rounded-pill bg-light text-dark">Reporte de Volumen Exigo</span>
                    </div>
                    <div class="card-body text-lg-left text-center pt-0">
                        {{-- <div class="form-group text-lg-left justify-content-lg-start justify-content-center">
                            <span>Código de socio</span>
                            <input type="text" class="form-control" id="socioCode" name="socioCode" placeholder="Código de socio">
                        </div> --}}
                        <div class="form-group text-lg-left justify-content-lg-start justify-content-center">
                            <span>Periodo de medición:</span>
                            <select class="form-control " aria-label="Default select" id="periodSlct" name="periodSlct">
                                <option value="202502">Febrero 2025</option>
                                <option value="202503">Marzo 2025</option>
                                <option value="202504">Abril 2025</option>
                            </select>
                        </div>
                        <hr>
                        <a href="javascript:;" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0" onclick="reportVolum();">
                            Generar Reporte
                            <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@stop

@section('mainjs')
<script src="{{ asset('assets/mainjs/inactivos.js?v=' . Date('YmdHis')) }}"></script>
<script>
    function reportVolum(){
        var periodSlct = document.getElementById('periodSlct').value;
        window.open('/reportVolum?period=' + periodSlct, '_blank');
    }
    setMonthsSlct('periodSlct', 0);
</script>
@stop