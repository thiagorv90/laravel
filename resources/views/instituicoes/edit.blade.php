@extends('layout.main')

@section('title', 'Editando tipo_instancia')

@section('content')

    <style>
        .welcomediv {
            color: white;
            background: rgb(153, 114, 187);
            background: linear-gradient(90deg, rgba(156, 104, 203, 1) 35%, rgba(182, 154, 233, 1) 100%);
            border: 2px solid rgb(255, 255, 255);
            box-shadow: #ebe9e9 1px 1px 4px 3px;
            font-family: 'Montserrat', sans-serif;
            transition: all 1.5s;
            padding: 3px;
        }
    </style>


    <div id="event-create-container" class="container">
        <div class="container my-3 ps-3 welcomediv">
            <h1 class="mt-1">Instituições</h1>
        </div>
        @foreach ($selecionado as $inst)
            <form action="/instituicoes/update/{{ $inst->cdInstituicao }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nmInstituicao">Nome:</label>
                    <input type="text" class="form-control" id="nmInstituicao" name="nmInstituicao"
                           value="{{ $inst->nmInstituicao }}"></input>
                </div>
                <div class="form-group">
                    <label for="cdTipoInstituicao">Tipo:</label>
                    <select id="cdTipoInstituicao" name="cdTipoInstituicao" class="form-select">
                        @foreach ($lista as $i)
                            <option value="{{ $i->cdTipoInstancia }}"
                                    @if ($inst->cdTipoInstituicao == $i->cdTipoInstancia) selected @endif>
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
