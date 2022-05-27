@extends('layout.main')

@section('title', 'Editando usuarios')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Usuarios</h1>
  @foreach ($users as $age)
  <form action="/usuarios/update/{{$age->id}}" method="POST">
  @csrf
   
   @method('PUT')
    <div class="form-group">
      <label for="date">Nome:</label>
      <input type="text" class="form-control" id="name" name="name" value="{{$age->name}}" >
    </div>
    <div class="form-group">
      <label for="title">Perfil	</label>
      <select id="statusadm"  name="statusadm" class="form-control">
  
     @if  ($age->statusadm == 1)
    <option value="{{$age->statusadm}}"  >
            Administrador
        </option>
        <option value="0">Usuario</option>
     @else  ($age->statusadm == 0)
    <option value="{{$age->statusadm}}"  >
            usuario
        </option>
        <option value="1">Administrador</option>)  
    @endif
    </select>
    </div>
   
    <div class="form-group">
      <label for="title">Email:</label>
      <input type="text" class="form-control" id="email" name="email" value="{{$age->email}}" >
    </div>
    
    
    <br>
    <input type="submit" class="btn btn-primary" value="Alterar">
  </form>
  @endforeach
</div>



@endsection