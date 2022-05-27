@extends('layout.main')

@section('title', 'Contatos Instancia')

@section('content')

@if (is_countable($selecionado) && count($selecionado) == 0) 
@foreach ($contatos as $contato)
<h3>Não ha contato para esta instancia:{{$contato->nmInstancia}}</h3>

<h1> Criar Contatos para a Instancia </h1>
<div id="event-create-container" class="col-md-6 offset-md-3">

  <form action="listacontatos/" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="nmContato" name="nmContato" >
    </div>
    <div class="form-group">
      <label for="title">cdInstancia</label>
      <select name="cdInstancia" id="cdInstancia" class="form-select">
     
      <option value="{{$contato->cdInstancia}}" > {{$contato->nmInstancia}}</option>
   
     
      </select>
    </div>
    <div class="form-group">
      <label for="title">dsEmail:</label>
      <input type="text" class="form-control" id="dsEmail" name="dsEmail" >
    </div>
    <div class="form-group">
      <label for="title">Ativo?</label>
      <select name="stAtivo" id="stAtivo" class="form-select">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">tpContatoRepresentante</label>
      <select name="tpContatoRepresentante" id="tpContatoRepresentante" class="form-select">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="title">Email Alternativo:</label>
      <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo" >
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">
  </form>
</div>
@endforeach
@else


<h1>Contatos da Instancia:</h1>

<form action="{{route('searchco')}}" method="GET" >
     <div class="row">
         <div class="col-lg-10">
             <div class="form-group">
             <input type="text" class="form-control" value="" name="query" id="query" placeholder="busca">
             <button class="navbar-search__buttton">
                 <i class="fa fa-search"></i>
</button>
</div></div></div></form>

    <table class="table">
    
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Opções</th>
             </tr>
        </thead>
        <tbody>
        @foreach ($selecionado as $event)
                <tr>
                      <td><a >{{ $event->nmContato }}</a></td>
                      <td>         <a href="/contatos/edit/{{$event->cdContato}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon></a>   
                                <a href="/telcon/{{$event->cdContato}}" class="btn btn-info edit-btn"><ion-icon name="call-outline"></ion-icon></a></td>
                </tr>
                @endforeach
         </tbody>
    </table>
    
<br>
<br>
<br>
<h1> Criar Contatos da Instância:{{$event->nmInstancia}}</h1>
<div id="event-create-container" class="col-md-6 offset-md-3">

  <form action="listacontatos/" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="nmContato" name="nmContato" >
    </div>
    <div class="form-group">
      <label for="title">cdInstancia</label>
      <select name="cdInstancia" id="cdInstancia" class="form-select">
      @foreach ($contatos as $contato)
      <option value="{{$contato->cdInstancia}}" > {{$contato->nmInstancia}}</option>
   
      @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="title">dsEmail:</label>
      <input type="text" class="form-control" id="dsEmail" name="dsEmail" >
    </div>
    <div class="form-group">
      <label for="title">Ativo?</label>
      <select name="stAtivo" id="stAtivo" class="form-select">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">tpContatoRepresentante</label>
      <select name="tpContatoRepresentante" id="tpContatoRepresentante" class="form-select">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="title">Email Alternativo:</label>
      <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo" >
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">
  </form>
</div>



@endif
@endsection