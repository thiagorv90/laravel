@extends('layout.main')

@section('title', 'Representacões')

@section('content')
<h1>Representações</h1>
<echo>{{$representantes}}</echo>
<div class="col-md-10 offset-md-1 dashboard-events-container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Data</th>
                <th scope="col">Opções</th>
               
            </tr>
        </thead>
        <tbody>
        @foreach ($representantes as $event)
       
                <tr>
                    <td scropt="row">{{$event->nmRepresentanteSuplente}}</td>
                    <td><a >{{ $event->dtInicioVigencia }}</a></td>
                    
                    
                    <td>         <a href="/representacoes/edit/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> </a> 
                    <a href="/agendas/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn"><ion-icon name="book-outline"></ion-icon> </a>           
                   
                    
                </tr>
            @endforeach    
        </tbody>
    </table>
    
</div>




<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Crie sua Representação</h1>
  <form action="representacoes" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">cdInstancia</label>
      <select name="cdInstancia" id="cdInstancia" class="form-control">
      @foreach ( $instancias as  $instancia)
      <option value="{{$instancia->cdInstancia}}" > {{$instancia->nmInstancia}}</option>
   
      @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="title">cdTitular</label>
      <select name="cdTitular" id="cdTitular" class="form-control">
      @foreach ( $representantes as  $representante)
      <option value="{{$representante->cdRepSup}}" > {{$representante->nmRepresentanteSuplente}}</option>
   
      @endforeach
      </select>
      
    </div>
    <div class="form-group">
      <label for="title">cdSuplente</label>
      <select name="cdSuplente" id="cdSuplente" class="form-control">
    
        
      <option value="">Não</option>
        @foreach ($representantes as  $representante)
      <option value="{{$representante->cdRepSup}}" > {{$representante->nmRepresentanteSuplente}}</option>
    
      @endforeach
      </select>
     
    </div>
    <div class="form-group">
      <label for="title">dtInicioVigencia</label>
      <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia" >
    </div>
    <div class="form-group">
      <label for="title">dtFimVigencia</label>
      <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia" >
    </div>
    <div class="form-group">
      <label for="title">dsDesignacao</label>
      <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao" >
    </div>
    <div class="form-group">
      <label for="title">dsNomeacao</label>
      <input type="text" class="form-control" id="dsNomeacao" name="dsNomeacao" >
    </div>
    <div class="form-group">
      <label for="title">stAtivo</label>
      <select name="stAtivo" id="stAtivo" class="form-control">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">
  </form>
</div>
<br>
<br>
<br>




@endsection