@extends('layout.main')

@section('title', 'Contatos')

@section('content')


    <div id="event-create-container" class="container">
        <h1>Contatos</h1>
        <form action="/contatos" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="nmContato" name="nmContato" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="title">Instancia:</label>
                <select name="cdInstancia" id="cdInstancia" class="form-control">
                    @foreach ($contatos as $contato)
                        <option value="{{$contato->cdInstancia}}"> {{$contato->nmInstancia}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Email:</label>
                <input type="text" class="form-control" id="dsEmail" name="dsEmail">
            </div>
            <div class="form-group">
                <label for="title">Ativo:</label>
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
                    <label for="title">Tipo</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpContatoRepresentante"
                               id="tpContatoRepresentante" value="1" checked>
                        <label class="form-check-label" for="tpContatoRepresentante">
                            Celular
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpContatoRepresentante"
                               id="tpContatoRepresentante" value="0">
                        <label class="form-check-label" for="tpContatoRepresentante">
                            Fixo
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="title">Email Alternativo:</label>
                        <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Criar Evento">
        </form>
    </div>
    <br>
    <br>
    <br>

    <form action="{{route('searchco')}}" method="GET">
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <input type="text" class="form-control" value="" name="query" id="query" placeholder="busca">
                    <button class="navbar-search__buttton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    @foreach ($events as $event)
        <table class="table">
            <thead>
            <tr>


                <th scope="col">Nome</th>
                <th scope="col">Opções</th>

            </tr>
            </thead>
            <tbody>

            <tr>


                <td><a>{{ $event->nmContato }}</a></td>

                <td><a href="/contatos/edit/{{$event->cdContato}}" class="btn btn-info edit-btn">
                        <ion-icon name="create-outline"></ion-icon>
                    </a>
            </tr>

            @endforeach
            </tbody>
        </table>

        </div>

        @endsection
