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

class ExpRelInstancias implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        return view('exports.expPorInstancia', [
            'instancias' => DB::table('instancias')
                ->join('instituicoes', 'instancias.cdInstituicao', '=', 'instituicoes.cdInstituicao')
                ->join('contatos', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')
                ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
                ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
                ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
                ->select(DB::raw('instituicoes.nmInstituicao, instancias.nmInstancia, contatos.nmContato, representante_suplentes.nmRepresentanteSuplente,
            representacao_representantes.dsDesiginacao, representacao_representantes.dsNomeacao, representacoes.dtInicioVigencia,
            representacoes.dtFimVigencia, instancias.stAtivo, instancias.dsOBjetivo'))
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
