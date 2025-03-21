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
            $hoja1->setCellValue('A1', "Fecha de descarga: " . Date("Y-m-d H:i:s") . "id socio: $code");
            $hoja1->setCellValue('A2', "id socio: $code");
            $hoja1->getStyle('A1')->getFont()->setBold(true);
            
            $h = ['Ownerid', 'total_orden', 'retail', 'rango_Socio', 'moneda', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'vp_Orden', 'vc_Orden', 'Periodo_Orden', 'numAtCardSAP', 'NumFacturaSAP'];
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

            $h = ['Ownerid', 'vc_orden', 'porcentaje', 'rebate', 'rango_Socio', 'moneda', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'total_Orden', 'vp_Orden', 'Periodo_Orden', 'numAtCard', 'NumFactura'];
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

            $h = ['Ownerid', 'vc_Orden', 'porcentaje', 'total_comision', 'rango_Socio', 'moneda', 'profundidad', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'total_Orden', 'vp_Orden', 'Periodo_Orden', 'numAtCard', 'NumFactura'];
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

            $h = ['Ownerid', 'vc_Orden', 'porcentaje', 'total_comision', 'rango_Socio', 'moneda', 'profundidad', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'total_Orden', 'vp_Orden', 'Periodo_Orden', 'numAtCard', 'NumFactura'];
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

            $h = ['Ownerid', 'vc_Orden', 'porcentaje', 'total_comision', 'rango_Socio', 'moneda', 'associateid', 'order_Num', 'fecha_Orden', 'pais_Orden', 'total_Orden', 'vp_Orden', 'Periodo_Orden', 'numAtCard', 'NumFactura'];
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
            
            $h = ['PERIOD', 'ASSOCIATEID', 'VP', 'VGP', 'VO', 'VOLDP', 'VOLDPYS', 'FECHA ACTUALIZACION'];
            $d = $core->getReportBody("SELECT 
                                            Period
                                            ,Associateid 
                                            ,VP
                                            ,VGP
                                            ,VO
                                            ,VOLDP
                                            ,VOLDPYS
                                            ,UltimaActualizacion
                                        FROM diccionarioExigo.dbo.VolumeHistory WITH(NOLOCK)
                                        WHERE Period = $period;", "SQL173", $h);
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
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename=' . $fileName,
            ]
        );
    }
}
