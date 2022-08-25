<?php

namespace App\Exports;

use App\Models\Instancia;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class InstanciaPorVigenciaExport implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;

    public function __construct($dataInicio, $dataFim)
    {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;


    }

    public function view(): View
    {
        if ($this->dataFim <> '') {
            return view('exports.instanciasPorVigencia', [
                'instancias' => Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                    ->where('r.dtFimVigencia', '<=', $this->dataFim)
                    ->where('r.dtInicioVigencia', '>=', $this->dataInicio)
                    ->get()
            ]);
        } else {
            return view('exports.instanciasPorVigencia', [
                'instancias' => Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                    ->get()
            ]);
        }
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
