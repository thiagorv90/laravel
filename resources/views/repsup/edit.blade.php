@extends('layout.main')

@section('title', 'Editando Representante')

@section('content')
    @foreach ($selecionado as $age)
        <div id="event-create-container" class="col-md-6 offset-md-3">
            <h1>Editar dados Representante:{{$age->nmRepresentanteSuplente}}</h1>

            <form action="/repsup/update/{{ $age->cdRepSup}}" method="POST">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="date">Nome:</label>
                    <input type="text" class="form-control" id="nmRepresentanteSuplente" name="nmRepresentanteSuplente"
                           value="{{$age->nmRepresentanteSuplente}}">
                </div>
                <div class="form-group">
                    <label for="title">cdRepresentacao </label>
                    <select id="cdEmpresa" name="cdEmpresa" class="form-control">

                        <option value="{{$age->cdEmpresa}}">
                            {{ $age->nmEmpresa }}
                        </option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Escolaridade </label>
                    <select id="cdEscolaridade" name="cdEscolaridade" class="form-control">
                        @foreach($escola as $e)
                            <option value="{{$e->cdEscolaridade}}"
                                    @if ($age->cdEscolaridade == $e->cdEscolaridade) selected @endif >
                                {{ $e->dsEscolaridade }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" id="dsEmail" name="dsEmail" value="{{$age->dsEmail}}">
                </div>

                <div class="form-group">
                    <label for="title">Email Alternativo:</label>
                    <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo"
                           value="{{$age->dsEmailAlternativo}}">
                </div>
                <div class="form-group">
                    <label for="title">Profissão:</label>
                    <input type="text" class="form-control" id="dsProfissao" name="dsProfissao"
                           value="{{$age->dsProfissao}}">
                </div>
                <div class="form-group">
                    <label for="title">ativo</label>


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
                    <label for="title">Endereço:</label>
                    <input type="textarea" class="form-control" id="dsEndereco" name="dsEndereco"
                           value="{{$age->dsEndereco}}">
                </div>
                <div class="form-group">
                    <label for="title">Data de Nascimento:</label>
                    <input type="textarea" class="form-control" id="dtNascimento" name="dtNascimento"
                           value="{{$age->dtNascimento}}">
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="Alterar">
            </form>
            @endforeach
        </div>



        @endsection
