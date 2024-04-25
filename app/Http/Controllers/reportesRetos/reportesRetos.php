<?php

namespace App\Http\Controllers\reportesRetos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\coreApp;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\reportCVEmprendedor;

class reportesRetos extends Controller{
    public function reportesRetos(){
        $coreApp = new coreApp();
        $dataH1 = $coreApp->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranetABIsParticipantes 1, 2", 'SQL173');
        $dataH2 = $coreApp->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranetABIsNoParticipantes 1, 2", 'SQL173');
        $dataH3 = $coreApp->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_DetalleIncorporaciones 1, 1", 'SQL173');
        $dataH4 = $coreApp->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_DetalleKinya 1, 1", 'SQL173');
        
        return new reportCVEmprendedor($dataH1, $dataH2, $dataH3, $dataH4);
    }
}
