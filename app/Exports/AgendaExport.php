<?php

namespace App\Exports;

use App\Models\Agenda;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AgendaExport implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        return view('exports.agendasPorData', [
            'agendas' => Agenda::join('representacoes', 'agendas.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
                ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
                ->join('instituicoes', 'instituicoes.cdInstituicao', 'instancias.cdInstituicao')
                ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
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
