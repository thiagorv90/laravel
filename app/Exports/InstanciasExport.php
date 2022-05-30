<?php

namespace App\Exports;

use App\Models\Instancia;
use Illuminate\Contracts\View\view;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class InstanciasExport implements FromView, ShouldAutoSize

{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): view
    {
        return view('exports.instancias', ['instancias' => Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
            ->leftjoin('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->leftjoin('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->leftjoin('representante_suplentes', 'representacoes.cdTitular', '=', 'cdRepsup')
            ->leftjoin('contatos', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')

            ->get()]);
    }
}
