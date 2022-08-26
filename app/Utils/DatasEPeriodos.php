<?php

namespace App\Utils;

use App\Http\Controllers\AgendasController;
use Carbon\Carbon;

abstract class DatasEPeriodos
{

    static function retornaDiaDeHoje()
    {
        date_default_timezone_set('America/Sao_Paulo');
        setlocale(LC_ALL, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
        setlocale(LC_TIME, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');


        return Carbon::now();
    }

    static function retornaSemanaAtual()
    {
        $diaDeHoje = DatasEPeriodos::retornaDiaDeHoje();

        $iniSemana = $diaDeHoje->startOfWeek()->format('Y-m-d');
        $fimSemana = $diaDeHoje->endOfWeek()->format('Y-m-d');

        return [$iniSemana, $fimSemana];
    }

    static function retornaMesAtual()
    {
        $iniMes = new Carbon('first day of this month');
        $fimMes = new Carbon('last day of this month');

        return [$iniMes->toDateString(), $fimMes->toDateString()];
    }
}
