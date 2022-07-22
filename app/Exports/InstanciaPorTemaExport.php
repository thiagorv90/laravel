<?php

namespace App\Exports;

use App\Models\Instancia;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class InstanciaPorTemaExport implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;

    public function view(): View
    {
        return view('exports.instanciasPorTema', [
            'instancias' => Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                ->join('representante_suplentes as rs', 'rs.cdRepSup', '=', 'r.cdSuplente')
                ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
                ->join('tema_representacoes as tr', 'instancias.cdTema', '=', 'tr.cdTema')
                ->select(DB::raw('tr.nmTema as tema, instancias.nmInstancia as instancia,
                rt.nmRepresentanteSuplente as repTit, rs.nmRepresentanteSuplente as repSup'))
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
