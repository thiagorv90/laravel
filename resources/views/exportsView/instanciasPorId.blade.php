@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatório de Instâncias Por ID</h2>
    <a href="{{route('porInstancia')}}" class="btn btn-primary"><ion-icon name="arrow-down-outline"></ion-icon></a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Instancia</strong></th>
            <th scope="col"><strong>Titular</strong></th>
            <th scope="col"><strong>Suplente</strong></th>
            <th scope="col"><strong>ClassificacaoPP</strong></th>
            <th scope="col"><strong>ClassificacaoDF</strong></th>
            <th scope="col"><strong>Objetivo</strong></th>
            <th scope="col"><strong>Atribuicao</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmInstancia }}</td>
                <td>{{ $instancia->repTit }}</td>
                <td>{{ $instancia->repSup }}</td>
                <td>
                    @if($instancia->tpPublicoPrivado == true)
                        Publico
                    @else
                        Privado
                    @endif
                </td>
                <td>
                    @if($instancia->tpFederalDistrital == true)
                        Federal
                    @else
                        Distrital
                    @endif
                </td>
                <td>{{ $instancia->dsObjetivo }}</td>
                <td>{{ $instancia->tpAtribuicoes }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
