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

class ExpReunioesMensais implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        return view('exports.expReunioesMensais', [
            'reunioes' => DB::table('instancias')
                ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
                ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
                ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
                ->join('agendas', 'agendas.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
                ->select(DB::raw('instancias.nmInstancia, representante_suplentes.nmRepresentanteSuplente, agendas.dsPauta'))
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
