@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>agenda</h1>
  @foreach ($selecionado as $age)
  <form action="/agendas/update/{{ $age->cdAgenda}}" method="POST">
  @csrf
   
   @method('PUT')
    <div class="form-group">
      <label for="date">dtAgenda:</label>
      <input type="text" class="form-control" id="dtAgenda" name="dtAgenda" value="{{$age->dtAgenda}}" >
    </div>
    <div class="form-group">
      <label for="title">cdRepresentacao	</label>
      <select id="cdRepresentacao"  name="cdRepresentacao" class="form-control">
    
        <option value="{{$age->cdRepresentacao}}" >
            {{ $age->cdTitular }}
        </option>
    
    </select>
    </div>
    <div class="form-group">
      <label for="title">hrAgenda:</label>
      <input type="text" class="form-control" id="hrAgenda" name="hrAgenda" value="{{$age->hrAgenda}}" >
    </div>
    <div class="form-group">
            <label for="title">Assunto:</label>
            <input type="text" class="form-control" id="dsAssunto" name="dsAssunto">
        </div>
    
    <div class="form-group">
      <label for="title">stAgenda</label>
      <select name="stAgenda" id="stAgenda" class="form-control">
        <option value="{{$age->stAgenda}}">{{$age->stAgenda}}</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">dsLocal:</label>
      <input type="text" class="form-control" id="dsLocal" name="dsLocal" value="{{$age->dsLocal}}" >
    </div>
    <div class="form-group">
      <label for="title">stSuplente</label>
      <select name="stSuplente" id="stSuplente" class="form-control">
        <option value="{{$age->stSuplente}}">{{$age->stSuplente}}</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">dsPauta:</label>
      <input type="textarea" class="form-control" id="dsPauta" name="dsPauta" value="{{$age->dsPauta}}">
    </div>
    <div class="form-group">
      <label for="title">dsResumo:</label>
      <input type="textarea" class="form-control" id="dsResumo" name="dsResumo" value="{{$age->dsResumo}}" >
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Alterar">
  </form>
  @endforeach
</div>



@endsection