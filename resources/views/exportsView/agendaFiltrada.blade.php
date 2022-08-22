@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')


    <h1>Relatorio de Agendas</h1>
    <form action="{{route('porFiltroAgendas')}}" method="GET">

<div class="input-group mb-2 inicio" style="display:none">
    <label for="dataInicio" class="input-group-text">Inicio da Vigência: </label>
    <input type="date" class="form-control" name="dataInicio" id="inicio-vigencia" value={{$dataInicio}}>
</div>

<div class="input-group mb-2"style="display:none">
    <label for="dataFim" class="input-group-text">Data Final</label>
    <input type="date" class="form-control" name="dataFim" id="fim-vigencia"  value={{$dataFim}}>
</div>

<button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                            data-bs-title="Deletar">
                                        <ion-icon name="arrow-down-outline"></ion-icon>
                                    </button>

</form>
    <form action="{{route('filtradoAgenda')}}" method="GET">

<div class="input-group mb-2 inicio">
    <label for="dataInicio" class="input-group-text">Inicio da Vigência: </label>
    <input type="date" class="form-control" name="dataInicio" id="inicio-vigencia">
</div>

<div class="input-group mb-2">
    <label for="dataFim" class="input-group-text">Data Final</label>
    <input type="date" class="form-control" name="dataFim" id="fim-vigencia">
</div>


<input type="submit" class="btn btn-primary" value="Filtrar" id="butao-filtrar">
</form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Nome da Instituição</strong></th>
            <th scope="col"><strong>Representante</strong></th>
            <th scope="col"><strong>Data da Agenda</strong></th>
            <th scope="col"><strong>Hora da Agenda</strong></th>
            <th scope="col"><strong>Assunto da Agenda</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($agendas as $agenda)
            <tr>
                <td>{{ $agenda->nmInstituicao }}</td>
                <td>{{ $agenda->nmRepresentanteSuplente }}</td>
                <td scope="col">{!! date('d/m/Y', strtotime($agenda->dtAgenda)) !!}</td>
                    <td scope="col">{!! date('G:i', strtotime($agenda->hrAgenda)) !!}</td>
                <td>{{ $agenda->dsAssunto }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
