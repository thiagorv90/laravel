@extends('layout.main')

@section('title', 'Editando Empresas')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Editar</h1>
        <form action="/escolaridade/update/{{ $escolaridade->cdEscolaridade}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="nmEmprdsEscolaridadeesa" name="dsEscolaridade"
                       value="{{$escolaridade->dsEscolaridade}}"></input>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" value="Criar Evento">
        </form>
    </div>

@endsection
