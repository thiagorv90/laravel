@extends('layout.main')

@section('title', 'Instancias Por Data')

    @section('content')
        <h2>Relatorio Instancias Por Data</h2>
        <a href="{{route('porData')}}" class="btn btn-primary"><ion-icon name="arrow-down-outline"></ion-icon></a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><strong>Instancia</strong></th>
                <th scope="col"><strong>Data</strong></th>
                <th scope="col"><strong>Local</strong></th>
                <th scope="col"><strong>Horario</strong></th>
                <th scope="col"><strong>Pauta</strong></th>
                <th scope="col"><strong>Representante</strong></th>
            </tr>
            </thead>
            <tbody>
            @foreach($instancias as $instancia)
                <tr>
                    <td>{{ $instancia->nmInstancia }}</td>
                    <td>{{ $instancia->dtAgenda }}</td>
                    <td>{{ $instancia->dsLocal }}</td>
                    <td>{{ \Illuminate\Support\Str::of($instancia->hrAgenda)->limit(5, '') }}</td>
                    <td>{{ $instancia->dsPauta }}</td>
                    <td>{{ $instancia->nmRepresentanteSuplente }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endsection
