@extends('layout.main')

@section('title', 'Criar Representação')

@section('content')



    @if (is_countable($selecionado) && count($selecionado) == 0)
        @foreach ( $instancias as  $instancia)

            <h3>Não ha representações para esta instancia:{{$instancia->nmInstancia}}</h3>

            <div id="event-create-container" class="container">
                <h1>Crie sua Representação</h1>
                <form action="repinsta" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Instancia:</label>
                        <select name="cdInstancia" id="cdInstancia" class="form-control">

                            <option value="{{$instancia->cdInstancia}}"> {{$instancia->nmInstancia}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Titular:</label>
                        <select name="cdTitular" id="cdTitular" class="form-control">
                            @foreach ( $representantes as $representante)
                                <option
                                    value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="title">Suplente:</label>
                        <select name="cdSuplente" id="cdSuplente" class="form-control">

                            <option value="">Não</option>
                            @foreach ($representantes as $representante)
                                <option
                                    value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="title">Inicio da Vigência:</label>
                        <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia">
                    </div>
                    <div class="form-group">
                        <label for="title">Fim da Vigência:</label>
                        <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia">
                    </div>
                    <div class="form-group">
                        <label for="title">Designação:</label>
                        <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao">
                    </div>
                    <div class="form-group">
                        <label for="title">Nomeação:</label>
                        <input type="text" class="form-control" id="dsNomeacao" name="dsNomeacao">
                    </div>
                    <div class="form-group">
                        <label for="title">Status:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                            >
                            <label class="form-check-label" for="stAtivo">
                                Ativo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                            >
                            <label class="form-check-label" for="stAtivo">
                                Desativado
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Data de Nomeação:</label>
                        <input type="date" class="form-control" id="dtNomeacao" name="dtNomeacao">
                    </div>
                    <div class="form-group">
                        <label for="title">Nomeação:</label>
                        <input type="number" class="form-control" id="nuNomeacao" name="nuNomeacao">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary mb-2" value="Criar Representação">
                </form>
            </div>

            @else

                <div class="container">


                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nome Titular</th>
                            <th scope="col">Incio</th>
                            <th scope="col">Opções</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($selecionado as $event)
                            <tr>

                                <td scropt="row">{{$event->nmRepresentanteSuplente}}</td>
                                <td><a>{{ $event->dtInicioVigencia }}</a></td>

                                <td>
                                    <a href="/representacoes/edit/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn"
                                       data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <a href="/repsup/edit/{{$event->cdTitular}}" class="btn btn-info edit-btn"
                                       data-bs-toggle="tooltip" data-bs-title="Contatos">
                                        <ion-icon name="person-outline"></ion-icon>
                                    </a>
                                    <a href="/agendas/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn"
                                       data-bs-toggle="tooltip" data-bs-title="Agenda">
                                        <ion-icon name="book-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div id="event-create-container" class="container mt-5">
                    <h1>Crie sua Representação</h1>
                    <form action="repinsta" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Instância:</label>
                            <select name="cdInstancia" id="cdInstancia" class="form-control">
                                @foreach ( $selecionado as $instancia)
                                    <option value="{{$instancia->cdInstancia}}"> {{$instancia->nmInstancia}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Titular:</label>
                            <select name="cdTitular" id="cdTitular" class="form-control">
                                @foreach ( $representantes as $representante)
                                    <option
                                        value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="title">Suplente:</label>
                            <select name="cdSuplente" id="cdSuplente" class="form-control">

                                <option value="">Não</option>
                                @foreach ($representantes as $representante)
                                    <option
                                        value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="title">Inicio da Vigência:</label>
                            <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia">
                        </div>
                        <div class="form-group">
                            <label for="title">Fim da Vigência:</label>
                            <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia">
                        </div>
                        <div class="form-group">
                            <label for="title">Designação:</label>
                            <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao">
                        </div>
                        <div class="form-group">
                            <label for="title">Nomeação:</label>
                            <input type="text" class="form-control" id="dsNomeacao" name="dsNomeacao">
                        </div>
                        <div class="form-group">
                            <label for="title">Status:</label>
                            <div class="form-check">

                                <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                                >
                                <label class="form-check-label" for="stAtivo">
                                    Ativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                                >
                                <label class="form-check-label" for="stAtivo">
                                    Desativado
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="title">Data de Nomeação:</label>
                                <input type="date" class="form-control" id="dtNomeacao" name="dtNomeacao">
                            </div>
                            <div class="form-group">
                                <label for="title">Nomeação:</label>
                                <input type="number" class="form-control" id="nuNomeacao" name="nuNomeacao">
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary mb-2" value="Criar Evento">
                    </form>
                </div>

            @endif




            @endsection
