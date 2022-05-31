@extends('layout.main')

@section('title', 'Contatos')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Contatos</h1>
  <form action="contatos" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="nmContato" name="nmContato">
    </div>
    <div class="form-group">
      <label for="title">cdInstancia</label>
      <select name="cdInstancia" id="cdInstancia" class="form-control">
        @foreach ($contatos as $contato)
        <option value="{{$contato->cdInstancia}}"> {{$contato->nmInstancia}}</option>

        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="title">dsEmail:</label>
      <input type="text" class="form-control" id="dsEmail" name="dsEmail">
    </div>
    <div class="form-group">
      <label for="title">Ativo?</label>
      <select name="stAtivo" id="stAtivo" class="form-control">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">tpContatoRepresentante</label>
      <select name="tpContatoRepresentante" id="tpContatoRepresentante" class="form-control">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>

    <div class="form-group">
      <label for="title">Email Alternativo:</label>
      <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo">
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">
  </form>
</div>
<br>
<br>
<br>

<form action="{{route('searchco')}}" method="GET">
  <div class="row">
    <div class="col-lg-10">
      <div class="form-group">
        <input type="text" class="form-control" value="" name="query" id="query" placeholder="busca">
        <button class="navbar-search__buttton">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
  </div>
</form>
@foreach ($events as $event)
<table class="table">
  <thead>
    <tr>


      <th scope="col">Nome</th>
      <th scope="col">Opções</th>

    </tr>
  </thead>
  <tbody>

    <tr>



      <td><a>{{ $event->nmContato }}</a></td>

      <td> <a href="/contatos/edit/{{$event->cdContato}}" class="btn btn-info edit-btn">
          <ion-icon name="create-outline"></ion-icon>
        </a>
    </tr>

    @endforeach
  </tbody>
</table>

</div>

@endsection