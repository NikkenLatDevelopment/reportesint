<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\LazyCollection;
use Maatwebsite\Excel\Concerns\FromIterator;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;

class posibleAvance implements WithMultipleSheets, Responsable{
    use Exportable;
    
    private $fileName = "Reconocimientos - Posibles avances de rango";
    private $writerType = \Maatwebsite\Excel\Excel::CSV;
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        return [
            'Primera Hoja' => new MyFirstSheet($this->data),
        ];
    }
}

class MyFirstSheet implements FromIterator, WithTitle, WithHeadings, WithStyles, ShouldAutoSize, WithCustomStartCell, WithEvents
{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function iterator(): \Iterator{
        return new \ArrayIterator($this->data);
    }

    public function title(): string{
        return 'Posible';
    }

    public function headings(): array{
        return [
            'Codigo',
            'Nombre',
            'Rango',
            'Pais',
            'Periodo',
            'VP',
            'VGP',
            'VO',
            'VO_LDP',
            'VO_LDPyS',
            'Avance',
            'Tipo Avance',
            'VP Faltante',
            'VGP Faltante',
            'VO Faltante',
            'VO_LDP Faltante',
            'VO_LDPyS Faltante',
            'Posible Rango',
            'Código patrocinador',
            'Nombre Patocinador',
            'País patrocinador',
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            3 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
            ],
        ];
    }

    public function startCell(): string{
        return 'A3';
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->setCellValue('A1', 'Reconocimientos | Posibles avances de rango | Fecha de actualización: ' . Date('Y-m-d H:i:s'));
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
            },
        ];
    }
}