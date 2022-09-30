@component('mail::message')
    Prezados {{$mail->representante}}

    Nome da Instancia:{{$mail->nmInstancia}}<br>
    Data da Agenda:{!! date('d/m/Y', strtotime($mail->dtAgenda)) !!}<br>
    Hora da Agenda:{!! date('G:i', strtotime($mail->hrAgenda)) !!}<br>
    Assunto da Agenda:{{$mail->dsAssunto}}<br>
    Local da Agenda:{{$mail->dsLocal}}<br>
    Pauta da Agenda:{{$mail->dsPauta}}<br>
    Resumo da Agenda:{{$mail->dsResumo}}

@endcomponent
