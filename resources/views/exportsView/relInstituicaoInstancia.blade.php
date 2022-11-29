@extends('layout.main')

@section('title', 'Relatório de Instituições')

@section('content')

    <h2>Relatório de Instituições</h2>
    <a href="{{route('expInstituicao')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Instituição</strong></th>
            <th scope="col"><strong>Instância</strong></th>
            <th scope="col"><strong>Titular</strong></th>
            <th scope="col"><strong>Status</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmInstituicao }}</td>
                <td>{{ $instancia->nmInstancia }}</td>
                <td>{{ $instancia->nmRepresentanteSuplente }}</td>
                <td>@php echo $instancia->stAtivo == 1 ? "Ativo" : "Desativo" @endphp</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
