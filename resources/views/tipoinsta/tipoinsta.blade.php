@extends('layout.main')

@section('title', 'Tipo Instancia')

@section('content')
    <div class="container">
        <h1>Tipos de Instancias</h1>
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
                    <td><a href="/tipoinsta/edit/{{$event->cdTipoInstancia}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                </tr>
            @endforeach
            </tbody>
        </table>

        <br>
        @if (!$tipo_instancia->isEmpty())
            <form action="/tipoinsta/{{$event->cdTipoInstancia}}/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input placeholder="Buscar Tipo..." type="text" class="form-control" id="query"
                           name="query" aria-label="Buscar Tipo" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>
        @endif
        <br>

        <h1>Crie Tipo das instancias</h1>

        <form action="/tipoinsta" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input placeholder="Criar Tipo..." type="text" class="form-control" id="dsTipoInstancia"
                       name="dsTipoInstancia" required/>
                <input type="submit" class="btn btn-primary" value="Criar">

            </div>
        </form>
    </div>

@endsection
