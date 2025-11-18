@extends('layouts.master')

@section('title', 'Termina el año en plata')

@section('sidebar')
    
@stop

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header text-center pt-4 pb-3">
                        <span class="badge rounded-pill bg-light text-dark">Termina el año en plata</span>
                    </div>
                    <div class="card-body text-lg-left pt-0">
                        <div class="form-group text-lg-left justify-content-lg-start ">
                            <span>Periodo de medición:</span>
                            <select class="form-control" aria-label="Default select" id="periodSlct" name="periodSlct">
                                <option value="202510">Octubre 2025</option>
                                <option value="202511">Noviembre 2025</option>
                                <option value="202512">Diciembre 2025</option>
                            </select>
                        </div>
                        <hr>
                        <a href="javascript:;" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0" onclick="getReport();">
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
<script>
    function getReport(){
        periodo = $("#periodSlct").val();
        window.open(`/getFinAnioPlata?periodo=${periodo}`, "_blank");
    }
</script>
@stop