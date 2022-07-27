@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio Instancias Por Tema</h2>
    <a href="{{route('porTema')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Tema</strong></th>
            <th scope="col"><strong>Instancia</strong></th>
            <th scope="col"><strong>Titular</strong></th>
            <th scope="col"><strong>Suplente</strong></th>
            <th scope="col"><strong>Caráter</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->tema }}</td>
                <td>{{ $instancia->instancia }}</td>
                <td>{{ $instancia->repTit }}</td>
                <td>{{ $instancia->repSup }}</td>
                <td>
                    @if( $instancia->boCaraterDaInstancia == true)
                        Consultivo
                    @else
                        Deliberativo
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
