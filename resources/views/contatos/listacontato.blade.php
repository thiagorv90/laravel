@extends('layout.main')

@section('title', 'Contatos Instancia')

@section('content')

@if (isset($selecionado) && $selecionado->count() > 0) 

@foreach ($nome as $name)
<h1>Contatos da Instancia:{{$name->nmInstancia}}</h1>
@endforeach

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
  
    
    <form action="/contatos/{{$name->cdInstancia}}/search" method="GET" >
    @csrf
    <div class="row">
         <div class="col-lg-10">
             <div class="form-group">
             <input type="text" class="form-control" value="" name="query" id="query" placeholder="busca">
             <button class="navbar-search__buttton">
                 <i class="fa fa-search"></i>
</button>
</div></div></div></form>
<br>
<br>
<br>
<h1> Criar Contatos da Instância:{{$name->nmInstancia}}</h1>
<div id="event-create-container" class="col-md-6 offset-md-3">

  <form action="listacontatos/" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="nmContato" name="nmContato">
    </div>
    <div class="form-group">
      <label for="title">cdInstancia</label>
      <select name="cdInstancia" id="cdInstancia" class="form-select">


      <option value="{{$name->cdInstancia}}" > {{$name->nmInstancia}}</option>
   
  
      </select>
    </div>
    
    <div class="form-group">
      <label for="title">dsEmail:</label>
      <input type="text" class="form-control" id="dsEmail" name="dsEmail">
    </div>
    <div class="form-group">
      <label for="title">Ativo?</label>
      <div class="form-check">
  <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1" checked>
  <label class="form-check-label" for="stAtivo">
    Ativo
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo"  value="0" >
  <label class="form-check-label" for="stAtivo">
    Desativado
  </label>
</div>
    
    <div class="form-group">

      <label for="title">Contato Representante</label>
      <div class="form-check">
  <input class="form-check-input" type="radio" name="tpContatoRepresentante" id="tpContatoRepresentante" value="1" checked >
  <label class="form-check-label" for="tpContatoRepresentante">
    Sim
  </label>
</div>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="tpContatoRepresentante" id="tpContatoRepresentante"  value="0"  >
  <label class="form-check-label" for="tpContatoRepresentante">
    Não
  </label>
</div>
</div>

    <div class="form-group">
      <label for="title">Email Alternativo:</label>
      <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo">
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">
  </form>
</div>


@else
@foreach ($nome as $contato)
<h3>Não ha contato para esta instancia:{{$contato->nmInstancia}}</h3>

<h1> Criar Contatos para a Instancia {{$contato->nmInstancia}}</h1>
<div id="event-create-container" class="col-md-6 offset-md-3">

  <form action="listacontatos/" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="nmContato" name="nmContato">
    </div>
    <div class="form-group">
      <label for="title">cdInstancia</label>
      <select name="cdInstancia" id="cdInstancia" class="form-select">

     
      <option value="{{$contato->cdInstancia}}" > {{$contato->nmInstancia}}</option>
   
     
      </select>
    </div>
    <div class="form-group">
      <label for="title">dsEmail:</label>
      <input type="text" class="form-control" id="dsEmail" name="dsEmail">
    </div>
    <div class="form-group">
      <label for="title">Ativo?</label>
      <div class="form-check">
  <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1" checked>
  <label class="form-check-label" for="stAtivo">
    Ativo
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo"  value="0" >
  <label class="form-check-label" for="stAtivo">
    Desativado
  </label>
</div>
    
    <div class="form-group">

      <label for="title">Contato Representante</label>
      <div class="form-check">
  <input class="form-check-input" type="radio" name="tpContatoRepresentante" id="tpContatoRepresentante" value="1" checked >
  <label class="form-check-label" for="tpContatoRepresentante">
    Sim
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="tpContatoRepresentante" id="tpContatoRepresentante"  value="0"  >
  <label class="form-check-label" for="tpContatoRepresentante">
    Não
  </label>
</div>
    

    <div class="form-group">
      <label for="title">Email Alternativo:</label>
      <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo">
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">
  </form>
</div>
@endforeach
@endif
@endsection