@extends('layout.main')

@section('title', 'Editando usuarios')

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
        @foreach ($users as $age)
            <form action="/usuarios/update/{{$age->id}}" method="POST">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="date">Nome:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$age->name}}">
                </div>
                <div class="form-group">
                    <label for="title">Perfil: </label>
                    <select id="statusadm" name="statusadm" class="form-select">

                        @if ($age->statusadm == 1)
                            <option value="{{$age->statusadm}}">
                                Administrador
                            </option>
                            <option value="0">Usuario</option>
                        @else ($age->statusadm == 0)
                            <option value="{{$age->statusadm}}">
                                usuario
                            </option>
                            <option value="1">Administrador</option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{$age->email}}">
                </div>


                <br>
                <div class="container d-flex justify-content-between mt-2">
                    <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                    <input type="submit" class="btn btn-primary mb-2" value="Alterar">
                </div>
            </form>
        @endforeach
    </div>

@endsection
