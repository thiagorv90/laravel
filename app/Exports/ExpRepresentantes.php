<?php

namespace App\Exports;

use App\Models\agenda;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExpRepresentantes implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        return view('exports.expRepresentantes', [
            'representacoes' => DB::table('representacoes')
                ->join('instancias', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
                ->join('representacao_representantes', 'representacao_representantes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
                ->join('representante_suplentes', 'representante_suplentes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
                ->select(DB::raw('representante_suplentes.nmRepresentanteSuplente, instancias.nmInstancia, representacao_representantes.dsDesiginacao,
                representacao_representantes.dsNomeacao, representacoes.dtInicioVigencia, representacoes.dtFimVigencia, instancias.stAtivo'))
                ->distinct('instancias.nmInstancia')
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
