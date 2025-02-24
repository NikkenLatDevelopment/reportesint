<?php

namespace App\Http\Controllers\reportesRetos;

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

class retos2025 extends Controller{
    public function reporteEmprendedor25(){
        $core = new coreApp();

        $spreadsheet = new Spreadsheet();
        
        # HOJA 1
            $hoja1 = $spreadsheet->getActiveSheet();
            $hoja1->setTitle("Tablero Principal");
            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }

            $hoja1->mergeCells('A1:F1');
            $hoja1->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $hoja1->mergeCells('A2:F2');
            $hoja1->setCellValue('A2', "RESULTADOS DE CLUB VIAJERO EMPRENDEDORES");
            $hoja1->getStyle('A2')->getFont()->setBold(true);
            
            $hoja1->mergeCells('A4:B4');
            $hoja1->setCellValue('A4', "Fecha de descarga:");
            $hoja1->setCellValue('C4', Date('Y-m-d H:i:s'));
            $hoja1->getStyle('A4:C4')->getFont()->setBold(true);

            $hoja1->mergeCells('A6:J6');
            $hoja1->setCellValue('A6', "Periodo 1: Enero a Septiembre de 2025");
            $hoja1->getStyle('A6')->getFont()->setBold(true);

            $color = 'FBE2D5';
            $range = "A6";
            $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);

            $hoja1->mergeCells('A8:E8');
            $hoja1->setCellValue('A8', "Cantidad socios calificando");
            $hoja1->getStyle('A8')->getFont()->setBold(true);

            $color = 'FBE2D5';
            $range = "A8:E8";
            $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);

            #TABLA 1
                $headerStyle = [
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFD9D9D9']]
                ];
                $bodyStyle = [
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
                ];
                $h = ['País', 'Trim1 Ene-Mar', 'Trim2 Abr-Jun', 'Trim3 Jul-Sep', 'Ganadores 1 Periodo'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSociosCal;", "SQL173", $h);
                $d[] = ['Latinoamérica', '=SUM(B11:B19)', '=SUM(C11:C19)', '=SUM(D11:D19)', '=SUM(E11:E19)'];
                $hoja1->fromArray($d, null, 'A10', true);
                $hoja1->getStyle('A10:E20')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A10:E10')->applyFromArray($headerStyle);
                $color = 'FBE2D5';
                $range = "A20:E20";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
            #TABLA 1

            #TABLA 2
                $hoja1->mergeCells('A23:J23');
                $hoja1->setCellValue('A23', "Cantidad socios calificando por variable");
                $hoja1->getStyle('A23')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A23:E23";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray([['Filtro por país', 'Latam'],],null, 'A25', true);
                $h = ['Variable', 'Enero',  'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSociosCalVarible;", "SQL173", $h);
                $hoja1->fromArray($d,null, 'A27', true);
                $hoja1->getStyle('A27:J29')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A27:J27')->applyFromArray($headerStyle);
                $hoja1->fromArray([['Filtro por país', 'Latam'],],null, 'A32', true);
                $h = ['Variable', '1 Trimestre', '2 Trimestre', '3 Trimestre'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSociosCalVarible_Trim;", "SQL173", $h);
                $hoja1->fromArray($d, null, 'A34', true);
                $hoja1->getStyle('A34:D38')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A34:D34')->applyFromArray($headerStyle);
            #TABLA 2

            #TABLA 3
                $hoja1->mergeCells('A42:J42');
                $hoja1->setCellValue('A42', "Cantidad de socios con más de 30,000 de VGP en el año");
                $hoja1->getStyle('A42')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A42";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $h = ['País', 'Directo', 'Superior', 'Ejecutivo', 'Plata', 'VGP 30,000 o más'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSocios30000masVGPAnual;", "SQL173", $h);
                $d[] = ['Latinoamérica', '=SUM(B45:B53)', '=SUM(C45:C53)', '=SUM(D45:D53)', '=SUM(E45:E53)', '=SUM(F45:F53)'];
                $hoja1->fromArray($d, null, 'A44', true);
                $hoja1->getStyle('A44:F54')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A44:F44')->applyFromArray($headerStyle);
            #TABLA 3

            #TABLA 4
                $hoja1->mergeCells('A57:J57');
                $hoja1->setCellValue('A57', "Ventas  en dolares generadas por todos los socios que entraron al Reto de Negocio");
                $hoja1->getStyle('A57')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A57";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $h = ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_VentaDolaresSocios2025;", "SQL173", $h);
                $d[] = ['Latinoamérica', '=SUM(B60:B68)', '=SUM(C60:C68)', '=SUM(D60:D68)', '=SUM(E60:E68)', '=SUM(F60:F68)', '=SUM(G60:G68)', '=SUM(H60:H68)', '=SUM(I60:I68)', '=SUM(J60:J68)'];
                $hoja1->fromArray($d, null, 'A59', true);
                $hoja1->getStyle('A59:J69')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A59:J59')->applyFromArray($headerStyle);
            #TABLA 4

            #TABLA 5
                $hoja1->mergeCells('A72:J72');
                $hoja1->setCellValue('A72', "Ventas  en dolares generadas por todos los ganadores del periodo 1");
                $hoja1->getStyle('A72')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A72";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $h = ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_VentaDolaresPeriodo_Uno;", "SQL173", $h);
                $d[] = ['Latinoamérica', '=SUM(B75:B83)', '=SUM(C75:C83)', '=SUM(D75:D83)', '=SUM(E75:E83)', '=SUM(F75:F83)', '=SUM(G75:G83)', '=SUM(H75:H83)', '=SUM(I75:I83)', '=SUM(J75:J83)'];
                $hoja1->fromArray($d, null, 'A74', true);
                $hoja1->getStyle('A74:J84')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A74:J74')->applyFromArray($headerStyle);
            #TABLA 5

            #TABLA 6
                $hoja1->mergeCells('A87:J87');
                $hoja1->setCellValue('A87', "% Venta de los club viajero emprendedores");
                $hoja1->getStyle('A87')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A87";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $h = ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_porcentajeVentaCVE2025;", "SQL173", $h);
                $d[] = ['Latinoamérica', '=SUM(B90:B98)', '=SUM(C90:C98)', '=SUM(D90:D98)', '=SUM(E90:E98)', '=SUM(F90:F98)', '=SUM(G90:G98)', '=SUM(H90:H98)', '=SUM(I90:I98)', '=SUM(J90:J98)'];
                $hoja1->fromArray($d, null, 'A89', true);
                $hoja1->getStyle('A89:J99')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A89:J89')->applyFromArray($headerStyle);
            #TABLA 6
        # HOJA 1
        
        # HOJA 2
            $hoja2 = $spreadsheet->createSheet();
            $hoja2->setTitle("Emprendedores - Periodo 1");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
                $hoja2->getColumnDimension('A' . $letter)->setAutoSize(true);
                $hoja2->getColumnDimension('C' . $letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A7:CO7')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A7:CO7');

            $hoja2->mergeCells('A1:D1');
            $hoja2->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $hoja2->mergeCells('A2:D2');
            $hoja2->setCellValue('A2', "CLUB VIAJERO EMPRENDEDOR ");
            $hoja2->getStyle('A2')->getFont()->setBold(true);

            $hoja2->mergeCells('A3:D3');
            $hoja2->setCellValue('A3', "PERIODO 1:  ENERO A SEPTIEMBRE DE 2025");
            $hoja2->getStyle('A3')->getFont()->setBold(true);

            $hoja2->mergeCells('A4:D4');
            $hoja2->setCellValue('A4', "RANGOS: DIRECTO, SUPERIOR, EJECUTIVO Y PLATA");
            $hoja2->getStyle('A4')->getFont()->setBold(true);

            $hoja2->mergeCells('E1:G1');
            $hoja2->setCellValue('E1', "Fecha y hora de descarcarga del reporte: " . Date('Y-m-d H:i:s'));
            $hoja2->getStyle('E1')->getFont()->setBold(true);

            $color = 'DAE9F8';
            $range = "A7:CO7";
            $hoja2->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja2->getStyle($range)->getFill()->getStartColor()->setRGB($color);

            $h = ['Código Socio', 'Nombre', 'Rango', 'Fecha del último rango', 'Estado', 'Correo electrónico', 'Teléfono Móvil', 'País', 'VP Enero', 'VP Febrero', 'VP Marzo', 'VGP Enero', 'VGP Febrero', 'VGP Marzo', 'KinYa Enero', 'KinYa Febrero', 'KinYa Marzo', 'Inc Agua Enero', 'Inc Agua Febrero', 'Inc Agua Marzo', 'VP Enero', 'VP Febrero', 'VP Marzo', 'VGP Enero', 'VGP Febrero', 'VGP Marzo', 'Acumulado VP 1 Trim', 'Cumple Acumulado VP 1 Trim', 'Acumulado VGP 1 Trim', 'Cumple Acumulado VGP 1 Trim', 'Acumulado Kinya  1 Trim', 'Cumple Acumulado Kinya 1 Trim', 'Acumulado Inc Agua 1 Trim', 'Cumple Acumulado Inc Agua 1 Trim', 'Cumplimiento 1 Trim', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'KinYa Abril', 'KinYa Mayo', 'KinYa Junio', 'Inc Agua Abril', 'Inc Agua Mayo', 'Inc Agua Junio', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'Acumulado VP 2 Trim', 'Cumple Acumulado VP 2 Trim', 'Acumulado VGP 2 Trim', 'Cumple Acumulado VGP 2 Trim', 'Acumulado Kinya  2 Trim', 'Cumple Acumulado Kinya 2 Trim', 'Acumulado Inc Agua 2 Trim', 'Cumple Acumulado Inc Agua 2 Trim', 'Cumplimiento 2 Trim', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'KinYa Julio', 'KinYa Agosto', 'KinYa Septiembre', 'Inc Agua Julio', 'Inc Agua Agosto', 'Inc Agua Septiembre', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'Acumulado VP 3 Trim', 'Cumple Acumulado VP 3 Trim', 'Acumulado VGP 3 Trim', 'Cumple Acumulado VGP 3 Trim', 'Acumulado Kinya  3 Trim', 'Cumple Acumulado Kinya 3 Trim', 'Acumulado Inc Agua 3 Trim', 'Cumple Acumulado Inc Agua 3 Trim', 'Cumplimiento 3 Trim', 'VGP Acumulado 1 Periodo', 'Falta VGP para el 1 Periodo', 'Cumplimiento 1 Periodo', 'Aplica doble requisito 1 periodo'];
            $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_PeriodoUno;", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A7', true);
        # HOJA 2
        
        # HOJA 3
            $hoja3 = $spreadsheet->createSheet();
            $hoja3->setTitle("Emprendedores - Periodo 2");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
                $hoja3->getColumnDimension('A' . $letter)->setAutoSize(true);
                $hoja3->getColumnDimension('C' . $letter)->setAutoSize(true);
            }
            $hoja3->getStyle('A7:CO7')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A7:CO7');

            $hoja3->mergeCells('A1:D1');
            $hoja3->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja3->getStyle('A1')->getFont()->setBold(true);

            $hoja3->mergeCells('A2:D2');
            $hoja3->setCellValue('A2', "CLUB VIAJERO EMPRENDEDOR ");
            $hoja3->getStyle('A2')->getFont()->setBold(true);

            $hoja3->mergeCells('A3:D3');
            $hoja3->setCellValue('A3', "PERIODO 2:  ABRIL A DICIEMBRE DE 2025");
            $hoja3->getStyle('A3')->getFont()->setBold(true);

            $hoja3->mergeCells('A4:D4');
            $hoja3->setCellValue('A4', "RANGOS: DIRECTO, SUPERIOR, EJECUTIVO Y PLATA");
            $hoja3->getStyle('A4')->getFont()->setBold(true);

            $hoja3->mergeCells('E1:G1');
            $hoja3->setCellValue('E1', "Fecha y hora de descarcarga del reporte: " . Date('Y-m-d H:i:s'));
            $hoja3->getStyle('E1')->getFont()->setBold(true);

            $color = 'DAE9F8';
            $range = "A7:CO7";
            $hoja3->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja3->getStyle($range)->getFill()->getStartColor()->setRGB($color);

            $h = ['Código Socio', 'Nombre', 'Rango', 'Fecha del último rango', 'Estado', 'Correo electrónico', 'Teléfono Móvil', 'País', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'KinYa Abril', 'KinYa Mayo', 'KinYa Junio', 'Inc Agua Abril', 'Inc Agua Mayo', 'Inc Agua Junio', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'Acumulado VP 1 Trim', 'Cumple Acumulado VP 1 Trim', 'Acumulado VGP 1 Trim', 'Cumple Acumulado VGP 1 Trim', 'Acumulado Kinya  1 Trim', 'Cumple Acumulado Kinya 1 Trim', 'Acumulado Inc Agua 1 Trim', 'Cumple Acumulado Inc Agua 1 Trim', 'Cumplimiento 1 Trim', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'KinYa Julio', 'KinYa Agosto', 'KinYa Septiembre', 'Inc Agua Julio', 'Inc Agua Agosto', 'Inc Agua Septiembre', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'Acumulado VP 2 Trim', 'Cumple Acumulado VP 2 Trim', 'Acumulado VGP 2 Trim', 'Cumple Acumulado VGP 2 Trim', 'Acumulado Kinya  2 Trim', 'Cumple Acumulado Kinya 2 Trim', 'Acumulado Inc Agua 2 Trim', 'Cumple Acumulado Inc Agua 2 Trim', 'Cumplimiento 2 Trim', 'VP Octubre', 'VP Noviembre', 'VP Diciembre', 'VGP Octubre', 'VGP Noviembre', 'VGP Diciembre', 'KinYa Octubre', 'KinYa Noviembre', 'KinYa Diciembre', 'Inc Agua Octubre', 'Inc Agua Noviembre', 'Inc Agua Diciembre', 'VP Octubre', 'VP Noviembre', 'VP Diciembre', 'VGP Octubre', 'VGP Noviembre', 'VGP Diciembre', 'Acumulado VP 3 Trim', 'Cumple Acumulado VP 3 Trim', 'Acumulado VGP 3 Trim', 'Cumple Acumulado VGP 3 Trim', 'Acumulado Kinya  3 Trim', 'Cumple Acumulado Kinya 3 Trim', 'Acumulado Inc Agua 3 Trim', 'Cumple Acumulado Inc Agua 3 Trim', 'Cumplimiento 3 Trim', 'VGP Acumulado 2 Periodo', 'Falta VGP para el 2 Periodo', 'Cumplimiento 2 Periodo', 'Aplica doble requisito 2 periodo'];
            $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_PeriodoDos;", "SQL173", $h);
            $hoja3->fromArray($d, null, 'A7', true);
        # HOJA 3
        
        # HOJA 4
            $hoja4 = $spreadsheet->createSheet();
            $hoja4->setTitle("Ganadores Cena Trimestral ");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja4->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja4->getStyle('A7:I7')->getFont()->setBold(true);
            $hoja4->setAutoFilter('A7:I7');

            $hoja4->mergeCells('A1:D1');
            $hoja4->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja4->getStyle('A1')->getFont()->setBold(true);

            $hoja4->mergeCells('A2:D2');
            $hoja4->setCellValue('A2', "CLUB VIAJERO EMPRENDEDOR ");
            $hoja4->getStyle('A2')->getFont()->setBold(true);

            $hoja4->mergeCells('A3:D3');
            $hoja4->setCellValue('A3', "");
            $hoja4->getStyle('A3')->getFont()->setBold(true);

            $hoja4->mergeCells('A4:D4');
            $hoja4->setCellValue('A4', "RANGOS: DIRECTO, SUPERIOR, EJECUTIVO Y PLATA");
            $hoja4->getStyle('A4')->getFont()->setBold(true);

            $hoja4->mergeCells('E1:G1');
            $hoja4->setCellValue('E1', "Fecha y hora de descarcarga del reporte: " . Date('Y-m-d H:i:s'));
            $hoja4->getStyle('E1')->getFont()->setBold(true);

            $color = 'DAE9F8';
            $range = "A7:I7";
            $hoja4->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja4->getStyle($range)->getFill()->getStartColor()->setRGB($color);
            
            $h = ['Código Socio','Nombre','Rango','Fecha del último rango','Estado','Correo electrónico','Teléfono Móvil','País','Trimestre Ganador'];
            $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_GanadoresCenaTrimestral;", "SQL173", $h);
            $hoja4->fromArray($d, null, 'A7', true);
        # HOJA 4

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Club Viajero Emprendedor 2025 - " . Date('Y_m_d_H_i_s') . '.xlsx';
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

    public function reporteViajero25(){
        $core = new coreApp();

        $spreadsheet = new Spreadsheet();

        # HOJA 1
            $hoja1 = $spreadsheet->getActiveSheet();
            $hoja1->setTitle("Tablero Principal");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }

            $hoja1->mergeCells('A1:F1');
            $hoja1->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $hoja1->mergeCells('A2:F2');
            $hoja1->setCellValue('A2', "RESULTADOS DE CLUB VIAJERO 2025");
            $hoja1->getStyle('A2')->getFont()->setBold(true);
            
            $hoja1->mergeCells('A4:C4');
            $hoja1->setCellValue('A4', "Fecha de descarga: " . Date('Y-m-d H:i:s'));            
            $hoja1->getStyle('A4')->getFont()->setBold(true);

            $hoja1->mergeCells('A6:M6');
            $hoja1->setCellValue('A6', "Enero a Dicciembre de 2025");
            $hoja1->getStyle('A6')->getFont()->setBold(true);

            $color = 'FBE2D5';
            $range = "A6";
            $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);

            $hoja1->mergeCells('A8:M8');
            $hoja1->setCellValue('A8', "Cantidad socios calificando");
            $hoja1->getStyle('A8')->getFont()->setBold(true);

            $color = 'FBE2D5';
            $range = "A8:E8";
            $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);

            #TABLA 1
                $headerStyle = [
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFD9D9D9']]
                ];
                $bodyStyle = [
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
                ];

                $h = ['País', 'Trim1 Ene-Mar', 'Trim2 Abr-Jun', 'Trim3 Jul-Sep', 'Trim4 Oct-Dic', 'Ganadores Club viajero'];
                $d = $core->getReportBody("exec RETOS_ESPECIALES.dbo.report_viajero_caro_porpaish1 1;", "SQL173", $h);
                $d[] = ['Latinoamérica', '=SUM(B11:B19)', '=SUM(C11:C19)', '=SUM(D11:D19)', '=SUM(E11:E19)', '=SUM(F11:F19)'];
                $hoja1->fromArray($d, null, 'A10', true);
                $hoja1->getStyle('A10:F20')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A10:F10')->applyFromArray($headerStyle);
                $color = 'FBE2D5';
                $range = "A20:F20";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
            #TABLA 1

            #TABLA 2
                $hoja1->mergeCells('A23:M23');
                $hoja1->setCellValue('A23', "Cantidad socios calificando por variable");
                $hoja1->getStyle('A23')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A23:M23";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray(
                    [['Filtro por país', 'Latam'],], null, 'A25', true);
                $h = ['Variable', 'Enero',  'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.report_viajero_caro 'LAT', 2;", "SQL173", $h);
                $hoja1->fromArray($d, null, 'A27', true);
                $hoja1->getStyle('A27:M29')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A27:M27')->applyFromArray($headerStyle);
                $hoja1->fromArray(
                    [
                        ['Filtro por país', 'Latam'],
                    ],
                    null, 'A32', true
                );
                $h = ['Variable', '1 Trimestre', '2 Trimestre', '3 Trimestre', '4 Trimestre'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.report_viajero_caro 'LAT', 3;", "SQL173", $h);
                $hoja1->fromArray($d, null, 'A34', true);
                $hoja1->getStyle('A34:E38')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A34:E34')->applyFromArray($headerStyle);
            #TABLA 2

            #TABLA 3
                $hoja1->mergeCells('A42:M42');
                $hoja1->setCellValue('A42', "Cantidad de socios con más de 53,000 de VGP en el año");
                $hoja1->getStyle('A42')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A42";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $h = ['País', 'Oro', 'Platino', 'Diamante', 'Diamante Real', 'VGP 53,000 o más'];
                $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.report_viajero_caro_porpaish1 2;", "SQL173", $h);
                $d[] = ['Latinoamérica', '=SUM(B45:B53)', '=SUM(C45:C53)', '=SUM(D45:D53)', '=SUM(E45:E53)', '=SUM(F45:F53)'];
                $hoja1->fromArray($d, null, 'A44', true);
                $hoja1->getStyle('A44:F54')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A44:F44')->applyFromArray($headerStyle);
            #TABLA 3

            #TABLA 4
                $hoja1->mergeCells('A57:M57');
                $hoja1->setCellValue('A57', "Ventas  en dolares generadas por todos los socios que entraron al Reto de Negocio");
                $hoja1->getStyle('A57')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A57";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                // $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_VentaDolaresSocios2025;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B60:B68)', '=SUM(C60:C68)', '=SUM(D60:D68)', '=SUM(E60:E68)', '=SUM(F60:F68)', '=SUM(G60:G68)', '=SUM(H60:H68)', '=SUM(I60:I68)', '=SUM(J60:J68)', '=SUM(K60:K68)', '=SUM(L60:L68)', '=SUM(M60:M68)'],
                    ],
                    null, 'A59', true
                );
                $hoja1->getStyle('A59:M69')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A59:M59')->applyFromArray($headerStyle);
            #TABLA 4

            #TABLA 5
                $hoja1->mergeCells('A72:M72');
                $hoja1->setCellValue('A72', "Ventas  en dolares generadas por todos los ganadores");
                $hoja1->getStyle('A72')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A72";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                // $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_VentaDolaresPeriodo_Uno;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B75:B83)', '=SUM(C75:C83)', '=SUM(D75:D83)', '=SUM(E75:E83)', '=SUM(F75:F83)', '=SUM(G75:G83)', '=SUM(H75:H83)', '=SUM(I75:I83)', '=SUM(J75:J83)', '=SUM(K75:K83)', '=SUM(L75:L83)', '=SUM(M75:M83)'],
                    ],
                    null, 'A74', true
                );
                $hoja1->getStyle('A74:M84')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A74:M74')->applyFromArray($headerStyle);
            #TABLA 5

            #TABLA 6
                $hoja1->mergeCells('A87:M87');
                $hoja1->setCellValue('A87', "% Venta de los club viajero");
                $hoja1->getStyle('A87')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A87";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                // $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_porcentajeVentaCVE2025;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B90:B98)', '=SUM(C90:C98)', '=SUM(D90:D98)', '=SUM(E90:E98)', '=SUM(F90:F98)', '=SUM(G90:G98)', '=SUM(H90:H98)', '=SUM(I90:I98)', '=SUM(J90:J98)', '=SUM(K90:K98)', '=SUM(L90:L98)', '=SUM(M90:M98)'],
                    ],
                    null, 'A89', true
                );
                $hoja1->getStyle('A89:M99')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A89:M89')->applyFromArray($headerStyle);
            #TABLA 6
        # HOJA 1

        # HOJA 2
            $hoja2 = $spreadsheet->createSheet();
            $hoja2->setTitle("Club Viajero 2025");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
                $hoja2->getColumnDimension('A' . $letter)->setAutoSize(true);
                $hoja2->getColumnDimension('C' . $letter)->setAutoSize(true);
                $hoja2->getColumnDimension('D' . $letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A7:DTO7')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A7:DT7');

            $hoja2->mergeCells('A1:D1');
            $hoja2->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $hoja2->mergeCells('A2:D2');
            $hoja2->setCellValue('A2', "CLUB VIAJERO");
            $hoja2->getStyle('A2')->getFont()->setBold(true);

            $hoja2->mergeCells('A3:D3');
            $hoja2->setCellValue('A3', "PERIODO :  ENERO A DICIEMBRE DE 2025");
            $hoja2->getStyle('A3')->getFont()->setBold(true);

            $hoja2->mergeCells('A4:D4');
            $hoja2->setCellValue('A4', "RANGOS: ORO, PLATINO, DIAMANTE Y DIAMANTE REAL ");
            $hoja2->getStyle('A4')->getFont()->setBold(true);

            $hoja2->mergeCells('E1:G1');
            $hoja2->setCellValue('E1', "Fecha y hora de descarcarga del reporte: " . Date('Y-m-d H:i:s'));
            $hoja2->getStyle('E1')->getFont()->setBold(true);

            $color = 'DAE9F8';
            $range = "A7:DT7";
            $hoja2->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja2->getStyle($range)->getFill()->getStartColor()->setRGB($color);
            $h = ['Código Socio', 'Nombre', 'Rango', 'Fecha del último rango', 'Estado', 'Correo electrónico', 'Teléfono Móvil', 'País', 'VP Enero', 'VP Febrero', 'VP Marzo', 'VGP Enero', 'VGP Febrero', 'VGP Marzo', 'KinYa Enero', 'KinYa Febrero', 'KinYa Marzo', 'Inc Agua Enero', 'Inc Agua Febrero', 'Inc Agua Marzo', 'Acumulado VP 1 Trim', 'Cumple Acumulado VP 1 Trim', 'Acumulado VGP 1 Trim', 'Cumple Acumulado VGP 1 Trim', 'Acumulado Kinya  1 Trim', 'Cumple Acumulado Kinya 1 Trim', 'Acumulado Inc Agua 1 Trim', 'Cumple Acumulado Inc Agua 1 Trim', 'Cumplimiento 1 Trim', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'KinYa Abril', 'KinYa Mayo', 'KinYa Junio', 'Inc Agua Abril', 'Inc Agua Mayo', 'Inc Agua Junio', 'Acumulado VP 2 Trim', 'Cumple Acumulado VP 2 Trim', 'Acumulado VGP 2 Trim', 'Cumple Acumulado VGP 2 Trim', 'Acumulado Kinya  2 Trim', 'Cumple Acumulado Kinya 2 Trim', 'Acumulado Inc Agua 2 Trim', 'Cumple Acumulado Inc Agua 2 Trim', 'Cumplimiento 2 Trim', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'KinYa Julio', 'KinYa Agosto', 'KinYa Septiembre', 'Inc Agua Julio', 'Inc Agua Agosto', 'Inc Agua Septiembre', 'Acumulado VP 3 Trim', 'Cumple Acumulado VP 3 Trim', 'Acumulado VGP 3 Trim', 'Cumple Acumulado VGP 3 Trim', 'Acumulado Kinya  3 Trim', 'Cumple Acumulado Kinya 3 Trim', 'Acumulado Inc Agua 3 Trim', 'Cumple Acumulado Inc Agua 3 Trim', 'Cumplimiento 3 Trim', 'VP Octubre', 'VP Noviembre', 'VP Diciembre', 'VGP Octubre', 'VGP Noviembre', 'VGP Diciembre', 'KinYa Octubre', 'KinYa Noviembre', 'KinYa Diciembre', 'Inc Agua Octubre', 'Inc Agua Noviembre', 'Inc Agua Diciembre', 'Acumulado VP 4 Trim', 'Cumple Acumulado VP 4 Trim', 'Acumulado VGP 4 Trim', 'Cumple Acumulado VGP 4 Trim', 'Acumulado Kinya  4 Trim', 'Cumple Acumulado Kinya 4 Trim', 'Acumulado Inc Agua 4 Trim', 'Cumple Acumulado Inc Agua 4 Trim', 'Cumplimiento 4 Trim', 'Gana Trimestre 1', 'Gana Trimestre 2', 'Gana Trimestre 3', 'Gana Trimestre 4', 'VGP Acumulado 2025', 'Falta VGP Acumulado', 'Cumple Club viajero 2025', 'Aplica doble requisito 2025'];
            $d = $core->getReportBody("EXEC RETOS_ESPECIALES.dbo.report_viajero_caro_h2;", "SQL173", $h);
            $hoja2->fromArray($d, null, 'A7', true);
        # HOJA 2

        # HOJA 3
            $hoja3 = $spreadsheet->createSheet();
            $hoja3->setTitle("Ganadores Cena Trimestral");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
            }
            $hoja3->getStyle('A7:J7')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A7:J7');

            $hoja3->mergeCells('A1:D1');
            $hoja3->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja3->getStyle('A1')->getFont()->setBold(true);

            $hoja3->mergeCells('A2:D2');
            $hoja3->setCellValue('A2', "CLUB VIAJERO - GANADORES CENA");
            $hoja3->getStyle('A2')->getFont()->setBold(true);

            $hoja3->mergeCells('A3:D3');
            $hoja3->setCellValue('A3', "");
            $hoja3->getStyle('A3')->getFont()->setBold(true);

            $hoja3->mergeCells('A4:F4');
            $hoja3->setCellValue('A4', "RANGOS: ORO, PLATINO, DIAMANTE Y DIAMANTE REAL");
            $hoja3->getStyle('A4')->getFont()->setBold(true);

            $hoja3->mergeCells('E1:G1');
            $hoja3->setCellValue('E1', "Fecha y hora de descarcarga del reporte: " . Date('Y-m-d H:i:s'));
            $hoja3->getStyle('E1')->getFont()->setBold(true);

            $color = 'DAE9F8';
            $range = "A7:J7";
            $hoja3->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja3->getStyle($range)->getFill()->getStartColor()->setRGB($color);
            $h = ['Código Socio', 'Nombre', 'Rango', 'Fecha del último rango', 'Estado', 'Correo electrónico', 'Teléfono Móvil', 'País', 'Trimestre Ganador', 'Validación'];
            $d = $core->getReportBody("exec RETOS_ESPECIALES.dbo.report_viajero_caro_ganadores;", "SQL173", $h);
            $hoja3->fromArray($d, null, 'A7', true);
        # HOJA 3

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Club Viajero 2025 - " . Date('Y_m_d_H_i_s') . '.xlsx';
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

    public function reporteVip25(){
        $core = new coreApp();

        $spreadsheet = new Spreadsheet();

        # HOJA 1
            $hoja1 = $spreadsheet->getActiveSheet();
            $hoja1->setTitle("Tablero Principal");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja1->getColumnDimension($letter)->setAutoSize(true);
            }

            $hoja1->mergeCells('A1:F1');
            $hoja1->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja1->getStyle('A1')->getFont()->setBold(true);

            $hoja1->mergeCells('A2:F2');
            $hoja1->setCellValue('A2', "RESULTADOS DE CLUB VIAJERO VIP 2025");
            $hoja1->getStyle('A2')->getFont()->setBold(true);
            
            $hoja1->mergeCells('A4:C4');
            $hoja1->setCellValue('A4', "Fecha de descarga: " . Date('Y-m-d H:i:s'));            
            $hoja1->getStyle('A4')->getFont()->setBold(true);

            $hoja1->mergeCells('A6:N6');
            $hoja1->setCellValue('A6', "Enero a Dicciembre de 2025");
            $hoja1->getStyle('A6')->getFont()->setBold(true);

            $color = 'FBE2D5';
            $range = "A6";
            $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);

            $hoja1->mergeCells('A8:N8');
            $hoja1->setCellValue('A8', "Cantidad socios calificando");
            $hoja1->getStyle('A8')->getFont()->setBold(true);

            $color = 'FBE2D5';
            $range = "A8:N8";
            $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);

            # TABLA 1
                $headerStyle = [
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFD9D9D9']]
                ];
                $bodyStyle = [
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
                ];
                // $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSociosCal;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Platino', 'Diamante', 'Diamante Real', 'Ganadores Club viajero VIP'],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B11:B19)', '=SUM(C11:C19)', '=SUM(D11:D19)', '=SUM(E11:E19)']
                    ],
                    null, 'A10', true
                );
                $hoja1->getStyle('A10:E20')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A10:E10')->applyFromArray($headerStyle);
                $color = 'FBE2D5';
                $range = "A20:E20";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
            # TABLA 1

            # TABLA 2
                $hoja1->mergeCells('A23:N23');
                $hoja1->setCellValue('A23', "Cantidad socios calificando por variable");
                $hoja1->getStyle('A23')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A23:N23";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);

                $hoja1->mergeCells('A26:N26');
                $hoja1->setCellValue('A26', "Cantidad de socios calificando club viajero");
                $hoja1->getStyle('A26')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A26:N26";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray(
                    [
                        ['País', 'Platino', 'Diamante', 'Diamante Real', 'Ganadores Club viajero'],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B29:B37)', '=SUM(C29:C37)', '=SUM(D29:D37)', '=SUM(E29:E37)']
                    ],
                    null, 'A28', true
                );
                $hoja1->getStyle('A28:E38')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A28:E28')->applyFromArray($headerStyle);
            # TABLA 2

            # TABLA 3
                $hoja1->mergeCells('A42:N42');
                $hoja1->setCellValue('A42', "Cantidad de socios calificando club viajero");
                $hoja1->getStyle('A42')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A42:N42";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray(
                    [
                        ['País', 'Enero ', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre', '2025'],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B45:B53)', '=SUM(C45:C53)', '=SUM(D45:D53)', '=SUM(E45:E53)', '=SUM(F45:F53)', '=SUM(G45:G53)', '=SUM(H45:H53)', '=SUM(I45:I53)', '=SUM(J45:J53)', '=SUM(K45:K53)', '=SUM(L45:L53)', '=SUM(M45:M53)', '=SUM(N45:N53)'],
                    ],
                    null, 'A44', true
                );
                $hoja1->getStyle('A44:N54')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A44:N44')->applyFromArray($headerStyle);
            # TABLA 3

            # TABLA 4
                $hoja1->mergeCells('A58:N58');
                $hoja1->setCellValue('A58', "Cantidad de socios calificando a Club viajero VIP cumpliendo los requisitos de plata por semestre ");
                $hoja1->getStyle('A58')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A58:N58";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray(
                    [
                        ['País', 'Enero ', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre', '2025'],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B61:B69)', '=SUM(C61:C69)', '=SUM(D61:D69)', '=SUM(E61:E69)', '=SUM(F61:F69)', '=SUM(G61:G69)', '=SUM(H61:H69)', '=SUM(I61:I69)', '=SUM(J61:J69)', '=SUM(K61:K69)', '=SUM(L61:L69)', '=SUM(M61:M69)', '=SUM(N61:N69)'],
                    ],
                    null, 'A60', true
                );
                $hoja1->getStyle('A60:N70')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A60:N60')->applyFromArray($headerStyle);
            # TABLA 4
            
            # TABLA 5
                $hoja1->mergeCells('A74:N74');
                $hoja1->setCellValue('A74', "Ventas  en dolares generadas por todos los socios que entraron al Reto de Negocio");
                $hoja1->getStyle('A74')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A74:N74";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray(
                    [
                        ['País', 'Enero ', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B77:B85)', '=SUM(C77:C85)', '=SUM(D77:D85)', '=SUM(E77:E85)', '=SUM(F77:F85)', '=SUM(G77:G85)', '=SUM(H77:H85)', '=SUM(I77:I85)', '=SUM(J77:J85)', '=SUM(K77:K85)', '=SUM(L77:L85)', '=SUM(M77:M85)'],
                    ],
                    null, 'A76', true
                );
                $hoja1->getStyle('A76:M86')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A76:M76')->applyFromArray($headerStyle);
            # TABLA 5
            
            # TABLA 6
                $hoja1->mergeCells('A89:N89');
                $hoja1->setCellValue('A89', "Ventas  en dolares generadas por todos los ganadores");
                $hoja1->getStyle('A89')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A89:N89";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray(
                    [
                        ['País', 'Enero ', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B92:B100)', '=SUM(C92:C100)', '=SUM(D92:D100)', '=SUM(E92:E100)', '=SUM(F92:F100)', '=SUM(G92:G100)', '=SUM(H92:H100)', '=SUM(I92:I100)', '=SUM(J92:J100)', '=SUM(K92:K100)', '=SUM(L92:L100)', '=SUM(M92:M100)'],
                    ],
                    null, 'A91', true
                );
                $hoja1->getStyle('A91:M101')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A91:M91')->applyFromArray($headerStyle);
            # TABLA 6
            
            # TABLA 7
                $hoja1->mergeCells('A104:N104');
                $hoja1->setCellValue('A104', "% Venta de los club viajero VIP");
                $hoja1->getStyle('A104')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A104:N104";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray(
                    [
                        ['País', 'Enero ', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        ['Latinoamérica', '=SUM(B107:B115)', '=SUM(C107:C115)', '=SUM(D107:D115)', '=SUM(E107:E115)', '=SUM(F107:F115)', '=SUM(G107:G115)', '=SUM(H107:H115)', '=SUM(I107:I115)', '=SUM(J107:J115)', '=SUM(K107:K115)', '=SUM(L107:L115)', '=SUM(M107:M115)'],
                    ],
                    null, 'A106', true
                );
                $hoja1->getStyle('A106:M116')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A106:M106')->applyFromArray($headerStyle);
            # TABLA 7
        # HOJA 1

        # HOHJA 2
            $hoja2 = $spreadsheet->createSheet();
            $hoja2->setTitle("Club Viajero VIP 2025");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja2->getColumnDimension($letter)->setAutoSize(true);
                $hoja2->getColumnDimension('A' . $letter)->setAutoSize(true);
                $hoja2->getColumnDimension('AA' . $letter)->setAutoSize(true);
            }
            $hoja2->getStyle('A7:AAO7')->getFont()->setBold(true);
            $hoja2->setAutoFilter('A7:AA7');

            $hoja2->mergeCells('A1:D1');
            $hoja2->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja2->getStyle('A1')->getFont()->setBold(true);

            $hoja2->mergeCells('A2:D2');
            $hoja2->setCellValue('A2', "CLUB VIAJERO VIP");
            $hoja2->getStyle('A2')->getFont()->setBold(true);

            $hoja2->mergeCells('A3:D3');
            $hoja2->setCellValue('A3', "PERIODO: ENERO A DICIEMBRE DE 2025");
            $hoja2->getStyle('A3')->getFont()->setBold(true);

            $hoja2->mergeCells('A4:D4');
            $hoja2->setCellValue('A4', "RANGOS:PLATINO, DIAMANTE Y DIAMANTE REAL");
            $hoja2->getStyle('A4')->getFont()->setBold(true);

            $hoja2->mergeCells('E1:G1');
            $hoja2->setCellValue('E1', "Fecha y hora de descarcarga del reporte: " . Date('Y-m-d H:i:s'));
            $hoja2->getStyle('E1')->getFont()->setBold(true);

            $color = 'DAE9F8';
            $range = "A7:AA7";
            $hoja2->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja2->getStyle($range)->getFill()->getStartColor()->setRGB($color);
            // $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_PeriodoUno;", "SQL173");
            $h = ['Ranking', 'Código Socio', 'Nombre', 'Rango', 'Fecha del último rango', 'Estado', 'Correo electrónico', 'Teléfono Móvil', 'País', 'Ganador Club Viajero', 'Cantidad de avances Plata- 1 Semestre', 'Cantidad de avances Plata- 2 Semestre', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre', 'VGP Acumulado 2025', 'Cumple requisitos', 'Aplica a doble requisito'];
            $datos = [];
            $datos[] = $h;
            $hoja2->fromArray($datos, null, 'A7', true);
        # HOJA 2

        # HOHJA 3
            $hoja3 = $spreadsheet->createSheet();
            $hoja3->setTitle("Ganadores Club Viajero VIP");

            for($i=65; $i<=90; $i++) {  
                $letter = chr($i);
                $hoja3->getColumnDimension($letter)->setAutoSize(true);
                $hoja3->getColumnDimension('A' . $letter)->setAutoSize(true);
            }
            $hoja3->getStyle('A7:MO7')->getFont()->setBold(true);
            $hoja3->setAutoFilter('A7:M7');

            $hoja3->mergeCells('A1:D1');
            $hoja3->setCellValue('A1', "NIKKEN LATINOAMERICA");
            $hoja3->getStyle('A1')->getFont()->setBold(true);

            $hoja3->mergeCells('A2:D2');
            $hoja3->setCellValue('A2', "CLUB VIAJERO VIP 2025");
            $hoja3->getStyle('A2')->getFont()->setBold(true);

            $hoja3->mergeCells('A3:D3');
            $hoja3->setCellValue('A3', "RANGOS: PLATINO, DIAMANTE Y DIAMANTE REAL");
            $hoja3->getStyle('A3')->getFont()->setBold(true);

            $hoja3->mergeCells('E1:G1');
            $hoja3->setCellValue('E1', "Fecha y hora de descarcarga del reporte: " . Date('Y-m-d H:i:s'));
            $hoja3->getStyle('E1')->getFont()->setBold(true);

            $color = 'DAE9F8';
            $range = "A7:M7";
            $hoja3->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $hoja3->getStyle($range)->getFill()->getStartColor()->setRGB($color);
            // $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_PeriodoUno;", "SQL173");
            $h = ['Ranking', 'Código Socio', 'Nombre', 'Rango', 'Fecha del último rango', 'Estado', 'Correo electrónico', 'Teléfono Móvil', 'País', 'Ganador Club viajero', 'Platas - 1 Sem', 'Platas - 2 Sem', 'VGP'];
            $datos = [];
            $datos[] = $h;
            $hoja3->fromArray($datos, null, 'A7', true);
        # HOJA 3

        // Guardar el archivo temporalmente
        $tempFilePath = tempnam(sys_get_temp_dir(), 'export_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Enviar la respuesta para forzar la descarga
        $fileName = "Club Viajero VIP 2025 - " . Date('Y_m_d_H_i_s') . '.xlsx';
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
