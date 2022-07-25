@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio de Instancias Por Prioridade</h2>
    <a href="{{route('porData')}}" class="btn btn-primary">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th><strong>Instancia</strong></th>
            <th><strong>Prioridade</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmInstancia }}</td>
                <td>{{ $instancia->tpPrioridade }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
