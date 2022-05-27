@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')
<echo>{{$selecionado}}</echo>

<div id="event-create-container" class="col-md-6 offset-md-3">

    @foreach ($selecionado as $tel)
  <form action="/telcon/update/{{ $tel->cdTelefone}}" method="POST">
  @csrf
   
    @method('PUT')
    <div class="form-group">
      <label for="title">Numero:</label>
      <input type="text" class="form-control" id="nuTelefone" name="nuTelefone" value="{{$tel->nuTelefone}}"></input>
    </div>

    <div class="form-group">
      <label for="title">DDD</label>
      <input type="text" class="form-control" id="nuDDDTelefone" name="nuDDDTelefone" value="{{$tel->nuDDDTelefone}}"></input>
    </div>
    <label for="title">Nome:</label>
    <select id="cdContatoTelefone"  name="cdContatoTelefone" class="form-control">
    @foreach($selecionado as $i)
        <option value="{{$i->cdContato}}"> {{ $i->nmContato }}
        </option>
    @endforeach
</select>
    <br>
    <input type="submit" class="btn btn-primary" value="Alterar Telefone" >
  
</form>
@endforeach
 
</div>





@endsection