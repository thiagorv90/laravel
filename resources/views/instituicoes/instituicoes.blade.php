@extends('layout.main')

@section('title', 'Instituições')

@section('content')

    <style>
        a {
            text-decoration: none;
            color: #6f42c1;
        }

        a:hover {
            color: #452680;
        }
        .welcomediv{
            color: white;
            background: rgb(156,104,203);
            background: linear-gradient(90deg, rgba(156,104,203,1) 35%, rgba(182,154,233,1) 100%);
            border: 2px solid rgb(255, 255, 255);
            box-shadow: #cccccc 1px 1px 4px 3px; 
            font-family: 'Montserrat', sans-serif;
            transition: all 1.5s;
        }
    </style>
    
    <div class="container">

        <div class="container mt-3 mb-3 welcomediv">
            <h1 class="mt-1">Instituições</h1>
        </div>
        
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Tipo</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($events as $event)
                <tr>
                    <td scropt="row">{{$event->nmInstituicao}}</td>
                    <td><a>{{ $event->dsTipoInstancia }}</a></td>
                    <td><a href="/instituicoes/edit/{{$event->cdInstituicao}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Editar">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                        <a href="/instancias/{{$event->cdInstituicao}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Instâncias">
                            <ion-icon name="clipboard-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{$events->links()}}

        <br>
        @if (!$events->isEmpty())
            <form action="/instituicoes/{{$event->cdInstituicao}}/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="" name="query" id="query"
                           placeholder="Buscar Instituição..."
                           aria-label="Buscar Instituição" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>

            <form action="/instituicoes/searchinsta" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="" name="query" id="query"
                           placeholder="Buscar Instancia..."
                           aria-label="Buscar Instancia" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>
        @endif
        <br>

        <div class="container mt-3 mb-3 welcomediv">
            <h1 class="mt-1">Criar Instituição</h1>
        </div>

        <form action="/instituicoes" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Tipo:</label>
                <select name="cdTipoInstituicao" id="cdTipoInstituicao" class="form-select">
                    @foreach ($instituicoes as $instituicoe)
                        <option value="{{$instituicoe->cdTipoInstancia}}"> {{$instituicoe->dsTipoInstancia}}</option>

                    @endforeach
                </select>
            </div>
            <div id="form-instituicao" class="form-group">
                <label for="title">Nome:</label>
                <div class="input-group mb-3">
                    <input placeholder="Nome Instituição..." type="text" class="form-control" id="nmInstituicao"
                           name="nmInstituicao" aria-label="Nome Instituicao" aria-describedby="button-addon2"
                           required/>
                    <input type="submit" class="btn btn-primary" value="Criar" id="button-addon2">
                </div>
            </div>
        </form>
    </div>

@endsection
