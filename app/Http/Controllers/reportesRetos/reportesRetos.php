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
        ini_set('memory_limit', '2048M');
        $data = $coreApp->execSQLQuery("SELECT Associateid, AssociateName,Rango, Pais, PV AS 'VP' ,GV AS 'VGP' ,OV AS 'VO',QOVOPL AS 'VO_LDP',QOVOPSL AS 'VO_LDPyS',Period AS 'Periodo',Sponsorid, SponsorName,SponsorPais, AssociateType, Estatus, estado FROM [LAT_MyNIKKEN].dbo.VolumeGlob with(nolock) WHERE Period = $periodo AND ltrim(rtrim(associateid)) LIKE '%03' AND associatetype=100", 'SQL173');
        return Excel::download(new volumenGlobal($data), 'volumen_global.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function posibleAvance(){
        // $periodo = request()->periodo;
        $coreApp = new coreApp();
        ini_set('memory_limit', '2048M');
        $data = $coreApp->execSQLQuery("SELECT Associateid,AssociateName, Rango,Pais,Period,QPV,QGV,QOV,QOVOPL,QOVOPSL,CASE WHEN Avance>0 THEN 'SI' ELSE 'NO' END as Avance,TipoAvance,QPV_Faltante,QGV_Faltante,QOV_Faltante,QOVOPL_Faltante,QOVOPSL_Faltante,Posible,Sponsorid, SponsorName, SponsorPais FROM LAT_MyNIKKEN.dbo.Posibles_AvancesLAT WHERE posible='SUP' AND period = 202407", 'SQL173');
        return Excel::download(new posibleAvance($data), 'Reconocimientos - Posibles avances de rango.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
