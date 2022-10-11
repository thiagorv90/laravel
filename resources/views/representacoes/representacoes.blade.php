@extends('layout.main')

@section('title', 'Representacões')

@section('content')
    <h1>Representações</h1>

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nome da Instancia</th>
                <th scope="col">Data</th>
                <th scope="col">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($representantes as $event)
                <tr>
                    <td scropt="row">{{$event->nmInstancia}}</td>
                    <td><a>{{ $event->dtInicioVigencia }}</a></td>
                    <td>
                        <a href="/agendas/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Agenda">
                            <ion-icon name="book-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
