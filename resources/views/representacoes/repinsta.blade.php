@extends('layout.main')

@section('title', 'Criar Representação')

@section('content')


<div id="event-create-container" class="container">
    @if (is_countable($selecionado) && count($selecionado) == 0)
        @foreach ( $instancias as  $instancia)

            <h3>Não ha representações para esta instancia:{{$instancia->nmInstancia}}</h3>

            <div id="event-create-container" class="container">
                <h1>Crie sua Representação</h1>
                <form action="repinsta" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group" style="display:none">
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
                        <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Fim da Vigência:</label>
                        <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia" required>
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
                    <div class="form-group">
                                <label for="title">Documento:</label>
                                <input type="file" class="form-control" id="fnNomeacao" name="fnNomeacao">
                            </div>
                    <br>
                    <div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="criar">
</div>
                </form>
            </div>

            @else

                <div class="container">


                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nome Titular</th>
                            <th scope="col">Incio</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opções</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($selecionado as $event)
                            <tr>

                                <td scropt="row">{{$event->nmRepresentanteSuplente}}</td>
                                <td><a>{{ $event->dtInicioVigencia }}</a></td>
                                @if($event->stAtivo ==1)
                                    <td>Ativo</td>
                                @else
                                    <td>Desativado</td>
                                @endif

                                <td>
                                    <a href="/representacoes/edit/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn"
                                       data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <ion-icon name="create-outline"></ion-icon>
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
                    <div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="criar">
</div>

                </div>

                <div id="event-create-container" class="container mt-5">
                    <h1>Crie sua Representação</h1>
                    <form action="repinsta" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group" style="display:none">
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
                            <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Fim da Vigência:</label>
                            <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia" required>
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
                            <div class="form-group">
                                <label for="title">Documento:</label>
                                <input type="file" class="form-control" id="fnNomeacao" name="fnNomeacao">
                            </div>
                        </div>
                        <br>
                        <div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="criar">
</div>
                    </form>
                </div>

            @endif
            </div>



            @endsection
