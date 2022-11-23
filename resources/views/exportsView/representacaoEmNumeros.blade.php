@extends('layout.main')

@section('title', 'Relatório de Representacoes Em Número')

@section('content')

    <h2>Relatório de Representacao em Numeros</h2>
    <a href="{{route('expRepNum')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Temas</strong></th>
            <th scope="col"><strong>totInstancias</strong></th>
            <th scope="col"><strong>totRepresentacoes</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($representacoes as $representacao)
            <tr>
                <td>{{ $representacao->nmTema }}</td>
                <td>{{ $representacao->inst_count }}</td>
                <td>{{ $representacao->rep_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
