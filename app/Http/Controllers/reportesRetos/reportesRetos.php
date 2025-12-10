<?php

namespace App\Http\Controllers\reportesRetos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\coreApp;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\reportCVEmprendedor;
use App\Exports\volumenGlobal;
use App\Exports\posibleAvance;
use App\Exports\kinyaHistoric;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Style\Color;

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
        $data = $coreApp->execSQLQuery("SELECT Associateid, AssociateName,Rango, Pais, PV AS 'VP' ,GV AS 'VGP' ,OV AS 'VO',QOVOPL AS 'VO_LDP',QOVOPSL AS 'VO_LDPyS',Period AS 'Periodo',Sponsorid, SponsorName,SponsorPais, AssociateType, Estatus, TRANSLATE(estado, 'áéíóúÁÉÍÓÚ', 'aeiouAEIOU') AS estado FROM [LAT_MyNIKKEN].dbo.VolumeGlob with(nolock) WHERE Period = $periodo AND ltrim(rtrim(associateid)) LIKE '%03' AND associatetype=100", 'SQL173');
        return Excel::download(new volumenGlobal($data), 'volumen_global.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function posibleAvanceData(){
        $periodo = request()->periodo;
        $rango = request()->periodo2;

        $country = request()->country;
        $and = " AND Pais = '$country'";
        ($country == 'latam') ? $and = "" : null;

        $coreApp = new coreApp();
        ini_set('memory_limit', '2048M');
        $data = $coreApp->execSQLQuery("SELECT Associateid,AssociateName, Rango,Pais,Period,QPV,QGV,QOV,QOVOPL,QOVOPSL,CASE WHEN Avance>0 THEN 'SI' ELSE 'NO' END as Avance,TipoAvance,QPV_Faltante,QGV_Faltante,QOV_Faltante,QOVOPL_Faltante,QOVOPSL_Faltante,Posible,Sponsorid, SponsorName, SponsorPais FROM LAT_MyNIKKEN.dbo.Posibles_AvancesLAT WHERE posible='$rango' AND period = $periodo $and", 'SQL173');
        return Excel::download(new posibleAvance($data), 'Reconocimientos - Posibles avances de rango.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function kinyaHistoricData(){
        $periodo = request()->periodo;
        $periodo2 = request()->periodo2;

        $coreApp = new coreApp();
        ini_set('memory_limit', '2048M');
        $data = $coreApp->execSQLQuery("SELECT Associateid, AssociateName, Rango, Email, Telefono, Estado, Pais, Fecha_Incorp, VP_Mes, Periodo, Unidades_VentaDirecta, Unidades_PorInfluencer, Transformado, TotalUnidades, Total_Transfor_Mokuteki, Total_Incorpo_Influencer, Cumple_Kinya, kinya_PorVenta, kinya_PorInfluencia, Sponsorid, SponsorName, SponsorPais, Estatus 
        FROM RETOS_ESPECIALES..Reporte_Kinya_Historic WHERE Periodo BETWEEN $periodo AND  $periodo2 ORDER BY Periodo DESC,TotalUnidades DESC", 'SQL173');
        return Excel::download(new kinyaHistoric($data), 'Reconocimientos | KinYa! (Histórico).csv', \Maatwebsite\Excel\Excel::CSV);
    }

    ## Reporte de Club emprendedores
    public function vReporteVEmprendedores(){
        return view('vReporteVEmprendedores');
    }
    public function reportCVEmprendedor(){
        $sem = request()->s;
        $trim = request()->t;
        
        $core = new coreApp();
        $dataH1 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranetABIsParticipantes $sem, $trim;", "SQL173");
        $dataH2 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranetABIsNoParticipantes $sem, $trim;", "SQL173");
        $dataH3 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_DetalleIncorporaciones $sem, $trim;", "SQL173");
        $dataH4 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_DetalleKinya $sem, $trim;", "SQL173");

        $dataH5tb1 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porAnio_CantidadGanadores", "SQL173");
        $dataH5tb2 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porAnio_VentaDolaresGanadores", "SQL173");
        $dataH5tb3 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porAnio_VentaDolaresAbis100vp800vgp", "SQL173");
        $dataH5tb4 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porAnio_PorcVentaDolaresAbis100vp800vgp", "SQL173");
        $dataH5tb5 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porAnio_TotalAvancesRango", "SQL173");
        $dataH5tb6 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porAnio_TotalKinyaAbisDirectoPlata", "SQL173");
        $dataH5tb7 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porAnio_TotalIncorporacionConSistemaAguaDirctoPlata", "SQL173");

        $dataH6tb1 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porSemestre_CantidadGanadores", "SQL173");
        $dataH6tb2 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porSemestre_VentaDolaresGanadores", "SQL173");
        $dataH6tb3 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porSemestre_CantidadAbisCumpliendoTrim", "SQL173");
        $dataH6tb4 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porSemestre_PorcVentaPrograma", "SQL173");
        $dataH6tb5 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porSemestre_CantidadAbisVolVGP", "SQL173");
        $dataH6tb6 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porSemestre_TotalAvancesRango", "SQL173");
        $dataH6tb7 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porSemestre_TotalKinyaDirPlata", "SQL173");
        $dataH6tb8 = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2024_ReporteIntranet_porSemestre_TotalIncorporacionesSistemaDirPlata", "SQL173");
        
        ## Hoja 1
            $spreadsheet = new Spreadsheet();
            $sheet1 = $spreadsheet->getActiveSheet();
            $sheet1->setTitle("ABIs que participan");

            $imageUrl = 'https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png';
            $imageContent = file_get_contents($imageUrl);
            $tempImagePath = tempnam(sys_get_temp_dir(), 'image_') . '.png';
            file_put_contents($tempImagePath, $imageContent);

            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Paid');
            $drawing->setDescription('Paid');
            $drawing->setPath($tempImagePath);
            $drawing->setCoordinates('A1');
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(0);
            $drawing->setWidth(200);
            $drawing->setHeight(100);
            $drawing->setWorksheet($spreadsheet->getActiveSheet());
            
            $sheet1->mergeCells('B6:M6');
            $sheet1->getColumnDimension('A')->setAutoSize(true);
            $sheet1->setCellValue('A6', "Semestre de medición:");
            $sheet1->getStyle('A6')->getFont()->setBold(true);
            $sheet1->setCellValue('B6', "$sem");
            
            $sheet1->mergeCells('B7:M7');
            $sheet1->setCellValue('A7', "Trimestre de medición:");
            $sheet1->getStyle('A7')->getFont()->setBold(true);
            $sheet1->setCellValue('B7', "$trim");

            $sheet1->getStyle('A9:AL9')->getFont()->setBold(true);
            $sheet1->setCellValue('A9', 'Codigo Asesor');
            $sheet1->setCellValue('B9', 'Nombre Asesor');
            $sheet1->setCellValue('C9', 'Rango Inicial');
            $sheet1->setCellValue('D9', 'Rango Actual');
            $sheet1->setCellValue('E9', 'Teléfono Asesor');
            $sheet1->setCellValue('F9', 'pais');
            $sheet1->setCellValue('G9', 'Cod Patrocinador');
            $sheet1->setCellValue('H9', 'Nombre Patrocinador');
            $sheet1->setCellValue('I9', 'Rango Patrocinador');
            $sheet1->setCellValue('J9', 'País Patrocinador');
            $sheet1->setCellValue('K9', 'Semestre Participacion');
            $sheet1->setCellValue('L9', 'Mes Inicio Semestre');
            $sheet1->setCellValue('M9', 'Mes Fin Semestre');
            $sheet1->setCellValue('N9', 'vgp Acumulado');
            $sheet1->setCellValue('O9', 'vgp Restante');
            $sheet1->setCellValue('P9', 'Mes Inicio Trim');
            $sheet1->setCellValue('Q9', 'Mes Fin Trim');
            $sheet1->setCellValue('R9', 'vgp Acumulado Trim');
            $sheet1->setCellValue('S9', 'vgp Restante Trim');
            $sheet1->setCellValue('T9', 'vp Acumulado Trim');
            $sheet1->setCellValue('U9', 'vp Restante Trim1');
            $sheet1->setCellValue('V9', 'vp Mes 1');
            $sheet1->setCellValue('W9', 'vp Mes 2');
            $sheet1->setCellValue('X9', 'vp Mes 3');
            $sheet1->setCellValue('Y9', 'vp Realizado Mes 1');
            $sheet1->setCellValue('Z9', 'vp Faltantes Mes 1');
            $sheet1->setCellValue('AA9', 'vgp Mes 1');
            $sheet1->setCellValue('AB9', 'vgp Mes 2');
            $sheet1->setCellValue('AC9', 'vgp Mes 3');
            $sheet1->setCellValue('AD9', 'vgp Realizado Mes 1');
            $sheet1->setCellValue('AE9', 'vgp Faltantes Mes 1');
            $sheet1->setCellValue('AF9', 'cantidad Kinya Mes 1');
            $sheet1->setCellValue('AG9', 'kinya Realizados Mes 1');
            $sheet1->setCellValue('AH9', 'kinya Faltantes Mes 1');
            $sheet1->setCellValue('AI9', 'cantidad Frontales Mes 1');
            $sheet1->setCellValue('AJ9', 'Frontales Realizados Mes 1');
            $sheet1->setCellValue('AK9', 'Frontales Faltantes Mes 1');
            $sheet1->setCellValue('AL9', 'Ganador trimestre 1');

            $startColumn = 'A';
            $endColumn = 'Z';
            $this->setAutoSizeColumns($sheet1, $startColumn, $endColumn);

            $row = 10;
            foreach ($dataH1 as $r) {
                $sheet1->setCellValue("A$row", $r->CodAsesor);
                $sheet1->setCellValue("B$row", $r->NombreAsesor);
                $sheet1->setCellValue("C$row", $r->RangoInicial);
                $sheet1->setCellValue("D$row", $r->RangoActual);
                $sheet1->setCellValue("E$row", $r->TelefonoAsesor);
                $sheet1->setCellValue("F$row", $r->pais);
                $sheet1->setCellValue("G$row", $r->CodPatrocinador);
                $sheet1->setCellValue("H$row", $r->NombrePatrocinador);
                $sheet1->setCellValue("I$row", $r->RangoPatrocinador);
                $sheet1->setCellValue("J$row", $r->PaisPatrocinador);
                $sheet1->setCellValue("K$row", $r->SemestreParticipacion);
                $sheet1->setCellValue("L$row", $r->MesInicioSemestre);
                $sheet1->setCellValue("M$row", $r->MesFinSemestre);
                $sheet1->setCellValue("N$row", $r->vgpAcumulado);
                $sheet1->setCellValue("O$row", $r->vgpRestante);
                $sheet1->setCellValue("P$row", $r->MesInicioTrim1);
                $sheet1->setCellValue("Q$row", $r->MesFinTrim1);
                $sheet1->setCellValue("R$row", $r->vgpAcumuladoTrim1);
                $sheet1->setCellValue("S$row", $r->vgpRestanteTrim1);
                $sheet1->setCellValue("T$row", $r->vpAcumuladoTrim1);
                $sheet1->setCellValue("U$row", $r->vpRestanteTrim1);
                $sheet1->setCellValue("V$row", $r->vpMes1);
                $sheet1->setCellValue("W$row", $r->vpMes2);
                $sheet1->setCellValue("X$row", $r->vpMes3);
                $sheet1->setCellValue("Y$row", $r->vpRealizadoMes1);
                $sheet1->setCellValue("Z$row", $r->vpFaltantesMes1);
                $sheet1->setCellValue("AA$row", $r->vgpMes1);
                $sheet1->setCellValue("AB$row", $r->vgpMes2);
                $sheet1->setCellValue("AC$row", $r->vgpMes3);
                $sheet1->setCellValue("AD$row", $r->vgpRealizadoMes1);
                $sheet1->setCellValue("AE$row", $r->vgpFaltantesMes1);
                $sheet1->setCellValue("AF$row", $r->cantidadKinyaMes1);
                $sheet1->setCellValue("AG$row", $r->kinyaRealizadosMes1);
                $sheet1->setCellValue("AH$row", $r->kinyaFaltantesMes1);
                $sheet1->setCellValue("AI$row", $r->cantidadFrontalesMes1);
                $sheet1->setCellValue("AJ$row", $r->FrontalesRealizadosMes1);
                $sheet1->setCellValue("AK$row", $r->FrontalesFaltantesMes1);
                $sheet1->setCellValue("AL$row", $r->Ganadortrimestre1);
                $row++;
            }
        ## / Hoja 1

        ## Hoja 2
            $sheet1 = $spreadsheet->createSheet();
            $sheet1->setTitle("ABIs que no participan");

            $imageUrl = 'https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png';
            $imageContent = file_get_contents($imageUrl);
            $tempImagePath = tempnam(sys_get_temp_dir(), 'image_') . '.png';
            file_put_contents($tempImagePath, $imageContent);

            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Paid');
            $drawing->setDescription('Paid');
            $drawing->setPath($tempImagePath);
            $drawing->setCoordinates('A1');
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(0);
            $drawing->setWidth(200);
            $drawing->setHeight(100);
            $drawing->setWorksheet($spreadsheet->setActiveSheetIndex(1));
            
            $sheet1->mergeCells('B6:M6');
            $sheet1->getColumnDimension('A')->setAutoSize(true);
            $sheet1->setCellValue('A6', "Semestre de medición:");
            $sheet1->getStyle('A6')->getFont()->setBold(true);
            $sheet1->setCellValue('B6', "$sem");
            
            $sheet1->mergeCells('B7:M7');
            $sheet1->setCellValue('A7', "Trimestre de medición:");
            $sheet1->getStyle('A7')->getFont()->setBold(true);
            $sheet1->setCellValue('B7', "$trim");

            $sheet1->getStyle('A9:BI9')->getFont()->setBold(true);
            $sheet1->setCellValue("A9", 'Cod Asesor');
            $sheet1->setCellValue("B9", 'Nombre Asesor');
            $sheet1->setCellValue("C9", 'Rango Inicial');
            $sheet1->setCellValue("D9", 'Rango Actual');
            $sheet1->setCellValue("E9", 'Telefono Asesor');
            $sheet1->setCellValue("F9", 'pais');
            $sheet1->setCellValue("G9", 'Cod Patrocinador');
            $sheet1->setCellValue("H9", 'Nombre Patrocinador');
            $sheet1->setCellValue("I9", 'Rango Patrocinador');
            $sheet1->setCellValue("J9", 'Pais Patrocinador');
            $sheet1->setCellValue("K9", 'Semestre Participacion');
            $sheet1->setCellValue("L9", 'Mes Inicio Semestre');
            $sheet1->setCellValue("M9", 'Mes Fin Semestre');
            $sheet1->setCellValue("N9", 'vgp Acumulado');
            $sheet1->setCellValue("O9", 'vgp Restante');
            $sheet1->setCellValue("P9", 'Mes Inicio Trim 1');
            $sheet1->setCellValue("Q9", 'Mes FinTrim 1');
            $sheet1->setCellValue("R9", 'vgp Acumulado Trim 1');
            $sheet1->setCellValue("S9", 'vgp Restante Trim 1');
            $sheet1->setCellValue("T9", 'vp Acumulado Trim 1');
            $sheet1->setCellValue("U9", 'vp Restante Trim 1');
            $sheet1->setCellValue("V9", 'vp Mes 1');
            $sheet1->setCellValue("W9", 'vp Mes 2');
            $sheet1->setCellValue("X9", 'vp Mes 3');
            $sheet1->setCellValue("Y9", 'vp Realizado Mes 1');
            $sheet1->setCellValue("Z9", 'vp Faltantes Mes 1');
            $sheet1->setCellValue("AA9", 'vgp Mes 1');
            $sheet1->setCellValue("AB9", 'vgp Mes 2');
            $sheet1->setCellValue("AC9", 'vgp Mes 3');
            $sheet1->setCellValue("AD9", 'vgp Realizado Mes 1');
            $sheet1->setCellValue("AE9", 'vgp Faltantes Mes 1');
            $sheet1->setCellValue("AF9", 'cantidad Kinya Mes 1');
            $sheet1->setCellValue("AG9", 'kinya Realizados Mes 1');
            $sheet1->setCellValue("AH9", 'kinya Faltantes Mes 1');
            $sheet1->setCellValue("AI9", 'cantidad Frontales Mes 1');
            $sheet1->setCellValue("AJ9", 'Frontales Realizados Mes 1');
            $sheet1->setCellValue("AK9", 'Frontales Faltantes Mes 1');
            $sheet1->setCellValue("AL9", 'Ganador trimestre 1');

            $startColumn = 'A';
            $endColumn = 'Z';
            $this->setAutoSizeColumns($sheet1, $startColumn, $endColumn);

            $row = 10;
            foreach ($dataH2 as $r) {
                $sheet1->setCellValue("A$row", $r->CodAsesor);
                $sheet1->setCellValue("B$row", $r->NombreAsesor);
                $sheet1->setCellValue("C$row", $r->RangoInicial);
                $sheet1->setCellValue("D$row", $r->RangoActual);
                $sheet1->setCellValue("E$row", $r->TelefonoAsesor);
                $sheet1->setCellValue("F$row", $r->pais);
                $sheet1->setCellValue("G$row", $r->CodPatrocinador);
                $sheet1->setCellValue("H$row", $r->NombrePatrocinador);
                $sheet1->setCellValue("I$row", $r->RangoPatrocinador);
                $sheet1->setCellValue("J$row", $r->PaisPatrocinador);
                $sheet1->setCellValue("K$row", $r->SemestreParticipacion);
                $sheet1->setCellValue("L$row", $r->MesInicioSemestre);
                $sheet1->setCellValue("M$row", $r->MesFinSemestre);
                $sheet1->setCellValue("N$row", $r->vgpAcumulado);
                $sheet1->setCellValue("O$row", $r->vgpRestante);
                $sheet1->setCellValue("P$row", $r->MesInicioTrim1);
                $sheet1->setCellValue("Q$row", $r->MesFinTrim1);
                $sheet1->setCellValue("R$row", $r->vgpAcumuladoTrim1);
                $sheet1->setCellValue("S$row", $r->vgpRestanteTrim1);
                $sheet1->setCellValue("T$row", $r->vpAcumuladoTrim1);
                $sheet1->setCellValue("U$row", $r->vpRestanteTrim1);
                $sheet1->setCellValue("V$row", $r->vpMes1);
                $sheet1->setCellValue("W$row", $r->vpMes2);
                $sheet1->setCellValue("X$row", $r->vpMes3);
                $sheet1->setCellValue("Y$row", $r->vpRealizadoMes1);
                $sheet1->setCellValue("Z$row", $r->vpFaltantesMes1);
                $sheet1->setCellValue("AA$row", $r->vgpMes1);
                $sheet1->setCellValue("AB$row", $r->vgpMes2);
                $sheet1->setCellValue("AC$row", $r->vgpMes3);
                $sheet1->setCellValue("AD$row", $r->vgpRealizadoMes1);
                $sheet1->setCellValue("AE$row", $r->vgpFaltantesMes1);
                $sheet1->setCellValue("AF$row", $r->cantidadKinyaMes1);
                $sheet1->setCellValue("AG$row", $r->kinyaRealizadosMes1);
                $sheet1->setCellValue("AH$row", $r->kinyaFaltantesMes1);
                $sheet1->setCellValue("AI$row", $r->cantidadFrontalesMes1);
                $sheet1->setCellValue("AJ$row", $r->FrontalesRealizadosMes1);
                $sheet1->setCellValue("AK$row", $r->FrontalesFaltantesMes1);
                $sheet1->setCellValue("AL$row", $r->Ganadortrimestre1);
                $row++;
            }
        ## / Hoja 2

        ## Hoja 3
            $sheet1 = $spreadsheet->createSheet();
            $sheet1->setTitle("Detalle de Incorporaciones");

            $imageUrl = 'https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png';
            $imageContent = file_get_contents($imageUrl);
            $tempImagePath = tempnam(sys_get_temp_dir(), 'image_') . '.png';
            file_put_contents($tempImagePath, $imageContent);

            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Paid');
            $drawing->setDescription('Paid');
            $drawing->setPath($tempImagePath);
            $drawing->setCoordinates('A1');
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(0);
            $drawing->setWidth(200);
            $drawing->setHeight(100);
            $drawing->setWorksheet($spreadsheet->setActiveSheetIndex(2));
            
            $sheet1->mergeCells('B6:M6');
            $sheet1->getColumnDimension('A')->setAutoSize(true);
            $sheet1->setCellValue('A6', "Semestre de medición:");
            $sheet1->getStyle('A6')->getFont()->setBold(true);
            $sheet1->setCellValue('B6', "$sem");
            
            $sheet1->mergeCells('B7:M7');
            $sheet1->setCellValue('A7', "Trimestre de medición:");
            $sheet1->getStyle('A7')->getFont()->setBold(true);
            $sheet1->setCellValue('B7', "$trim");

            $sheet1->getStyle('A9:BI9')->getFont()->setBold(true);
            $sheet1->setCellValue("A9", 'Cod Asesor');
            $sheet1->setCellValue("B9", 'Nombre Asesor');
            $sheet1->setCellValue("C9", 'pais');
            $sheet1->setCellValue("D9", 'Fecha Incorporado');
            $sheet1->setCellValue("E9", 'Item code');
            $sheet1->setCellValue("F9", 'Descripcion');
            $sheet1->setCellValue("G9", 'Cantidad');
            $sheet1->setCellValue("H9", 'Periodo');
            $sheet1->setCellValue("I9", 'Sponsor Code');
            $sheet1->setCellValue("J9", 'Sponsor Name');
            $sheet1->setCellValue("K9", 'Sponsor Rango');
            $sheet1->setCellValue("L9", 'Sponsor Pais');

            $startColumn = 'A';
            $endColumn = 'Z';
            $this->setAutoSizeColumns($sheet1, $startColumn, $endColumn);

            $row = 10;
            foreach ($dataH3 as $r) {
                $sheet1->setCellValue("A$row", $r->CodAsesor);
                $sheet1->setCellValue("B$row", $r->NombreAsesor);
                $sheet1->setCellValue("C$row", $r->pais);
                $sheet1->setCellValue("D$row", $r->FechaIncorporado);
                $sheet1->setCellValue("E$row", $r->Itemcode);
                $sheet1->setCellValue("F$row", $r->Descripcion);
                $sheet1->setCellValue("G$row", $r->Cantidad);
                $sheet1->setCellValue("H$row", $r->Periodo);
                $sheet1->setCellValue("I$row", $r->SponsorCode);
                $sheet1->setCellValue("J$row", $r->SponsorName);
                $sheet1->setCellValue("K$row", $r->SponsorRango);
                $sheet1->setCellValue("L$row", $r->SponsorPais);
                $row++;
            }
        ## / Hoja 3

        ## Hoja 4
            $sheet1 = $spreadsheet->createSheet();
            $sheet1->setTitle("Detalle de Kinya");

            $imageUrl = 'https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png';
            $imageContent = file_get_contents($imageUrl);
            $tempImagePath = tempnam(sys_get_temp_dir(), 'image_') . '.png';
            file_put_contents($tempImagePath, $imageContent);

            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Paid');
            $drawing->setDescription('Paid');
            $drawing->setPath($tempImagePath);
            $drawing->setCoordinates('A1');
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(0);
            $drawing->setWidth(200);
            $drawing->setHeight(100);
            $drawing->setWorksheet($spreadsheet->setActiveSheetIndex(3));
            
            $sheet1->mergeCells('B6:M6');
            $sheet1->getColumnDimension('A')->setAutoSize(true);
            $sheet1->setCellValue('A6', "Semestre de medición:");
            $sheet1->getStyle('A6')->getFont()->setBold(true);
            $sheet1->setCellValue('B6', "$sem");
            
            $sheet1->mergeCells('B7:M7');
            $sheet1->setCellValue('A7', "Trimestre de medición:");
            $sheet1->getStyle('A7')->getFont()->setBold(true);
            $sheet1->setCellValue('B7', "$trim");

            $sheet1->getStyle('A9:BI9')->getFont()->setBold(true);
            $sheet1->setCellValue("A9", 'Cod Asesor');
            $sheet1->setCellValue("B9", 'Nombre Asesor');
            $sheet1->setCellValue("C9", 'pais');
            $sheet1->setCellValue("D9", 'Num Orden');
            $sheet1->setCellValue("E9", 'Tipo Documento');
            $sheet1->setCellValue("F9", 'Item code');
            $sheet1->setCellValue("G9", 'Descripcion');
            $sheet1->setCellValue("H9", 'Cantidad');
            $sheet1->setCellValue("I9", 'Fecha Orden');
            $sheet1->setCellValue("J9", 'periodo');

            $startColumn = 'A';
            $endColumn = 'Z';
            $this->setAutoSizeColumns($sheet1, $startColumn, $endColumn);

            $row = 10;
            foreach ($dataH4 as $r) {
                $sheet1->setCellValue("A$row", $r->CodAsesor);
                $sheet1->setCellValue("B$row", $r->NombreAsesor);
                $sheet1->setCellValue("C$row", $r->pais);
                $sheet1->setCellValue("D$row", $r->NumOrden);
                $sheet1->setCellValue("E$row", $r->TipoDocumento);
                $sheet1->setCellValue("F$row", $r->Itemcode);
                $sheet1->setCellValue("G$row", $r->Descripcion);
                $sheet1->setCellValue("H$row", $r->Cantidad);
                $sheet1->setCellValue("I$row", $r->FechaOrden);
                $sheet1->setCellValue("J$row", $r->periodo);
                $row++;
            }
        ## / Hoja 4

        ## Hoja 5
            $sheet1 = $spreadsheet->createSheet();
            $sheet1->setTitle("Reporte por Año");

            $imageUrl = 'https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png';
            $imageContent = file_get_contents($imageUrl);
            $tempImagePath = tempnam(sys_get_temp_dir(), 'image_') . '.png';
            file_put_contents($tempImagePath, $imageContent);

            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Paid');
            $drawing->setDescription('Paid');
            $drawing->setPath($tempImagePath);
            $drawing->setCoordinates('D1');
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(0);
            $drawing->setWidth(200);
            $drawing->setHeight(100);
            $drawing->setWorksheet($spreadsheet->setActiveSheetIndex(4));
            
            $sheet1->mergeCells('A1:C1');
            $sheet1->getColumnDimension('A')->setAutoSize(true);
            $sheet1->setCellValue('A1', "NIKKEN Latinoamérica");
            $sheet1->getStyle('A1')->getFont()->setBold(true);
            
            $startColumn = 'A';
            $endColumn = 'Z';
            $this->setAutoSizeColumns($sheet1, $startColumn, $endColumn);
            
            $sheet1->mergeCells('A2:C2');
            $sheet1->setCellValue('A2', "Tablero consolidado de ganadores - Retos de Negocio");
            $sheet1->getStyle('A2')->getFont()->setBold(true);
            
            $sheet1->mergeCells('A3:C3');
            $sheet1->setCellValue('A3', "Club Emprendedores (Directos a Platas)");
            $sheet1->getStyle('A3')->getFont()->setBold(true);
            
            $sheet1->mergeCells('A6:C6');
            $sheet1->setCellValue('A6', "Año 2024 (Enero a Septiembre)");
            $sheet1->getStyle('A6')->getFont()->setBold(true);
            
            $sheet1->mergeCells('A7:C7');
            $sheet1->setCellValue('A7', "imprimir fecha de consulta y mes de cierre de medición");
            $sheet1->getStyle('A7')->getFont()->setBold(true);
            
            $sheet1->mergeCells('A9:C9');
            $sheet1->setCellValue('A9', "Cantidad de ganadores");
            $sheet1->getStyle('A9')->getFont()->setBold(true);
            $sheet1->mergeCells('B11:C11');
            $sheet1->setCellValue('B11', "Semestre 1 Enero - Junio");
            $sheet1->getStyle('B11')->getFont()->setBold(true);
            $sheet1->mergeCells('D11:E11');
            $sheet1->setCellValue('D11', "Semestre 2 Febrero - Julio");
            $sheet1->getStyle('D11')->getFont()->setBold(true);
            $sheet1->mergeCells('F11:G11');
            $sheet1->setCellValue('F11', "Semestre 3 Marzo - Agosto");
            $sheet1->getStyle('F11')->getFont()->setBold(true);
            $sheet1->mergeCells('H11:I11');
            $sheet1->setCellValue('H11', "Semestre 4 Abril - Septiembre");
            $sheet1->getStyle('H11')->getFont()->setBold(true);

            ## tabla 1
                $sheet1->getStyle('A12:K12')->getFont()->setBold(true);
                $sheet1->setCellValue("A12", 'País ');
                $sheet1->setCellValue("B12", 'Trimestre 1 (Ene-Mar)');
                $sheet1->setCellValue("C12", 'Trimestre 2 (Abr-Jun)');
                $sheet1->setCellValue("D12", 'Trimestre 1 (Feb-Abr)');
                $sheet1->setCellValue("E12", 'Trimestre 2 (May-Jul)');
                $sheet1->setCellValue("F12", 'Trimestre 1 (Mar- May )');
                $sheet1->setCellValue("G12", 'Trimestre 2 (Jun-Ago)');
                $sheet1->setCellValue("H12", 'Trimestre 1 (Abr-Jun)');
                $sheet1->setCellValue("I12", 'Trimestre 2 (Jul-Sep)');
                $sheet1->setCellValue("J12", 'Total');
                $sheet1->setCellValue("K12", '% Ganadores');
                $row = 13;
                foreach ($dataH5tb1 as $r) {
                    $sheet1->getStyle("A$row")->getFont()->setBold(true);
                    $sheet1->setCellValue("A$row", $r->pais);
                    $sheet1->setCellValue("B$row", $r->semestreUnoTrimUno);
                    $sheet1->setCellValue("C$row", $r->semestreUnoTrimDos);
                    $sheet1->setCellValue("D$row", $r->semestreDosTrimUno);
                    $sheet1->setCellValue("E$row", $r->semestreDosTrimDos);
                    $sheet1->setCellValue("F$row", $r->semestreTresTrimUno);
                    $sheet1->setCellValue("G$row", $r->semestretresTrimDos);
                    $sheet1->setCellValue("H$row", $r->semestreCuatroTrimUno);
                    $sheet1->setCellValue("I$row", $r->semestreCuatroTrimDos);
                    $sheet1->setCellValue("J$row", $r->total);
                    $sheet1->setCellValue("K$row", $r->porcGanadores);
                    $row++;
                }
            ## tabla 1

            ## tabla 2
                $sheet1->mergeCells('A25:C25');
                $sheet1->setCellValue('A25', "Semestre 4 Abril - Septiembre");
                $sheet1->getStyle('A25')->getFont()->setBold(true);
                $sheet1->getStyle('A28:L28')->getFont()->setBold(true);
                $sheet1->setCellValue("A28", 'País ');
                $sheet1->setCellValue("B28", 'Enero');
                $sheet1->setCellValue("C28", 'Febrero');
                $sheet1->setCellValue("D28", 'Marzo');
                $sheet1->setCellValue("E28", 'Abril');
                $sheet1->setCellValue("F28", 'Mayo');
                $sheet1->setCellValue("G28", 'Junio');
                $sheet1->setCellValue("H28", 'Julio');
                $sheet1->setCellValue("I28", 'Agosto');
                $sheet1->setCellValue("J28", 'Septiembre');
                $sheet1->setCellValue("K28", 'Total');
                $sheet1->setCellValue("L28", '% Ganadores');
                $row = 29;
                foreach ($dataH5tb2 as $r) {
                    $sheet1->getStyle("A$row")->getFont()->setBold(true);
                    $sheet1->setCellValue("A$row", $r->nombrePais);
                    $sheet1->setCellValue("B$row", $r->Enero);
                    $sheet1->setCellValue("C$row", $r->Febreo);
                    $sheet1->setCellValue("D$row", $r->Marzo);
                    $sheet1->setCellValue("E$row", $r->abril);
                    $sheet1->setCellValue("F$row", $r->mayo);
                    $sheet1->setCellValue("G$row", $r->junio);
                    $sheet1->setCellValue("H$row", $r->julio);
                    $sheet1->setCellValue("I$row", $r->agosto);
                    $sheet1->setCellValue("J$row", $r->septiembre);
                    $sheet1->setCellValue("K$row", $r->total);
                    // $sheet1->setCellValue("L$row", $r->);
                    $row++;
                }
            ## tabla 2

            ## tabla 3
                $sheet1->mergeCells('A41:C41');
                $sheet1->setCellValue('A41', "Venta generada por el programa con ABIs minimo 100 de VP y 800 de VGP en dólares");
                $sheet1->getStyle('A41')->getFont()->setBold(true);
                $sheet1->getStyle('A44:L44')->getFont()->setBold(true);
                $sheet1->setCellValue("A44", 'País ');
                $sheet1->setCellValue("B44", 'Enero');
                $sheet1->setCellValue("C44", 'Febrero');
                $sheet1->setCellValue("D44", 'Marzo');
                $sheet1->setCellValue("E44", 'Abril');
                $sheet1->setCellValue("F44", 'Mayo');
                $sheet1->setCellValue("G44", 'Junio');
                $sheet1->setCellValue("H44", 'Julio');
                $sheet1->setCellValue("I44", 'Agosto');
                $sheet1->setCellValue("J44", 'Septiembre');
                $sheet1->setCellValue("K44", 'Total');
                $sheet1->setCellValue("L44", '% Ganadores');
                $row = 45;
                foreach ($dataH5tb3 as $r) {
                    $sheet1->getStyle("A$row")->getFont()->setBold(true);
                    $sheet1->setCellValue("A$row", $r->nombrePais);
                    $sheet1->setCellValue("B$row", $r->Enero);
                    $sheet1->setCellValue("C$row", $r->Febreo);
                    $sheet1->setCellValue("D$row", $r->Marzo);
                    $sheet1->setCellValue("E$row", $r->abril);
                    $sheet1->setCellValue("F$row", $r->mayo);
                    $sheet1->setCellValue("G$row", $r->junio);
                    $sheet1->setCellValue("H$row", $r->julio);
                    $sheet1->setCellValue("I$row", $r->agosto);
                    $sheet1->setCellValue("J$row", $r->septiembre);
                    $sheet1->setCellValue("K$row", $r->total);
                    // $sheet1->setCellValue("L$row", $r->);
                    $row++;
                }
            ## tabla 3

            ## tabla 4
                $sheet1->mergeCells('A57:C57');
                $sheet1->setCellValue('A57', "% Venta representa el programa Club Viajero Emprendedor (Abis 100 de Vp y 800 VGP)");
                $sheet1->getStyle('A57')->getFont()->setBold(true);
                $sheet1->getStyle('A60:L60')->getFont()->setBold(true);
                $sheet1->setCellValue("A60", 'País ');
                $sheet1->setCellValue("B60", 'Enero');
                $sheet1->setCellValue("C60", 'Febrero');
                $sheet1->setCellValue("D60", 'Marzo');
                $sheet1->setCellValue("E60", 'Abril');
                $sheet1->setCellValue("F60", 'Mayo');
                $sheet1->setCellValue("G60", 'Junio');
                $sheet1->setCellValue("H60", 'Julio');
                $sheet1->setCellValue("I60", 'Agosto');
                $sheet1->setCellValue("J60", 'Septiembre');
                $sheet1->setCellValue("K60", 'Total');
                $sheet1->setCellValue("L60", '% Ganadores');
                $row = 61;
                foreach ($dataH5tb4 as $r) {
                    $sheet1->getStyle("A$row")->getFont()->setBold(true);
                    $sheet1->setCellValue("A$row", $r->nombrePais);
                    $sheet1->setCellValue("B$row", $r->Enero);
                    $sheet1->setCellValue("C$row", $r->Febreo);
                    $sheet1->setCellValue("D$row", $r->Marzo);
                    $sheet1->setCellValue("E$row", $r->abril);
                    $sheet1->setCellValue("F$row", $r->mayo);
                    $sheet1->setCellValue("G$row", $r->junio);
                    $sheet1->setCellValue("H$row", $r->julio);
                    $sheet1->setCellValue("I$row", $r->agosto);
                    $sheet1->setCellValue("J$row", $r->septiembre);
                    $sheet1->setCellValue("K$row", $r->total);
                    // $sheet1->setCellValue("L$row", $r->);
                    $row++;
                }
            ## tabla 4

            ## tabla 5
                $sheet1->mergeCells('A72:C72');
                $sheet1->setCellValue('A72', "Total avances de rango en el año ");
                $sheet1->getStyle('A72')->getFont()->setBold(true);
                $sheet1->getStyle('A75:L75')->getFont()->setBold(true);
                $sheet1->setCellValue("A75", 'País  ');
                $sheet1->setCellValue("B75", 'México ');
                $sheet1->setCellValue("C75", 'Colombia ');
                $sheet1->setCellValue("D75", 'Perú');
                $sheet1->setCellValue("E75", 'Ecuador ');
                $sheet1->setCellValue("F75", 'Costa Rica');
                $sheet1->setCellValue("G75", 'Panamá');
                $sheet1->setCellValue("H75", 'Guatemala');
                $sheet1->setCellValue("I75", 'Chile');
                $sheet1->setCellValue("J75", 'El Salvador');
                $sheet1->setCellValue("K75", 'Total Año');
                $row = 76;
                foreach ($dataH5tb5 as $r) {
                    $sheet1->getStyle("A$row")->getFont()->setBold(true);
                    $sheet1->setCellValue("A$row", $r->rango);
                    $sheet1->setCellValue("B$row", $r->México);
                    $sheet1->setCellValue("C$row", $r->Colombia);
                    $sheet1->setCellValue("D$row", $r->Perú);
                    $sheet1->setCellValue("E$row", $r->Ecuador);
                    $sheet1->setCellValue("F$row", $r->Costa_Rica);
                    $sheet1->setCellValue("G$row", $r->Panamá);
                    $sheet1->setCellValue("H$row", $r->Guatemala);
                    $sheet1->setCellValue("I$row", $r->Chile);
                    $sheet1->setCellValue("J$row", $r->El_Salvador);
                    $sheet1->setCellValue("K$row", $r->Total_Año);
                    $row++;
                }
            ## tabla 5
            
            ## tabla 6
                $sheet1->mergeCells('A82:C82');
                $sheet1->setCellValue('A82', "Total KinYa de los Abis Directo a Plata");
                $sheet1->getStyle('A82')->getFont()->setBold(true);
                $sheet1->getStyle('A84:L84')->getFont()->setBold(true);
                $sheet1->setCellValue("A84", 'País ');
                $sheet1->setCellValue("B84", 'Enero');
                $sheet1->setCellValue("C84", 'Febrero');
                $sheet1->setCellValue("D84", 'Marzo');
                $sheet1->setCellValue("E84", 'Abril');
                $sheet1->setCellValue("F84", 'Mayo');
                $sheet1->setCellValue("G84", 'Junio');
                $sheet1->setCellValue("H84", 'Julio');
                $sheet1->setCellValue("I84", 'Agosto');
                $sheet1->setCellValue("J84", 'Septiembre');
                $sheet1->setCellValue("K84", 'Total Año');
                $row = 85;
                foreach ($dataH5tb6 as $r) {
                    $sheet1->getStyle("A$row")->getFont()->setBold(true);
                    $sheet1->setCellValue("A$row", $r->pais);
                    $sheet1->setCellValue("B$row", $r->Enero);
                    $sheet1->setCellValue("C$row", $r->Febrero);
                    $sheet1->setCellValue("D$row", $r->Marzo);
                    $sheet1->setCellValue("E$row", $r->Abril);
                    $sheet1->setCellValue("F$row", $r->Mayo);
                    $sheet1->setCellValue("G$row", $r->Junio);
                    $sheet1->setCellValue("H$row", $r->Julio);
                    $sheet1->setCellValue("I$row", $r->Agosto);
                    $sheet1->setCellValue("J$row", $r->Septiembre);
                    $sheet1->setCellValue("K$row", $r->Total_Año);
                    $row++;
                }
            ## tabla 6
            
            ## tabla 7
                $sheet1->mergeCells('A97:C97');
                $sheet1->setCellValue('A97', "Total Incorporaciones con Sistema de Agua de Directo a Plata");
                $sheet1->getStyle('A97')->getFont()->setBold(true);
                $sheet1->getStyle('A99:L99')->getFont()->setBold(true);
                $sheet1->setCellValue("A99", 'País ');
                $sheet1->setCellValue("B99", 'Enero');
                $sheet1->setCellValue("C99", 'Febrero');
                $sheet1->setCellValue("D99", 'Marzo');
                $sheet1->setCellValue("E99", 'Abril');
                $sheet1->setCellValue("F99", 'Mayo');
                $sheet1->setCellValue("G99", 'Junio');
                $sheet1->setCellValue("H99", 'Julio');
                $sheet1->setCellValue("I99", 'Agosto');
                $sheet1->setCellValue("J99", 'Septiembre');
                $sheet1->setCellValue("K99", 'Total Año');
                $row = 100;
                foreach ($dataH5tb7 as $r) {
                    $sheet1->getStyle("A$row")->getFont()->setBold(true);
                    $sheet1->setCellValue("A$row", $r->pais);
                    $sheet1->setCellValue("B$row", $r->Enero);
                    $sheet1->setCellValue("C$row", $r->Febrero);
                    $sheet1->setCellValue("D$row", $r->Marzo);
                    $sheet1->setCellValue("E$row", $r->Abril);
                    $sheet1->setCellValue("F$row", $r->Mayo);
                    $sheet1->setCellValue("G$row", $r->Junio);
                    $sheet1->setCellValue("H$row", $r->Julio);
                    $sheet1->setCellValue("I$row", $r->Agosto);
                    $sheet1->setCellValue("J$row", $r->Septiembre);
                    $sheet1->setCellValue("K$row", $r->Total_Año);
                    $row++;
                }
            ## tabla 7
        ## / Hoja 5

        ## Hoja 6
            $sheet1 = $spreadsheet->createSheet();
            $sheet1->setTitle("Reporte por Semestre");

            $imageUrl = 'https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png';
            $imageContent = file_get_contents($imageUrl);
            $tempImagePath = tempnam(sys_get_temp_dir(), 'image_') . '.png';
            file_put_contents($tempImagePath, $imageContent);

            $sheet = 

            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Paid');
            $drawing->setDescription('Paid');
            $drawing->setPath($tempImagePath);
            $drawing->setCoordinates('A1');
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(0);
            $drawing->setWidth(200);
            $drawing->setHeight(100);
            $drawing->setWorksheet($spreadsheet->setActiveSheetIndex(5));
            
            $sheet1->getColumnDimension('A')->setAutoSize(true);
            $sheet1->setCellValue('A6', "Semestre de medición:");
            $sheet1->getStyle('A6')->getFont()->setBold(true);
            $sheet1->getColumnDimension('C')->setAutoSize(true);
            $sheet1->setCellValue('C6', "Enero-Junio/2024");
            $sheet1->getStyle('C6')->getFont()->setBold(true);
            
            $sheet1->mergeCells('A8:D8');
            $sheet1->setCellValue('A8', Date('Y-m-d H:i:s'));
            $sheet1->getStyle('A8')->getFont()->setBold(true);
            
            $startColumn = 'A';
            $endColumn = 'Z';
            $this->setAutoSizeColumns($sheet1, $startColumn, $endColumn);
            
            $sheet1->mergeCells('A10:D10');
            $sheet1->setCellValue('A10', "Resumen Ejecutivo por variable");
            $sheet1->getStyle('A10')->getFont()->setBold(true);
            
            ## tabla 1
                $sheet1->mergeCells('A12:D12');
                $sheet1->setCellValue('A12', "Cantidad de ganadores");
                $sheet1->getStyle('A12')->getFont()->setBold(true);
                $sheet1->getStyle('A14:F14')->getFont()->setBold(true);
                $sheet1->setCellValue("A14", 'País');
                $sheet1->setCellValue("B14", 'Directo');
                $sheet1->setCellValue("C14", 'Superior');
                $sheet1->setCellValue("D14", 'Ejecutivo');
                $sheet1->setCellValue("E14", 'Plata');
                $sheet1->setCellValue("F14", 'Total');  
                $row = 15;
                foreach ($dataH6tb1 as $r) {
                    $sheet1->setCellValue("A$row", $r->pais);
                    $sheet1->setCellValue("B$row", $r->Directo);
                    $sheet1->setCellValue("C$row", $r->Executivo);
                    $sheet1->setCellValue("D$row", $r->Superior);
                    $sheet1->setCellValue("E$row", $r->Plata);
                    $sheet1->setCellValue("F$row", $r->Total);
                    $row++;
                }
            ## tabla 1
            
            ## tabla 2
                $sheet1->mergeCells('H12:K12');
                $sheet1->setCellValue('H12', "Venta generada por los ganadores en USD");
                $sheet1->getStyle('H12')->getFont()->setBold(true);
                $sheet1->getStyle('H14:R14')->getFont()->setBold(true);
                $sheet1->setCellValue("H14", 'País ');
                $sheet1->setCellValue("I14", 'Directo ');
                $sheet1->setCellValue("J14", 'Superior');
                $sheet1->setCellValue("K14", 'Ejecutivo ');
                $sheet1->setCellValue("L14", 'Plata');
                $sheet1->setCellValue("M14", 'Oro');
                $sheet1->setCellValue("N14", 'Platino');
                $sheet1->setCellValue("O14", 'Diamante');
                $sheet1->setCellValue("P14", 'DiamanteReal');
                $sheet1->setCellValue("Q14", 'Total');
                $sheet1->setCellValue("R14", '% Venta');
                $row = 15;
                foreach ($dataH6tb2 as $r) {
                    $sheet1->setCellValue("H$row", $r->pais);
                    $sheet1->setCellValue("I$row", $r->Directo);
                    $sheet1->setCellValue("J$row", $r->Executivo);
                    $sheet1->setCellValue("K$row", $r->Superior);
                    $sheet1->setCellValue("L$row", $r->Plata);
                    $sheet1->setCellValue("M$row", $r->Oro);
                    $sheet1->setCellValue("N$row", $r->Platino);
                    $sheet1->setCellValue("O$row", $r->Diamante);
                    $sheet1->setCellValue("P$row", $r->DiamanteReal);
                    $sheet1->setCellValue("Q$row", $r->Total);
                    $sheet1->setCellValue("R$row", $r->procVenta);
                    $row++;
                }
            ## tabla 2

            ## tabla 3
                $sheet1->mergeCells('A28:D28');
                $sheet1->setCellValue('A28', "Cantidad de ABIs cumpliendo en cada trimestre ");
                $sheet1->getStyle('A28')->getFont()->setBold(true);
                $sheet1->getStyle('A30:F30')->getFont()->setBold(true);
                $sheet1->setCellValue("A30", 'País ');
                $sheet1->setCellValue("B30", 'Trimestre 1 (Ene-Mar)');
                $sheet1->setCellValue("C30", 'Trimestre 2 (Abr-Jun)');
                $sheet1->setCellValue("D30", 'Total');
                $row = 31;
                foreach ($dataH6tb3 as $r) {
                    $sheet1->setCellValue("A$row", $r->pais);
                    $sheet1->setCellValue("B$row", $r->TrimestreUno);
                    $sheet1->setCellValue("C$row", $r->TrimestreDos);
                    $sheet1->setCellValue("D$row", $r->Total);
                    $row++;
                }
            ## tabla 3

            ## tabla 4
                $sheet1->mergeCells('H28:K28');
                $sheet1->setCellValue('H28', "% Venta representa el programa  (Abis que ganaron en los dos trimestres/ venta comercial del mes)");
                $sheet1->getStyle('H28')->getFont()->setBold(true);
                $sheet1->getStyle('H30:R30')->getFont()->setBold(true);
                $sheet1->setCellValue("H30", 'País ');
                $sheet1->setCellValue("I30", 'Directo ');
                $sheet1->setCellValue("J30", 'Superior');
                $sheet1->setCellValue("K30", 'Ejecutivo ');
                $sheet1->setCellValue("L30", 'Plata');
                $sheet1->setCellValue("M30", 'Total');
                $sheet1->setCellValue("N30", '% Venta');
                $row = 31;
                foreach ($dataH6tb4 as $r) {
                    $sheet1->setCellValue("H$row", $r->pais);
                    $sheet1->setCellValue("I$row", $r->Directo);
                    $sheet1->setCellValue("J$row", $r->Superior);
                    $sheet1->setCellValue("K$row", $r->Executivo);
                    $sheet1->setCellValue("L$row", $r->Plata);
                    $sheet1->setCellValue("M$row", $r->Total);
                    $sheet1->setCellValue("N$row", $r->procVenta);
                    $row++;
                }
            ## tabla 4

            ## tabla 5
                $sheet1->mergeCells('A46:D46');
                $sheet1->setCellValue('A46', "Cantidad de ABIs segmentado por volumenes en VGP");
                $sheet1->getStyle('A46')->getFont()->setBold(true);
                $sheet1->getStyle('A48:L48')->getFont()->setBold(true);
                $sheet1->setCellValue("A48", 'País ');
                $sheet1->setCellValue("B48", 'Latam ');
                $sheet1->setCellValue("C48", 'México ');
                $sheet1->setCellValue("D48", 'Colombia ');
                $sheet1->setCellValue("E48", 'Perú');
                $sheet1->setCellValue("F48", 'Ecuador ');
                $sheet1->setCellValue("G48", 'Costa Rica');
                $sheet1->setCellValue("H48", 'Panamá');
                $sheet1->setCellValue("I48", 'Guatemala');
                $sheet1->setCellValue("J48", 'Chile');
                $sheet1->setCellValue("K48", 'El Salvador');
                $sheet1->setCellValue("L48", 'Rep. Dominicana  ');
                $row = 48;
                foreach ($dataH6tb5 as $r) {
                    $sheet1->setCellValue("A$row", $r->pais);
                    $sheet1->setCellValue("B$row", $r->latam);
                    $sheet1->setCellValue("C$row", $r->mexico);
                    $sheet1->setCellValue("D$row", $r->colombia);
                    $sheet1->setCellValue("E$row", $r->peru);
                    $sheet1->setCellValue("F$row", $r->ecuador);
                    $sheet1->setCellValue("G$row", $r->costaRica);
                    $sheet1->setCellValue("H$row", $r->panama);
                    $sheet1->setCellValue("I$row", $r->guatemala);
                    $sheet1->setCellValue("J$row", $r->chile);
                    $sheet1->setCellValue("K$row", $r->elSalvador);
                    $sheet1->setCellValue("L$row", $r->repDominicana);
                    $row++;
                }
            ## tabla 5

            ## tabla 6
                $sheet1->mergeCells('A63:D63');
                $sheet1->setCellValue('A63', "Total avances de rango ");
                $sheet1->getStyle('A63')->getFont()->setBold(true);
                $sheet1->getStyle('A66:L66')->getFont()->setBold(true);
                $sheet1->setCellValue("A66", 'País ');
                $sheet1->setCellValue("B66", 'Latam ');
                $sheet1->setCellValue("C66", 'México ');
                $sheet1->setCellValue("D66", 'Colombia ');
                $sheet1->setCellValue("E66", 'Perú');
                $sheet1->setCellValue("F66", 'Ecuador ');
                $sheet1->setCellValue("G66", 'Costa Rica');
                $sheet1->setCellValue("H66", 'Panamá');
                $sheet1->setCellValue("I66", 'Guatemala');
                $sheet1->setCellValue("J66", 'Chile');
                $sheet1->setCellValue("K66", 'El Salvador');
                $row = 67;
                foreach ($dataH6tb6 as $r) {
                    $sheet1->setCellValue("A$row", $r->rango);
                    $sheet1->setCellValue("B$row", $r->México);
                    $sheet1->setCellValue("C$row", $r->Colombia);
                    $sheet1->setCellValue("D$row", $r->Perú);
                    $sheet1->setCellValue("E$row", $r->Ecuador);
                    $sheet1->setCellValue("F$row", $r->Costa_Rica);
                    $sheet1->setCellValue("G$row", $r->Panamá);
                    $sheet1->setCellValue("H$row", $r->Guatemala);
                    $sheet1->setCellValue("I$row", $r->Chile);
                    $sheet1->setCellValue("J$row", $r->El_Salvador);
                    $sheet1->setCellValue("K$row", $r->Total_Año);
                    $row++;
                }
            ## tabla 6
            
            ## tabla 7
                $sheet1->mergeCells('A73:D73');
                $sheet1->setCellValue('A73', "Total KinYa de los Abis Directo a Plata");
                $sheet1->getStyle('A73')->getFont()->setBold(true);
                $sheet1->getStyle('A75:L75')->getFont()->setBold(true);
                $sheet1->setCellValue("A75", 'País ');
                $sheet1->setCellValue("B75", 'Enero');
                $sheet1->setCellValue("C75", 'Febrero');
                $sheet1->setCellValue("D75", 'Marzo');
                $sheet1->setCellValue("E75", 'Abril');
                $sheet1->setCellValue("F75", 'Mayo');
                $sheet1->setCellValue("G75", 'Junio');
                $sheet1->setCellValue("H75", 'Julio');
                $sheet1->setCellValue("I75", 'Agosto');
                $sheet1->setCellValue("J75", 'Septiembre');
                $sheet1->setCellValue("K75", 'Total Año');
                $row = 76;
                foreach ($dataH6tb7 as $r) {
                    $sheet1->setCellValue("A$row", $r->pais);
                    $sheet1->setCellValue("B$row", $r->Enero);
                    $sheet1->setCellValue("C$row", $r->Febrero);
                    $sheet1->setCellValue("D$row", $r->Marzo);
                    $sheet1->setCellValue("E$row", $r->Abril);
                    $sheet1->setCellValue("F$row", $r->Mayo);
                    $sheet1->setCellValue("G$row", $r->Junio);
                    $sheet1->setCellValue("H$row", $r->Julio);
                    $sheet1->setCellValue("I$row", $r->Agosto);
                    $sheet1->setCellValue("J$row", $r->Septiembre);
                    $sheet1->setCellValue("K$row", $r->Total_Año);
                    $row++;
                }
            ## tabla 7

            ## tabla 8
                $sheet1->mergeCells('A88:D88');
                $sheet1->setCellValue('A88', "Total Incorporaciones con Sistema de Agua de Directo a Plata");
                $sheet1->getStyle('A88')->getFont()->setBold(true);
                $sheet1->getStyle('A90:L90')->getFont()->setBold(true);
                $sheet1->setCellValue("A90", 'País ');
                $sheet1->setCellValue("B90", 'Enero');
                $sheet1->setCellValue("C90", 'Febrero');
                $sheet1->setCellValue("D90", 'Marzo');
                $sheet1->setCellValue("E90", 'Abril');
                $sheet1->setCellValue("F90", 'Mayo');
                $sheet1->setCellValue("G90", 'Junio');
                $sheet1->setCellValue("H90", 'Julio');
                $sheet1->setCellValue("I90", 'Agosto');
                $sheet1->setCellValue("J90", 'Septiembre');
                $sheet1->setCellValue("K90", 'Total Año');
                $row = 91;
                foreach ($dataH6tb8 as $r) {
                    $sheet1->setCellValue("A$row", $r->pais);
                    $sheet1->setCellValue("B$row", $r->Enero);
                    $sheet1->setCellValue("C$row", $r->Febrero);
                    $sheet1->setCellValue("D$row", $r->Marzo);
                    $sheet1->setCellValue("E$row", $r->Abril);
                    $sheet1->setCellValue("F$row", $r->Mayo);
                    $sheet1->setCellValue("G$row", $r->Junio);
                    $sheet1->setCellValue("H$row", $r->Julio);
                    $sheet1->setCellValue("I$row", $r->Agosto);
                    $sheet1->setCellValue("J$row", $r->Septiembre);
                    $sheet1->setCellValue("K$row", $r->Total_Año);
                    $row++;
                }
            ## tabla 8
        ## / Hoja 6

        ## Hoja 7
            // $sheet1 = $spreadsheet->createSheet();
            // $sheet1->setTitle("Reporte por Año");

            // $imageUrl = 'https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png';
            // $imageContent = file_get_contents($imageUrl);
            // $tempImagePath = tempnam(sys_get_temp_dir(), 'image_') . '.png';
            // file_put_contents($tempImagePath, $imageContent);

            // $sheet = 

            // $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            // $drawing->setName('Paid');
            // $drawing->setDescription('Paid');
            // $drawing->setPath($tempImagePath);
            // $drawing->setCoordinates('A1');
            // $drawing->getShadow()->setVisible(true);
            // $drawing->getShadow()->setDirection(0);
            // $drawing->setWidth(200);
            // $drawing->setHeight(100);
            // $drawing->setWorksheet($spreadsheet->setActiveSheetIndex(3));
            
            // $sheet1->mergeCells('B6:M6');
            // $sheet1->getColumnDimension('A')->setAutoSize(true);
            // $sheet1->setCellValue('A6', "Semestre de medición:");
            // $sheet1->getStyle('A6')->getFont()->setBold(true);
            // $sheet1->setCellValue('B6', "$sem");
            
            // $sheet1->mergeCells('B7:M7');
            // $sheet1->setCellValue('A7', "Trimestre de medición:");
            // $sheet1->getStyle('A7')->getFont()->setBold(true);
            // $sheet1->setCellValue('B7', "$trim");

            // $sheet1->getStyle('A9:BI9')->getFont()->setBold(true);
            // $sheet1->setCellValue("A9", 'Cod Asesor');
            // $sheet1->setCellValue("B9", 'Nombre Asesor');
            // $sheet1->setCellValue("C9", 'pais');
            // $sheet1->setCellValue("D9", 'Num Orden');
            // $sheet1->setCellValue("E9", 'Tipo Documento');
            // $sheet1->setCellValue("F9", 'Item code');
            // $sheet1->setCellValue("G9", 'Descripcion');
            // $sheet1->setCellValue("H9", 'Cantidad');
            // $sheet1->setCellValue("I9", 'Fecha Orden');
            // $sheet1->setCellValue("J9", 'periodo');

            // $startColumn = 'A';
            // $endColumn = 'Z';
            // $this->setAutoSizeColumns($sheet1, $startColumn, $endColumn);

            // $row = 10;
            // foreach ($dataH4 as $r) {
            //     $sheet1->setCellValue("A$row", $r->CodAsesor);
            //     $sheet1->setCellValue("B$row", $r->NombreAsesor);
            //     $sheet1->setCellValue("C$row", $r->pais);
            //     $sheet1->setCellValue("D$row", $r->NumOrden);
            //     $sheet1->setCellValue("E$row", $r->TipoDocumento);
            //     $sheet1->setCellValue("F$row", $r->Itemcode);
            //     $sheet1->setCellValue("G$row", $r->Descripcion);
            //     $sheet1->setCellValue("H$row", $r->Cantidad);
            //     $sheet1->setCellValue("I$row", $r->FechaOrden);
            //     $sheet1->setCellValue("J$row", $r->periodo);
            //     $row++;
            // }
        ## / Hoja 7

        ## Final
            $fileName = "Bonificaciones - v" . Date('is') . '.xlsx';

            $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
            $writer = new Xlsx($spreadsheet);
            $writer->save($tempFilePath);

            return response()->stream(
                function () use ($tempFilePath) {
                    readfile($tempFilePath);
                    unlink($tempFilePath);
                },
                200,
                [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename=' . $fileName,
                ]
            );
        ## / Final
    }
    function setAutoSizeColumns($sheet, $start, $end) {
        $columns = [];
        for ($c = $start; $c <= $end; $c++) {
            $columns[] = $c;
        }

        foreach ($columns as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }

    public function depuracion_lat_2025(){
        $coreCms = new coreApp();
        $anio = Date('Y');
        $spreadsheet = new Spreadsheet();
        
        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Listado");
            for($i=65; $i<=90; $i++) {
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
                $hoja1->getColumnDimension("A$letter")->setAutoSize(true);
            }
            $hoja1->getStyle('A5:AB5')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A5:AB5');

            $hoja1->mergeCells('A1:H1');
            $hoja1->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja1->setCellValue('A2', "Socios posibles a depurar - Proceso Depuración 2025");
            $hoja1->setCellValue('A3', "Fecha de consulta: " . Date('Y-m-d H:i:s'));
            $hoja1->getStyle('A1:A3')->getFont()->setBold(true);
            
            $h = ['Codigo de Socio', 'Tipo Distribuidor', 'Nombre del Socio', 'Rango', 'Fecha Ingreso', 'Codigo del Patrocinador', 'Nombre del Patrocinador', 'Estado', 'Correo', 'Telefono', 'Pais', 'vp_ene_24', 'vp_feb_24', 'vp_mar_24', 'vp_abr_24', 'vp_may_24', 'vp_jun_24', 'vp_jul_24', 'vp_ago_24', 'vp_sep_24', 'vp_oct_24', 'vp_nov_24', 'vp_dic_24', 'VP_ene_25', 'VP_ene_25_USA', 'Requisito Faltante', 'Estatus SAP', 'Salvado'];
            $d = $coreCms->getReportBody("EXEC EXIGO_prod.dbo.depuracionLatam_interno", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A5', true);
        # hoja 1
        
        # hoja 2
            $hoja2 = $spreadsheet->createSheet();

            $hoja2->setTitle("Terminar 15 Ene");
            for($i=65; $i<=90; $i++) {
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
                $hoja2->getColumnDimension("A$letter")->setAutoSize(true);
            }
            $hoja2->getStyle('A5:AB5')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A5:AB5');

            $hoja2->mergeCells('A1:H1');
            $hoja2->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja2->setCellValue('A2', "Socios posibles a depurar - Proceso Depuración 2025");
            $hoja2->setCellValue('A3', "Fecha de consulta: " . Date('Y-m-d H:i:s'));
            $hoja2->getStyle('A1:A3')->getFont()->setBold(true);
            
            $h = ['Codigo de Socio', 'Tipo Distribuidor', 'Nombre del Socio', 'Rango', 'Fecha Ingreso', 'Codigo del Patrocinador', 'Nombre del Patrocinador', 'Estado', 'Correo', 'Telefono', 'Pais', 'vp_ene_24', 'vp_feb_24', 'vp_mar_24', 'vp_abr_24', 'vp_may_24', 'vp_jun_24', 'vp_jul_24', 'vp_ago_24', 'vp_sep_24', 'vp_oct_24', 'vp_nov_24', 'vp_dic_24', 'VP_ene_25', 'VP_ene_25_USA', 'Requisito Faltante', 'Estatus SAP', 'Salvado'];
            $d = $coreCms->getReportBody("EXEC EXIGO_prod.dbo.depuracionLatam_interno_depurarEnero", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A5', true);
        # hoja 2
        
        # hoja 3
            $hoja3 = $spreadsheet->createSheet();

            $hoja3->setTitle("Terminar 15 Feb");
            for($i=65; $i<=90; $i++) {
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
                $hoja3->getColumnDimension("A$letter")->setAutoSize(true);
            }
            $hoja3->getStyle('A5:AB5')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A5:AB5');

            $hoja3->mergeCells('A1:H1');
            $hoja3->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja3->setCellValue('A2', "Socios posibles a depurar - Proceso Depuración 2025");
            $hoja3->setCellValue('A3', "Fecha de consulta: " . Date('Y-m-d H:i:s'));
            $hoja3->getStyle('A1:A3')->getFont()->setBold(true);
            
            $h = ['Codigo de Socio', 'Tipo Distribuidor', 'Nombre del Socio', 'Rango', 'Fecha Ingreso', 'Codigo del Patrocinador', 'Nombre del Patrocinador', 'Estado', 'Correo', 'Telefono', 'Pais', 'vp_ene_24', 'vp_feb_24', 'vp_mar_24', 'vp_abr_24', 'vp_may_24', 'vp_jun_24', 'vp_jul_24', 'vp_ago_24', 'vp_sep_24', 'vp_oct_24', 'vp_nov_24', 'vp_dic_24', 'VP_ene_25', 'VP_ene_25_USA', 'Requisito Faltante', 'Estatus SAP', 'Salvado'];
            $d = $coreCms->getReportBody("EXEC EXIGO_prod.dbo.depuracionLatam_interno_depurarFebrero", "SQL173", $h);
            $hoja3->fromArray($d, null, 'A5', true);
        # hoja 3
        
        # hoja 4
            $hoja4 = $spreadsheet->createSheet();

            $hoja4->setTitle("Facturación Colchones");
            for($i=65; $i<=90; $i++) {
                $letter = chr($i);
                $hoja4->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja4->getStyle('A5:I5')->getFont()->setBold(true);
            $hoja4->setAutoFilter('A5:I5');

            $hoja4->mergeCells('A1:I1');
            $hoja4->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja4->setCellValue('A2', "Socios posibles a depurar - Proceso Depuración 2025");
            $hoja4->setCellValue('A3', "Fecha de consulta: " . Date('Y-m-d H:i:s'));
            $hoja4->getStyle('A1:A3')->getFont()->setBold(true);
            
            $h = ['Pais', 'cardCode', 'NumAtCard', 'U_orden_vista', 'U_Garantia', 'ItemCode', 'Dscription', 'Fecha_Creacion', 'Fecha_Contabilizacion'];
            $d = $coreCms->getReportBody("EXEC EXIGO_prod.dbo.depuracionLatam_interno_garantias", "SQL173", $h);
            $hoja4->fromArray($d, null, 'A5', true);
        # hoja 4

        $fileName = "Listado Renovación 2025 para fidelizaciones_" . Date('Y_m_d_H_i_s') . '.xlsx';

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        return response()->stream(
            function () use ($tempFilePath) {
                readfile($tempFilePath);
                unlink($tempFilePath);
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename=' . $fileName,
            ]
        );
    }

    public function reportSimuladorV5(){
        $coreCms = new coreApp();
        $sap_code = request()->sap_code;
        $periodo = request()->periodo;
        $spreadsheet = new Spreadsheet();
        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Grupo Personal");
            for($i=65; $i<=90; $i++) {
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
                $hoja1->getColumnDimension("A$letter")->setAutoSize(true);
            }
            $hoja1->getStyle('A5:AB5')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A5:AB5');

            $hoja1->mergeCells('A1:H1');
            $hoja1->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja1->setCellValue('A2', "Simulador plan de compensación");
            $hoja1->setCellValue('A3', "Fecha de consulta: " . Date('Y-m-d H:i:s'));
            $hoja1->getStyle('A1:A3')->getFont()->setBold(true);
            
            $h = ['Código', 'Nombre', 'Orden', 'Puntos', 'Rango', 'País', 'Vol.Calc.', '%', 'Bonificación', '% nuevo', 'Total orden', 'Bono recalculado', 'Conv.', 'Total Ganado', 'Total Ganado Recalculado'];
            $d = $coreCms->getReportBody("SELECT 
                                            OWNERID AS associateId,
                                            IIF(TRIM(CONCAT(RTRIM(b.FirstName),' ',LTRIM(b.LastName))) = '',b.Company,TRIM(CONCAT(RTRIM(b.FirstName),' ',LTRIM(b.LastName)))) as associateName,
                                            ORDER_NUM as orderNum,
                                            businessVolumeTotal as puntos,
                                            CASE 
                                                WHEN RANGO_SOCIO = 9 THEN 'DRL'
                                                WHEN RANGO_SOCIO = 8 THEN 'DIA'
                                                WHEN RANGO_SOCIO = 7 THEN 'PLO'
                                                WHEN RANGO_SOCIO = 6 THEN 'ORO'
                                                WHEN RANGO_SOCIO = 5 THEN 'PLA'
                                                WHEN RANGO_SOCIO = 3 THEN 'EJE'
                                                WHEN RANGO_SOCIO = 2 THEN 'SUP'
                                                ELSE 'DIR' 
                                            END AS rangoPago,
                                            c.paisorden as paisOrden,
                                            VC_PLUS as Vol_calculo,
                                            20 as porcentajeRembolso,
                                            SUBTOTAL_ORDEN,
                                            PORCENTAJE as porcentajeNuevo,
                                            TOTAL_COMISION_VC_PLUS as Bonificacion,
                                            SUBTOTAL_ORDEN*(PORCENTAJE/100) as bono_recalc,
                                            TIPO_CAMBIO AS Conv,
                                            TOTAL_COMISION_VC_PLUS as Total,
                                            SUBTOTAL_ORDEN*(PORCENTAJE/100)/tipo_cambio as TotalRecalculado
                                        FROM [VCplus].[dbo].[vcplus_calculo_todos_simulador] a
                                        LEFT JOIN EXIGO_prod.dbo.Customers b ON a.ASSOCIATEID = b.CustomerID
                                        LEFT JOIN EXIGO_prod.dbo.orders c ON a.ORDER_NUM = c.orderid AND a.OWNERID = c.customerid
                                        WHERE a.ASSOCIATEID = $sap_code_user
                                        AND a.PERIODO_ORDEN = $periodSelect
                                        AND a.Tipo_Bonus = 2
                                            UNION ALL
                                        SELECT
                                            a.OWNERID AS associateId,
                                            IIF(TRIM(CONCAT(RTRIM(b.FirstName),' ',LTRIM(b.LastName))) = '',b.Company,TRIM(CONCAT(RTRIM(b.FirstName),' ',LTRIM(b.LastName)))) as associateName,
                                            a.ORDER_NUM as orderNum,
                                            businessVolumeTotal as puntos,
                                            CASE 
                                                WHEN a.RANGO_SOCIO = 9 THEN 'DRL'
                                                WHEN a.RANGO_SOCIO = 8 THEN 'DIA'
                                                WHEN a.RANGO_SOCIO = 7 THEN 'PLO'
                                                WHEN a.RANGO_SOCIO = 6 THEN 'ORO'
                                                WHEN a.RANGO_SOCIO = 5 THEN 'PLA'
                                                WHEN a.RANGO_SOCIO = 3 THEN 'EJE'
                                                WHEN a.RANGO_SOCIO = 2 THEN 'SUP'
                                                ELSE 'DIR' 
                                            END AS rangoPago,
                                            c.paisorden as paisOrden,
                                            a.VC_PLUS as Vol_calculo,
                                            d.PORCENTAJE as porcentajeRembolso,
                                            a.SUBTOTAL_ORDEN,
                                            a.PORCENTAJE as porcentajeNuevo,
                                            a.TOTAL_COMISION_VC_PLUS as Bonificacion,
                                            a.SUBTOTAL_ORDEN*(a.PORCENTAJE/100) as bono_recalc,
                                            a.TIPO_CAMBIO AS Conv,
                                            a.TOTAL_COMISION_VC_PLUS as Total,
                                            a.SUBTOTAL_ORDEN*(a.PORCENTAJE/100)/a.tipo_cambio as TotalRecalculado
                                        FROM [VCplus].[dbo].[vcplus_calculo_todos_simulador] a
                                        LEFT JOIN EXIGO_prod.dbo.Customers b ON a.ASSOCIATEID = b.CustomerID
                                        LEFT JOIN EXIGO_prod.dbo.orders c ON a.ORDER_NUM = c.orderid AND a.ASSOCIATEID = c.customerid
                                        LEFT JOIN [VCplus].[dbo].[vcplus_calculo] d ON a.OWNERID = d.OWNERID AND d.Tipo_Bonus = 3 AND a.ORDER_NUM = d.ORDER_NUM
                                        WHERE a.OWNERID = $sap_code_user
                                        AND a.PERIODO_ORDEN = $periodSelect
                                        AND a.Tipo_Bonus = 3", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A5', true);
        # hoja 1
        # hoja 2
            $hoja2 = $spreadsheet->createSheet();

            $hoja2->setTitle("Liderazgo");
            for($i=65; $i<=90; $i++) {
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
                $hoja2->getColumnDimension("A$letter")->setAutoSize(true);
            }
            $hoja2->getStyle('A5:AB5')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A5:AB5');

            $hoja2->mergeCells('A1:H1');
            $hoja2->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja2->setCellValue('A2', "Simulador plan de compensación");
            $hoja2->setCellValue('A3', "Fecha de consulta: " . Date('Y-m-d H:i:s'));
            $hoja2->getStyle('A1:A3')->getFont()->setBold(true);
            
            $h = ['Código', 'Nombre', 'Profundidad', 'País', 'Vol.Calc.', '%', '% Recalculo', 'Bonificación', 'Bono Recalculo', 'Conv', 'Total_Ganado', 'Total_Ganado_nuevo'];
            $d = $coreCms->getReportBody("SELECT
                                            a.ASSOCIATEID AS associateId,
                                            IIF(TRIM(CONCAT(RTRIM(b.FirstName),' ',LTRIM(b.LastName))) = '',b.Company,TRIM(CONCAT(RTRIM(b.FirstName),' ',LTRIM(b.LastName)))) as associateName,
                                            a.PROFUNDIDAD as Profundidad,
                                            c.paisorden as paisOrden,
                                            d.vcFinal as Vol_calculo,
                                            d.PORCENTAJE as porcentajeRembolso,
                                            a.PORCENTAJE as porcentajeNuevo,
                                            d.TotalFinal as Bonificacion,
                                            a.VC_PLUS*(a.PORCENTAJE/100) as bono_recalc,
                                            a.TIPO_CAMBIO AS Conv,
                                            d.TotalFinal as Total,
                                            a.VC_PLUS*(a.PORCENTAJE/100)/a.tipo_cambio as TotalRecalculado
                                        FROM [VCplus].[dbo].[vcplus_calculo_todos_simulador] a
                                        LEFT JOIN EXIGO_prod.dbo.Customers b ON a.ASSOCIATEID = b.CustomerID
                                        LEFT JOIN EXIGO_prod.dbo.orders c ON a.ORDER_NUM = c.orderid AND a.ASSOCIATEID = c.customerid
                                        LEFT JOIN [167].NIKKENDWH.dbo.NKN_Bonificacion_ProgramaDetalle d ON a.OWNERID = d.CodigoAsesor 
                                        AND d.Id_ConceptoGanancia = 7 
                                        AND a.ORDER_NUM = d.NumeroOrden
                                        WHERE a.OWNERID = $sap_code_user
                                        AND a.PERIODO_ORDEN = $periodSelect
                                        AND a.Tipo_Bonus = 7", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A5', true);
        # hoja 2

        $fileName = "Simulador plan de compensación - v" . Date('i_s') . '.xlsx';

        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);
        return response()->stream(
            function () use ($tempFilePath) {
                readfile($tempFilePath);
                unlink($tempFilePath);
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename=' . $fileName,
            ]
        );
    }
}
