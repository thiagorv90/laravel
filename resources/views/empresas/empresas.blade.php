@extends('layout.main')

@section('title', 'HDC Events')

@section('content')

    <h1>Empresas:</h1>

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach($empresas as $empresa)
                <tr>
                    <td scropt="row">{{$empresa->cdEmpresa}}</td>
                    <td><a>{{ $empresa->nmEmpresa }}</a></td>
                    <td>
                        <a href="/empresas/edit/{{$empresa->cdEmpresa}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        @if (!$empresas->isEmpty())
            <form action="empresas/{{$empresa->cdEmpresa}}/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="" name="query" id="query"
                           placeholder="Buscar Empresa..."
                           aria-label="Buscar Empresa" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>
        @endif
        <br>

        <h1>Criar Empresas:</h1>
            <form action="/empresas" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input placeholder="Criar Empresa..." type="text" class="form-control" id="nmEmpresa"
                           name="nmEmpresa"
                           aria-label="Criar Empresa" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Criar Empresa" id="button-addon2">
                </div>
            </form>
    </div>

@endsection
