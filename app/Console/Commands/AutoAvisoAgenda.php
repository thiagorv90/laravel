<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agenda;
use App\Mail\AvisoAgenda;
use App\Models\Representacoe;
use App\Models\Representante_suplente;
use App\Models\Instancia;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AutoAvisoAgenda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:avisoagenda';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aviso para data agenda';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mails = Agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
        ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
        ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
        ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
        
        ->get(['representante_suplentes.nmRepresentanteSuplente as representante','representante_suplentes.dsEmail as emailrepre','s.nmRepresentanteSuplente',
        's.dsEmail','instancias.nmInstancia','agendas.dtAgenda','agendas.hrAgenda','agendas.dsAssunto','agendas.dsLocal','agendas.dsPauta','agendas.dsResumo']);

       
        
        foreach($mails as $mail){
            if(Carbon::parse($mail->dtAgenda)->diffForHumans(Carbon::now('America/Sao_Paulo')) == 2){ 
                mail::send( new \App\Mail\AvisoAgenda($mail));
                $this->info('auto:avisoagenda deu certo!');
            }
      
    }
}
}