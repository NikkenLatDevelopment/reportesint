<?php

namespace App\Exports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;

class reportCVEmprendedor implements WithMultipleSheets, Responsable{
    use Exportable;

    private $fileName = "Retos Especiales 2024 - Reporte Interno.xlsx";
    private $writerType = \Maatwebsite\Excel\Excel::XLSX;
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    protected $dataH1;
    protected $dataH2;
    protected $dataH3;
    protected $dataH4;

    public function __construct($dataH1, $dataH2, $dataH3, $dataH4){
        $this->dataH1 = $dataH1;
        $this->dataH2 = $dataH2;
        $this->dataH3 = $dataH3;
        $this->dataH4 = $dataH4;
    }

    public function sheets(): array{
        return [
            'Primera Hoja' => new MyFirstSheet($this->dataH1),
            'Segunda Hoja' => new MySecondSheet($this->dataH2),
            'Tercera Hoja' => new MyThirdSheet($this->dataH3),
            'Cuarta Hoja' => new MyQuarterSheet($this->dataH4),
        ];
    }
}

class MyFirstSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize, WithDrawings, WithCustomStartCell, WithEvents{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function collection(){
        return collect($this->data);
    }

    public function title(): string{
        return 'ABIs que participan';
    }

    public function headings(): array{
        return [
            'Código de Asesor ',
            'Nombre',
            'Rango Inicial ',
            'Rango Actual',
            '# Movil ',
            'pais',
            'Codigo de patrocinador ',
            'Nombre patrocinador',
            'Rango patrocinador',
            'pais del Patrocinador',
            'Semestre de participación',
            'Mes de Inicio de semestre',
            'Mes de Finalización  de semestre',
            'VGP Acumulado ',
            'VGP Faltante',
            'Mes de Inicio del Trimestre',
            'Mes de Finalización  de trimestre',
            'VGP Acumulado ',
            'VGP Faltante',
            'VP Acumulado ',
            'VP Faltante',
            'Mes 1 VP',
            'Mes 2 VP',
            'Mes 3 VP',
            'Realizado VP mensual',
            'Faltante VP mensual',
            'Mes 1 VGP',
            'Mes 2 VGP',
            'Mes 3 VGP',
            'Realizado VGP mensual',
            'Faltante VGP mensual',
            'Cantidad de KinYa',
            'Realizado ',
            'Faltante',
            'Incorporaciones con Kit Sistemas de Agua',
            'Realizado ',
            'Faltante',
            'Ganador del trimestre 1',
            'Mes de Inicio del Trimestre',
            'Mes de Finalización  de trimestre',
            'VGP Acumulado ',
            'VGP Faltante',
            'VP Acumulado ',
            'VP Faltante',
            'Mes 1 VP',
            'Mes 2 VP',
            'Mes 3 VP',
            'Realizado VP mensual',
            'Faltante VP mensual',
            'Mes 1 VGP',
            'Mes 2 VGP',
            'Mes 3 VGP',
            'Realizado VGP mensual',
            'Faltante VGP mensual',
            'Cantidad de KinYa',
            'Realizado ',
            'Faltante',
            'Incorporaciones con Kit Sistemas de Agua',
            'Realizado ',
            'Faltante',
            'Ganador de trimestre 2',
        ];
    }

    public function drawings(){
        if (!$imageResource = @imagecreatefromstring(file_get_contents('https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png'))) {
            throw new \Exception('The image URL cannot be converted into an image resource.');
        }

        $drawing = new MemoryDrawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setImageResource($imageResource);
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function styles(Worksheet $sheet){
        return [
            9 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
            ],
        ];
    }

