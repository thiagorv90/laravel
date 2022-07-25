@extends('layout.main')

@section('title', 'Criar Representação')

@section('content')



    @if (is_countable($selecionado) && count($selecionado) == 0)
        @foreach ( $instancias as  $instancia)

            <h3>Não ha representações para esta instancia:{{$instancia->nmInstancia}}</h3>

            <div id="event-create-container" class="col-md-6 offset-md-3">
                <h1>Crie sua Representação</h1>
                <form action="repinsta" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">cdInstancia</label>
                        <select name="cdInstancia" id="cdInstancia" class="form-control">

                            <option value="{{$instancia->cdInstancia}}"> {{$instancia->nmInstancia}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">cdTitular</label>
                        <select name="cdTitular" id="cdTitular" class="form-control">
                            @foreach ( $representantes as $representante)
                                <option
                                    value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="title">cdSuplente</label>
                        <select name="cdSuplente" id="cdSuplente" class="form-control">

                            <option value="">Não</option>
                            @foreach ($representantes as $representante)
                                <option
                                    value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="title">dtInicioVigencia</label>
                        <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia">
                    </div>
                    <div class="form-group">
                        <label for="title">dtFimVigencia</label>
                        <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia">
                    </div>
                    <div class="form-group">
                        <label for="title">dsDesignacao</label>
                        <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao">
                    </div>
                    <div class="form-group">
                        <label for="title">dsNomeacao</label>
                        <input type="text" class="form-control" id="dsNomeacao" name="dsNomeacao">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                                   @if($instancias->stAtivo ==1) checked @endif >
                            <label class="form-check-label" for="stAtivo">
                                Ativo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                                   @if($instancias->stAtivo ==0) checked @endif >
                            <label class="form-check-label" for="stAtivo">
                                Desativado
                            </label>
                        </div>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Criar Representação">
                </form>
            </div>



            @else

                <div class="col-md-10 offset-md-1 dashboard-events-container">


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

                                <td><a href="/representacoes/edit/{{$event->cdRepresentacao}}"
                                       class="btn btn-info edit-btn">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <a href="/repsup/edit/{{$event->cdTitular}}" class="btn btn-info edit-btn">
                                        <ion-icon name="person-outline"></ion-icon>
                                    </a>
                                    <a href="/agendas/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn">
                                        <ion-icon name="book-outline"></ion-icon>
                                    </a>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>


                <br>
                <br>
                <br>

                <div id="event-create-container" class="col-md-6 offset-md-3">
                    <h1>Crie sua Representação</h1>
                    <form action="repinsta" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">cdInstancia</label>
                            <select name="cdInstancia" id="cdInstancia" class="form-control">
                                @foreach ( $selecionado as $instancia)
                                    <option value="{{$instancia->cdInstancia}}"> {{$instancia->nmInstancia}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">cdTitular</label>
                            <select name="cdTitular" id="cdTitular" class="form-control">
                                @foreach ( $representantes as $representante)
                                    <option
                                        value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="title">cdSuplente</label>
                            <select name="cdSuplente" id="cdSuplente" class="form-control">

                                <option value="">Não</option>
                                @foreach ($representantes as $representante)
                                    <option
                                        value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>

                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="title">dtInicioVigencia</label>
                            <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia">
                        </div>
                        <div class="form-group">
                            <label for="title">dtFimVigencia</label>
                            <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia">
                        </div>
                        <div class="form-group">
                            <label for="title">dsDesignacao</label>
                            <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacao">
                        </div>
                        <div class="form-group">
                            <label for="title">dsNomeacao</label>
                            <input type="text" class="form-control" id="dsNomeacao" name="dsNomeacao">
                        </div>
                        <div class="form-group">
                            <label for="title">Ativo?</label>
                            <div class="form-check">

                                <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                                       @if($instancia->stAtivo ==1) checked @endif >
                                <label class="form-check-label" for="stAtivo">
                                    Ativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                                       @if($instancia->stAtivo ==0) checked @endif >
                                <label class="form-check-label" for="stAtivo">
                                    Desativado
                                </label>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Criar Evento">
                    </form>
                </div>

            @endif




            @endsection
