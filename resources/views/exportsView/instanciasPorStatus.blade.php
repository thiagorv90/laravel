@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio por Status</h2>

    <a href="{{route('porStatus')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">

        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Instancia</strong></th>
            <th scope="col"><strong>Ativo/Inativo</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmInstancia }}</td>
                <td>
                    @if($instancia->stAtivo == true)
                        Ativo
                    @else
                        Inativo
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