    public function startCell(): string{
        return 'A9';
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('A5', 'Semestre de medición: ');
                $event->sheet->getStyle('A5')->getFont()->setBold(true);
                $event->sheet->mergeCells('B5:E5');
                $event->sheet->setCellValue('B5', 'Semestre 1 (Enero-Junio/2024)  / Semestre 2 (Feb-Julio 2024) / Semestre 3 ( Marzo-Agosto2024)/ Semestre 4 (Abril-Sept2024)');

                $event->sheet->setCellValue('A6', 'Trimestre de medición:');
                $event->sheet->getStyle('A6')->getFont()->setBold(true);
                $event->sheet->mergeCells('B6:E6');
                $event->sheet->setCellValue('B6', 'Trimestre 1 / 2 / 3, etc.');

                $event->sheet->setCellValue('P7', 'Trimestre 1');
                $event->sheet->getStyle('P7')->getFont()->setBold(true);
                $event->sheet->mergeCells('P7:AL7');
                $event->sheet->getDelegate()->getStyle('P7:AL7')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'FFFF00']]]);
                
                $event->sheet->setCellValue('AM7', 'Trimestre 2');
                $event->sheet->getStyle('AM7')->getFont()->setBold(true);
                $event->sheet->mergeCells('AM7:BI7');
                $event->sheet->getDelegate()->getStyle('AM7:BI7')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'BDD7EE']]]);

                $event->sheet->getDelegate()->getStyle('A9:L9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'B4C6E7']]]);
                $event->sheet->getDelegate()->getStyle('M9:U9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'D9E1F2']]]);
                $event->sheet->getDelegate()->getStyle('V9:W9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'DBDBDB']]]);
                $event->sheet->getDelegate()->getStyle('X9:AB9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'F4B084']]]);
                $event->sheet->getDelegate()->getStyle('AC9:AG9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'FFE699']]]);
                $event->sheet->getDelegate()->getStyle('AH9:AJ9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'D6DCE4']]]);
                $event->sheet->getDelegate()->getStyle('AK9:AM9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'FFE699']]]);
                $event->sheet->getDelegate()->getStyle('AN9:BI9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'FFE699']]]);
            },
        ];
    }
}

class MySecondSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize, WithDrawings, WithCustomStartCell, WithEvents{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function collection(){
        return collect($this->data);
    }

    public function title(): string{
        return 'ABIs que no participan';
    }

    public function headings(): array{
        return [
            'CodAsesor',
            'NombreAsesor',
            'RangoInicial',
            'RangoActual',
            'TelefonoAsesor',
            'pais',
            'CodPatrocinador',
            'NombrePatrocinador',
            'RangoPatrocinador',
            'PaisPatrocinador',
            'SemestreParticipacion',
            'MesInicioSemestre',
            'MesFinSemestre',
            'vgpAcumulado',
            'vgpRestante',
            'MesInicioTrim1',
            'MesFinTrim1',
            'vgpAcumuladoTrim1',
            'vgpRestanteTrim1',
            'vpAcumuladoTrim1',
            'vpRestanteTrim1',
            'vpMes1',
            'vpMes2',
            'vpMes3',
            'vpRealizadoMes1',
            'vpFaltantesMes1',
            'vgpMes1',
            'vgpMes2',
            'vgpMes3',
            'vgpRealizadoMes1',
            'vgpFaltantesMes1',
            'cantidadKinyaMes1',
            'kinyaRealizadosMes1',
            'kinyaFaltantesMes1',
            'cantidadFrontalesMes1',
            'FrontalesRealizadosMes1',
            'FrontalesFaltantesMes1',
            'Ganadortrimestre1',
            'MesInicioTrim2',
            'MesFinTrim2',
            'vgpAcumuladoTrim2',
            'vgpRestanteTrim2',
            'vpAcumuladoTrim2',
            'vpRestanteTrim2',
            'vpMes4',
            'vpMes5',
            'vpMes6',
            'vpRealizadoMes2',
            'vpFaltantesMes2',
            'vgpMes4',
            'vgpMes5',
            'vgpMes6',
            'vgpRealizadoMes2',
            'vgpFaltantesMes2',
            'cantidadKinyaMes2',
            'kinyaRealizadosMes2',
            'kinyaFaltantesMes2',
            'cantidadFrontalesMes2',
            'FrontalesRealizadosMes2',
            'FrontalesFaltantesMes2',
            'Ganadortrimestre2',
        ];
    }

    public function drawings(){
        if (!$imageResource = @imagecreatefromstring(file_get_contents('https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png'))) {
            throw new \Exception('The image URL cannot be converted into an image resource.');
        }

        $drawing = new MemoryDrawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setImageResource($imageResource);
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function styles(Worksheet $sheet){
        return [
            9 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'B4C6E7']], // Fondo azul
            ],
        ];
    }

    public function startCell(): string{
        return 'A9';
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('A5', 'Semestre de medición: ');
                $event->sheet->getStyle('A5')->getFont()->setBold(true);
                $event->sheet->mergeCells('B5:E5');
                $event->sheet->setCellValue('B5', 'Semestre 1 (Enero-Junio/2024)  / Semestre 2 (Feb-Julio 2024) / Semestre 3 ( Marzo-Agosto2024)/ Semestre 4 (Abril-Sept2024)');

                $event->sheet->setCellValue('A6', 'Trimestre de medición:');
                $event->sheet->getStyle('A6')->getFont()->setBold(true);
                $event->sheet->mergeCells('B6:E6');
                $event->sheet->setCellValue('B6', 'Trimestre 1 / 2 / 3, etc.');
                
                $event->sheet->setCellValue('P7', 'Trimestre 1');
                $event->sheet->getStyle('P7')->getFont()->setBold(true);
                $event->sheet->mergeCells('P7:AL7');
                $event->sheet->getDelegate()->getStyle('P7:AL7')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'FFFF00']]]);
                
                $event->sheet->setCellValue('AM7', 'Trimestre 2');
                $event->sheet->getStyle('AM7')->getFont()->setBold(true);
                $event->sheet->mergeCells('AM7:BI7');
                $event->sheet->getDelegate()->getStyle('AM7:BI7')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'BDD7EE']]]);

                $event->sheet->getDelegate()->getStyle('A9:L9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'B4C6E7']]]);
                $event->sheet->getDelegate()->getStyle('M9:U9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'D9E1F2']]]);
                $event->sheet->getDelegate()->getStyle('V9:W9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'DBDBDB']]]);
                $event->sheet->getDelegate()->getStyle('X9:AB9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'F4B084']]]);
                $event->sheet->getDelegate()->getStyle('AC9:AG9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'FFE699']]]);
                $event->sheet->getDelegate()->getStyle('AH9:AJ9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'D6DCE4']]]);
                $event->sheet->getDelegate()->getStyle('AK9:AM9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'FFE699']]]);
                $event->sheet->getDelegate()->getStyle('AN9:BI9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'FFE699']]]);
            },
        ];
    }
}

class MyThirdSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize, WithDrawings, WithCustomStartCell, WithEvents{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function collection(){
        return collect($this->data);
    }

    public function title(): string{
        return 'Detalle de Incorporaciones';
    }

    public function headings(): array{
        return [
            'Código Incorporado',
            'Nombre Incorporado',
            'País',
            'Fecha De Incorporado',
            'Item',
            'Descripcion Del Kit',
            'Cantidad',
            'Periodo De Plan Incorporacion',
            'Código Patrocinador ',
            'Nombre de Patrocinador ',
            'Rango Patrocinador ',
            'Pais Patrocinador ',
        ];
    }

    public function drawings(){
        if (!$imageResource = @imagecreatefromstring(file_get_contents('https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png'))) {
            throw new \Exception('The image URL cannot be converted into an image resource.');
        }

        $drawing = new MemoryDrawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setImageResource($imageResource);
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function styles(Worksheet $sheet){
        return [
            9 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'B4C6E7']], // Fondo azul
            ],
        ];
    }

    public function startCell(): string{
        return 'A9';
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('A5', 'Semestre de medición: ');
                $event->sheet->getStyle('A5')->getFont()->setBold(true);
                $event->sheet->mergeCells('B5:E5');
                $event->sheet->setCellValue('B5', 'Semestre 1 (Enero-Junio/2024)  / Semestre 2 (Feb-Julio 2024) / Semestre 3 ( Marzo-Agosto2024)/ Semestre 4 (Abril-Sept2024)');

                $event->sheet->setCellValue('A6', 'Trimestre de medición:');
                $event->sheet->getStyle('A6')->getFont()->setBold(true);
                $event->sheet->mergeCells('B6:E6');
                $event->sheet->setCellValue('B6', 'Trimestre 1 / 2 / 3, etc.');

                $event->sheet->getDelegate()->getStyle('A9:L9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'B4C6E7']]]);
            },
        ];
    }
}

class MyQuarterSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize, WithDrawings, WithCustomStartCell, WithEvents{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function collection(){
        return collect($this->data);
    }

    public function title(): string{
        return 'Detalle de Kinya';
    }

    public function headings(): array{
        return [
            'Código Incorporado',
            'Nombre Incorporado',
            'Pais',
            'Núm De Orden',
            'Tipo De Documento',
            'Item',
            'Descripción',
            'Cantidad',
            'Pais',
            'Fecha De Orden',
            'Periodo',
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            9 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'B4C6E7']], // Fondo azul
            ],
        ];
    }

    public function drawings(){
        if (!$imageResource = @imagecreatefromstring(file_get_contents('https://storage.googleapis.com/proyectos_latam/retos_especiales_2024/emprendedor/Club%20Viajero%20Emprendedores.png'))) {
            throw new \Exception('The image URL cannot be converted into an image resource.');
        }

        $drawing = new MemoryDrawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setImageResource($imageResource);
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function startCell(): string{
        return 'A9';
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('A5', 'Semestre de medición: ');
                $event->sheet->getStyle('A5')->getFont()->setBold(true);
                $event->sheet->mergeCells('B5:E5');
                $event->sheet->setCellValue('B5', 'Semestre 1 (Enero-Junio/2024)  / Semestre 2 (Feb-Julio 2024) / Semestre 3 ( Marzo-Agosto2024)/ Semestre 4 (Abril-Sept2024)');

                $event->sheet->setCellValue('A6', 'Trimestre de medición:');
                $event->sheet->getStyle('A6')->getFont()->setBold(true);
                $event->sheet->mergeCells('B6:E6');
                $event->sheet->setCellValue('B6', 'Trimestre 1 / 2 / 3, etc.');

                $event->sheet->getDelegate()->getStyle('A9:K9')->applyFromArray(['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'startColor' => ['argb' => 'B4C6E7']]]);
            },
        ];
    }
}