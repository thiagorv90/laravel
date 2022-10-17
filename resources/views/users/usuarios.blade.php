@extends('layout.main')

@section('title', 'usuarios')

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

    <div id="event-create-container" class="container">
        <div class="container my-3 ps-3 welcomediv bg-seconday">
            <h1>Usuarios</h1>
        </div>
        <form action="/usuarios/search" method="GET">
            <div class="input-group mb-3">
                <input placeholder="Buscar Usuário..." type="text" class="form-control" id="query" name="query"
                    aria-label="Buscar Usuário" aria-describedby="button-addon2" required />
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
                        <td scropt="row">{{ $user->name }}</td>
                        <td><a>{{ $user->email }}</a></td>
                        <td class="d-flex justify-content-between">
                            <div class="d-flex ">                  
                                <a href="/usuarios/edit/{{ $user->id }}" class="btn btn-info edit-btn ms-1"
                                    data-bs-toggle="tooltip" data-bs-title="Editar">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                                <form action="/usuarios/edit/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn ms-1" data-bs-toggle="tooltip"
                                     data-bs-title="Deletar">
                                     <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
