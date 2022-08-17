@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio de Instancias Por Prioridade</h2>
    <a href="{{route('porPrioridade')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
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
                <td>
                    @if($instancia->tpPrioridade == 1) Baixa
                    @elseif($instancia->tpPrioridade == 2) Media
                    @else Alta
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
