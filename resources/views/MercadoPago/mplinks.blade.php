@extends('layouts.master')
 
@section('title', 'Mercado Pago Links')
 
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
                        <span class="badge rounded-pill bg-light text-dark">Mercado Pago Links</span>
                        <h1 class="font-weight-bold mt-2">
                            <img src="https://1000marcas.net/wp-content/uploads/2023/01/Mercado-Pago-Logo.png" width="90%">
                        </h1>
                    </div>
                    <div class="card-body text-lg-left text-center pt-0">
                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                            <div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center">
                                <i class="fas fa-calendar opacity-10" aria-hidden="true"></i>
                            </div>
                            <div>
                                <span class="ps-3">Fecha inicial</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="date" id="date_ini">
                        </div>
                        <hr>
                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                            <div class="icon icon-shape icon-xs rounded-circle bg-gradient-success shadow text-center">
                                <i class="fas fa-calendar opacity-10" aria-hidden="true"></i>
                            </div>
                            <div>
                                <span class="ps-3">Fecha final</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="date" id="date_end">
                        </div>
                        <a href="javascript:;" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0" onclick="getMplinksData()">
                            Generar Reporte
                            <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>            
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="table-responsive pb-4 mt-3" id="inactivosDiv">
                        <table class="table align-items-center mb-0 text-center" id="getMplinksTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">#</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Venta</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">País</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Metodo de pago</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Proveedor de pago</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Monto</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Estatus</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Fecha de creación</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-black">Fecha de actualización</th>
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
@stop