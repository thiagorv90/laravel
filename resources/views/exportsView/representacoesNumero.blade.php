@extends('layout.main')

@section('title', 'Relatório de Representacao em Numeros')

@section('content')
    <h2>Relatório de Representacao em Numeros</h2>
    <a href="{{route('repEmNumeros')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Tema</strong></th>
            <th scope="col"><strong>totInstancias</strong></th>
            <th scope="col">{{ $instancias->count() }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmTema }}</td>
                <td>{{ $instancia->nmInstancia }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
