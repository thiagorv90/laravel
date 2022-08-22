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
use Illuminate\Http\Request;


class AgendaFiltradaExport implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;
       /**
     * @return \Illuminate\Support\Collection
     */

    
    public function __construct($dataInicio, $dataFim) 
    {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;

       
    }

    public function view(): View
    {
        // dd($request);
        // $dataInicio = $request->input('dataInicio');
        // $dataFim = $request->input('dataFim');

        return view('exports.agendaFiltrada', [
            'agendas' =>  Agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
        ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
        
        ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
        ->join('instituicoes','instituicoes.cdInstituicao','instancias.cdInstituicao')->whereBetween('dtAgenda',[$this->dataInicio,  $this->dataFim] )        
        
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
