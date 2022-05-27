@extends('layout.main')

@section('title', 'Tema Representação')

@section('content')

<h1>Crie Tema</h1>

<div id="event-create-container" class="col-md-10 offset-md-1">
    <form action="temarep" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input placeholder="Criar Tema..." type="text" class="form-control" id="nmTema" name="nmTema" aria-label="Criar Tema" aria-describedby="button-addon2" required />
            <input type="submit" class="btn btn-primary" value="Criar Tema" class="btn btn-outline-secondary" id="button-addon2">
        </div>
    </form>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
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

                <td> <a href="/temarep/edit/{{$event->cdTema}}" class="btn btn-info edit-btn">
                        <ion-icon name="create-outline"></ion-icon>
                    </a>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection