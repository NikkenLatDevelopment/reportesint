<?php

namespace App\Exports;

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

class volumenGlobal implements WithMultipleSheets, Responsable
{
    use Exportable;

    private $fileName = "Reconocimientos | Volumen LATAM";
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

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function iterator(): \Iterator
    {
        // Using ArrayIterator to ensure compatibility with FromIterator
        return new \ArrayIterator($this->data);
    }

    public function title(): string
    {
        return 'ABIs que participan';
    }

    public function headings(): array
    {
        return [
            'Codigo de influencer',
            'Nombre',
            'Rango',
            'Pais',
            'VP',
            'VGP',
            'VO',
            'VO-LDP',
            'VO-LDPyS',
            'Periodo',
            'Codigo de patrocinador',
            'Nombre patrocinador',
            'Pais patrocinador',
            'Tipo de usuario',
            'Estatus',
            'Estado',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            3 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
            ],
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->setCellValue('A1', 'Reconocimientos | Volumen LATAM | Fecha de actualización: ' . Date('Y-m-d H:i:s'));
                $event->sheet->getStyle('A1')->getFont()->setBold(true);

                $event->sheet->setCellValue('A2', 'Solo contiene volumen de la unidad de mercado LATINOAMÉRICA');
                $event->sheet->getStyle('A2')->getFont()->setBold(true);
            },
        ];
    }
}