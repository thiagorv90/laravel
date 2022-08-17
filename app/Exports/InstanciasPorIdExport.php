<?php

namespace App\Exports;

use App\Models\Instancia;
use App\Models\Representacoe;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\view;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class InstanciasPorIdExport implements FromView, ShouldAutoSize, WithDrawings
{
    protected $id;
    use \Maatwebsite\Excel\Concerns\Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
//    public function __construct($id)
//    {
//        $this->id = $id;
//    }

    public function view(): View
    {
        return view('exports.instanciasPorId', [
            'instancias' => Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                ->join('representante_suplentes as rs', 'rs.cdRepSup', '=', 'r.cdSuplente')
                ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
                ->select(DB::raw('nmInstancia, tpPublicoPrivado, tpFederalDistrital, dsObjetivo,
                rs.nmRepresentanteSuplente as repSup, rt.nmRepresentanteSuplente as repTit'))
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
