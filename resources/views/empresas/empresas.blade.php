@extends('layout.main')

@section('title', 'Empresas')

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

    <div class="container my-3 ps-3 welcomediv bg-seconday">
        <h1 class="mt-1">Empresas</h1>
    </div>


    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($empresas as $empresa)
                <tr>
                    <td scropt="row">{{ $empresa->cdEmpresa }}</td>
                    <td><a>{{ $empresa->nmEmpresa }}</a></td>
                    <td>
                        <a href="/empresas/edit/{{ $empresa->cdEmpresa }}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Editar">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        @if (!$empresas->isEmpty())
            <form action="empresas/{{ $empresa->cdEmpresa }}/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="" name="query" id="query"
                           placeholder="Buscar Empresa..." aria-label="Buscar Empresa" aria-describedby="button-addon2"
                           required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>
        @endif
        <br>

        <div class="container my-3 ps-3 welcomediv">
            <h1 class="mt-1">Criar Empresa</h1>
        </div>

        <form action="/empresas" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input placeholder="Criar Empresa..." type="text" class="form-control" id="nmEmpresa" name="nmEmpresa"
                       aria-label="Criar Empresa" aria-describedby="button-addon2" required/>
                <input type="submit" class="btn btn-primary" value="Criar" id="button-addon2">
            </div>
        </form>
    </div>

@endsection
