@extends('layout.main')

@section('title', 'HDC Events')

@section('content'),

<h1>Empresas:</h1>


<div id="event-create-container" class="col-md-10 offset-md-1">

    <form action="/empresas" method="POST">

        @csrf

        <div class="input-group mb-3">
            <input placeholder="Criar Empresa..." type="text" class="form-control" id="nmEmpresa" name="nmEmpresa" aria-label="Criar Empresa" aria-describedby="button-addon2" required/>
            <input type="submit" class="btn btn-primary" value="Criar Empresa" class="btn btn-outline-secondary" id="button-addon2">

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
            @foreach($empresas as $empresa)

            <tr>
                <td scropt="row">{{$empresa->cdEmpresa}}</td>
                <td><a>{{ $empresa->nmEmpresa }}</a></td>

                <td> <a href="/empresas/edit/{{$empresa->cdEmpresa}}" class="btn btn-info edit-btn">
                        <ion-icon name="create-outline"></ion-icon>
                    </a>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endsection