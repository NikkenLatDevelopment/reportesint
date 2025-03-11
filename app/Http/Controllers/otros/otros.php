<?php

namespace App\Http\Controllers\otros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\coreApp;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class otros extends Controller{
    public function estCHLexe(){
        $core = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("2024");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }

            $hoja1->mergeCells('A1:M1');
            $hoja1->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $h = ['Código de Socio', 'Código Patrocinador', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Cumple VP', 'Cumple VGP', 'Cumple', 'Cumple Incorporaciones', 'Nombre patrocinador'];
            $d = $core->getReportBody("SELECT * FROM RETOS_ESPECIALES.dbo.EstrategiaGTM_SLV_EXE_ganadores_chl_gtm (202401,202412);", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();
            $hoja2->setTitle("2025");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A3:M3')->getFont()->setBold(true);

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $h = ['Código de Socio', 'Código Patrocinador', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Cumple VP', 'Cumple VGP', 'Cumple', 'Cumple Incorporaciones', 'Nombre patrocinador'];
            $d = $core->getReportBody("SELECT * FROM RETOS_ESPECIALES.dbo.EstrategiaGTM_SLV_EXE_ganadores_chl_gtm (202501,202512);", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A3', true);
        # hoja 2

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Estrategia CHL Rangos Ejecutivos - " . Date('Y_m_d_H_i_s') . '.xlsx';
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

    public function estVHLideres(){
        $core = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("2024");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A3:M3')->getFont()->setBold(true);

            $hoja1->mergeCells('A1:M1');
            $hoja1->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $h = [ 'Código de Influencer', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Total de incorporaciones', 'Total Cumplen Estrategia', 'Cumple VP', 'Cumple VGP', 'Cumple Incorporaciones', 'Cumple Incorporaciones', 'Nombre patrocinador' ];
            $d = $core->getReportBody("SELECT * FROM RETOS_ESPECIALES.dbo.EstrategiaGTM_SLV_Lideres_ganadores_CHL_GTM (202401,202412);", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();
            $hoja2->setTitle("2025");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A3:M3')->getFont()->setBold(true);

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $h = [ 'Código de Influencer', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Total de incorporaciones', 'Total Cumplen Estrategia', 'Cumple VP', 'Cumple VGP', 'Cumple Incorporaciones', 'Cumple Incorporaciones', 'Nombre patrocinador' ];
            $d = $core->getReportBody("SELECT * FROM RETOS_ESPECIALES.dbo.EstrategiaGTM_SLV_Lideres_ganadores_CHL_GTM (202501,202512);", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A3', true);
        # hoja 2

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Estrategia CHL Rangos Lideres - " . Date('Y_m_d_H_i_s') . '.xlsx';
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

    public function homeCheckBonos(){
        return view('otros.homeCheckBonos');
    }

    public function reportCheckBonos(){
        $code = request()->code;
        $period = request()->period;

        $core = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("fn_retail_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A3:N3')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A3:N3');

            $hoja1->mergeCells('A1:M1');
            $hoja1->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);
            
            $h = ['Ownerid', 'retail', 'porcentaje', 'total_comision', 'FromRankID', 'moneda', 'associateid', 'orderNum', 'fecha_Orden', 'paisOrden', 'total', 'vp_Orden', 'vc_Orden', 'PeriodOrden'];
            $d = $core->getReportBody("SELECT * FROM diccionarioExigo.dbo.fn_retail_exigo ($code, '$period');", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();

            $hoja2->setTitle("fn_rebate_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A3:N3')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A3:N3');

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $h = ['Ownerid', 'rebate', 'porcentaje', 'total_comision', 'FromRankID', 'moneda', 'associateid', 'orderNum', 'fecha_Orden', 'paisOrden', 'total', 'vp_Orden', 'vc_Orden', 'PeriodOrden'];
            $d = $core->getReportBody("SELECT * FROM diccionarioExigo.dbo.fn_rebate_exigo ($code, '$period');", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A3', true);
        # hoja 2
        
        # hoja 3
            $hoja3 = $spreadsheet->createSheet();

            $hoja3->setTitle("fn_override_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja3->getStyle('A3:N3')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A3:N3');

            $hoja3->mergeCells('A1:M1');
            $hoja3->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja3->getStyle('A1')->getFont()->setBold(true);

            $h = ['Ownerid', 'comision', 'porcentaje', 'total_comision', 'rangoSocio', 'moneda', 'associateid', 'orderNum', 'fecha_Orden', 'paisOrden', 'total', 'vp_Orden', 'vc_Orden', 'PeriodOrden'];
            $d = $core->getReportBody("SELECT * FROM diccionarioExigo.dbo.fn_override_exigo ($code, '$period');", "SQL173", $h);
            $hoja3->fromArray($d, null, 'A3', true);
        # hoja 3

        # hoja 4
            $hoja4 = $spreadsheet->createSheet();

            $hoja4->setTitle("fn_leadrship_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja4->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja4->getStyle('A3:N3')->getFont()->setBold(true);
            $hoja4->setAutoFilter('A3:N3');

            $hoja4->mergeCells('A1:M1');
            $hoja4->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja4->getStyle('A1')->getFont()->setBold(true);

            $h = ['Ownerid', 'comision', 'porcentaje', 'total_comision', 'FromRankID', 'moneda', 'associateid', 'orderNum', 'fecha_Orden', 'paisOrden', 'total', 'vp_Orden', 'vc_Orden', 'PeriodOrden'];
            $d = $core->getReportBody("SELECT * FROM diccionarioExigo.dbo.fn_leadrship_exigo ($code, '$period');", "SQL173", $h);
            $hoja4->fromArray($d, null, 'A3', true);
        # hoja 4
        
        # hoja 5
            $hoja5 = $spreadsheet->createSheet();

            $hoja5->setTitle("fn_lifestyleBonus_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja5->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja5->getStyle('A3:N3')->getFont()->setBold(true);
            $hoja5->setAutoFilter('A3:N3');

            $hoja5->mergeCells('A1:M1');
            $hoja5->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja5->getStyle('A1')->getFont()->setBold(true);

            $h = ['Ownerid', 'comision', 'porcentaje', 'total_comision', 'FromRankID', 'moneda', 'associateid', 'orderNum', 'fecha_Orden', 'paisOrden', 'total', 'vp_Orden', 'vc_Orden', 'PeriodOrden'];
            $d = $core->getReportBody("SELECT * FROM diccionarioExigo.dbo.fn_lifestyleBonus_exigo ($code, '$period');", "SQL173", $h);
            $hoja5->fromArray($d, null, 'A3', true);
        # hoja 5

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Check de bonificaciones - " . Date('Y_m_d_H_i_s') . '.xlsx';
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
