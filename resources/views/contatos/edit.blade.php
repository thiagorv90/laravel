@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">

        @foreach ($selecionado as $con)
            <form action="/contatos/update/{{ $con->cdContato}}" method="POST">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="title">Nome:</label>
                    <input type="text" class="form-control" id="nmContato" name="nmContato"
                           value="{{$con->nmContato}}"></input>
                </div>
                <div class="form-group">
                    <label for="title">Instancia:</label>
                    <select id="cdInstancia" name="cdInstancia" class="form-control">

                        <option value="{{$con->cdInstancia}}">
                            {{ $con->nmInstancia }}
                        </option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" id="dsEmail" name="dsEmail"
                           value="{{$con->dsEmail}}"></input>
                </div>


                <div class="form-group">
                    <label for="title">Ativo:</label>
                    <div class="form-check">

                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                               @if($con->stAtivo ==1) checked @endif >
                        <label class="form-check-label" for="stAtivo">
                            Ativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                               @if($con->stAtivo ==0) checked @endif >
                        <label class="form-check-label" for="stAtivo">
                            Desativado
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Contato Representante:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpContatoRepresentante"
                               id="tpContatoRepresentante" value="1"
                               @if($con->tpContatoRepresentante ==1) checked @endif >
                        <label class="form-check-label" for="tpContatoRepresentante">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpContatoRepresentante"
                               id="tpContatoRepresentante" value="0"
                               @if($con->tpContatoRepresentante ==0) checked @endif >
                        <label class="form-check-label" for="tpContatoRepresentante">
                            Não
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">dsEmailAlternativo:</label>
                    <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo"
                           value="{{$con->dsEmailAlternativo}}"></input>
                </div>


                <br>
                <input type="submit" class="btn btn-primary" value="Alterar">
            </form>
        @endforeach

    </div>

@endsection
