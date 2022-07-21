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
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use App\Invoice;
use Maatwebsite\Excel\Concerns\Construct;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class InstanciasExport implements FromView, ShouldAutoSize, WithDrawings

{
    protected $id;
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): view
    {
        return view('exports.instancias', ['instancias' => Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
            ->leftjoin('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->leftjoin('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->leftjoin('representante_suplentes', 'representacoes.cdTitular', '=', 'cdRepsup')
            ->leftjoin('contatos', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')
            ->where('instancias.cdInstancia', '=', $this->id)
            ->get()]);
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('FIBRA');
        $drawing->setPath(public_path('/image/fibralogo.png'));
        $drawing->setHeight(90);
        $drawing->setWidth(250);
        $drawing->setCoordinates('A2');

        return $drawing;
    }
}
