@extends('layout.main')

@section('title', 'Editando Empresas')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Editar</h1>
        <form action="/escolaridade/update/{{ $escolaridade->cdEscolaridade}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="nmEmprdsEscolaridadeesa" name="dsEscolaridade"
                       value="{{$escolaridade->dsEscolaridade}}"></input>
            </div>
            <br><div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Alterar">
</div>
        </form>
    </div>

@endsection
