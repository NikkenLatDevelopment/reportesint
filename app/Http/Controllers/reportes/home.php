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

    public function getDataInactivos(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Inactivos');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        
        $sheet->getStyle('A2:K2')->getFont()->setBold(true);
        $sheet->setCellValue('A2', "Código");
        $sheet->setCellValue('B2', "Nombre");
        $sheet->setCellValue('C2', "Rango");
        $sheet->setCellValue('D2', "País");
        $sheet->setCellValue('E2', "Telefono");
        $sheet->setCellValue('F2', "Correo");
        $sheet->setCellValue('G2', "VP Noviembre.Calc.");
        $sheet->setCellValue('H2', "Código Patrocinador");
        $sheet->setCellValue('I2', "Nombre Patrocinador");

        $coreApp = new coreApp();
        $data = $coreApp->execSQLQuery('EXEC PLAN_INFLUENCIA_MK.dbo.sgtPerfecto_ReporteInternoRegresaACasa;', 'SQL173');

        $x = 3;
        foreach ($data as $row) {
            $sheet->setCellValue("A$x", $row->codAsociado);
            $sheet->setCellValue("B$x", $row->nombreAsociado);
            $sheet->setCellValue("C$x", $row->Rango);
            $sheet->setCellValue("D$x", $row->pais);
            $sheet->setCellValue("E$x", $row->telefono);
            $sheet->setCellValue("F$x", $row->E_mail);
            $sheet->setCellValue("G$x", $row->vpNoviembre2023);
            $sheet->setCellValue("H$x", $row->SponsorId);
            $sheet->setCellValue("I$x", $row->sponsorname);
            $x++;
        }
        
        $fileName = "Inactivos 2023 - v" . Date('is') . '.xlsx';

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
