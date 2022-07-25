@extends('layout.main')

@section('title', 'HDC Events')

@section('content')

    <h1>Criar Escolaridade</h1>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
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
                    <td><a href="/escolaridade/edit/{{$event->cdEscolaridade}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <br>
    <form action="escolaridade/{{$event->cdEscolaridade}}/search" method="GET">
        @csrf
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <input type="text" class="form-control" value="" name="query" id="query" placeholder="busca">
                    <button class="navbar-search__buttton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <br>
    <h1>Escolaridade</h1>

    <div id="event-create-container" class="col-md-10 offset-md-1">
        <form action="escolaridade" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input placeholder="Criar Escolaridade..." type="text" class="form-control" id="dsEscolaridade"
                       name="dsEscolaridade" aria-label="Criar Escolaridade" aria-describedby="button-addon2" required/>
                <input type="submit" class="btn btn-primary" value="Criar Escolaridade"
                       class="btn btn-outline-secondary" id="button-addon2">
            </div>
        </form>
    </div>

@endsection
