@extends('layout.main')

@section('title', 'Relatório de Reuniões Mensais')

@section('content')
    <h2>Relatório de Reuniões Mensais</h2>
    <a href="{{route('expReunioesMensais')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Instancia</strong></th>
            <th scope="col"><strong>Titular</strong></th>
            <th scope="col"><strong>Pauta</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($reunioes as $reuniao)
            <tr>
                <td>{{ $reuniao->nmInstancia }}</td>
                <td>{{ $reuniao->nmRepresentanteSuplente }}</td>
                <td>{{ $reuniao->dsPauta }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
