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

class kinyaHistoric implements WithMultipleSheets, Responsable{
    use Exportable;

    private $fileName = "Reconocimientos | KinYa! (Histórico)";
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
        return 'KinYa';
    }

    public function headings(): array
    {
        return [
            'Associateid',
            'AssociateName',
            'Rango',
            'Email',
            'Telefono',
            'Estado',
            'Pais',
            'Fecha_Incorp',
            'VP_Mes',
            'Periodo',
            'Unidades_VentaDirecta',
            'Unidades_PorInfluencer',
            'Transformado',
            'TotalUnidades',
            'Total_Transfor_Mokuteki',
            'Total_Incorpo_Influencer',
            'Cumple_Kinya',
            'kinya_PorVenta',
            'kinya_PorInfluencia',
            'Sponsorid',
            'SponsorName',
            'SponsorPais',
            'Estatus',
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
                $event->sheet->setCellValue('A1', 'Reconocimientos | KinYa! (Histórico) | Fecha de actualización: ' . Date('Y-m-d H:i:s'));
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
            },
        ];
    }
}