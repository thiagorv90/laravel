@extends('layout.main')

@section('title', 'Editando Empresas')

@section('content')

    <style>
        .welcomediv {
            color: white;
            background: rgb(153, 114, 187);
            background: linear-gradient(90deg, rgb(179, 130, 223) 35%, rgba(182, 154, 233, 1) 100%);
            border: 2px solid rgb(255, 255, 255);
            box-shadow: #ebe9e9 1px 1px 4px 3px;
            font-family: 'Montserrat', sans-serif;
            transition: all 1.5s;
            padding: 3px;
        }
    </style>

    <div id="event-create-container" class="container">

        <div class="container my-3 ps-3 welcomediv">
            <h1 class="mt-1">Empresa</h1>
        </div>

        <form action="/empresas/update/{{ $empresas->cdEmpresa}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="nmEmpresa" name="nmEmpresa"
                       value="{{$empresas->nmEmpresa}}"></input>
            </div>
            <br>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/empresas" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Salvar">
            </div>
        </form>
    </div>
@endsection
