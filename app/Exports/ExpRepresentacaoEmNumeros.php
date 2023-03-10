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

class ExpRepresentacaoEmNumeros implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        return view('exports.expRepresentacaoEmNumeros', [
            'representacoes' => DB::table('representacoes')
                ->join('instancias', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
                ->join('tema_representacoes', 'tema_representacoes.cdTema', '=', 'instancias.cdTema')
                ->select(DB::raw('count(instancias.cdInstancia) as inst_count,
                count(representacoes.cdRepresentacao) as rep_count, tema_representacoes.nmTema'))
                ->groupBy("tema_representacoes.nmTema")
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
