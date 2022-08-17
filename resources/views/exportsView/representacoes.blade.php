@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio de Representantes</h2>
    <a href="{{route('porRepresentante')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Nome</strong></th>
            <th scope="col"><strong>Instancias</strong></th>
            <th scope="col"><strong>Data Nomeacao</strong></th>
            <th scope="col"><strong>Vigencia</strong></th>
            <th scope="col"><strong>Mandato</strong></th>
            <th scope="col"><strong>Designacao</strong></th>
            <th scope="col"><strong>Nomeacao</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($representacoes as $representacao)
            <tr>
                <td>{{ $representacao->nmRepresentanteSuplente }}</td>
                <td>{{ $representacao->nmInstancia }}</td>
                <td>{{ $representacao->dtNomeacao }}</td>
                <td>{{ $representacao->dtInicioVigencia }} - {{ $representacao->dtFimVigencia }}</td>
                <td>{{ $representacao->dsMandato }}</td>
                <td>{{ $representacao->dsDesignacao }}</td>
                <td>{{ $representacao->dsNomeacao}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
