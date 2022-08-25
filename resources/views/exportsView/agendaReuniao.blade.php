@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio de Reuniões</h2>

    <a href="{{route('exortAgendaReuniao')}}" class="btn btn-primary mb-2"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="radioDia" id="radioDia" checked>
        <label class="form-check-label" for="flexRadioDefault1">
            Dia
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="radioSemana" id="radioSemana">
        <label class="form-check-label" for="flexRadioDefault2">
            Semana
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="radioMensal" id="radioMensal">
        <label class="form-check-label" for="flexRadioDefault2">
            Mensal
        </label>
    </div>

    <div id="agendaTotal">
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
            @foreach($agendas as $agenda)
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

    <div id="agendaSemana">
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

    <div id="agendaMes">
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

    <script>
        $("#radioDia").on

    </script>
@endsection
