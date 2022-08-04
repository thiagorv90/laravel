@extends('layout.main')

@section('title', 'Agendas')

@section('content')
    @if (is_countable($selecionado) && count($selecionado) == 0)
    @if(auth()->user()->statusadm ==1)
        @foreach ($agendas as $agenda)
            <h3>Não há nada agendado para esta representação</h3>
            <h1>Criar Agenda</h1>

            <div id="event-create-container" class="container">
                <form action="agendas" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="date">Data:</label>
                        <input type="date" class="form-control" id="dtAgenda" name="dtAgenda">
                    </div>
                    <div class="form-group">
                        <label for="title">Representação: </label>
                        <select name="cdRepresentacao" id="cdRepresentacao" class="form-select">

                            <option value="{{$agenda->cdRepresentacao}}"> {{$agenda->cdTitular}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Hora:</label>
                        <input type="time" class="form-control" id="hrAgenda" name="hrAgenda">
                    </div>
                    <div class="form-group">
                        <label for="title">Assunto:</label>
                        <input type="text" class="form-control" id="dsAssunto" name="dsAssunto">
                    </div>
                    <div class="form-group">
                            <label for="title">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stAgenda" id="stAgenda" value="1">
                                <label class="form-check-label" for="stAgenda">
                                    Ativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stAgenda" id="stAgenda" value="0">
                                <label class="form-check-label" for="stAgenda">
                                    Desativado
                                </label>
                            </div>
                    <div class="form-group">
                        <label for="title">Local:</label>
                        <input type="text" class="form-control" id="dsLocal" name="dsLocal">
                    </div>
                    <div class="form-group">
                            <label for="title">Status Suplente:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stSuplente" id="stSuplente" value="1">
                                <label class="form-check-label" for="stSuplente">
                                    Ativo
                                </label>
                            </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stSuplente" id="stSuplente" value="0">
                                <label class="form-check-label" for="stSuplente">
                                    Desativado
                                </label>
                            </div>
                    <div class="form-group">
                        <label for="title">Pauta:</label>
                        <input type="textarea" class="form-control" id="dsPauta" name="dsPauta">
                    </div>
                    <div class="form-group">
                        <label for="title">Resumo:</label>
                        <input type="textarea" class="form-control" id="dsResumo" name="dsResumo">
                    </div>
                    <br><div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Criar">
</div>
                </form>
            </div>
            @endif
            @else

                <h1>Agendas da representação:</h1>
                <div class="container">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nome Instancia</th>
                            <th scope="col">Assunto</th>
                            <th scope="col">Pauta</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opções</th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            @foreach ($selecionado as $event)
                                <td scropt="row">{{$event->nmInstancia}}</td>
                                <td><a>{{$event->dsAssunto}}</a></td>
                                <td><a>{{$event->dsPauta}}</a></td>
                                 @if($event->stAgenda ==1)
                                    <td>Ativo</td>
                                @else
                                    <td>Desativado</td>
                                @endif

                                <td class="opcoes-agenda d-flex">
                                    <a href="/agendas/edit/{{$event->cdAgenda}}" class="btn btn-info edit-btn me-2" data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    @if(auth()->user()->statusadm ==1)
                                    <form action="/agendas/edit/{{ $event->cdAgenda }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn" data-bs-toggle="tooltip" data-bs-title="Deletar">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <br>
                
                <form action="/agendas/{{$event->cdAgenda}}/search" method="GET">
                    @csrf
                    <div class="row">
                        <div class="container">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="busca" id="busca" value="1" checked>
                                <label class="form-check-label" for="busca">
                                    Assunto
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="busca" id="busca" value="2" checked>
                                <label class="form-check-label" for="busca">
                                    Pauta
                                </label>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="" name="query" id="query"
                                       placeholder="Buscar Representação..."
                                       aria-label="Buscar Representação" aria-describedby="button-addon2" required/>
                                <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                            </div>


                        </div>
                    </div>
                </form>
                <br>
                @if(auth()->user()->statusadm ==1)
                <h1>Agenda</h1>

                <div id="event-create-container" class="container">
                    <form action="agendas" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="date">Data:</label>
                            <input type="date" class="form-control" id="dtAgenda" name="dtAgenda">
                        </div>
                        <div class="form-group">
                            <label for="title">Representação: </label>
                            <select name="cdRepresentacao" id="cdRepresentacao" class="form-control" >
                                @foreach ($selecionado as $agenda)
                                    <option value="{{$agenda->cdRepresentacao}}"> {{$agenda->nmRepresentanteSuplente}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Hora:</label>
                            <input type="time" class="form-control" id="hrAgenda" name="hrAgenda">
                        </div>
                        <div class="form-group">
                        <label for="title">Assunto:</label>
                        <input type="text" class="form-control" id="dsAssunto" name="dsAssunto" placeholder="Assunto...">
                    </div>
                        <div class="form-group">
                            <label for="title">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stAgenda" id="stAgenda" value="1">
                                <label class="form-check-label" for="stAgenda">
                                    Ativo
                                </label>
                            </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stAgenda" id="stAgenda" value="0">
                                <label class="form-check-label" for="stAgenda">
                                    Desativado
                                </label>
                            </div>
                        <div class="form-group">
                            <label for="title">Local:</label>
                            <input type="text" class="form-control" id="dsLocal" name="dsLocal" placeholder="Local...">
                        </div>
                        
                        <div class="form-group">
                            <label for="title">Status Suplente:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stSuplente" id="stSuplente" value="1">
                                <label class="form-check-label" for="stSuplente">
                                    Ativo
                                </label>
                            </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stSuplente" id="stSuplente" value="0">
                                <label class="form-check-label" for="stSuplente">
                                    Desativado
                                </label>
                            </div>
                        <div class="form-group">
                            <label for="title">Pauta:</label>
                            <input type="textarea" class="form-control" id="dsPauta" name="dsPauta" placeholder="Pauta...">
                        </div>
                        <div class="form-group">
                            <label for="title">Resumo:</label>
                            <textarea type="textarea" class="form-control" id="dsResumo" name="dsResumo" placeholder="Resumo..."></textarea>
                        </div>
                        <br><div class="container d-flex justify-content-between mt-2">
                        <input type="submit" class="btn btn-primary mb-2" value="Criar">
                        
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                
</div>
                    </form>
                </div>
            @endif
            @endif

            @endsection
