@extends('layout.main')

@section('title', 'Relatório de Representantes')

@section('content')
    <h2>Relatório de Representantes</h2>
    <a href="{{route('expRepresentantes')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Representante</strong></th>
            <th scope="col"><strong>Instância</strong></th>
            <th scope="col"><strong>Designação</strong></th>
            <th scope="col"><strong>Nomeação</strong></th>
            <th scope="col"><strong>Início</strong></th>
            <th scope="col"><strong>Fim</strong></th>
            <th scope="col"><strong>Status</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($representacoes as $representacao)
            <tr>
                <td>{{ $representacao->nmRepresentanteSuplente }}</td>
                <td>{{ $representacao->nmInstancia }}</td>
                <td>@php echo $representacao->dsDesiginacao != null ?  $representacao->dsDesiginacao : "--" @endphp</td>
                <td>@php echo $representacao->dsNomeacao != null ? $representacao->dsNomeacao : "--" @endphp</td>
                <td>{!! date('d/m/Y', strtotime($representacao->dtInicioVigencia ))!!}</td>
                <td>{!! date('d/m/Y', strtotime($representacao->dtFimVigencia ))!!}</td>
                <td>@php echo $representacao->stAtivo == 1 ? "Ativo" : "Desativo" @endphp</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
