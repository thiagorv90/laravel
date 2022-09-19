<?php

namespace App\Exports;

use App\Http\Controllers\AgendasController;
use App\Models\agenda;
use App\Utils\DatasEPeriodos;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AgendaReuniao implements FromView, ShouldAutoSize, WithDrawings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($periodo = "Todas")
    {
        $this->periodo = $periodo;

        $this->semana = DatasEPeriodos::retornaSemanaAtual();
        $this->mes = DatasEPeriodos::retornaMesAtual();
    }

    public function view(): View
    {
        switch ($this->periodo) {
            case 'Dia':
                $agendasDia = Agenda::orderBy('dtAgenda')
                    ->where('dtAgenda', DatasEPeriodos::retornaDiaDeHoje())
                    ->get();

                return view('exports.agendaReuniao', ['agendas' => $agendasDia]);
            case 'Semana':
                $agendasSemana = Agenda::orderBy('dtAgenda')
                    ->whereBetween('dtAgenda', [$this->semana[0], $this->semana[1]])
                    ->get();

                return view('exports.agendaReuniao', ['agendas' => $agendasSemana]);
            case 'Mes':
                $agendasMensal = Agenda::orderBy('dtAgenda')
                    ->whereBetween('dtAgenda', [$this->mes[0], $this->mes[1]])
                    ->get();

                return view('exports.agendaReuniao', ['agendas' => $agendasMensal]);
            case 'Todas':
                return view('exports.agendaReuniao', [
                    'agendas' => Agenda::orderBy('dtAgenda')
                        ->get()
                ]);
            default:
                return view('exports.agendaReuniao', [
                    'agendas' => Agenda::orderBy('dtAgenda')
                        ->get()
                ]);
        }
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
