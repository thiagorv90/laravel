@extends('layout.main')

@section('title', 'Relatório de Tipo de Instâncias')

@section('content')

    <h2>Relatório de Tipo de Instâncias</h2>
    <a href="{{route('expTipoInstancia')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Tipo</strong></th>
            <th scope="col"><strong>Tipo</strong></th>
            <th scope="col"><strong>Instancia</strong></th>
            <th scope="col"><strong>Titular</strong></th>
            <th scope="col"><strong>Status</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>@php echo $instancia->tpFederalDistrital == 1 ? "Federal" : "Distrital" @endphp</td>
                <td>@php echo $instancia->tpPublicoPrivado == 1 ? "Publico" : "Privado" @endphp</td>
                <td>{{ $instancia->nmInstancia }}</td>
                <td>{{ $instancia->nmRepresentanteSuplente }}</td>
                <td>@php echo $instancia->stAtivo == 1 ? "Ativo" : "Desativo" @endphp</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
