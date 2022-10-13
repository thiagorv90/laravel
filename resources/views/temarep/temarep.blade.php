@extends('layout.main')

@section('title', 'Tema Representação')

@section('content')

    <div class="container">
        <h1>Temas</h1>
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

        <h1>Criar Tema</h1>

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
