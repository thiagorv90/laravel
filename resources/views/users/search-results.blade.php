@extends('layout.main')

@section('title', 'usuarios')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        @if ($users->isEmpty())
            <h1>Não existe usúario com esse nome.</h1>
            <div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>

            </div>
        @else
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
                <div class="container d-flex justify-content-between mt-2">
                    <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>

                </div>

            </div>
        @endif
    </div>
@endsection
