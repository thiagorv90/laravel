@extends('layout.main')

@section('title', 'Representacões')

@section('content')
    <h1>Representações</h1>
    
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Data</th>
                <th scope="col">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($representantes as $event)
                <tr>
                    <td scropt="row">{{$event->nmRepresentanteSuplente}}</td>
                    <td><a>{{ $event->dtInicioVigencia }}</a></td>
                    <td><a href="/representacoes/edit/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                        <a href="/agendas/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn">
                            <ion-icon name="book-outline"></ion-icon>
                        </a>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

   

@endsection
