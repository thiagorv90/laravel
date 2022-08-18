@extends('layout.main')

@section('title', 'Editando tema')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Editar</h1>

        <form action="/temarep/update/{{ $temarep->cdTema}}" method="POST">

            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="nmTema" name="nmTema" value="{{$temarep->nmTema}}"></input>
            </div>

            <br>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/temarep" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Alterar">
            </div>
        </form>
    </div>

@endsection
