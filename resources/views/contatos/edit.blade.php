@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">

    @foreach ($selecionado as $con)
  <form action="/contatos/update/{{ $con->cdContato}}" method="POST">
     @csrf
   
    @method('PUT')
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="nmContato" name="nmContato" value="{{$con->nmContato}}"></input>
    </div>
    <div class="form-group">
    <label for="title">Instancia:</label>
    <select id="cdInstancia"  name="cdInstancia" class="form-control">
    @foreach($lista as $i)
        <option value="{{$i->cdInstancia}}"  @if ($con->cdInstancia == $i->cdInstancia) selected @endif >
            {{ $i->nmInstancia }}
        </option>
    @endforeach
    </select>
</div>
    <div class="form-group">
      <label for="title">Email:</label>
      <input type="text" class="form-control" id="dsEmail" name="dsEmail" value="{{$con->dsEmail}}"></input>
    </div>
    
   
    <div class="form-group">
      <label for="title">Está Ativo?:</label>
      <input type="text" class="form-control" id="stAtivo" name="stAtivo" value="{{$con->stAtivo}}"></input>
    </div>
    <div class="form-group">
      <label for="title">tpContatoRepresentante:</label>
      <input type="text" class="form-control" id="tpContatoRepresentante" name="tpContatoRepresentante" value="{{$con->tpContatoRepresentante}}"></input>
    </div>
    <div class="form-group">
      <label for="title">dsEmailAlternativo:</label>
      <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo" value="{{$con->dsEmailAlternativo}}"></input>
    </div>


    <br>
    <input type="submit" class="btn btn-primary" value="Alterar">
</form>
@endforeach
 
</div>





@endsection