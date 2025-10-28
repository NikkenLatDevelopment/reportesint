<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\coreApp;
use Spatie\SimpleExcel\SimpleExcelWriter;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Style\Color;

class home extends Controller{
    public function index(){
        return view('home');
    }

    public function getDataInactivosTable(){
        $coreApp = new coreApp();
        $data['data'] = $coreApp->execSQLQuery('EXEC PLAN_INFLUENCIA_MK.dbo.sgtPerfecto_ReporteInternoRegresaACasa;', 'SQL173');
        return $data;
    }
    
    public function mplinks(){
        return view('MercadoPago.mplinks');
    }

    public function getMplinksData(){
        $date_ini = request()->date_ini;
        $date_end = request()->date_end;
        $coreApp = new coreApp();
        $data['data'] = $coreApp->execMySQLQuery("SELECT id, sale_id, 'Perú' AS pais, payment_method, payment_provider, payment_amount, status, created_at, updated_at
        FROM sales_information_payments
        WHERE payment_method = 'MercadoPago - Link de Pago' AND created_at BETWEEN '$date_ini' AND '$date_end';", 'TVMySQL');
        return $data;
    }

    public function VP_VGP_Inactivos(){
        return view('VP_VGP_Inactivos.VP_VGP_Inactivos');
    }

    public function VP_VGP_InactivosData(){
        $coreApp = new coreApp();
        $periodo = request()->periodSlct;
        $key = sprintf('VP_VGP_Inactivos_%s', $periodo);
        $timeCaching = 3600; ##86400 = 24 horas, 43200 = 12 horas, 21600 = 6 horas, 14400 = 4 horas, 7200 = 2 horas, 4680 = 1 hora 30 minutos, 3600 = 1 hora

        return cache()->remember($key, $timeCaching, static function () use ($coreApp, $periodo) {
            $data['data'] = $coreApp->execSQLQuery("EXEC LAT_MyNIKKEN.dbo.VP_VGP_Inactivos $periodo;", "SQL73");
            return $data;
        });
    }

    public function cumplimiento(){
        return view('otros.cumplimiento');
    }

    public function getReportCheckBonos(){
        $coreApp = new coreApp();
        $anio = request()->year;
        $pais = request()->pais;
        $data['data'] = $coreApp->execSQLQuery("SELECT top 50 * 
                                                FROM EXIGO_prod.dbo.RangosPivot_Local 
                                                WHERE anio = '$anio' AND MainCountry = '$pais'
                                                ORDER BY CustomerID;", "SQL173");
        return $data;
    }
}
