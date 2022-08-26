@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio de Reuniões</h2>

    <a href="{{route('exportAgendaReuniaoDiaria')}}" class="btn btn-primary mb-2"
       data-bs-toggle="tooltip" data-bs-title="Download" id="downloadDia">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>

    <a href="{{route('exportAgendaReuniaoSemanal')}}" class="btn btn-primary mb-2"
       data-bs-toggle="tooltip" data-bs-title="Download" id="downloadSemana" style="display: none">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>

    <a href="{{route('exportAgendaReuniaoMensal')}}" class="btn btn-primary mb-2"
       data-bs-toggle="tooltip" data-bs-title="Download" id="downloadMes" style="display: none">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>

    <form id="periodoForm" class="form-check">
        <input class="form-check-input" type="radio" name="periodoFormRadio" id="radioDia" value="Dia">
        <label class="form-check-label" for="radioDia">
            Diária
        </label>
        <br>
        <input class="form-check-input" type="radio" name="periodoFormRadio" id="radioSemana" value="Semana">
        <label class="form-check-label" for="radioSemana">
            Semanal
        </label>
        <br>
        <input class="form-check-input" type="radio" name="periodoFormRadio" id="radioMensal" value="Mes">
        <label class="form-check-label" for="radioMensal">
            Mensal
        </label>
    </form>

    <div id="agendaDia">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><strong>Pauta</strong></th>
                <th scope="col"><strong>Assunto</strong></th>
                <th scope="col"><strong>Data</strong></th>
                <th scope="col"><strong>Hora</strong></th>
                <th scope="col"><strong>Local</strong></th>
            </tr>
            </thead>
            <tbody>
            @foreach($agendasDia as $agenda)
                <tr>
                    <td>{{ $agenda->dsPauta }}</td>
                    <td>{{ $agenda->dsAssunto }}</td>
                    <td>{!! date('d/m/Y', strtotime($agenda->dtAgenda)) !!}</td>
                    <td>{!! date('G:i', strtotime($agenda->hrAgenda)) !!}</td>
                    <td>{{ $agenda->dsLocal }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="agendaSemana" style="display: none">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><strong>Pauta</strong></th>
                <th scope="col"><strong>Assunto</strong></th>
                <th scope="col"><strong>Data</strong></th>
                <th scope="col"><strong>Hora</strong></th>
                <th scope="col"><strong>Local</strong></th>
            </tr>
            </thead>
            <tbody>
            @foreach($agendasSemana as $agenda)
                <tr>
                    <td>{{ $agenda->dsPauta }}</td>
                    <td>{{ $agenda->dsAssunto }}</td>
                    <td>{!! date('d/m/Y', strtotime($agenda->dtAgenda)) !!}</td>
                    <td>{!! date('G:i', strtotime($agenda->hrAgenda)) !!}</td>
                    <td>{{ $agenda->dsLocal }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="agendaMes" style="display: none">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><strong>Pauta</strong></th>
                <th scope="col"><strong>Assunto</strong></th>
                <th scope="col"><strong>Data</strong></th>
                <th scope="col"><strong>Hora</strong></th>
                <th scope="col"><strong>Local</strong></th>
            </tr>
            </thead>
            <tbody>
            @foreach($agendasMes as $agenda)
                <tr>
                    <td>{{ $agenda->dsPauta }}</td>
                    <td>{{ $agenda->dsAssunto }}</td>
                    <td>{!! date('d/m/Y', strtotime($agenda->dtAgenda)) !!}</td>
                    <td>{!! date('G:i', strtotime($agenda->hrAgenda)) !!}</td>
                    <td>{{ $agenda->dsLocal }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(function() {
            $(":radio[name='periodoFormRadio'][value='Dia']").attr('checked', 'checked');
        })

        $('#periodoForm').on('change', function () {
            const agendaDia = $("#agendaDia");
            const agendaSemana = $("#agendaSemana");
            const agendaMes = $("#agendaMes");
            const agendaTotal = $("#agendaTotal");
            const downloadDia = $("#downloadDia");
            const downloadSemana = $("#downloadSemana");
            const downloadMes = $("#downloadMes");
            const radio = $('input[name=periodoFormRadio]:checked', '#periodoForm');

            const radioMarcado = radio.val();

            switch (radioMarcado) {
                case 'Dia':
                    agendaTotal.hide();
                    agendaDia.show();
                    agendaSemana.hide();
                    agendaMes.hide();
                    downloadDia.show();
                    downloadSemana.hide();
                    downloadMes.hide();
                    return;
                case 'Semana':
                    agendaTotal.hide();
                    agendaDia.hide();
                    agendaSemana.show();
                    agendaMes.hide();
                    downloadDia.hide();
                    downloadSemana.show();
                    downloadMes.hide();
                    return;
                case 'Mes':
                    agendaTotal.hide();
                    agendaDia.hide();
                    agendaSemana.hide();
                    agendaMes.show();
                    downloadDia.hide();
                    downloadSemana.hide();
                    downloadMes.show();
                    return;
            }
        });
    </script>
@endsection
