@extends('layout.main')

@section('title', 'Editando tipo_instancia')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Instituições</h1>
        @foreach ($selecionado as $inst)
            <form action="/instituicoes/update/{{ $inst->cdInstituicao}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nmInstituicao">Nome:</label>
                    <input type="text" class="form-control" id="nmInstituicao" name="nmInstituicao"
                           value="{{$inst->nmInstituicao}}"></input>
                </div>
                <div class="form-group">
                    <label for="cdTipoInstituicao">Tipo:</label>
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
                <div class="container d-flex justify-content-between mt-2">
                    <a href="/instituicoes" class="btn btn-info mb-2">Voltar</a>
                    <input type="submit" class="btn btn-primary mb-2" value="Salvar">
                </div>
            </form>
        @endforeach

    </div>

@endsection
