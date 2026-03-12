<?php

namespace App\Exports;

use App\Models\Pago;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PagosExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $pagos;
    protected $filters;
    protected $summary;

    public function __construct($pagos, $filters = [], $summary = [])
    {
        $this->pagos = $pagos;
        $this->filters = $filters;
        $this->summary = $summary;
    }

    public function view(): View
    {
        return view('exports.pagos', [
            'pagos' => $this->pagos,
            'filters' => $this->filters,
            'summary' => $this->summary
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:C1' => [ // Estilo para el encabezado del resumen
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F46E5']]
            ],
        ];
    }
}