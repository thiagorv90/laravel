@extends('layout.main')

@section('title', 'Tema Representação')

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
            <h1>Temas</h1>
        </div>
        
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tema_representacoe as $event)
                <tr>
                    <td scropt="row">{{$event->cdTema}}</td>
                    <td><a>{{ $event->nmTema }}</a></td>

                    <td><a href="/temarep/edit/{{$event->cdTema}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Editar">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <br>
        @if (!$tema_representacoe->isEmpty())
            <form action="/temarep/{{$event->cdTema}}/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input placeholder="Buscar Tema..." type="text" class="form-control" id="query"
                           name="query"
                           aria-label="Buscar Tema" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>
        @endif
        <br>

        <div class="container my-3 ps-3 welcomediv bg-seconday">
            <h1>Criar tema</h1>
        </div>

        <form action="/temarep" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input placeholder="Criar Tema..." type="text" class="form-control" id="nmTema" name="nmTema"
                       aria-label="Criar Tema" aria-describedby="button-addon2" required/>
                <input type="submit" class="btn btn-primary" value="Criar Tema" id="button-addon2">
            </div>
        </form>
    </div>

@endsection
