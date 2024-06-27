<?php

namespace App\Http\Controllers\reportesRetos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\coreApp;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\reportCVEmprendedor;
use App\Exports\volumenGlobal;

class reportesRetos extends Controller{
    public function reportesRetos(){
        $coreApp = new coreApp();
        $dataH1 = $coreApp->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranetABIsParticipantes 1, 2", 'SQL173');
        $dataH2 = $coreApp->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranetABIsNoParticipantes 1, 2", 'SQL173');
        $dataH3 = $coreApp->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_DetalleIncorporaciones 1, 1", 'SQL173');
        $dataH4 = $coreApp->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_DetalleKinya 1, 1", 'SQL173');
        
        return new reportCVEmprendedor($dataH1, $dataH2, $dataH3, $dataH4);
    }

    public function reportVolGlobal(){
        $periodo = request()->periodo;
        $coreApp = new coreApp();
        $data = $coreApp->execSQLQuery("SELECT TOP 50000 Associateid, AssociateName,Rango, Pais, PV AS 'VP' ,GV AS 'VGP' ,OV AS 'VO',QOVOPL AS 'VO_LDP',QOVOPSL AS 'VO_LDPyS',Period AS 'Periodo',Sponsorid, SponsorName,SponsorPais, AssociateType, Estatus,estado FROM [LAT_MyNIKKEN].dbo.VolumeGlob with(nolock) WHERE Period=$periodo AND ltrim(rtrim(associateid)) LIKE '%03' AND associatetype=100", 'SQL173');
        return new volumenGlobal($data);
    }
}
