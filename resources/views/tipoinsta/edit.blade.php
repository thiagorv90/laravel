@extends('layout.main')

@section('title', 'Editando tipo_instancia')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editar</h1>

  <form action="/tipoinsta/update/{{ $tipoinsta->cdTipoInstancia}}" method="POST">

    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="dsTipoInstancia" name="dsTipoInstancia" value="{{$tipoinsta->dsTipoInstancia}}"></input>
    </div>

    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">

  </form>
</div>





@endsection