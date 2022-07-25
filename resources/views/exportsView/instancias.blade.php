@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h1>Relatorio de Instâncias</h1>
    <a href="{{route('porInstancia')}}" class="btn btn-primary">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Nome</strong></th>
            <th scope="col"><strong>Tema</strong></th>
            <th scope="col"><strong>Representantes</strong></th>
            <th scope="col"><strong>E-mail</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmInstancia }}</td>
                <td>{{ $instancia->nmTema }}</td>
                <td>{{ $instancia->nmRepresentanteSuplente }}</td>
                <td>{{ $instancia->dsEmail }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
