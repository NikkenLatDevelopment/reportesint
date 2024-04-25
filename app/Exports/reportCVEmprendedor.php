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

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;

class reportCVEmprendedor implements WithMultipleSheets, Responsable{
    use Exportable;

    private $fileName = 'Retos Especiales 2024 - Reporte Interno.xlsx';
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

class MyFirstSheet implements FromCollection, WithTitle, WithHeadings, WithStyles{
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

    public function styles(Worksheet $sheet){
        foreach(range('A', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('B', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('C', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('D', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('E', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('F', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('G', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('H', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('I', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('J', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('K', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('L', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('M', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('N', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('O', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('P', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('Q', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('R', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('S', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('T', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('U', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('V', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('W', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('X', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('Y', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('Z', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AA', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AB', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AC', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AD', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AE', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AF', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AG', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AH', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AI', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AJ', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AK', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AL', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AM', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AN', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AO', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AP', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AQ', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AR', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AS', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AT', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AU', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AV', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AW', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AX', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AY', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AZ', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BA', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BB', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BC', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BD', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BE', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BF', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BG', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BH', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BI', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '5ed1ff']], // Fondo azul
            ],
        ];
    }
}

class MySecondSheet implements FromCollection, WithTitle, WithHeadings, WithStyles{
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

    public function styles(Worksheet $sheet){
        foreach(range('A', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('B', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('C', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('D', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('E', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('F', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('G', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('H', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('I', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('J', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('K', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('L', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('M', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('N', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('O', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('P', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('Q', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('R', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('S', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('T', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('U', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('V', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('W', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('X', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('Y', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('Z', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AA', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AB', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AC', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AD', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AE', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AF', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AG', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AH', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AI', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AJ', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AK', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AL', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AM', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AN', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AO', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AP', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AQ', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AR', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AS', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AT', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AU', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AV', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AW', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AX', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AY', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('AZ', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BA', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BB', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BC', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BD', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BE', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BF', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BG', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BH', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('BI', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '5ed1ff']], // Fondo azul
            ],
        ];
    }
}

class MyThirdSheet implements FromCollection, WithTitle, WithHeadings, WithStyles{
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
            'CodAsesor',
            'NombreAsesor',
            'pais',
            'FechaIncorporado',
            'Itemcode',
            'Descripcion',
            'Cantidad',
            'Periodo',
            'SponsorCode',
            'SponsorName',
            'SponsorRango',
            'SponsorPais',
        ];
    }

    public function styles(Worksheet $sheet){
        foreach(range('A', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('B', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('C', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('D', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('E', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('F', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('G', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('H', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('I', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('J', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('K', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('L', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '5ed1ff']], // Fondo azul
            ],
        ];
    }
}

class MyQuarterSheet implements FromCollection, WithTitle, WithHeadings, WithStyles{
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
            'CodAsesor',
            'NombreAsesor',
            'pais',
            'NumOrden',
            'TipoDocumento',
            'Itemcode',
            'Descripcion',
            'Cantidad',
            'Pais_1',
            'FechaOrden',
            'periodo',
        ];
    }

    public function styles(Worksheet $sheet){
        foreach(range('A', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('B', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('C', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('D', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('E', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('F', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('G', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('H', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('I', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('J', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        foreach(range('K', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '5ed1ff']], // Fondo azul
            ],
        ];
    }
}