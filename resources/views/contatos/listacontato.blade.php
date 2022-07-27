@extends('layout.main')

@section('title', 'Contatos Instancia')

@section('content')

    @if (isset($selecionado) && $selecionado->count() > 0)

        @foreach ($nome as $name)
            <h1>Contatos da Instancia: {{$name->nmInstancia}}</h1>
        @endforeach

        <table class="table">

            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($selecionado as $event)

                <tr>
                    <td><a>{{ $event->nmContato }}</a></td>
                    <td><a href="/contatos/edit/{{$event->cdContato}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Editar">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                        <a href="/telcon/{{$event->cdContato}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Contato">
                            <ion-icon name="call-outline"></ion-icon>
                        </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <form action="/contatos/{{$name->cdInstancia}}/search" method="GET">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="" name="query" id="query"
                       placeholder="Buscar Contato..."
                       aria-label="Buscar Contato" aria-describedby="button-addon2" required/>
                <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
            </div>
        </form>
        <br>
        <br>
        <br>
        <h1> Criar Contatos da Instância: {{$name->nmInstancia}}</h1>
        <div id="event-create-container" class="container">

            <form action="listacontatos/" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Nome:</label>
                    <input type="text" class="form-control" id="nmContato" name="nmContato">
                </div>
                <div class="form-group">
                    <label for="title">Instancia:</label>
                    <select name="cdInstancia" id="cdInstancia" class="form-select">


                        <option value="{{$name->cdInstancia}}"> {{$name->nmInstancia}}</option>


                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" id="dsEmail" name="dsEmail">
                </div>
                <div class="form-group">
                    <label for="title">Status:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1" checked>
                        <label class="form-check-label" for="stAtivo">
                            Ativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0">
                        <label class="form-check-label" for="stAtivo">
                            Desativado
                        </label>
                    </div>

                    <div class="form-group">

                        <label for="title">Contato Representante:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpContatoRepresentante"
                                   id="tpContatoRepresentante" value="1" checked>
                            <label class="form-check-label" for="tpContatoRepresentante">
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpContatoRepresentante"
                               id="tpContatoRepresentante" value="0">
                        <label class="form-check-label" for="tpContatoRepresentante">
                            Não
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Email Secundário:</label>
                    <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo">
                </div>
                <br>
                <input type="submit" class="btn btn-primary mb-2" value="Criar Evento">
            </form>
        </div>

    @else
        @foreach ($nome as $contato)
            <h3>Não ha contato para esta instancia:{{$contato->nmInstancia}}</h3>

            <h1> Criar Contatos para a Instancia {{$contato->nmInstancia}}</h1>
            <div id="event-create-container" class="container">

                <form action="listacontatos/" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Nome:</label>
                        <input type="text" class="form-control" id="nmContato" name="nmContato">
                    </div>
                    <div class="form-group">
                        <label for="title">Instancia:</label>
                        <select name="cdInstancia" id="cdInstancia" class="form-select">


                            <option value="{{$contato->cdInstancia}}"> {{$contato->nmInstancia}}</option>


                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Email:</label>
                        <input type="text" class="form-control" id="dsEmail" name="dsEmail">
                    </div>
                    <div class="form-group">
                        <label for="title">Status:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1" checked>
                            <label class="form-check-label" for="stAtivo">
                                Ativo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0">
                            <label class="form-check-label" for="stAtivo">
                                Desativado
                            </label>
                        </div>

                        <div class="form-group">

                            <label for="title">Contato Representante:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tpContatoRepresentante"
                                       id="tpContatoRepresentante" value="1" checked>
                                <label class="form-check-label" for="tpContatoRepresentante">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tpContatoRepresentante"
                                       id="tpContatoRepresentante" value="0">
                                <label class="form-check-label" for="tpContatoRepresentante">
                                    Não
                                </label>
                            </div>


                            <div class="form-group">
                                <label for="title">Email Secundário:</label>
                                <input type="text" class="form-control" id="dsEmailAlternativo"
                                       name="dsEmailAlternativo">
                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary mb-2" value="Criar Evento">
                </form>
            </div>
            </div>
            </div>
        @endforeach
    @endif
@endsection
