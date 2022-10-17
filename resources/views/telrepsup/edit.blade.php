@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')
    <style>
        .welcomediv {
            color: white;
            background: rgb(153, 114, 187);
            background: linear-gradient(90deg, rgb(186, 143, 223) 35%, rgba(182, 154, 233, 1) 100%);
            border: 2px solid rgb(255, 255, 255);
            box-shadow: #ebe9e9 1px 1px 4px 3px;
            font-family: 'Montserrat', sans-serif;
            transition: all 1.5s;
            padding: 3px;
        }
    </style>

    <div id="event-create-container" class="container">

        @foreach ($selecionado as $tel)
            <form action="/telrepsup/update/{{ $tel->cdTelefone}}" method="POST">
                @csrf

                <div class="container my-3 ps-3 welcomediv bg-seconday">
                    <h1>Editar telefone</h1>
                </div>

                @method('PUT')
                <div class="form-group">
                    <label for="title">Numero:</label>
                    <input type="text" class="form-control" id="nuTelefone" name="nuTelefone"
                           value="{{$tel->nuTelefone}}"></input>
                </div>

                <div class="form-group">
                    <label for="title">DDD:</label>
                    <input type="text" class="form-control" id="nuDDDTelefone" name="nuDDDTelefone"
                           value="{{$tel->nuDDDTelefone}}"/>
                </div>

                <div class="form-group">
                    <label for="title">Tipo:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpTelefone"
                               id="tpTelefone" value="1" @if($tel->tpTelefone ==1) checked @endif >
                        <label class="form-check-label" for="tpTelefone">
                            Celular
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpTelefone"
                               id="tpTelefone" value="0" @if($tel->tpTelefone ==0) checked @endif >
                        <label class="form-check-label" for="tpTelefone">
                            Fixo
                        </label>
                    </div>
                </div>
                <div style="display:none">
                    <label for="title">Nome:</label>
                    <select id="cdRepSup" name="cdRepSup" class="form-select">
                        @foreach($lista as $i)
                            <option value="{{$i->cdRepSup}}" @if ($tel->cdRepSup == $i->cdRepSup) selected @endif >
                                {{ $i->nmRepresentanteSuplente }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="Salvar">
            </form>
        @endforeach

    </div>

@endsection
