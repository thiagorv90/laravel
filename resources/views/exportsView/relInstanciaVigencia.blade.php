@extends('layout.main')

@section('title', 'Relatório de Instancias por Vigência')

@section('content')

    <h2>Relatório de Instancias por Vigência</h2>
    <a href="{{route('expInsta')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Instituição</strong></th>
            <th scope="col"><strong>Instância</strong></th>
            <th scope="col"><strong>Titular</strong></th>
            <th scope="col"><strong>Designação</strong></th>
            <th scope="col"><strong>Nomeação</strong></th>
            <th scope="col"><strong>Início</strong></th>
            <th scope="col"><strong>Fim</strong></th>
            <th scope="col"><strong>Status</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmInstituicao }}</td>
                <td>{{ $instancia->nmInstancia }}</td>
                <td>{{ $instancia->nmRepresentanteSuplente }}</td>
                <td>@php echo $instancia->dsDesiginacao != null ?  $instancia->dsDesiginacao : "--" @endphp</td>
                <td>@php echo $instancia->dsNomeacao != null ? $instancia->dsNomeacao : "--" @endphp</td>
                <td>{!! date('d/m/Y', strtotime($instancia->dtInicioVigencia ))!!}</td>
                <td>{!! date('d/m/Y', strtotime($instancia->dtFimVigencia ))!!}</td>
                <td>@php echo $instancia->stAtivo == 1 ? "Ativo" : "Desativo" @endphp</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
