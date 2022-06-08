@extends('layout.main')

@section('title', 'Criar Representação')

@section('content')

<echo>{{$selecionado}}</echo>
@if (is_countable($selecionado) && count($selecionado) == 0)
@foreach ( $instancias as $instancia)
<h3>Não ha representações para esta instancia:{{$instancia->nmInstancia}}</h3>

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Crie sua Representação</h1>
  <form action="repinsta" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">cdInstancia</label>
      <select name="cdInstancia" id="cdInstancia" class="form-control">

        <option value="{{$instancia->cdInstancia}}"> {{$instancia->nmInstancia}}</option>

        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="title">cdTitular</label>
      <select name="cdTitular" id="cdTitular" class="form-control">
        @foreach ( $representantes as $representante)
        <option value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

        @endforeach
      </select>

    </div>
    <div class="form-group">
      <label for="title">cdSuplente</label>
      <select name="cdSuplente" id="cdSuplente" class="form-control">

        <option value="">Não</option>
        @foreach ($representantes as $representante)
        <option value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

        @endforeach
      </select>

    </div>
    <div class="form-group">
      <label for="title">dtInicioVigencia</label>
      <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia">
    </div>
    <div class="form-group">
      <label for="title">dtFimVigencia</label>
      <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia">
    </div>
    <div class="form-group">
      <label for="title">dsDesignacao</label>
      <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao">
    </div>
    <div class="form-group">
      <label for="title">dsNomeacao</label>
      <input type="text" class="form-control" id="dsNomeacao" name="dsNomeacao">
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



@else
@foreach ($selecionado as $event)
<div class="col-md-10 offset-md-1 dashboard-events-container">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nome Titular</th>
        <th scope="col">Incio</th>
        <th scope="col">Opções</th>

      </tr>
    </thead>
    <tbody>

      <tr>
        <td scropt="row">{{$event->nmRepresentanteSuplente}}</td>
        <td><a>{{ $event->dtInicioVigencia }}</a></td>

        <td> <a href="/representacoes/edit/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn">
            <ion-icon name="create-outline"></ion-icon>
          </a>
          <a href="/repsup/edit/{{$event->cdTitular}}" class="btn btn-info edit-btn">
            <ion-icon name="person-outline"></ion-icon>
          </a>
          <a href="/agendas/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn">
            <ion-icon name="book-outline"></ion-icon>
          </a>

      </tr>

    </tbody>
  </table>

</div>
@endforeach
<br>
<br>
<br>

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Crie sua Representação</h1>
  <form action="repinsta" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">cdInstancia</label>
      <select name="cdInstancia" id="cdInstancia" class="form-control">
        @foreach ( $selecionado as $instancia)
        <option value="{{$instancia->cdInstancia}}"> {{$instancia->nmInstancia}}</option>

        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="title">cdTitular</label>
      <select name="cdTitular" id="cdTitular" class="form-control">
        @foreach ( $representantes as $representante)
        <option value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

        @endforeach
      </select>

    </div>
    <div class="form-group">
      <label for="title">cdSuplente</label>
      <select name="cdSuplente" id="cdSuplente" class="form-control">

        <option value="">Não</option>
        @foreach ($representantes as $representante)
        <option value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

        @endforeach
      </select>

    </div>
    <div class="form-group">
      <label for="title">dtInicioVigencia</label>
      <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia">
    </div>
    <div class="form-group">
      <label for="title">dtFimVigencia</label>
      <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia">
    </div>
    <div class="form-group">
      <label for="title">dsDesignacao</label>
      <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao">
    </div>
    <div class="form-group">
      <label for="title">dsNomeacao</label>
      <input type="text" class="form-control" id="dsNomeacao" name="dsNomeacao">
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


@endif




@endsection