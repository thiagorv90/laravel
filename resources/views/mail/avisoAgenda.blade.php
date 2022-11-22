@component('mail::message')

Prezado {{$mail->nmRepresentanteSuplente}}.

Segue o lembrete de reunião do <strong>{{$mail->nmInstancia}}</strong>.

<strong>Data</strong>: {!! date('d/m/Y', strtotime($mail->dtAgenda)) !!}

                        
<strong>Horário</strong>:{!! date('G:i', strtotime($mail->hrAgenda)) !!}

<strong>Local</strong>: {{$mail->dsLocal}}. 



Pauta: {{$mail->dsPauta}}.



Por gentileza confirmar presença.
@endcomponent
