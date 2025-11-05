<?php

namespace App\Http\Controllers\otros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\coreApp;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
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
            $hoja1->getStyle('A3:N3')->getFont()->setBold(true);

            $hoja1->mergeCells('A1:N1');
            $hoja1->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $h = ['Código de Socio', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Cumple VP', 'Cumple VGP', 'Cumple', 'Cumple Incorporaciones', 'Código Patrocinador', 'Nombre patrocinador'];
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
            $hoja2->getStyle('A3:N3')->getFont()->setBold(true);

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $h = ['Código de Socio', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Cumple VP', 'Cumple VGP', 'Cumple', 'Cumple Incorporaciones', 'Código Patrocinador', 'Nombre patrocinador'];
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
            $hoja1->getStyle('A3:N3')->getFont()->setBold(true);

            $hoja1->mergeCells('A1:M1');
            $hoja1->setCellValue('A1', "Estrategia CHL Lideres | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $h = [ 'Código de Influencer', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Total de incorporaciones', 'Total Cumplen Estrategia', 'Cumple VP', 'Cumple VGP', 'Cumple Incorporaciones', 'Código Patrocinador', 'Nombre patrocinador'];
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
            $hoja2->getStyle('A3:N3')->getFont()->setBold(true);

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Estrategia CHL Lideres | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $h = [ 'Código de Influencer', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Total de incorporaciones', 'Total Cumplen Estrategia', 'Cumple VP', 'Cumple VGP', 'Cumple Incorporaciones', 'Código Patrocinador', 'Nombre patrocinador'];
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

    public function estGTMSLVexe(){
        $core = new coreApp();
        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("2024");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A3:N3')->getFont()->setBold(true);

            $hoja1->mergeCells('A1:N1');
            $hoja1->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $h = ['Código de Socio', 'Código Patrocinador', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Cumple VP', 'Cumple VGP', 'Cumple', 'Nombre patrocinador'];
            $d = $core->getReportBody("SELECT * FROM RETOS_ESPECIALES.dbo.EstrategiaGTM_SLV_EXE(202401,202412) ORDER BY periodo ASC", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();
            $hoja2->setTitle("2025");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A3:N3')->getFont()->setBold(true);

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            
            $h = ['Código de Socio', 'Código Patrocinador', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Cumple VP', 'Cumple VGP', 'Cumple', 'Nombre patrocinador'];
            $d = $core->getReportBody("SELECT * FROM RETOS_ESPECIALES.dbo.EstrategiaGTM_SLV_EXE(202501,202512) ORDER BY periodo ASC;", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A3', true);
        # hoja 2

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Csv($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Estrategia GTM y SLV Rangos Ejecutivos - " . Date('Y_m_d_H_i_s') . '.csv';
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

    public function estGTMSLVLideres(){
        $core = new coreApp();
        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("2024");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A3:N3')->getFont()->setBold(true);

            $hoja1->mergeCells('A1:N1');
            $hoja1->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $h = ['Código de Socio', 'Código Patrocinador', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Cumple VP', 'Cumple VGP', 'Cumple', 'Nombre patrocinador'];
            $d = $core->getReportBody("SELECT * FROM RETOS_ESPECIALES.dbo.EstrategiaGTM_SLV_Lideres(202401,202412) ORDER BY periodo ASC,total_incorporaciones DESC;", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();
            $hoja2->setTitle("2025");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A3:N3')->getFont()->setBold(true);

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Estrategia CHL Rangos Ejecutivos | Fecha de actualización: " . Date("Y-m-d H:i:s"));
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            
            $h = ['Código de Socio', 'Código Patrocinador', 'Nombre', 'País', 'Rango', 'Periodo', 'VP Latam', 'VGP Latam', 'Incorporaciones totales', 'Total Cumplen Estrategia', 'Cumple VP', 'Cumple VGP', 'Cumple', 'Nombre patrocinador'];
            $d = $core->getReportBody("SELECT * FROM RETOS_ESPECIALES.dbo.EstrategiaGTM_SLV_Lideres(202501,202512) ORDER BY periodo ASC,total_incorporaciones DESC;", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A3', true);
        # hoja 2

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Csv($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Estrategia GTM y SLV Rangos Lideres - " . Date('Y_m_d_H_i_s') . '.csv';
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
            $hoja1->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja1->setCellValue('A2', "id socio: $code");
            $hoja1->getStyle('A1')->getFont()->setBold(true);
            
            // $h = ['Ownerid', 'total_orden', 'retail', 'rango_Socio', 'moneda', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'vp_Orden', 'vc_Orden', 'Periodo_Orden', 'numAtCardSAP', 'NumFacturaSAP'];
            $h = [
                'Ownerid',
                'OwnerName',
                'vc_Orden',
                'porcentaje',
                'total_comision',
                'tipo_cambio',
                'rango_Socio',
                'moneda',
                'profundidad',
                'associateid',
                'order_Num',
                'fecha_Orden',
                'pais_Orden',
                'total_Orden',
                'vp_Orden',
                'Periodo_Orden',
                'numAtCard',
                'NumFactura',
                'SponsorID',
                'SponsorName'
            ];
        
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_retail_exigo $code, '$period';", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();

            $hoja2->setTitle("fn_rebate_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A3:O3')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A3:O3');

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja2->setCellValue('A2', "id socio: $code");
            $hoja2->getStyle('A1')->getFont()->setBold(true);

           // $h = ['Ownerid', 'vc_orden', 'porcentaje', 'rebate', 'rango_Socio', 'moneda', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'total_Orden', 'vp_Orden', 'Periodo_Orden', 'numAtCard', 'NumFactura'];
            $h = [
                'Ownerid',
                'OwnerName',
                'vc_Orden',
                'porcentaje',
                'total_comision',
                'tipo_cambio',
                'rango_Socio',
                'moneda',
                'profundidad',
                'associateid',
                'order_Num',
                'fecha_Orden',
                'pais_Orden',
                'total_Orden',
                'vp_Orden',
                'Periodo_Orden',
                'numAtCard',
                'NumFactura',
                'SponsorID',
                'SponsorName'
            ];
            
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_rebate_exigo $code, '$period';", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A3', true);
        # hoja 2
        
        # hoja 3
            $hoja3 = $spreadsheet->createSheet();

            $hoja3->setTitle("fn_override_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja3->getStyle('A3:P3')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A3:P3');

            $hoja3->mergeCells('A1:M1');
            $hoja3->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja3->setCellValue('A2', "id socio: $code");
            $hoja3->getStyle('A1')->getFont()->setBold(true);

            // $h = ['Ownerid', 'vc_Orden', 'porcentaje', 'total_comision', 'rango_Socio', 'moneda', 'profundidad', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'total_Orden', 'vp_Orden', 'Periodo_Orden', 'numAtCard', 'NumFactura'];
            $h = [
                'Ownerid',
                'OwnerName',
                'vc_Orden',
                'porcentaje',
                'total_comision',
                'tipo_cambio',
                'rango_Socio',
                'moneda',
                'profundidad',
                'associateid',
                'order_Num',
                'fecha_Orden',
                'pais_Orden',
                'total_Orden',
                'vp_Orden',
                'Periodo_Orden',
                'numAtCard',
                'NumFactura',
                'SponsorID',
                'SponsorName'
            ];
            
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_override_exigo $code, '$period';", "SQL173", $h);
            $hoja3->fromArray($d, null, 'A3', true);
        # hoja 3

        # hoja 4
            $hoja4 = $spreadsheet->createSheet();

            $hoja4->setTitle("fn_leadrship_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja4->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja4->getStyle('A3:P3')->getFont()->setBold(true);
            $hoja4->setAutoFilter('A3:P3');

            $hoja4->mergeCells('A1:M1');
            $hoja4->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja4->setCellValue('A2', "id socio: $code");
            $hoja4->getStyle('A1')->getFont()->setBold(true);

            // $h = ['Ownerid', 'vc_Orden', 'porcentaje', 'total_comision', 'rango_Socio', 'moneda', 'profundidad', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'total_Orden', 'vp_Orden', 'Periodo_Orden', 'numAtCard', 'NumFactura'];
            $h = [
                'Ownerid',
                'OwnerName',
                'vc_Orden',
                'porcentaje',
                'total_comision',
                'tipo_cambio',
                'rango_Socio',
                'moneda',
                'profundidad',
                'associateid',
                'order_Num',
                'fecha_Orden',
                'pais_Orden',
                'total_Orden',
                'vp_Orden',
                'Periodo_Orden',
                'numAtCard',
                'NumFactura',
                'SponsorID',
                'SponsorName'
            ];
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_leadership_exigo $code, '$period';", "SQL173", $h);
            $hoja4->fromArray($d, null, 'A3', true);
        # hoja 4
        
        # hoja 5
            $hoja5 = $spreadsheet->createSheet();

            $hoja5->setTitle("fn_lifestyleBonus_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja5->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja5->getStyle('A3:O3')->getFont()->setBold(true);
            $hoja5->setAutoFilter('A3:O3');

            $hoja5->mergeCells('A1:M1');
            $hoja5->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja5->setCellValue('A2', "id socio: $code");
            $hoja5->getStyle('A1')->getFont()->setBold(true);

            // $h = ['Ownerid', 'vc_Orden', 'porcentaje', 'total_comision', 'rango_Socio', 'moneda', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'total_Orden', 'vp_Orden', 'Periodo_Orden', 'numAtCard', 'NumFactura'];
            $h = [
                'Ownerid',
                'OwnerName',
                'vc_Orden',
                'porcentaje',
                'total_comision',
                'tipo_cambio',
                'rango_Socio',
                'moneda',
                'profundidad',
                'associateid',
                'order_Num',
                'fecha_Orden',
                'pais_Orden',
                'total_Orden',
                'vp_Orden',
                'Periodo_Orden',
                'numAtCard',
                'NumFactura',
                'SponsorID',
                'SponsorName'
            ];
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_lifestyleBonus_exigo $code, '$period';", "SQL173", $h);
            $hoja5->fromArray($d, null, 'A3', true);
        # hoja 5

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Check de bonificaciones $code - " . Date('Y_m_d_H_i_s') . '.csv';
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

    public function getReportSalesTvKueski(){
        $core = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Kueski");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A3:M3')->getFont()->setBold(true);

            $hoja1->mergeCells('A1:M1');
            $hoja1->setCellValue('A1', "Ventas rechazadas por Kueski TV | Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $h = ['codigo_usuario', 'nombre_usuario', 'id_venta', 'referencia_venta', 'metodo_de_pago', 'proveedor_de_pago', 'estatus_compra', 'total_compra', 'fecha_compra'];
            $d = $core->getReportBody("SELECT 
                                            CASE
                                                WHEN u.sap_code IS NULL THEN 'CLIENTE'
                                                ELSE u.sap_code
                                            END AS codigo_usuario,
                                            CONCAT(u.`name`, ' ', u.last_name) AS nombre_usuario,
                                            s.id AS id_venta,
                                            s.reference_code AS referencia_venta,
                                            sp.payment_method AS metodo_de_pago,
                                            sp.payment_provider AS proveedor_de_pago,
                                            s.status AS estatus_compra,
                                            s.total AS total_compra,
                                            s.created_at AS fecha_compra
                                        FROM sales_information_payments sp
                                        INNER JOIN sales s ON s.id = sp.sale_id
                                        INNER JOIN users u ON u.id = s.user_id
                                        WHERE 
                                            sp.payment_provider = 'Kueski' AND 
                                            sp.status IN ('cancelada', 'standby', 'abierta');", "TVMySQL", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Ventas rechazadas Kueski - " . Date('Y_m_d_H_i_s') . '.xlsx';
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

    public function getReportSalesTv3DS(){
        $core = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Banorte 3d Secure");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A3:M3')->getFont()->setBold(true);

            $hoja1->mergeCells('A1:M1');
            $hoja1->setCellValue('A1', "Ventas rechazadas Banorte 3DS TV | Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $h = ['codigo_usuario', 'nombre_usuario', 'id_venta', 'referencia_venta', 'metodo_de_pago', 'proveedor_de_pago', 'estatus_compra', 'total_compra', 'fecha_compra'];
            $d = $core->getReportBody("SELECT 
                                            CASE
                                                WHEN u.sap_code IS NULL THEN 'CLIENTE'
                                                ELSE u.sap_code
                                            END AS codigo_usuario,
                                            CONCAT(u.`name`, ' ', u.last_name) AS nombre_usuario,
                                            s.id AS id_venta,
                                            s.reference_code AS referencia_venta,
                                            sp.payment_method AS metodo_de_pago,
                                            sp.payment_provider AS proveedor_de_pago,
                                            s.status AS estatus_compra,
                                            s.total AS total_compra,
                                            s.created_at AS fecha_compra
                                        FROM sales_information_payments sp
                                        INNER JOIN sales s ON s.id = sp.sale_id
                                        INNER JOIN users u ON u.id = s.user_id
                                        WHERE 
                                            sp.payment_provider = 'Banorte 3d Secure' AND 
                                            sp.status IN ('cancelada', 'standby', 'abierta') AND
                                            sp.created_at >= '2025-01-01';", "TVMySQL", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Ventas rechazadas Banorte 3DS - " . Date('Y_m_d_H_i_s') . '.xlsx';
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

    public function homeCheckBonos_vcplus(){
        return view('otros.homeCheckBonos_vcplus');
    }

    public function reportCheckBonos_vcplus(){
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
            $hoja1->getStyle('A3:M3')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A3:M3');

            $hoja1->mergeCells('A1:M1');
            $hoja1->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja1->setCellValue('A2', "id socio: $code");
            $hoja1->getStyle('A1')->getFont()->setBold(true);
            
            $h = ['OWNERID', 'TOTAL_ORDEN', 'RETAIL', 'RANGO_SOCIO', 'MONEDA', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'PAIS_ORDEN', 'VP_ORDEN', 'VC_ORDEN', 'PERIODO_ORDEN', 'NUMATCARD'];
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_simulador_retail_exigo $code, '$period';", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();

            $hoja2->setTitle("fn_rebate_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A3:P3')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A3:P3');

            $hoja2->mergeCells('A1:M1');
            $hoja2->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja2->setCellValue('A2', "id socio: $code");
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $h = ['OWNERID', 'VC_ORDEN', 'VC_PLUS_ORDEN', 'PORCENTAJE', 'REBATE', 'REBATE_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'PAIS_ORDEN', 'TOTAL_ORDEN', 'VP_ORDEN', 'PERIODO_ORDEN', 'NUMATCARD'];
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_simulador_rebate_exigo $code, '$period';", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A3', true);
        # hoja 2
        
        # hoja 3
            $hoja3 = $spreadsheet->createSheet();

            $hoja3->setTitle("fn_override_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja3->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A3:Q3');

            $hoja3->mergeCells('A1:M1');
            $hoja3->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja3->setCellValue('A2', "id socio: $code");
            $hoja3->getStyle('A1')->getFont()->setBold(true);

            $h = ['OWNERID', 'VC_ORDEN', 'VC_PLUS_ORDEN', 'PORCENTAJE', 'TOTAL_COMISION', 'TOTAL_COMISION_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'PROFUNDIDAD', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'PAIS_ORDEN', 'TOTAL_ORDEN', 'VP_ORDEN', 'PERIODO_ORDEN', 'NUMATCARD'];
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_simulador_override_exigo $code, '$period';", "SQL173", $h);
            $hoja3->fromArray($d, null, 'A3', true);
        # hoja 3

        # hoja 4
            $hoja4 = $spreadsheet->createSheet();

            $hoja4->setTitle("fn_leadrship_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja4->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja4->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja4->setAutoFilter('A3:Q3');

            $hoja4->mergeCells('A1:M1');
            $hoja4->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja4->setCellValue('A2', "id socio: $code");
            $hoja4->getStyle('A1')->getFont()->setBold(true);

            $h = ['OWNERID', 'VC_ORDEN', 'VC_PLUS_ORDEN', 'PORCENTAJE', 'TOTAL_COMISION', 'TOTAL_COMISION_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'PROFUNDIDAD', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'PAIS_ORDEN', 'TOTAL_ORDEN', 'VP_ORDEN', 'PERIODO_ORDEN', 'NUMATCARD'];
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_simulador_leadership_exigo $code, '$period';", "SQL173", $h);
            $hoja4->fromArray($d, null, 'A3', true);
        # hoja 4
        
        # hoja 5
            $hoja5 = $spreadsheet->createSheet();

            $hoja5->setTitle("fn_lifestyleBonus_exigo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja5->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja5->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja5->setAutoFilter('A3:Q3');

            $hoja5->mergeCells('A1:M1');
            $hoja5->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja5->setCellValue('A2', "id socio: $code");
            $hoja5->getStyle('A1')->getFont()->setBold(true);

            $h = ['OWNERID', 'VC_ORDEN', 'VC_PLUS_ORDEN', 'PORCENTAJE', 'TOTAL_COMISION', 'TOTAL_COMISION_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'PROFUNDIDAD', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'PAIS_ORDEN', 'TOTAL_ORDEN', 'VP_ORDEN', 'PERIODO_ORDEN', 'NUMATCARD'];
            $d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_simulador_lifestyleBonus_exigo $code, '$period';", "SQL173", $h);
            $hoja5->fromArray($d, null, 'A3', true);
        # hoja 5

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Check de bonificaciones $code - " . Date('Y_m_d_H_i_s') . '.xlsx';
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

    public function homeReportVolum(){
        return view('otros.homeReportVolum');
    }

    public function reportVolum(){
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
            $hoja1->getStyle('A3:M3')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A3:M3');

            $hoja1->mergeCells('A1:M1');
            $hoja1->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            // $hoja1->setCellValue('A2', "id socio: $code");
            $hoja1->getStyle('A1')->getFont()->setBold(true);
            
            $h = ['PERIODO', 'CODIGO_SOCIO', 'NOMBRE_SOCIO', 'TELEFONO', 'CORREO', 'TIPO_DISTRIBUIDOR', 'ESTATUS', 'RANGO', 'PAIS', 'VP', 'VGP', 'VO', 'VOLDP', 'VOLDPYS', 'CODIGO_PATROCINADOR', 'NOMBRE_PATROCINADOR', 'PAIS_PATROCINADOR', 'ULTIMA_ACTUALIZACION'];
            $d = $core->getReportBody("SELECT 
                                            a.Period,
                                            a.Associateid AS CodigoSocio,
                                            b.AssociateName AS NombreDelSocio,
                                            ISNULL(CASE
                                                WHEN b.Country in ('US','CA') THEN IIF(b.Mobile_Number= '' or b.Mobile_Number is null,b.Alternative_number,b.Mobile_Number)
                                                ELSE IIF(e.Phone1= '' or e.Phone1 is null,e.Phone2,e.Phone1)
                                            END,'') AS Telefono,
                                            ISNULL(e.E_Mail,'') AS CorreoElectronico,
                                            b.CustomerTypeID AS TipoDeDistribuidor,
                                            b.Distributor_Status AS Estado,
                                            a.RankID AS Rango,
                                            b.Country AS Pais,
                                            a.VP,
                                            a.VGP,
                                            a.VO,
                                            a.VOLDP,
                                            a.VOLDPYS,
                                            b.Sponsor_id AS CodigoDePatrocinador,
                                            d.AssociateName AS NombreDePatrocinador,
                                            d.Country AS PaisDePatrocinador,
                                            a.UltimaActualizacion
                                        FROM diccionarioExigo.dbo.VolumeHistory a WITH(NOLOCK)
                                        LEFT JOIN diccionarioExigo.dbo.Distributors_MD b WITH(NOLOCK) on a.Associateid = b.AssociateID 
                                        LEFT JOIN diccionarioExigo.dbo.Distributors_MD d WITH(NOLOCK) on b.Sponsor_id = d.Associateid
                                        LEFT JOIN diccionarioExigo.dbo.CardCodeInfoDeSAP e WITH(NOLOCK) on a.Associateid = e.CardCode
                                        WHERE a.Period = $period;", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Csv($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Reporte de Volumen Exigo $period - " . Date('Y_m_d_H_i_s') . '.csv';
        return response()->stream(
            function () use ($tempFilePath) {
                readfile($tempFilePath);
                unlink($tempFilePath);
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8',
                'Content-Disposition' => 'attachment; filename=' . $fileName,
            ]
        );
    }

    public function ficha2(){
        $code = request()->code;
        $period = request()->period;
        ini_set('max_execution_time', 500);
        $core = new coreApp();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);
        $styleMorado = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '800080'] // Morado
            ]
        ];
        

     // # hoja 1
        /*
        $hoja1 = $spreadsheet->getActiveSheet();

        $hoja1->setTitle("Tablero");
        for($i=65; $i<=90; $i++) {  
            $letter = chr($i);
            $hoja1->getColumnDimension($letter)->setAutoSize(true);
        }
        $hoja1->getStyle('A3:M3')->getFont()->setBold(true);
        $hoja1->setAutoFilter('A3:M3');

        $hoja1->mergeCells('A1:M1');
        $hoja1->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
        $hoja1->setCellValue('A2', "id socio: $code");
        $hoja1->getStyle('A1')->getFont()->setBold(true);

        //$h = ['OWNERID', 'TOTAL_ORDEN', 'RETAIL', 'RANGO_SOCIO', 'MONEDA', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'PAIS_ORDEN', 'VP_ORDEN', 'VC_ORDEN', 'PERIODO_ORDEN', 'NUMATCARD'];
        //$d = $core->getReportBody("EXEC diccionarioExigo.dbo.vcplus_simulador_retail_exigo $code, '$period';", "SQL173", $h);
        //$hoja1->fromArray($d, null, 'A3', true);
        */
        # hoja 1



        // # hoja 2
        // Hoja 2
        $hoja2 = $spreadsheet->createSheet();
        $hoja2->setTitle("Lista_ganadores");

        // Estilo morado con texto blanco
        $styleMorado = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '800080']
            ]
        ];

        // Autoajustar columnas de A a Z
        for ($i = 65; $i <= 90; $i++) {
            $hoja2->getColumnDimension(chr($i))->setAutoSize(true);
        }

        // Títulos principales en parte superior
        $hoja2->mergeCells('A1:M1');
        $hoja2->setCellValue('A1', "NIKKEN LATINOAMERICA");

        $hoja2->mergeCells('A2:M2');
        $hoja2->setCellValue('A2', "LISTA DEFINITIVA PARA RECONOCIMIENTOS - FICHA # 2");

        $hoja2->mergeCells('A3:M3');
        $hoja2->setCellValue('A3', "MES DE MEDICIÓN: MARZO DE 2025");

        $hoja2->mergeCells('A4:M4');
        $hoja2->setCellValue('A4', "Elaborado por Procesos Comerciales : " . date("Y-m-d H:i:s"));

        // Aplicar fondo morado a los títulos
        $hoja2->getStyle('A1:M4')->applyFromArray($styleMorado);

        // CABECERAS (personalizadas)
        $headers = [
            'Distribuidor', 'Tipo', 'Nombre', 'Telefono', 'Rango', 'Ciudad', 'Estado',
            'E_mail', 'pais', 'VP_LATAM_Marzo', 'VP_GLOBAL_Marzo', 'numero_Ascensos', 'Ficha_No2'
        ];

        // Pintar cabeceras en la fila 6
        $hoja2->fromArray($headers, null, 'A6');
        $hoja2->getStyle('A6:M6')->applyFromArray($styleMorado);
        $hoja2->setAutoFilter('A6:M6');

        // Obtener los datos desde SP (omitimos encabezado porque ya lo definimos)
        $h = []; // sin columnas forzadas
        $d = $core->getReportBody("EXEC [LAT_MyNIKKEN].[dbo].[conEmp_reporteria_Ficha2_ganadores]", "SQL73", $h);

        // Insertar datos en fila 7 hacia abajo
        $hoja2->fromArray($d, null, 'A6', true);
        # hoja 2
        // Hoja 3
                $hoja3 = $spreadsheet->createSheet();
                $hoja3->setTitle("Data_Socios");

                // Estilo morado con texto blanco
                $styleMorado = [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF']
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '800080']
                    ]
                ];

                // Autoajustar columnas de A a Z
                for ($i = 65; $i <= 90; $i++) {
                    $hoja3->getColumnDimension(chr($i))->setAutoSize(true);
        }

        // Títulos institucionales en la parte superior
        $hoja3->mergeCells('A1:W1');
        $hoja3->setCellValue('A1', "NIKKEN LATINOAMERICA");

        $hoja3->mergeCells('A2:W2');
        $hoja3->setCellValue('A2', "LISTA DEFINITIVA PARA RECONOCIMIENTOS - FICHA # 2");

        $hoja3->mergeCells('A3:W3');
        $hoja3->setCellValue('A3', "MES DE MEDICIÓN: MARZO DE 2025");

        $hoja3->mergeCells('A4:W4');
        $hoja3->setCellValue('A4', "Elaborado por Procesos Comerciales : " . date("Y-m-d H:i:s"));

        // Aplicar fondo morado a las cabeceras superiores
        $hoja3->getStyle('A1:W4')->applyFromArray($styleMorado);

        // CABECERAS de columna
        $headers3 = [
            'Distribuidor', 'Tipo', 'Estatus_SAP', 'Nombre', 'Telefono', 'Rango_inicial', 'Ciudad', 'Estado',
            'E_mail', 'pais', 'VP_LATAM_Marzo', 'Falta_VP', 'VP_GLOBAL_Marzo', 'numero_Ascensos', 'Falta_Ascensos',
            'Ficha_No2', 'VPde_1a100', 'VPde_101a200', 'VPde_201a299', 'VPde_300a400', 'VPde_401a499', 'VPde_500omás'
        ];

        // Escribir encabezados en fila 6
        $hoja3->fromArray($headers3, null, 'A6');
        $hoja3->getStyle('A6:W6')->applyFromArray($styleMorado);
        $hoja3->setAutoFilter('A6:W6');

        // Obtener datos desde SP (sin encabezados porque ya los definimos)
        $h3 = []; // sin columnas forzadas
        $d3 = $core->getReportBody("EXEC [LAT_MyNIKKEN].[dbo].[conEmp_reporteria_Ficha2_dataSocios]", "SQL73", $h3);

        // Insertar datos en fila 7 hacia abajo
        $hoja3->fromArray($d3, null, 'A6', true);
        # hoja 3
        # hoja 4
        $hoja4 = $spreadsheet->createSheet();
        $hoja4->setTitle("Detalle_de_Ascensos");
        
        // Estilo morado con texto blanco
        $styleMorado = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '800080']
            ]
        ];
        
        // Autoajustar columnas A-Z
        for ($i = 65; $i <= 90; $i++) {
            $hoja4->getColumnDimension(chr($i))->setAutoSize(true);
        }
        
        // Títulos superiores institucionales
        $hoja4->mergeCells('A1:S1');
        $hoja4->setCellValue('A1', "NIKKEN LATINOAMERICA");
        
        $hoja4->mergeCells('A2:S2');
        $hoja4->setCellValue('A2', "LISTA DEFINITIVA PARA RECONOCIMIENTOS - FICHA # 2");
        
        $hoja4->mergeCells('A3:S3');
        $hoja4->setCellValue('A3', "MES DE MEDICIÓN: MARZO DE 2025");
        
        $hoja4->mergeCells('A4:S4');
        $hoja4->setCellValue('A4', "Elaborado por Procesos Comerciales : " . date("Y-m-d H:i:s"));
        
        // Aplicar fondo morado a los títulos institucionales
        $hoja4->getStyle('A1:S4')->applyFromArray($styleMorado);
        
        // Cabeceras personalizadas
        $headers4 = [
            'Distribuidor', 'Tipo', 'Nombre', 'Telefono', 'Rango_Inicial', 'Rango_Final', 'Ciudad', 'Estado',
            'E_mail', 'pais', 'codigo_Patrocinador', 'nombre_patrocinador', 'ciudad_patrocinador',
            'estado_patrocinador', 'E_mail_patrocinador', 'Pais_Patrocinador', 'VP', 'VGP_Cumple', 'avance'
        ];
        
        // Escribir cabeceras en la fila 6
        $hoja4->fromArray($headers4, null, 'A6');
        $hoja4->getStyle('A6:S6')->applyFromArray($styleMorado);
        $hoja4->setAutoFilter('A6:S6');
        
        // Ejecutar SP y traer los datos
        $h4 = []; // sin columnas forzadas
        $d4 = $core->getReportBody("EXEC [LAT_MyNIKKEN].[dbo].[conEmp_reporteria_Ficha2_detalleAscensos]", "SQL73", $h4);
        
        // Insertar los datos a partir de fila 7
        $hoja4->fromArray($d4, null, 'A6', true);
        # hoja 4
        
        # hoja 5
        $hoja5 = $spreadsheet->createSheet();
        $hoja5->setTitle("OrdenesNA");
        
        // Estilo morado con letras blancas
        $styleMorado = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '800080']
            ]
        ];
        
        // Autoajustar columnas A-Z
        for ($i = 65; $i <= 90; $i++) {
            $hoja5->getColumnDimension(chr($i))->setAutoSize(true);
        }
        
        // Títulos institucionales superiores
        $hoja5->mergeCells('A1:G1');
        $hoja5->setCellValue('A1', "NIKKEN LATINOAMERICA");
        
        $hoja5->mergeCells('A2:G2');
        $hoja5->setCellValue('A2', "LISTA DEFINITIVA PARA RECONOCIMIENTOS - FICHA # 2");
        
        $hoja5->mergeCells('A3:G3');
        $hoja5->setCellValue('A3', "MES DE MEDICIÓN: MARZO DE 2025");
        
        $hoja5->mergeCells('A4:G4');
        $hoja5->setCellValue('A4', "Elaborado por Procesos Comerciales : " . date("Y-m-d H:i:s"));
        
        // Aplicar fondo morado a los títulos institucionales
        $hoja5->getStyle('A1:G4')->applyFromArray($styleMorado);
        
        // Cabeceras específicas de la hoja
        $headers5 = [
            'Distribuidor', 'numero_Orden', 'fecha_Orden', 'pais', 'valorOrden', 'puntos', 'sponsor'
        ];
        
        // Escribir cabeceras en la fila 6
        $hoja5->fromArray($headers5, null, 'A6');
        $hoja5->getStyle('A6:G6')->applyFromArray($styleMorado);
        $hoja5->setAutoFilter('A6:G6');
        
        // Obtener los datos desde el SP
        $h5 = [];
        $d5 = $core->getReportBody("EXEC [LAT_MyNIKKEN].[dbo].[conEmp_reporteria_Ficha2_ordenNA]", "SQL73", $h5);
        
        // Insertar datos desde la fila 7
        $hoja5->fromArray($d5, null, 'A6', true);
        # hoja 5


         // Hoja 6
        $hoja6 = $spreadsheet->createSheet();
        $hoja6->setTitle("requisitos");

        // Ajustar ancho de columna A para todo el texto
        $hoja6->getColumnDimension('A')->setAutoSize(true);

        // Contenido distribuido (sin cabeceras ni formatos morados)
        $contenido = [
            ['2da Ficha Congreso'],
            ['Lanzamiento KO 3 de marzo'],
            ['Vigencia:'],
            ['1 al 31 de marzo'],
            ['Requisito:'],
            ['1.      VP mínimo: 500 puntos'],
            ['2.      3 frontales que asciendan a rango superior (VP 100 VGP 500)'],
            ['Ficha ganada:'],
            ['Entrada al Congreso (Ficha obligatoria)'],
            ['Términos y condiciones'],
            ['·         Dirigido a todos los socios de NIKKEN Latinoamérica pueden ganar la ficha congreso.'],
            ['·         Vigencia del 1 al 31 de enero del 2025.'],
            ['·         El VP que se tendrá en cuenta será el generado en NIKKEN Latinoamérica.'],
            ['·         Las compras de los clientes preferentes aplican para el cumplimiento del VP.'],
            ['·         Para ganar ficha doble se deben cumplir los requisitos al doble.'],
            ['·         Las fichas no son transferibles ni canjeables por dinero.'],
            ['·         Para el requisito de ascensos los socios de rango directo que suben a superior deben ser frontales de origen NIKKEN Latinoamérica.'],
            ['·         Para el ascenso de los superiores aplica el volumen de todas las unidades de mercado.'],
            ['·         NIKKEN se reserva la interpretación de este incentivo.'],
        ];

        // Insertar contenido desde la celda A1 hacia abajo
        $hoja6->fromArray($contenido, null, 'A1', true);
        # hoja 6
        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Reconocimientos ficha 2 $code - " . Date('Y_m_d_H_i_s') . '.xlsx';
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
    
    public function downloadReportvc300(){
        $coreCms = new coreApp();
        $sap_code_user = request()->sap_code_user;
        $periodSelect = request()->periodSelect;

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Grupo Personal");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A3:Q3');

            $hoja1->mergeCells('A1:Q1');
            $hoja1->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            // $hoja1->setCellValue('A2', "id socio: $code");
            $hoja1->getStyle('A1')->getFont()->setBold(true);
            
            $h = ['OWNERID', 'VC_REGULAR', 'VC_PLUS', 'PORCENTAJE', 'TOTAL_COMISION_REGULAR', 'TOTAL_COMISION_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'PROFUNDIDAD', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'TOTAL_ORDEN', 'PERIODO_ORDEN', 'OWNERID_NOMBRE', 'ASSOCIATEID_NOMBRE', 'TIPO_BONUS'];
            $d = $coreCms->getReportBody("SELECT 
                                        OWNERID,
                                        VC_REGULAR,
                                        VC_PLUS,
                                        PORCENTAJE,
                                        TOTAL_COMISION_REGULAR,
                                        TOTAL_COMISION_VC_PLUS,
                                        RANGO_SOCIO,
                                        MONEDA,
                                        PROFUNDIDAD,
                                        ASSOCIATEID,
                                        ORDER_NUM,
                                        FECHA_ORDEN,
                                        TOTAL_ORDEN,
                                        PERIODO_ORDEN,
                                        OWNERID_NOMBRE,
                                        ASSOCIATEID_NOMBRE,
                                        TIPO_BONUS
                                    FROM VCplus.dbo.vcplus_calculo WITH(NOLOCK)
                                    WHERE 
                                        PERIODO_ORDEN = '$periodSelect'
                                        AND OWNERID = $sap_code_user
                                        AND Tipo_Bonus IN (2, 3)", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();

            $hoja2->setTitle("Liderazgo");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A3:Q3');

            $hoja2->mergeCells('A1:Q1');
            $hoja2->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $h = ['OWNERID', 'VC_REGULAR', 'VC_PLUS', 'PORCENTAJE', 'TOTAL_COMISION_REGULAR', 'TOTAL_COMISION_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'PROFUNDIDAD', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'TOTAL_ORDEN', 'PERIODO_ORDEN', 'OWNERID_NOMBRE', 'ASSOCIATEID_NOMBRE', 'TIPO_BONUS'];
            $d = $coreCms->getReportBody("SELECT 
                                        OWNERID,
                                        VC_REGULAR,
                                        VC_PLUS,
                                        PORCENTAJE,
                                        TOTAL_COMISION_REGULAR,
                                        TOTAL_COMISION_VC_PLUS,
                                        RANGO_SOCIO,
                                        MONEDA,
                                        PROFUNDIDAD,
                                        ASSOCIATEID,
                                        ORDER_NUM,
                                        FECHA_ORDEN,
                                        TOTAL_ORDEN,
                                        PERIODO_ORDEN,
                                        OWNERID_NOMBRE,
                                        ASSOCIATEID_NOMBRE,
                                        TIPO_BONUS
                                    FROM VCplus.dbo.vcplus_calculo WITH(NOLOCK)
                                    WHERE 
                                        PERIODO_ORDEN = '$periodSelect'
                                        AND OWNERID = $sap_code_user
                                        AND Tipo_Bonus = 7;", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A3', true);
        # hoja 2
        
        # hoja 3
            $hoja3 = $spreadsheet->createSheet();

            $hoja3->setTitle("Sugerido");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja3->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A3:Q3');

            $hoja3->mergeCells('A1:Q1');
            $hoja3->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja3->getStyle('A1')->getFont()->setBold(true);

            $h = ['OWNERID', 'VC_REGULAR', 'VC_PLUS', 'PORCENTAJE', 'TOTAL_COMISION_REGULAR', 'TOTAL_COMISION_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'PROFUNDIDAD', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'TOTAL_ORDEN', 'PERIODO_ORDEN', 'OWNERID_NOMBRE', 'ASSOCIATEID_NOMBRE', 'TIPO_BONUS'];
            $d = $coreCms->getReportBody("SELECT 
                                        OWNERID,
                                        VC_REGULAR,
                                        VC_PLUS,
                                        PORCENTAJE,
                                        TOTAL_COMISION_REGULAR,
                                        TOTAL_COMISION_VC_PLUS,
                                        RANGO_SOCIO,
                                        MONEDA,
                                        PROFUNDIDAD,
                                        ASSOCIATEID,
                                        ORDER_NUM,
                                        FECHA_ORDEN,
                                        TOTAL_ORDEN,
                                        PERIODO_ORDEN,
                                        OWNERID_NOMBRE,
                                        ASSOCIATEID_NOMBRE,
                                        TIPO_BONUS
                                    FROM VCplus.dbo.vcplus_calculo WITH(NOLOCK)
                                    WHERE 
                                        PERIODO_ORDEN = '$periodSelect'
                                        AND OWNERID = $sap_code_user
                                        AND Tipo_Bonus = 6;", "SQL173", $h);
            $hoja3->fromArray($d, null, 'A3', true);
        # hoja 3
        
        # hoja 4
            $hoja4 = $spreadsheet->createSheet();

            $hoja4->setTitle("Club De Compras");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja4->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja4->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja4->setAutoFilter('A3:Q3');

            $hoja4->mergeCells('A1:Q1');
            $hoja4->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja4->getStyle('A1')->getFont()->setBold(true);

            $h = ['OWNERID', 'VC_REGULAR', 'VC_PLUS', 'PORCENTAJE', 'TOTAL_COMISION_REGULAR', 'TOTAL_COMISION_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'PROFUNDIDAD', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'TOTAL_ORDEN', 'PERIODO_ORDEN', 'OWNERID_NOMBRE', 'ASSOCIATEID_NOMBRE', 'TIPO_BONUS'];
            $d = $coreCms->getReportBody("SELECT 
                                        OWNERID,
                                        VC_REGULAR,
                                        VC_PLUS,
                                        PORCENTAJE,
                                        TOTAL_COMISION_REGULAR,
                                        TOTAL_COMISION_VC_PLUS,
                                        RANGO_SOCIO,
                                        MONEDA,
                                        PROFUNDIDAD,
                                        ASSOCIATEID,
                                        ORDER_NUM,
                                        FECHA_ORDEN,
                                        TOTAL_ORDEN,
                                        PERIODO_ORDEN,
                                        OWNERID_NOMBRE,
                                        ASSOCIATEID_NOMBRE,
                                        TIPO_BONUS
                                    FROM VCplus.dbo.vcplus_calculo WITH(NOLOCK)
                                    WHERE 
                                        PERIODO_ORDEN = '$periodSelect'
                                        AND OWNERID = $sap_code_user
                                        AND Tipo_Bonus = 111;", "SQL173", $h);
            $hoja4->fromArray($d, null, 'A3', true);
        # hoja 4

        # hoja 5
            $hoja5 = $spreadsheet->createSheet();

            $hoja5->setTitle("Estilo de Vida");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja5->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja5->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja5->setAutoFilter('A3:Q3');

            $hoja5->mergeCells('A1:Q1');
            $hoja5->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja5->getStyle('A1')->getFont()->setBold(true);

            $h = ['OWNERID', 'VC_REGULAR', 'VC_PLUS', 'PORCENTAJE', 'TOTAL_COMISION_REGULAR', 'TOTAL_COMISION_VC_PLUS', 'RANGO_SOCIO', 'MONEDA', 'PROFUNDIDAD', 'ASSOCIATEID', 'ORDER_NUM', 'FECHA_ORDEN', 'TOTAL_ORDEN', 'PERIODO_ORDEN', 'OWNERID_NOMBRE', 'ASSOCIATEID_NOMBRE', 'TIPO_BONUS'];
            $d = $coreCms->getReportBody("SELECT 
                                        OWNERID,
                                        VC_REGULAR,
                                        VC_PLUS,
                                        PORCENTAJE,
                                        TOTAL_COMISION_REGULAR,
                                        TOTAL_COMISION_VC_PLUS,
                                        RANGO_SOCIO,
                                        MONEDA,
                                        PROFUNDIDAD,
                                        ASSOCIATEID,
                                        ORDER_NUM,
                                        FECHA_ORDEN,
                                        TOTAL_ORDEN,
                                        PERIODO_ORDEN,
                                        OWNERID_NOMBRE,
                                        ASSOCIATEID_NOMBRE,
                                        TIPO_BONUS
                                    FROM VCplus.dbo.vcplus_calculo WITH(NOLOCK)
                                    WHERE 
                                        PERIODO_ORDEN = '$periodSelect'
                                        AND OWNERID = $sap_code_user
                                        AND Tipo_Bonus = 8;", "SQL173", $h);
            $hoja5->fromArray($d, null, 'A3', true);
        # hoja 5

        $fileName = "VC 300 $sap_code_user - $periodSelect - v" . Date('is') . '.xlsx';

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
    
    public function download_rep_volumenes_rec(){
        $coreCms = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("VOL");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A3:Q3')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A3:Q3');

            $hoja1->mergeCells('A1:Q1');
            $hoja1->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A1')->getFont()->setBold(true);
            
            $h = ['ASSOCIATEID', 'VP_ENERO', 'VGP_ENERO', 'VO_ENERO', 'VP_FEBRERO', 'VGP_FEBRERO', 'VO_FEBRERO', 'VP_MARZO', 'VGP_MARZO', 'VO_MARZO', 'VP_ABRIL', 'VGP_ABRIL', 'VO_ABRIL', 'VP_MAYO', 'VGP_MAYO', 'VO_MAYO', 'VP_JUNIO', 'VGP_JUNIO', 'VO_JUNIO', 'VP_JULIO', 'VGP_JULIO', 'VO_JULIO', 'VP_AGOSTO', 'VGP_AGOSTO', 'VO_AGOSTO', 'VP_SEPTIEMBRE', 'VGP_SEPTIEMBRE', 'VO_SEPTIEMBRE', 'VP_OCTUBRE', 'VGP_OCTUBRE', 'VO_OCTUBRE', 'VP_NOVIEMBRE', 'VGP_NOVIEMBRE', 'VO_NOVIEMBRE', 'VP_DICIEMBRE', 'VGP_DICIEMBRE', 'VO_DICIEMBRE', 'PAIS'];
            $d = $coreCms->getReportBody("EXEC LAT_MyNIKKEN.dbo.rep_volumenes_nikkenReconocimientos", "SQL73", $h);
            $hoja1->fromArray($d, null, 'A3', true);
        # hoja 1

        $fileName = "VOL Reconocimientos - v" . Date('is') . '.csv';

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Csv($spreadsheet);
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
    
    public function regresa_casa_report(){
        $coreCms = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("VOL");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A7:Q7')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A7:V7');

            $hoja1->mergeCells('A1:E1');
            $hoja1->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $hoja1->mergeCells('A2:E2');
            $hoja1->setCellValue('A2', "Vuelve a casa");
            $hoja1->getStyle('A2')->getFont()->setBold(true);

            $hoja1->mergeCells('A3:E3');
            $hoja1->setCellValue('A3', "Estrategia de Julio y Agosto de 2025");
            $hoja1->getStyle('A3')->getFont()->setBold(true);

            $hoja1->mergeCells('A4:E4');
            $hoja1->setCellValue('A4', "Socios que se depuraron en el mes de Enero de 2025");
            $hoja1->getStyle('A4')->getFont()->setBold(true);

            $hoja1->mergeCells('A5:E5');
            $hoja1->setCellValue('A5', "Fecha de consulta: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A5')->getFont()->setBold(true);
            
            $h = ['Codigo de Socio', 'Estatus SAP', 'Tipo Distribuidor', 'Nombre del Socio', 'Rango', 'Fecha Ingreso', 'Codigo del Patrocinador', 'Nombre del Patrocinador', 'Estado', 'Correo', 'Telefono', 'Pais', 'Código nuevo', 'Nombre del socio - nuevo', 'Código del Kit de vuelve a casa', 'Mes que vuelve a casa', 'VP Julio', 'VP Agosto', 'Salvado para Septiembre/2025', 'Codigo patrocinador actual', 'Nombre Patrocinador actual', 'Pais Patrocinador actual'];
            $d = $coreCms->getReportBody("EXEC LAT_MyNIKKEN.dbo.RegresaACasa_genealogia_2025_interno", "SQL73", $h);
            $hoja1->fromArray($d, null, 'A7', true);
            $hoja1->getStyle('A7:V7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1F497D');
            $hoja1->getStyle('A7:V7')->getFont()->getColor()->setRGB ('ffffff');

        # hoja 1

        $fileName = "Vuelve a casa Julio y Agosto de 2025 - v" . Date('is') . '.xlsx';

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

    public function impulsa_bd(){
        $coreCms = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Impulsa la base");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A5:T5')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A5:T5');

            $hoja1->mergeCells('A1:E1');
            $hoja1->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $hoja1->mergeCells('A2:E2');
            $hoja1->setCellValue('A2', "Impulsa la base- Julio de 2025");
            $hoja1->getStyle('A2')->getFont()->setBold(true);

            $hoja1->mergeCells('A3:E3');
            $hoja1->setCellValue('A3', "Fecha de consulta: " . Date("Y-m-d H:i:s"));
            $hoja1->getStyle('A3')->getFont()->setBold(true);
            
            $h = ['Código', 'Tipo de Distribuidor', 'Estado', 'Nombre Titular', 'Nombre Cotitular', 'Fecha de incorporación', 'Periodo de Incorporación', 'Rango', 'Correo', 'Estado', 'País', 'Periodo', 'VP Julio', 'Cantidad de Incorporaciones', 'Códigos de incorporación', 'Nombre Item', 'VP adicionales al kit', 'Patrocinador gana bono', 'Incorporado gana bono', 'Cumple estrategia base'];
            $d = $coreCms->getReportBody("EXEC LAT_MyNIKKEN.dbo.impulsaLaBase_2025_reporte_Interno", "SQL73", $h);
            $hoja1->fromArray($d, null, 'A5', true);

            $hoja1->getStyle('A5:T5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('7030A0');
            $hoja1->getStyle('A1:T3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('7030A0');
            $hoja1->getStyle('A5:T5')->getFont()->getColor()->setRGB ('ffffff');
            $hoja1->getStyle('A1:T5')->getFont()->getColor()->setRGB ('ffffff');
        # hoja 1

        # hoja 2
            // $hoja2 = $spreadsheet->createSheet();

            // $hoja2->setTitle("Incorporaciones");
            // for($i=65; $i<=90; $i++) {  
            //     $letter = chr($i);
            //     $hoja2->getColumnDimension($letter)->setAutoSize(true);
            // }
            // $hoja2->getStyle('A5:Z5')->getFont()->setBold(true);
            // $hoja2->setAutoFilter('A5:Z5');

            // $hoja2->mergeCells('A1:E1');
            // $hoja2->setCellValue('A1', "NIKKEN Latinoamérica");
            // $hoja2->getStyle('A1')->getFont()->setBold(true);

            // $hoja2->mergeCells('A2:E2');
            // $hoja2->setCellValue('A2', "Impulsa la base- Julio de 2025");
            // $hoja2->getStyle('A2')->getFont()->setBold(true);

            // $hoja2->mergeCells('A3:E3');
            // $hoja2->setCellValue('A3', "Fecha de consulta: " . Date("Y-m-d H:i:s"));
            // $hoja2->getStyle('A3')->getFont()->setBold(true);

            // $h = ["Tipo", "Codigo", "Nombre", "Kit", "Nombre Kit", "Fecha", "Periodo", "Mes de incorporacion", "Pais", "Departamento", "Celular", "Correo electronico", "Cod. patrocinador", "Nombre patrocinador", "Rango patrocinador", "Telefeno patrocinador", "Celular patrocinador", "Pais patrocinador", "Status", "Usuario", "Segmentacion", "Factura SAP", "Valor", "VP julio ", "VP adicionales", "Cumple requisito"];
            // $d = $coreCms->getReportBody("SELECT GETDATE() as hora", "SQL173", $h);
            // $hoja2->fromArray($d, null, 'A5', true);

            // $hoja2->getStyle('A5:Z5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('7030A0');
            // $hoja2->getStyle('A1:Z3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('7030A0');
            // $hoja2->getStyle('A5:Z5')->getFont()->getColor()->setRGB ('ffffff');
            // $hoja2->getStyle('A1:Z5')->getFont()->getColor()->setRGB ('ffffff');
        # hoja 2

        $fileName = "Impulsa la base - v" . Date('is') . '.xlsx';
        // $fileName = "Impulsa la base - v" . Date('is') . '.csv';

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        // $writer = new Csv($spreadsheet);
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

    public function impulsa_bd_h1_csv(){
        $core = new coreApp();
        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Impulsa la base");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->setAutoFilter('A5:T5');

            $hoja1->mergeCells('A1:E1');
            $hoja1->setCellValue('A1', "NIKKEN Latinoamérica");

            $hoja1->mergeCells('A2:E2');
            $hoja1->setCellValue('A2', "Impulsa la base- Julio de 2025");

            $hoja1->mergeCells('A3:E3');
            $hoja1->setCellValue('A3', "Fecha de consulta: " . Date("Y-m-d H:i:s"));
            
            $h = ['Código', 'Tipo de Distribuidor', 'Estado', 'Nombre Titular', 'Nombre Cotitular', 'Fecha de incorporación', 'Periodo de Incorporación', 'Rango', 'Correo', 'Estado', 'País', 'Periodo', 'VP Julio', 'Cantidad de Incorporaciones', 'Códigos de incorporación', 'Nombre Item', 'VP adicionales al kit', 'Patrocinador gana bono', 'Incorporado gana bono', 'Cumple estrategia base'];
            $d = $core->getReportBody("EXEC LAT_MyNIKKEN.dbo.impulsaLaBase_2025_reporte_Interno", "SQL73", $h);
            $hoja1->fromArray($d, null, 'A5', true);
        # hoja 1

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Csv($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Impulsa la base - v" . Date('Y_m_d_H_i_s') . '.csv';
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

    public function impulsa_bd_h2_csv(){
        $core = new coreApp();
        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Incorporaciones");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->setAutoFilter('A5:T5');

            $hoja1->mergeCells('A1:E1');
            $hoja1->setCellValue('A1', "NIKKEN Latinoamérica");

            $hoja1->mergeCells('A2:E2');
            $hoja1->setCellValue('A2', "Impulsa la base- Julio de 2025");

            $hoja1->mergeCells('A3:E3');
            $hoja1->setCellValue('A3', "Fecha de consulta: " . Date("Y-m-d H:i:s"));
            
            $h = ["Tipo", "Codigo", "Nombre", "Kit", "Nombre Kit", "Fecha", "Periodo", "Mes de incorporacion", "Pais", "Departamento", "Celular", "Correo electronico", "Cod. patrocinador", "Nombre patrocinador", "Rango patrocinador", "Telefeno patrocinador", "Celular patrocinador", "Pais patrocinador", "Status", "Usuario", "Segmentacion", "Factura SAP", "Valor", "VP julio ", "VP adicionales", "Cumple requisito"];
            $d = $core->getReportBody("SELECT GETDATE() as hora", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A5', true);
        # hoja 1

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Csv($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Impulsa la base - Incorporaciones - v" . Date('Y_m_d_H_i_s') . '.csv';
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

    public function fichaCongreso(){
        $core = new coreApp();
        $spreadsheet = new Spreadsheet();
        
        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("1. Consolidado 3 fichas o menos");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
                $hoja1->getColumnDimension('A'.$letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A7:AB7')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A7:AB7');

            $hoja1->mergeCells('A1:D1');
            $hoja1->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $hoja1->mergeCells('A2:D2');
            $hoja1->setCellValue('A2', "Control de fichas congreso mes de Septiembre de 2025");
            $hoja1->getStyle('A2')->getFont()->setBold(true);

            $hoja1->mergeCells('A3:D3');
            $hoja1->setCellValue('A3', "Elaborado por Procesos Comerciales ");
            $hoja1->getStyle('A3')->getFont()->setBold(true);

            $hoja1->mergeCells('A4:D4');
            $hoja1->setCellValue('A4', "3 de septiembre de 2025 ");
            $hoja1->getStyle('A4')->getFont()->setBold(true);

            $hoja1->setCellValue('M6', "Enero VP >=500");
            $hoja1->setCellValue('N6', "Marzo 3 SUP y VP >=500");
            $hoja1->setCellValue('O6', "Abril: VP 500, 3450 VG y 1 Kinya");
            $hoja1->setCellValue('P6', "Cumplimiento de las 4 semanas Junio/25");
            $hoja1->setCellValue('R6', "1 = Si y 0 =No");
            $hoja1->setCellValue('S6', "Fiesta de Celebración ");
            $hoja1->setCellValue('U6', "Entrada al congreso ");
            $hoja1->setCellValue('X6', "Hospedaje ");
            
            $h = ['codigo', 'grupo', 'Estatus', 'nombre', 'direccion3', 'telefono', 'telefono1', 'rango', 'ciudad', 'estado', 'correo', 'pais', 'Ficha #1 Ene', 'Fichas #2 Marz', 'Ficha # 3 Abril', 'Ficha # 4 Prox..', 'Ficha congreso ganadas', 'Recuperate', 'Compra Ficha # 1', 'Valor pagado Ficha #1 ML', 'Compra Ficha # 2 ', 'Recupera Ficha # 2', 'Valor pagado Ficha #2 ML', 'Recupera Ficha # 3', 'Valor canjeable Ficha # 4', 'Saldo Valor canejable ficha # 4', 'Paquete Completo', 'Valor pagado Paquete Completo ML'];
            $d = $core->getReportBody("EXEC [LAT_MyNIKKEN].[dbo].[conEmp_reporteria_recuperaFichas_h1]", "SQL73", $h);
            $hoja1->fromArray($d, null, 'A7', true);
            $hoja1->getStyle('A1:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('074F69');
            $hoja1->getStyle('A1:D2')->getFont()->getColor()->setRGB ('ffffff');
            $hoja1->getStyle('A7:Q7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('074F69');
            $hoja1->getStyle('R7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('F2CEEF');
            $hoja1->getStyle('S7:AB7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('7030A0');
            $hoja1->getStyle('A7:AB7')->getFont()->getColor()->setRGB ('ffffff');
        # hoja 1

        # hoja 2
            $hoja2 = $spreadsheet->createSheet();

            $hoja2->setTitle("2. Recuperate Ficha #2 o 3");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A12:Z12')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A12:Z12');

            $hoja2->mergeCells('A1:E1');
            $hoja2->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $hoja2->mergeCells('A2:E2');
            $hoja2->setCellValue('A2', "Recuperate Ficha # 2 o 3 ");
            $hoja2->getStyle('A2')->getFont()->setBold(true);

            $hoja2->mergeCells('A3:D3');
            $hoja2->setCellValue('A3', "Elaborado por Procesos Comerciales ");
            $hoja2->getStyle('A3')->getFont()->setBold(true);
            
            $hoja2->mergeCells('A4:D4');
            $hoja2->setCellValue('A4', "3 de septiembre de 2025 ");
            $hoja2->getStyle('A4')->getFont()->setBold(true);

            $h = ['codigo', 'grupo', 'Estatus', 'nombre', 'direccion3', 'telefono', 'telefono1', 'rango', 'ciudad', 'estado', 'correo', 'pais', 'Fichas #2 Marz', 'Ficha # 3 Abril', 'VP  Sep', 'VG  Sep', 'Avances Frontales', 'Unidades de agua', 'VP500 ', 'VG4500', '1 Sup Frontal ', '3 Unidades de agua', 'Gana que ficha ', ];
            $d = $core->getReportBody("EXEC [LAT_MyNIKKEN].[dbo].[conEmp_reporteria_recuperaFichas_h2]", "SQL73", $h);
            $hoja2->fromArray($d, null, 'A12', true);

            $hoja2->getStyle('A1:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('074F69');
            $hoja2->getStyle('A1:D2')->getFont()->getColor()->setRGB ('ffffff');
            $hoja2->getStyle('A12:W12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('074F69');
            $hoja2->getStyle('A12:W12')->getFont()->getColor()->setRGB ('ffffff');
        # hoja 2

        # hoja 3
            $hoja3 = $spreadsheet->createSheet();

            $hoja3->setTitle("3. Facturación y NC ");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
                $hoja3->getColumnDimension('A'.$letter)->setAutoSize(true);
            }
            $hoja3->getStyle('A7:AB7')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A7:AB7');

            $hoja3->mergeCells('A1:E1');
            $hoja3->setCellValue('A1', "NIKKEN Latinoamérica");
            $hoja3->getStyle('A1')->getFont()->setBold(true);

            $hoja3->mergeCells('A2:E2');
            $hoja3->setCellValue('A2', "Facturación y NC ");
            $hoja3->getStyle('A2')->getFont()->setBold(true);

            $hoja3->mergeCells('A3:D3');
            $hoja3->setCellValue('A3', "Elaborado por Procesos Comerciales ");
            $hoja3->getStyle('A3')->getFont()->setBold(true);
            
            $hoja3->mergeCells('A4:D4');
            $hoja3->setCellValue('A4', "3 de septiembre de 2025 ");
            $hoja3->getStyle('A4')->getFont()->setBold(true);

            $h = ['PAIS', 'U_NAME', 'DocDate', 'DocNum', 'CardCode', 'CardName', 'U_ran_CI', 'U_Precio', 'VisOrder', 'Codigo', 'ItemName', 'ItmsGrpNam', 'Cantidad', 'LineTotal', 'U_menudeo_comis', 'U_vol_calc', 'U_Puntos', 'U_Flete_incluido', 'U_autoship', 'NumAtCard', 'Grupo', 'U_Marca', 'U_Periodo', 'InvntItem', 'U_Num_Patrocinador', 'tipo_CI', 'CI_Activo', 'Usuario', ];
            $d = $core->getReportBody("EXEC [LAT_MyNIKKEN].[dbo].[conEmp_reporteria_recuperaFichas_h3]", "SQL73", $h);
            $hoja3->fromArray($d, null, 'A7', true);

            $hoja3->getStyle('A1:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('074F69');
            $hoja3->getStyle('A1:D2')->getFont()->getColor()->setRGB ('ffffff');
            $hoja3->getStyle('A7:AB7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('074F69');
            $hoja3->getStyle('A7:AB7')->getFont()->getColor()->setRGB ('ffffff');
        # hoja 3

        $fileName = "Recupera Fichas - v" . Date('is') . '.xlsx';

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

    public function finAnioPlata(){
        $coreCms = new coreApp();

        $spreadsheet = new Spreadsheet();

        # hoja 1
            $hoja1 = $spreadsheet->getActiveSheet();

            $hoja1->setTitle("Participantes");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                // $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja1->getStyle('A4:W4')->getFont()->setBold(true);
            $hoja1->setAutoFilter('A4:W4');

            $hoja1->mergeCells('A1:E1');
            $hoja1->setCellValue('A1', "NIKKEN Latinoamérica - Cierra el año en rango Plata en 3 meses");
            $hoja1->setCellValue('A2', "Fecha de descarga: " . Date('Y-m-d H:i:s'));
            $hoja1->getStyle('A1:A2')->getFont()->setBold(true);
            
            $h = ['Código', 'Nombre', 'País', 'Estado', 'Correo', 'Teléfono', 'Rango Octubre', 'Rango Meta', 'Periodo Icio', 'VP Otubre', 'Cumple VP 100 Octubre', 'VP Noviembre', 'Cumple VP 100 Noviembre', 'VP Diciembre', 'Cumple VP 100 Diciembre', 'VGP Octubre', 'VGP Noviembre', 'VGP Diciembre', 'VOLDP', 'VOLDPYS', 'Total VGP', 'Mes de Avance', 'Cumplio Requisito'];
            $d = $coreCms->getReportBody("SELECT * FROM EXIGO_PROD.dbo.RANGO_OCT_META;", "SQL173", $h);
            $hoja1->fromArray($d, null, 'A4', true);
        # hoja 1

        $fileName = "Termina el año en plata - v" . Date('is') . '.xlsx';
        // $fileName = "Termina el año en plata - v" . Date('is') . '.csv';

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        // $writer = new Csv($spreadsheet);
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
}
