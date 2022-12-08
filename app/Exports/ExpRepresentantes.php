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
            'representantes' => DB::table('representante_suplentes')
                ->join('telefone_representante_suplentes', 'telefone_representante_suplentes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
                ->join('escolaridades', 'escolaridades.cdEscolaridade', '=', 'representante_suplentes.cdEscolaridade')
                ->select(DB::raw('representante_suplentes.nmRepresentanteSuplente, representante_suplentes.dtNascimento , escolaridades.dsEscolaridade,
            representante_suplentes.dsEndereco,  telefone_representante_suplentes.nuDDDTelefone, telefone_representante_suplentes.nuTelefone, representante_suplentes.dsEmail'))
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
