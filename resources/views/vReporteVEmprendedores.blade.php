<!DOCTYPE html>
<html lang="es" itemscope itemtype="http://schema.org/WebPage">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/x-icon" href="{{ asset('fpro/img/favicon.ico') }}">
        <title>
            Club Viajero Plus
        </title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <link href="{{ asset('creative/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('creative/css/nucleo-svg.css') }}" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="{{ asset('creative/css/nucleo-svg.css') }}" rel="stylesheet" />
        <link id="pagestyle" href="{{ asset('creative/css/soft-design-system.css?v=1.0.9') }}" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" href="{{ asset('fpro/plugins/sweetalerts/sweetalert2.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('fpro/plugins/sweetalerts/sweetalert.css') }}"/>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.0.1/remixicon.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('fpro/plugins/table/datatable/datatables.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('fpro/plugins/table/datatable/custom_dt_zero_config.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('fpro/plugins/table/datatable/custom_dt_html5.css') }}">

        <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet'>
        <style>
            body {
                font-family: 'Comfortaa' !important;
            }
            .bg-gradient-info{
                background-image: linear-gradient(310deg, #a3b7ff 0%, #11d3ff 100%) !important;
            }
            .card .card-body{
                font-family: 'Comfortaa' !important;
            }

            .home-demo h2 {
                color: #FFF;
                text-align: center;
                padding: 5rem 0;
                margin: 0;
                font-style: italic;
                font-weight: 300;
            }

            table > tbody > tr > td{
                padding: 1px !important;
            }

            .bg-gradient-primary-vplus{
                background-image: linear-gradient(310deg, #FFB311 0%, #FF8F42 100%);
            }
            .page-item.active .page-link{
                background-color: #f53939;
                border-color: #fbcf33;
                border-radius: 25px;
                color: #000;
            }
            .page-item.active .page-link:hover{
                background-color: #f53939 !important;
                border-color: #fbcf33 !important;
                border-radius: 25px !important;
                color: #000 !important;
            }
            .page-item .page-link, .page-item span{
                color: #000 !important;
            }
        </style>
    </head>
    <body class="blog-author">
        <header class="header-2">
            <div class="page-header min-vh-75 relative">
                <span class="mask bg-gradient-primary bg-gradient-primary-vplus"></span>
                <div class="container" style="min-width: 98% !important;">
                    <div class="row">
                        <div class="col-lg-3 text-center mx-auto ">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img src="https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png?v={{Date('YmdHis')}}" class="w-75">
                                    <div class="form-group mb-4">
                                        <label for="semSlct" class="h5">Semestre</label>
                                        <select class="form-select" id="semSlct">
                                            <option value="1">Semestre 1</option>
                                            <option value="2">Semestre 2</option>
                                            <option value="3">Semestre 3</option>
                                            <option value="4">Semestre 4</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="trimSlct" class="h5">Trimestre:</label>
                                        <select class="form-select" id="trimSlct">
                                            <option value="1">Trimestre 1</option>
                                            <option value="2">Trimestre 2</option>
                                            <option value="3">Trimestre 3</option>
                                            <option value="4">Trimestre 4</option>
                                        </select>
                                    </div>
                                    <a href="javscript:void(0)" class="btn w-75 btn-secondary btn-rounded" onclick="reportCVEmprendedor();" style="background-image: linear-gradient(to right,#3862f5 0,#25d5e4 100%); border: 0 !important">
                                        Descargar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-absolute w-100 z-index-1 bottom-0">
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="moving-waves">
                            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
                            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
                        </g>
                    </svg>
                </div>
            </div>
        </header>

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{ asset('creative/js/core/popper.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('creative/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('creative/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('creative/js/plugins/parallax.min.js') }}"></script>
        <script src="{{ asset('fpro/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('creative/js/soft-design-system.min.js?v=1.0.9') }}" type="text/javascript"></script>
        <script src="{{ asset('fpro/js/lib.js?v='.Date('YmdHis')) }}"></script>
        <script src="{{ asset('fpro/plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('fpro/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('fpro/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
        <script src="{{ asset('fpro/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('fpro/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
        <script>
            function reportCVEmprendedor(){
                var sem = $("#semSlct").val();
                var trim = $("#trimSlct").val();
                window.open("/reportCVEmprendedor?t=" + trim + "&s=" + sem); 
            }
        </script>
    </body>
</html>
    