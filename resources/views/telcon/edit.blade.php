@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')
    <div id="event-create-container" class="container">

        @foreach ($selecionado as $tel)
            <h1>Crie Contato Telefonico para: {{$tel->nmContato}}</h1>
            <form action="/telcon/update/{{ $tel->cdTelefone}}" method="POST">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="title">Numero:</label>
                    <input type="text" class="form-control" id="nuTelefone" name="nuTelefone"
                           value="{{$tel->nuTelefone}}"></input>
                </div>

                <div class="form-group">
                    <label for="title">DDD:</label>
                    <input type="text" class="form-control" id="nuDDDTelefone" name="nuDDDTelefone"
                           value="{{$tel->nuDDDTelefone}}"> </input>
                </div>
                <div class="form-group">
                    <label for="title">Nome:</label>
                    <select id="cdContatoTelefone" name="cdContatoTelefone" class="form-control">
                        @foreach($selecionado as $i)
                            <option value="{{$i->cdContato}}"> {{ $i->nmContato }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <input type="submit" class="btn btn-primary mt-2" value="Salvar">

            </form>
        @endforeach

    </div>

@endsection

