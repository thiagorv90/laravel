@extends('layout.main')

@section('title', 'Editando tipo_instancia')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Editar</h1>

        <form action="/tipoinsta/update/{{ $tipoinsta->cdTipoInstancia}}" method="POST">

            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="dsTipoInstancia" name="dsTipoInstancia"
                       value="{{$tipoinsta->dsTipoInstancia}}"></input>
            </div>

            <br>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/tipoinsta" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Salvar">
            </div>

        </form>
    </div>

@endsection
