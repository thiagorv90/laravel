@extends('layout.main')

@section('title', 'Escolaridade')

@section('content')


    <div class="container">
        <h1>Criar Escolaridade</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($escolaridade as $event)
                <tr>
                    <td scropt="row">{{$event->cdEscolaridade}}</td>
                    <td><a>{{ $event->dsEscolaridade }}</a></td>
                    <td><a href="/escolaridade/edit/{{$event->cdEscolaridade}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Editar">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <br>
        @if (!$escolaridade->isEmpty())
            <form action="escolaridade/{{$event->cdEscolaridade}}/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="" name="query" id="query"
                           placeholder="Buscar Escolaridade..."
                           aria-label="Buscar Escolaridade" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>
        @endif
        <br>
        <h1>Escolaridade</h1>

        <form action="/escolaridade" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input placeholder="Criar Escolaridade..." type="text" class="form-control" id="dsEscolaridade"
                       name="dsEscolaridade" aria-label="Criar Escolaridade" aria-describedby="button-addon2"
                       required/>
                <input type="submit" class="btn btn-primary" value="Criar" id="button-addon2">
            </div>
        </form>
    </div>

@endsection
