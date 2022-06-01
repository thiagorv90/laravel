@extends('layout.main')

@section('title', 'Editando Empresas')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editar</h1>

  <form action="/empresas/update/{{ $empresas->cdEmpresa}}" method="POST">

    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="nmEmpresa" name="nmEmpresa" value="{{$empresas->nmEmpresa}}"></input>
    </div>

    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">

  </form>
</div>





@endsection