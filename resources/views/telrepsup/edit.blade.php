@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')
    <echo>{{$selecionado}}</echo>

    <div id="event-create-container" class="col-md-6 offset-md-3">

        @foreach ($selecionado as $tel)
            <form action="/telrepsup/update/{{ $tel->cdTelefone}}" method="POST">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="title">Numero:</label>
                    <input type="text" class="form-control" id="nuTelefone" name="nuTelefone"
                           value="{{$tel->nuTelefone}}"></input>
                </div>

                <div class="form-group">
                    <label for="title">DDD</label>
                    <input type="text" class="form-control" id="nuDDDTelefone" name="nuDDDTelefone"
                           value="{{$tel->nuDDDTelefone}}"></input>
                </div>
                <div class="form-group">
                    <label for="title">Tipo Telefone</label>
                    <input type="text" class="form-control" id="tpTelefone" name="tpTelefone"
                           value="{{$tel->tpTelefone}}"></input>
                </div>
                <label for="title">Nome:</label>
                <select id="cdRepSup" name="cdRepSup" class="form-control">
                    @foreach($lista as $i)
                        <option value="{{$i->cdRepSup}}" @if ($tel->cdRepSup == $i->cdRepSup) selected @endif >
                            {{ $i->nmRepresentanteSuplente }}
                        </option>
                    @endforeach
                </select>
                <br>
                <input type="submit" class="btn btn-primary" value="Alterar">
            </form>
        @endforeach

    </div>

@endsection
