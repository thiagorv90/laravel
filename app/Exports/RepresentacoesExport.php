<?php

namespace App\Exports;

use App\Models\Representacoe;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\view;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RepresentacoesExport implements FromView, ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): view
    {
        //Falta terminar a querry
        return view('exports.representacoes', [
            'representacoes' => Representacoe::join('instancias', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
                ->leftjoin('representante_suplentes', 'representante_suplente.cdRepSup', '=', 'representacoes.cdTitular')



        ]);
    }
}
