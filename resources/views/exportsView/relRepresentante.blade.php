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
            <th scope="col"><strong>Data De Nascimento</strong></th>
            <th scope="col"><strong>Escolaridade</strong></th>
            <th scope="col"><strong>Endereço</strong></th>
            <th scope="col"><strong>Telefone</strong></th>
            <th scope="col"><strong>E-mail</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($representantes as $representante)
            <tr>
                <td>{{ $representante->nmRepresentanteSuplente }}</td>
                <td>{!! date('d/m/Y', strtotime($representante->dtNascimento ))!!}</td>
                <td>{{ $representante->dsEscolaridade }}</td>
                <td>{{ $representante->dsEndereco }}</td>
                <td>({{ $representante->nuDDDTelefone }}) {{ $representante->nuTelefone }}</td>
                <td>{{ $representante->dsEmail }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
