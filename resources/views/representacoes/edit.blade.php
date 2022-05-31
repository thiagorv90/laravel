@extends('layout.main')

@section('title', 'Editando Representações')

@section('content')

<echo>{{$selecionado}}

  <div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Representacões</h1>
    @foreach ($selecionado as $age)
    <form action="/representacoes/update/{{ $age->cdRepresentacao}}" method="POST">
      @csrf

      @method('PUT')

      <div class="form-group">
        <label for="title">Instancias </label>
        <select id="cdInstancia" name="cdInstancia" class="form-control">
          @foreach($lista as $i)
          <option value="{{$i->cdInstancia}}" @if ($age->cdInstancia == $i->cdInstancia) selected @endif >
            {{ $i->nmInstancia }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="title">Titular </label>
        <select id="cdTitular" name="cdTitular" class="form-control">
          @foreach($rep as $e)

          <option value="{{$e->cdRepSup}}" @if ($age->cdTitular == $e->cdRepSup) selected @endif >
            {{ $e->nmRepresentanteSuplente }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="title">Suplente </label>
        <select id="cdSuplente" name="cdSuplente" class="form-control">

          @foreach($rep as $e)

          <option value="{{$e->cdRepSup}}" @if ($age->cdSuplente == $e->cdRepSup) selected @endif >
            {{ $e->nmRepresentanteSuplente }}
          </option>
          @endforeach
          <option value=""></option>
        </select>
      </div>
      <div class="form-group">
        <label for="title">Inicio Vigencia:</label>
        <input type="text" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia" value="{{$age->dtInicioVigencia}}">
      </div>

      <div class="form-group">
        <label for="title">Fim Vigencia:</label>
        <input type="text" class="form-control" id="dtFimVigencia" name="dtFimVigencia" value="{{$age->dtFimVigencia}}">
      </div>
      <div class="form-group">
        <label for="title">Designação:</label>
        <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao" value="{{$age->dsDesignacao}}">
      </div>
      <div class="form-group">
        <label for="title">ativo</label>
        <select name="stAtivo" id="stAtivo" class="form-control">
          <option value="{{$age->stAtivo}}">{{$age->stAtivo}}</option>
          <option value="1">Sim</option>
        </select>
      </div>
      <div class="form-group">
        <label for="title">Nomeacao: </label>
        <input type="textarea" class="form-control" id="dsNomeacao" name="dsNomeacao" value="{{$age->dsNomeacao}}">
      </div>
      <div class="form-group">
        <label for="title">Data de Nascimento:</label>
        <input type="textarea" class="form-control" id="dtNascimento" name="dtNascimento" value="{{$age->dtNascimento}}">
      </div>
      <br>
      <input type="submit" class="btn btn-primary" value="Alterar">
    </form>

  </div>
  @endforeach


  @endsection