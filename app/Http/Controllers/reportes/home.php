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
        $periodo = request()->periodSlct;
        $pais = request()->countySlct;
        $coreApp = new coreApp();
        $data['data'] = $coreApp->execMySQLQuery("EXEC LAT_MyNIKKEN.dbo.VP_VGP_Inactivos $periodo;", 'SQL73');
        return $data;
    }
}
