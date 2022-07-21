<?php

namespace App\Exports;

use App\Models\Instancia;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class InstanciasPorIdExport implements FromView, ShouldAutoSize, WithDrawings
{
    protected $id;
    use \Maatwebsite\Excel\Concerns\Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
//    public function __construct($id)
//    {
//        $this->id = $id;
//    }

    public function view(): View
    {
        return view('exports.instanciasPorId', [
            'instancias' => Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                ->join('representante_suplentes as rs', 'rs.cdRepSup', '=', 'r.cdSuplente')
                ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
                ->select(DB::raw('nmInstancia, tpAtribuicoes, tpPublicoPrivado, tpFederalDistrital, dsObjetivo,
                rs.nmRepresentanteSuplente as repSup, rt.nmRepresentanteSuplente as repTit'))
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
