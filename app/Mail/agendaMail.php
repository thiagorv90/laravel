<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agenda;
use App\Models\Agenda_anexo;
use DB;
use App\Models\Representacoe;

class AgendaMail extends Mailable
{
    use Queueable, SerializesModels;

    private $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail)
    {

        $this->mail = $mail;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('SGR - Nova Agenda Criada');
        $this->to($this->mail->emailrepre);
        $this->to($this->mail->dsEmail);
        $this->cc(auth()->user()->email);
        return $this->markdown('mail.agendaMail', ['mail' => $this->mail]);
    }
}
