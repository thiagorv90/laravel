@extends('layout.main')

@section('title', 'Relatório de Aniversários')

@section('content')
    <h2>Relatório de Aniversários</h2>
    <a href="{{route('expRepresentantes')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Representante</strong></th>
            <th scope="col"><strong>Aniversário</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($representantes as $representante)
            <tr>
                <td>{{ $representante->nmRepresentanteSuplente }}</td>
                <td>{!! date('d/m', strtotime($representante->dtNascimento ))!!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
