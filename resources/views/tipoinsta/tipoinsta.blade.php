@extends('layout.main')

@section('title', 'Tipo Instancia')

@section('content')
    <style>
        .welcomediv {
            color: white;
            background: rgb(153, 114, 187);
            background: linear-gradient(90deg, rgb(186, 143, 223) 35%, rgba(182, 154, 233, 1) 100%);
            border: 2px solid rgb(255, 255, 255);
            box-shadow: #ebe9e9 1px 1px 4px 3px;
            font-family: 'Montserrat', sans-serif;
            transition: all 1.5s;
            padding: 3px;
        }
    </style>
    <div class="container">
        <div class="container my-3 ps-3 welcomediv bg-seconday">
            <h1>Tipos de Instancias</h1>
        </div>
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
                    <td><a href="/tipoinsta/edit/{{$event->cdTipoInstancia}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Editar">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

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

        <div class="container my-3 ps-3 welcomediv bg-seconday">
            <h1>Criar tipo de instancia</h1>
        </div>

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
