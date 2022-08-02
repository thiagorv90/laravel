@extends('layout.main')

@section('title', 'Editando Representações')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Representacões</h1>
        @foreach ($selecionado as $age)
            <form action="/representacoes/update/{{ $age->cdRepresentacao}}" method="POST">
                @csrf

                @method('PUT')

                <div class="form-group">
                    <label for="title">Instancias:</label>
                    <select id="cdInstancia" name="cdInstancia" class="form-select">
                        @foreach($lista as $i)
                            <option value="{{$i->cdInstancia}}"
                                    @if ($age->cdInstancia == $i->cdInstancia) selected @endif >
                                {{ $i->nmInstancia }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Titular:</label>
                    <select id="cdTitular" name="cdTitular" class="form-select">
                        @foreach($rep as $e)

                            <option value="{{$e->cdRepSup}}" @if ($age->cdTitular == $e->cdRepSup) selected @endif >
                                {{ $e->nmRepresentanteSuplente }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Suplente:</label>
                    <select id="cdSuplente" name="cdSuplente" class="form-select">

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
                    <input type="text" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia"
                           value="{{$age->dtInicioVigencia}}">
                </div>

                <div class="form-group">
                    <label for="title">Fim Vigencia:</label>
                    <input type="text" class="form-control" id="dtFimVigencia" name="dtFimVigencia"
                           value="{{$age->dtFimVigencia}}">
                </div>
                <div class="form-group">
                    <label for="title">Designação:</label>
                    <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao"
                           value="{{$age->dsDesignacao}}">
                </div>
                <div class="form-group">
                    <label for="title">Status:</label>
                    <div class="form-check">

                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                               @if($age->stAtivo ==1) checked @endif >
                        <label class="form-check-label" for="stAtivo">
                            Ativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                               @if($age->stAtivo ==0) checked @endif >
                        <label class="form-check-label" for="stAtivo">
                            Desativado
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Nomeacao: </label>
                    <input type="textarea" class="form-control" id="dsNomeacao" name="dsNomeacao"
                           value="{{$age->dsNomeacao}}">
                </div>
                <div class="form-group">
                        <label for="title">Data de Nomeação:</label>
                        <input type="text" class="form-control" id="dtNomeacao" name="dtNomeacao"
                        value="{{$age->dtNomeacao}}">
                    </div>
                    <div class="form-group">
                        <label for="title"> Numero Nomeação:</label>
                        <input type="number" class="form-control" id="nuNomeacao" name="nuNomeacao"
                        value="{{$age->nuNomeacao}}">
                    </div>

                <br>
                <input type="submit" class="btn btn-primary mb-2" value="Alterar">
            </form>

    </div>
    @endforeach

@endsection
