@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Agenda</h1>
        @foreach ($selecionado as $age)
            <form action="/agendas/update/{{ $age->cdAgenda}}" method="POST">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="date">Data:</label>
                    <input type="text" class="form-control" id="dtAgenda" name="dtAgenda" value="{{$age->dtAgenda}}">
                </div>
                <div class="form-group">
                    <label for="title">Representação:</label>
                    <select id="cdRepresentacao" name="cdRepresentacao" class="form-control">

                        <option value="{{$age->cdRepresentacao}}">
                            {{ $age->cdTitular }}
                        </option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Hora:</label>
                    <input type="text" class="form-control" id="hrAgenda" name="hrAgenda" value="{{$age->hrAgenda}}">
                </div>
                <div class="form-group">
                    <label for="title">Assunto:</label>
                    <input type="text" class="form-control" id="dsAssunto" name="dsAssunto" value="{{$age->dsAssunto}}">
                </div>

                <div class="form-group">
                    <label for="title">Status:</label>
                    <select name="stAgenda" id="stAgenda" class="form-control">
                        <option value="{{$age->stAgenda}}">{{$age->stAgenda}}</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Local:</label>
                    <input type="text" class="form-control" id="dsLocal" name="dsLocal" value="{{$age->dsLocal}}">
                </div>
                <div class="form-group">
                    <label for="title">Suplente:</label>
                    <select name="stSuplente" id="stSuplente" class="form-control">
                        <option value="{{$age->stSuplente}}">{{$age->stSuplente}}</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Pauta:</label>
                    <input type="textarea" class="form-control" id="dsPauta" name="dsPauta" value="{{$age->dsPauta}}">
                </div>
                <div class="form-group">
                    <label for="title">Resumo:</label>
                    <input type="textarea" class="form-control" id="dsResumo" name="dsResumo"
                           value="{{$age->dsResumo}}">
                </div>
                <br>
                <input type="submit" class="btn btn-primary mb-2" value="Alterar">
            </form>
        @endforeach
    </div>

@endsection
