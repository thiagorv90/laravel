@extends('layout.main')

@section('title', 'Editando tipo_instancia')

@section('content')

    <div id="event-create-container" class="container">

        @foreach ($selecionado as $inst)
            <form action="/instituicoes/update/{{ $inst->cdInstituicao}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Nome:</label>
                    <input type="text" class="form-control" id="nmInstituicao" name="nmInstituicao"
                           value="{{$inst->nmInstituicao}}"></input>
                </div>
                <div class="form-group">
                    <label for="title">Tipo:</label>
                    <select id="cdTipoInstituicao" name="cdTipoInstituicao" class="form-select">
                        @foreach($lista as $i)
                            <option value="{{$i->cdTipoInstancia}}"
                                    @if ($inst->cdTipoInstituicao == $i->cdTipoInstancia) selected @endif >
                                {{ $i->dsTipoInstancia }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="Criar Evento">
            </form>
        @endforeach

    </div>

@endsection
