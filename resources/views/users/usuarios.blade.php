@extends('layout.main')

@section('title', 'usuarios')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Usuários</h1>
        <form action="{{route('searchusu')}}" method="GET">
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
        <div class="col-md-10 offset-md-1 dashboard-events-container">

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
    </div>
@endsection
