@extends('layout.main')

@section('title', 'usuarios')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Usuários</h1>
        <form action="/usuarios/search" method="GET">
            <div class="input-group mb-3">
                <input placeholder="Buscar Usuário..." type="text" class="form-control" id="query"
                       name="query" aria-label="Buscar Usuário" aria-describedby="button-addon2" required/>
                <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scropt="row">{{$user->name}}</td>
                    <td><a>{{ $user->email }}</a></td>

                    <td>
                        <a href="/usuarios/edit/{{$user->id}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
