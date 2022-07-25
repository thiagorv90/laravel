<?php

namespace App\Exports;

use App\Models\Instancia;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class InstanciaPorData implements FromView, ShouldAutoSize, WithDrawings
{
    use \Maatwebsite\Excel\Concerns\Exportable;

    public function view(): View
{
    return view('exports.instanciasPorData', [
        'instancias' => Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
            ->join('agendas as a', 'a.cdAgenda', '=', 'r.cdRepresentacao')
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
