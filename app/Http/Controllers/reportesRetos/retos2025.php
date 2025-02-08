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
        // $spreadsheet->removeSheetByIndex(0);
        
        # HOJA 1
            $hoja1 = $spreadsheet->getActiveSheet();
            $hoja1->setTitle("Tablero Principal");
            $hoja1->getColumnDimension('A')->setAutoSize(true);
            $hoja1->getColumnDimension('B')->setAutoSize(true);
            $hoja1->getColumnDimension('C')->setAutoSize(true);
            $hoja1->getColumnDimension('D')->setAutoSize(true);
            $hoja1->getColumnDimension('E')->setAutoSize(true);
            $hoja1->getColumnDimension('F')->setAutoSize(true);
            $hoja1->getColumnDimension('G')->setAutoSize(true);
            $hoja1->getColumnDimension('H')->setAutoSize(true);
            $hoja1->getColumnDimension('I')->setAutoSize(true);
            $hoja1->getColumnDimension('J')->setAutoSize(true);

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
                $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSociosCal;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Trim1 Ene-Mar', 'Trim2 Abr-Jun', 'Trim3 Jul-Sep', 'Ganadores 1 Periodo'],
                        [$d[0]->pais, $d[0]->trim1EneMarz, $d[0]->trim2AbrJun, $d[0]->trim3JulSep, $d[0]->gandores1period],
                        [$d[1]->pais, $d[1]->trim1EneMarz, $d[1]->trim2AbrJun, $d[1]->trim3JulSep, $d[1]->gandores1period],
                        [$d[2]->pais, $d[2]->trim1EneMarz, $d[2]->trim2AbrJun, $d[2]->trim3JulSep, $d[2]->gandores1period],
                        [$d[3]->pais, $d[3]->trim1EneMarz, $d[3]->trim2AbrJun, $d[3]->trim3JulSep, $d[3]->gandores1period],
                        [$d[4]->pais, $d[4]->trim1EneMarz, $d[4]->trim2AbrJun, $d[4]->trim3JulSep, $d[4]->gandores1period],
                        [$d[5]->pais, $d[5]->trim1EneMarz, $d[5]->trim2AbrJun, $d[5]->trim3JulSep, $d[5]->gandores1period],
                        [$d[6]->pais, $d[6]->trim1EneMarz, $d[6]->trim2AbrJun, $d[6]->trim3JulSep, $d[6]->gandores1period],
                        [$d[7]->pais, $d[7]->trim1EneMarz, $d[7]->trim2AbrJun, $d[7]->trim3JulSep, $d[7]->gandores1period],
                        [$d[8]->pais, $d[8]->trim1EneMarz, $d[8]->trim2AbrJun, $d[8]->trim3JulSep, $d[8]->gandores1period],
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
            #TABLA 1

            #TABLA 2
                $hoja1->mergeCells('A23:J23');
                $hoja1->setCellValue('A23', "Cantidad socios calificando por variable");
                $hoja1->getStyle('A23')->getFont()->setBold(true);
                $color = 'FBE2D5';
                $range = "A23:E23";
                $hoja1->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $hoja1->getStyle($range)->getFill()->getStartColor()->setRGB($color);
                $hoja1->fromArray(
                    [
                        ['Filtro por país', 'Latam'],
                    ],
                    null, 'A25', true
                );
                $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSociosCalVarible;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['Variable', 'Enero',  'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'],
                        [$d[0]->variable, $d[0]->enero, $d[0]->febrero, $d[0]->marzo, $d[0]->abril, $d[0]->mayo, $d[0]->junio, $d[0]->julio, $d[0]->agosto, $d[0]->septirmbre],
                        [$d[1]->variable, $d[1]->enero, $d[1]->febrero, $d[1]->marzo, $d[1]->abril, $d[1]->mayo, $d[1]->junio, $d[1]->julio, $d[1]->agosto, $d[1]->septirmbre],
                    ],
                    null, 'A27', true
                );
                $hoja1->getStyle('A27:J29')->applyFromArray($bodyStyle);
                $hoja1->getStyle('A27:J27')->applyFromArray($headerStyle);
                $hoja1->fromArray(
                    [
                        ['Filtro por país', 'Latam'],
                    ],
                    null, 'A32', true
                );
                $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSociosCalVarible_Trim;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['Variable', '1 Trimestre', '2 Trimestre', '3 Trimestre'],
                        [$d[0]->variable, $d[0]->trimestreUno, $d[0]->trimestreDos, $d[0]->trimestreTres],
                        [$d[1]->variable, $d[1]->trimestreUno, $d[1]->trimestreDos, $d[1]->trimestreTres],
                        [$d[2]->variable, $d[2]->trimestreUno, $d[2]->trimestreDos, $d[2]->trimestreTres],
                        [$d[3]->variable, $d[3]->trimestreUno, $d[3]->trimestreDos, $d[3]->trimestreTres],
                    ],
                    null, 'A34', true
                );
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
                $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_CantidadSocios30000masVGPAnual;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Directo', 'Superior', 'Ejecutivo', 'Plata', 'VGP 30,000 o más'],
                        [$d[0]->pais, $d[0]->directo, $d[0]->superior, $d[0]->ejecutivo, $d[0]->plata, $d[0]->vgp30000mas],
                        [$d[1]->pais, $d[1]->directo, $d[1]->superior, $d[1]->ejecutivo, $d[1]->plata, $d[1]->vgp30000mas],
                        [$d[2]->pais, $d[2]->directo, $d[2]->superior, $d[2]->ejecutivo, $d[2]->plata, $d[2]->vgp30000mas],
                        [$d[3]->pais, $d[3]->directo, $d[3]->superior, $d[3]->ejecutivo, $d[3]->plata, $d[3]->vgp30000mas],
                        [$d[4]->pais, $d[4]->directo, $d[4]->superior, $d[4]->ejecutivo, $d[4]->plata, $d[4]->vgp30000mas],
                        [$d[5]->pais, $d[5]->directo, $d[5]->superior, $d[5]->ejecutivo, $d[5]->plata, $d[5]->vgp30000mas],
                        [$d[6]->pais, $d[6]->directo, $d[6]->superior, $d[6]->ejecutivo, $d[6]->plata, $d[6]->vgp30000mas],
                        [$d[7]->pais, $d[7]->directo, $d[7]->superior, $d[7]->ejecutivo, $d[7]->plata, $d[7]->vgp30000mas],
                        [$d[8]->pais, $d[8]->directo, $d[8]->superior, $d[8]->ejecutivo, $d[8]->plata, $d[8]->vgp30000mas],
                        ['Latinoamérica', '=SUM(B45:B53)', '=SUM(C45:C53)', '=SUM(D45:D53)', '=SUM(E45:E53)', '=SUM(F45:F53)'],
                    ],
                    null, 'A44', true
                );
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
                $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_VentaDolaresSocios2025;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'],
                        [$d[0]->pais, $d[0]->enero, $d[0]->febrero, $d[0]->marzo, $d[0]->abril, $d[0]->mayo, $d[0]->junio, $d[0]->julio, $d[0]->agosto, $d[0]->septiembre],
                        [$d[1]->pais, $d[1]->enero, $d[1]->febrero, $d[1]->marzo, $d[1]->abril, $d[1]->mayo, $d[1]->junio, $d[1]->julio, $d[1]->agosto, $d[1]->septiembre],
                        [$d[2]->pais, $d[2]->enero, $d[2]->febrero, $d[2]->marzo, $d[2]->abril, $d[2]->mayo, $d[2]->junio, $d[2]->julio, $d[2]->agosto, $d[2]->septiembre],
                        [$d[3]->pais, $d[3]->enero, $d[3]->febrero, $d[3]->marzo, $d[3]->abril, $d[3]->mayo, $d[3]->junio, $d[3]->julio, $d[3]->agosto, $d[3]->septiembre],
                        [$d[4]->pais, $d[4]->enero, $d[4]->febrero, $d[4]->marzo, $d[4]->abril, $d[4]->mayo, $d[4]->junio, $d[4]->julio, $d[4]->agosto, $d[4]->septiembre],
                        [$d[5]->pais, $d[5]->enero, $d[5]->febrero, $d[5]->marzo, $d[5]->abril, $d[5]->mayo, $d[5]->junio, $d[5]->julio, $d[5]->agosto, $d[5]->septiembre],
                        [$d[6]->pais, $d[6]->enero, $d[6]->febrero, $d[6]->marzo, $d[6]->abril, $d[6]->mayo, $d[6]->junio, $d[6]->julio, $d[6]->agosto, $d[6]->septiembre],
                        [$d[7]->pais, $d[7]->enero, $d[7]->febrero, $d[7]->marzo, $d[7]->abril, $d[7]->mayo, $d[7]->junio, $d[7]->julio, $d[7]->agosto, $d[7]->septiembre],
                        [$d[8]->pais, $d[8]->enero, $d[8]->febrero, $d[8]->marzo, $d[8]->abril, $d[8]->mayo, $d[8]->junio, $d[8]->julio, $d[8]->agosto, $d[8]->septiembre],
                        ['Latinoamérica', '=SUM(B60:B68)', '=SUM(C60:C68)', '=SUM(D60:D68)', '=SUM(E60:E68)', '=SUM(F60:F68)', '=SUM(G60:G68)', '=SUM(H60:H68)', '=SUM(I60:I68)', '=SUM(J60:J68)'],
                    ],
                    null, 'A59', true
                );
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
                $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_VentaDolaresPeriodo_Uno;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'],
                        [$d[0]->pais, $d[0]->enero, $d[0]->febrero, $d[0]->marzo, $d[0]->abril, $d[0]->mayo, $d[0]->junio, $d[0]->julio, $d[0]->agosto, $d[0]->septiembre],
                        [$d[1]->pais, $d[1]->enero, $d[1]->febrero, $d[1]->marzo, $d[1]->abril, $d[1]->mayo, $d[1]->junio, $d[1]->julio, $d[1]->agosto, $d[1]->septiembre],
                        [$d[2]->pais, $d[2]->enero, $d[2]->febrero, $d[2]->marzo, $d[2]->abril, $d[2]->mayo, $d[2]->junio, $d[2]->julio, $d[2]->agosto, $d[2]->septiembre],
                        [$d[3]->pais, $d[3]->enero, $d[3]->febrero, $d[3]->marzo, $d[3]->abril, $d[3]->mayo, $d[3]->junio, $d[3]->julio, $d[3]->agosto, $d[3]->septiembre],
                        [$d[4]->pais, $d[4]->enero, $d[4]->febrero, $d[4]->marzo, $d[4]->abril, $d[4]->mayo, $d[4]->junio, $d[4]->julio, $d[4]->agosto, $d[4]->septiembre],
                        [$d[5]->pais, $d[5]->enero, $d[5]->febrero, $d[5]->marzo, $d[5]->abril, $d[5]->mayo, $d[5]->junio, $d[5]->julio, $d[5]->agosto, $d[5]->septiembre],
                        [$d[6]->pais, $d[6]->enero, $d[6]->febrero, $d[6]->marzo, $d[6]->abril, $d[6]->mayo, $d[6]->junio, $d[6]->julio, $d[6]->agosto, $d[6]->septiembre],
                        [$d[7]->pais, $d[7]->enero, $d[7]->febrero, $d[7]->marzo, $d[7]->abril, $d[7]->mayo, $d[7]->junio, $d[7]->julio, $d[7]->agosto, $d[7]->septiembre],
                        [$d[8]->pais, $d[8]->enero, $d[8]->febrero, $d[8]->marzo, $d[8]->abril, $d[8]->mayo, $d[8]->junio, $d[8]->julio, $d[8]->agosto, $d[8]->septiembre],
                        ['Latinoamérica', '=SUM(B75:B83)', '=SUM(C75:C83)', '=SUM(D75:D83)', '=SUM(E75:E83)', '=SUM(F75:F83)', '=SUM(G75:G83)', '=SUM(H75:H83)', '=SUM(I75:I83)', '=SUM(J75:J83)'],
                    ],
                    null, 'A74', true
                );
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
                $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_porcentajeVentaCVE2025;", "SQL173");
                $hoja1->fromArray(
                    [
                        ['País', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'],
                        [$d[0]->pais, $d[0]->enero, $d[0]->febrero, $d[0]->marzo, $d[0]->abril, $d[0]->mayo, $d[0]->junio, $d[0]->julio, $d[0]->agosto, $d[0]->septiembre],
                        [$d[1]->pais, $d[1]->enero, $d[1]->febrero, $d[1]->marzo, $d[1]->abril, $d[1]->mayo, $d[1]->junio, $d[1]->julio, $d[1]->agosto, $d[1]->septiembre],
                        [$d[2]->pais, $d[2]->enero, $d[2]->febrero, $d[2]->marzo, $d[2]->abril, $d[2]->mayo, $d[2]->junio, $d[2]->julio, $d[2]->agosto, $d[2]->septiembre],
                        [$d[3]->pais, $d[3]->enero, $d[3]->febrero, $d[3]->marzo, $d[3]->abril, $d[3]->mayo, $d[3]->junio, $d[3]->julio, $d[3]->agosto, $d[3]->septiembre],
                        [$d[4]->pais, $d[4]->enero, $d[4]->febrero, $d[4]->marzo, $d[4]->abril, $d[4]->mayo, $d[4]->junio, $d[4]->julio, $d[4]->agosto, $d[4]->septiembre],
                        [$d[5]->pais, $d[5]->enero, $d[5]->febrero, $d[5]->marzo, $d[5]->abril, $d[5]->mayo, $d[5]->junio, $d[5]->julio, $d[5]->agosto, $d[5]->septiembre],
                        [$d[6]->pais, $d[6]->enero, $d[6]->febrero, $d[6]->marzo, $d[6]->abril, $d[6]->mayo, $d[6]->junio, $d[6]->julio, $d[6]->agosto, $d[6]->septiembre],
                        [$d[7]->pais, $d[7]->enero, $d[7]->febrero, $d[7]->marzo, $d[7]->abril, $d[7]->mayo, $d[7]->junio, $d[7]->julio, $d[7]->agosto, $d[7]->septiembre],
                        [$d[8]->pais, $d[8]->enero, $d[8]->febrero, $d[8]->marzo, $d[8]->abril, $d[8]->mayo, $d[8]->junio, $d[8]->julio, $d[8]->agosto, $d[8]->septiembre],
                        ['Latinoamérica', '=SUM(B90:B98)', '=SUM(C90:C98)', '=SUM(D90:D98)', '=SUM(E90:E98)', '=SUM(F90:F98)', '=SUM(G90:G98)', '=SUM(H90:H98)', '=SUM(I90:I98)', '=SUM(J90:J98)'],
                    ],
                    null, 'A89', true
                );
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
            $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_PeriodoUno;", "SQL173");
            $h = ['Código Socio', 'Nombre', 'Rango', 'Fecha del último rango', 'Estado', 'Correo electrónico', 'Teléfono Móvil', 'País', 'VP Enero', 'VP Febrero', 'VP Marzo', 'VGP Enero', 'VGP Febrero', 'VGP Marzo', 'KinYa Enero', 'KinYa Febrero', 'KinYa Marzo', 'Inc Agua Enero', 'Inc Agua Febrero', 'Inc Agua Marzo', 'VP Enero', 'VP Febrero', 'VP Marzo', 'VGP Enero', 'VGP Febrero', 'VGP Marzo', 'Acumulado VP 1 Trim', 'Cumple Acumulado VP 1 Trim', 'Acumulado VGP 1 Trim', 'Cumple Acumulado VGP 1 Trim', 'Acumulado Kinya  1 Trim', 'Cumple Acumulado Kinya 1 Trim', 'Acumulado Inc Agua 1 Trim', 'Cumple Acumulado Inc Agua 1 Trim', 'Cumplimiento 1 Trim', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'KinYa Abril', 'KinYa Mayo', 'KinYa Junio', 'Inc Agua Abril', 'Inc Agua Mayo', 'Inc Agua Junio', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'Acumulado VP 2 Trim', 'Cumple Acumulado VP 2 Trim', 'Acumulado VGP 2 Trim', 'Cumple Acumulado VGP 2 Trim', 'Acumulado Kinya  2 Trim', 'Cumple Acumulado Kinya 2 Trim', 'Acumulado Inc Agua 2 Trim', 'Cumple Acumulado Inc Agua 2 Trim', 'Cumplimiento 2 Trim', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'KinYa Julio', 'KinYa Agosto', 'KinYa Septiembre', 'Inc Agua Julio', 'Inc Agua Agosto', 'Inc Agua Septiembre', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'Acumulado VP 3 Trim', 'Cumple Acumulado VP 3 Trim', 'Acumulado VGP 3 Trim', 'Cumple Acumulado VGP 3 Trim', 'Acumulado Kinya  3 Trim', 'Cumple Acumulado Kinya 3 Trim', 'Acumulado Inc Agua 3 Trim', 'Cumple Acumulado Inc Agua 3 Trim', 'Cumplimiento 3 Trim', 'VGP Acumulado 1 Periodo', 'Falta VGP para el 1 Periodo', 'Cumplimiento 1 Periodo', 'Aplica doble requisito 1 periodo'];
            $datos = [];
            $datos[] = $h;
            for ($x=0; $x < sizeof($d); $x++) { 
                $datos[] = [
                    $d[$x]->codSocio,
                    $d[$x]->nombre,
                    $d[$x]->rango,
                    $d[$x]->fecha_ultimo_avance,
                    $d[$x]->estado,
                    $d[$x]->correo_elect,
                    $d[$x]->teléfono,
                    $d[$x]->pais,
                    $d[$x]->vpEnero,
                    $d[$x]->vpFebrero,
                    $d[$x]->vpMarzo,
                    $d[$x]->vgpEnero,
                    $d[$x]->vgpFebrero,
                    $d[$x]->vgpMarzo,
                    $d[$x]->kinyaEnero,
                    $d[$x]->kinyaFebrero,
                    $d[$x]->kinyaMarzo,
                    $d[$x]->frontalesEnero,
                    $d[$x]->frontalesFebrero,
                    $d[$x]->frontalesMarzo,
                    $d[$x]->vpEneroRequistos,
                    $d[$x]->vpFebreroRequistos,
                    $d[$x]->vpMarzoRequistos,
                    $d[$x]->vgpEneroRequistos,
                    $d[$x]->vgpFebreroRequistos,
                    $d[$x]->vgpMarzoRequistos,
                    $d[$x]->acumuladoVpTrimUno,
                    $d[$x]->cumpleAcumuladoVpTrimUno,
                    $d[$x]->acumuladoVgpTrimUno,
                    $d[$x]->cumpleAcumuladoVgpTrimUno,
                    $d[$x]->acumuladoKinyaTrimUno,
                    $d[$x]->cumpleKinyaAcumTrimUno,
                    $d[$x]->acumuladoIncorporacionTrimUno,
                    $d[$x]->cumpleIncorporacionAcumTrimUno,
                    $d[$x]->cumpleTrimestreUNO,
                    $d[$x]->vpAbril,
                    $d[$x]->vpMayo,
                    $d[$x]->vpJunio,
                    $d[$x]->vgpAbril,
                    $d[$x]->vgpMayo,
                    $d[$x]->vgpJunio,
                    $d[$x]->kinyaAbril,
                    $d[$x]->kinyaMayo,
                    $d[$x]->kinyaJunio,
                    $d[$x]->frontalesAbril,
                    $d[$x]->frontalesMayo,
                    $d[$x]->frontalesJunio,
                    $d[$x]->vpAbrilRequistos,
                    $d[$x]->vpMayoRequistos,
                    $d[$x]->vpJunioRequistos,
                    $d[$x]->vgpAbrilRequistos,
                    $d[$x]->vgpMayoRequistos,
                    $d[$x]->vgpJunioRequistos,
                    $d[$x]->acumuladoVpTrimDos,
                    $d[$x]->cumpleAcumuladoVpTrimDos,
                    $d[$x]->acumuladoVgpTrimDos,
                    $d[$x]->cumpleAcumuladoVgpTrimDos,
                    $d[$x]->acumuladoKinyaTrimDos,
                    $d[$x]->cumpleKinyaAcumTrimDos,
                    $d[$x]->acumuladoIncorporacionTrimDos,
                    $d[$x]->cumpleIncorporacionAcumTrimDos,
                    $d[$x]->cumpleTrimestreDos,
                    $d[$x]->vpJulio,
                    $d[$x]->vpAgosto,
                    $d[$x]->vpSeptiembre,
                    $d[$x]->vgpJulio,
                    $d[$x]->vgpAgosto,
                    $d[$x]->vgpSeptiembre,
                    $d[$x]->kinyaJulio,
                    $d[$x]->kinyaAgosto,
                    $d[$x]->kinyaSeptiembre,
                    $d[$x]->frontalesJulio,
                    $d[$x]->frontalesAgosto,
                    $d[$x]->frontalesSeptiembre,
                    $d[$x]->vpJulioRequistos,
                    $d[$x]->vpAgostoRequistos,
                    $d[$x]->vpSeptiembreRequistos,
                    $d[$x]->vgpJulioRequistos,
                    $d[$x]->vgpAgostoRequistos,
                    $d[$x]->vgpSeptiembreRequistos,
                    $d[$x]->acumuladoVpTrimTres,
                    $d[$x]->cumpleAcumuladoVpTrimTres,
                    $d[$x]->acumuladoVgpTrimTres,
                    $d[$x]->cumpleAcumuladoVgpTrimTres,
                    $d[$x]->acumuladoKinyaTrimTres,
                    $d[$x]->cumpleKinyaAcumTrimTres,
                    $d[$x]->acumuladoIncorporacionTrimTres,
                    $d[$x]->cumpleIncorporacionAcumTrimTres,
                    $d[$x]->cumpleTrimestreTres,
                    $d[$x]->vgpAcumuladoPeriodoUno,
                    $d[$x]->vgpRestantePeriodoUno,
                    $d[$x]->cumplePeriodo1,
                    $d[$x]->doble_Requisito_periodo1,
                ];
            }
            $hoja2->fromArray($datos, null, 'A7', true);
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
            $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_PeriodoDos;", "SQL173");
            $h = ['Código Socio', 'Nombre', 'Rango', 'Fecha del último rango', 'Estado', 'Correo electrónico', 'Teléfono Móvil', 'País', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'KinYa Abril', 'KinYa Mayo', 'KinYa Junio', 'Inc Agua Abril', 'Inc Agua Mayo', 'Inc Agua Junio', 'VP Abril', 'VP Mayo', 'VP Junio', 'VGP Abril', 'VGP Mayo', 'VGP Junio', 'Acumulado VP 1 Trim', 'Cumple Acumulado VP 1 Trim', 'Acumulado VGP 1 Trim', 'Cumple Acumulado VGP 1 Trim', 'Acumulado Kinya  1 Trim', 'Cumple Acumulado Kinya 1 Trim', 'Acumulado Inc Agua 1 Trim', 'Cumple Acumulado Inc Agua 1 Trim', 'Cumplimiento 1 Trim', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'KinYa Julio', 'KinYa Agosto', 'KinYa Septiembre', 'Inc Agua Julio', 'Inc Agua Agosto', 'Inc Agua Septiembre', 'VP Julio', 'VP Agosto', 'VP Septiembre', 'VGP Julio', 'VGP Agosto', 'VGP Septiembre', 'Acumulado VP 2 Trim', 'Cumple Acumulado VP 2 Trim', 'Acumulado VGP 2 Trim', 'Cumple Acumulado VGP 2 Trim', 'Acumulado Kinya  2 Trim', 'Cumple Acumulado Kinya 2 Trim', 'Acumulado Inc Agua 2 Trim', 'Cumple Acumulado Inc Agua 2 Trim', 'Cumplimiento 2 Trim', 'VP Octubre', 'VP Noviembre', 'VP Diciembre', 'VGP Octubre', 'VGP Noviembre', 'VGP Diciembre', 'KinYa Octubre', 'KinYa Noviembre', 'KinYa Diciembre', 'Inc Agua Octubre', 'Inc Agua Noviembre', 'Inc Agua Diciembre', 'VP Octubre', 'VP Noviembre', 'VP Diciembre', 'VGP Octubre', 'VGP Noviembre', 'VGP Diciembre', 'Acumulado VP 3 Trim', 'Cumple Acumulado VP 3 Trim', 'Acumulado VGP 3 Trim', 'Cumple Acumulado VGP 3 Trim', 'Acumulado Kinya  3 Trim', 'Cumple Acumulado Kinya 3 Trim', 'Acumulado Inc Agua 3 Trim', 'Cumple Acumulado Inc Agua 3 Trim', 'Cumplimiento 3 Trim', 'VGP Acumulado 2 Periodo', 'Falta VGP para el 2 Periodo', 'Cumplimiento 2 Periodo', 'Aplica doble requisito 2 periodo'];
            $datos = [];
            $datos[] = $h;
            for ($x=0; $x < sizeof($d); $x++) { 
                $datos[] = [
                    $d[$x]->codSocio,
                    $d[$x]->nombre,
                    $d[$x]->rango,
                    $d[$x]->fecha_ultimo_avance,
                    $d[$x]->estado,
                    $d[$x]->correo_elect,
                    $d[$x]->teléfono,
                    $d[$x]->pais,
                    $d[$x]->vpAbril,
                    $d[$x]->vpMayo,
                    $d[$x]->vpJunio,
                    $d[$x]->vgpAbril,
                    $d[$x]->vgpMayo,
                    $d[$x]->vgpJunio,
                    $d[$x]->kinyaAbril,
                    $d[$x]->kinyaMayo,
                    $d[$x]->kinyaJunio,
                    $d[$x]->frontalesAbril,
                    $d[$x]->frontalesMayo,
                    $d[$x]->frontalesJunio,
                    $d[$x]->vpAbrilRequistos,
                    $d[$x]->vpMayoRequistos,
                    $d[$x]->vpJunioRequistos,
                    $d[$x]->vgpAbrilRequistos,
                    $d[$x]->vgpMayoRequistos,
                    $d[$x]->vgpJunioRequistos,
                    $d[$x]->acumuladoVpTrimUno,
                    $d[$x]->cumpleAcumuladoVpTrimUno,
                    $d[$x]->acumuladoVgpTrimUno,
                    $d[$x]->cumpleAcumuladoVgpTrimUno,
                    $d[$x]->acumuladoKinyaTrimUno,
                    $d[$x]->cumpleKinyaAcumTrimUno,
                    $d[$x]->acumuladoIncorporacionTrimUno,
                    $d[$x]->cumpleIncorporacionAcumTrimUno,
                    $d[$x]->cumpleTrimestreUno,
                    $d[$x]->vpJulio,
                    $d[$x]->vpAgosto,
                    $d[$x]->vpSeptiembre,
                    $d[$x]->vgpJulio,
                    $d[$x]->vgpAgosto,
                    $d[$x]->vgpSeptiembre,
                    $d[$x]->kinyaJulio,
                    $d[$x]->kinyaAgosto,
                    $d[$x]->kinyaSeptiembre,
                    $d[$x]->frontalesJulio,
                    $d[$x]->frontalesAgosto,
                    $d[$x]->frontalesSeptiembre,
                    $d[$x]->vpJulioRequistos,
                    $d[$x]->vpAgostoRequistos,
                    $d[$x]->vpSeptiembreRequistos,
                    $d[$x]->vgpJulioRequistos,
                    $d[$x]->vgpAgostoRequistos,
                    $d[$x]->vgpSeptiembreRequistos,
                    $d[$x]->acumuladoVpTrimDos,
                    $d[$x]->cumpleAcumuladoVpTrimDos,
                    $d[$x]->acumuladoVgpTrimDos,
                    $d[$x]->cumpleAcumuladoVgpTrimDos,
                    $d[$x]->acumuladoKinyaTrimDos,
                    $d[$x]->cumpleKinyaAcumTrimDos,
                    $d[$x]->acumuladoIncorporacionTrimDos,
                    $d[$x]->cumpleIncorporacionAcumTrimDos,
                    $d[$x]->cumpleTrimestreDos,
                    $d[$x]->vpOctubre,
                    $d[$x]->vpNoviembre,
                    $d[$x]->vpDiciembre,
                    $d[$x]->vgpOctubre,
                    $d[$x]->vgpNoviembre,
                    $d[$x]->vgpDiciembre,
                    $d[$x]->kinyaOctubre,
                    $d[$x]->kinyaNoviembre,
                    $d[$x]->kinyaDiciembre,
                    $d[$x]->frontalesOctubre,
                    $d[$x]->frontalesNoviembre,
                    $d[$x]->frontalesDiciembre,
                    $d[$x]->vpOctubreRequistos,
                    $d[$x]->vpNoviembreRequistos,
                    $d[$x]->vpDiciembreRequistos,
                    $d[$x]->vgpOctubreRequistos,
                    $d[$x]->vgpNoviembreRequistos,
                    $d[$x]->vgpDiciembreRequistos,
                    $d[$x]->acumuladoVpTrimTres,
                    $d[$x]->cumpleAcumuladoVpTrimTres,
                    $d[$x]->acumuladoVgpTrimTres,
                    $d[$x]->cumpleAcumuladoVgpTrimTres,
                    $d[$x]->acumuladoKinyaTrimTres,
                    $d[$x]->cumpleKinyaAcumTrimTres,
                    $d[$x]->acumuladoIncorporacionTrimTres,
                    $d[$x]->cumpleIncorporacionAcumTrimTres,
                    $d[$x]->cumpleTrimestreTres,
                ];
            }
            $hoja3->fromArray($datos, null, 'A7', true);
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
            $d = $core->execSQLQuery("EXEC RETOS_ESPECIALES.dbo.rn_CVE_2025_ReporteIntranet_PeriodoDos;", "SQL173");
            $h = ['Código Socio','Nombre','Rango','Fecha del último rango','Estado','Correo electrónico','Teléfono Móvil','País','Trimestre Ganador'];
            $datos = [];
            $datos[] = $h;
            for ($x=0; $x < sizeof($d); $x++) { 
                $datos[] = [
                    $d[$x]->codSocio,
                    $d[$x]->nombre,
                    $d[$x]->rango,
                    $d[$x]->fecha_ultimo_avance,
                    $d[$x]->estado,
                    $d[$x]->correo_elect,
                    $d[$x]->teléfono,
                    $d[$x]->pais,
                    $d[$x]->trimestreGanador,
                ];
            }
            $hoja4->fromArray($datos, null, 'A7', true);
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
}
