@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio Por Vigencia do Mandato</h2>
    <a href="{{route('porVigencia')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Instancia</strong></th>
            <th scope="col"><strong>Mandato</strong></th>
            <th scope="col"><strong>Designacao</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmInstancia }}</td>
                <td>{{ $instancia->dsMandato }}</td>
                <td>{{ $instancia->dsDesignacao }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
