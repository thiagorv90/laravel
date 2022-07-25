@extends('layout.main')

@section('title', 'Tipo Instancia')

@section('content')
    <h1>Tipos de Instancias</h1>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tipo_instancia as $event)
                <tr>
                    <td><a>{{ $event->dsTipoInstancia }}</a></td>
                    <td><a href="/agendas/edit/{{$event->cdAgenda}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <br>
    <form action="/tipoinsta/{{$event->cdTipoInstancia}}/search" method="GET">
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

    <h1>Crie Tipo das instancias</h1>

    <div id="event-create-container" class="col-md-10 offset-md-1">
        <form action="tipoinsta" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input placeholder="Criar Tipo_instancia..." type="text" class="form-control" id="dsTipoInstancia"
                       name="dsTipoInstancia" required/>
                <input type="submit" class="btn btn-primary" value="Criar Tipo_instancia">

            </div>
        </form>
    </div>

@endsection
