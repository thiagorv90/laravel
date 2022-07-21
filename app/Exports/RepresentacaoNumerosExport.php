<?php

namespace App\Exports;

use App\Models\Instancia;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class RepresentacaoNumerosExport
{
    use \Maatwebsite\Excel\Concerns\Exportable;

    public function view(): View
    {
        return view('exports.instanciasPorId', [
            'instancias' => Instancia::select('stAtivo', DB::raw("'COUNT'(stAtivo) as quantAtivoInativo"))
            ->groupBy('stAtivo')
            ->get()
        ]);
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('FIBRA');
        $drawing->setPath(public_path('/image/fibra.png'));
        $drawing->setHeight(90);
        $drawing->setWidth(250);
        $drawing->setCoordinates('A2');

        return $drawing;
    }

}
