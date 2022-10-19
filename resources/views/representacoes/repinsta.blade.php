@extends('layout.main')

@section('title', 'Criar Representação')

@section('content')
    <style>
        a {
            text-decoration: none;
            color: #6f42c1;
        }

        a:hover {
            color: #452680;

        }
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
        <!--Alerta-->  <!--Alerta--> <!--Alerta-->
        @if (is_countable($selecionado) && count($selecionado) == 0)
            @foreach ( $instancias as  $instancia)
                <div class="alert alert-secondary d-flex align-items-center mt-4 mb-3 " role="alert">
                    <div>
                        <h6>Não existem representações para esta instancia.</h6>
                        <p>Caso precise, use o formulário abaixo para criar
                            ou <a href="../instituicoes/instituicoes." class="alert-link">clique aqui</a> para voltar ao
                            inicio.</p>
                    </div>
                </div>



                <div id="event-create-container" class="container">
                    <div class="container my-3 ps-3 welcomediv bg-seconday">
                        <h1>Crie sua Representação</h1>
                    </div>
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
                            <label for="title">Inicio da Vigência3:</label>
                            <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="title">Fim da Vigência:</label>
                            <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia"
                            >
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
                            <label for="title">Designação Suplente:</label>
                            <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacaoSuplente">
                        </div>
                        <div class="form-group">
                            <label for="title">Nomeação Suplente:</label>
                            <input type="text" class="form-control" id="dsNomeacaoSuplente" name="dsNomeacaoSuplente">
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
                            <label for="title">Número Nomeação:</label>
                            <input type="number" class="form-control" id="nuNomeacao" name="nuNomeacao">
                        </div>
                        <div class="form-group">
                            <label for="title">Detalhes Nomeação:</label>
                            <input type="text" class="form-control" id="fnNomeacao" name="fnNomeacao">
                        </div>
                        <div class="form-group">
                            <label for="title">Documentos:</label>
                            <input type="file" class="form-control" name="nmAnexo[]" multiple>
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
                        <div class="container my-3 ps-3 welcomediv bg-seconday">
                            <h1>Representação</h1>
                        </div>
                        <a href="/instituicoes">{{$bread->nmInstituicao}}</a>><a
                            href="/instancias/{{$bread->cdInstituicao}}">{{$bread->nmInstancia}}</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nome Titular</th>
                                <th scope="col">Incio Vigencia</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opções</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($selecionado as $event)
                                <tr>

                                    <?php $var = explode("/", $event->representantes);







                                    ?>

                                    <td scropt="row">@foreach($var as $va)
                                            {{$va}}<br>
                                        @endforeach </td>
                                    <td><a>{!! date('d/m/Y', strtotime($event->dtInicioVigencia)) !!}</a></td>
                                    @if($event->stAtivo ==1)
                                        <td>Ativo</td>
                                    @else
                                        <td>Desativado</td>
                                    @endif

                                    <td>
                                        <a href="/representacoes/edit/{{$event->cdRepresentacao}}"
                                           class="btn btn-info edit-btn"
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
                            <a href="/instancias/{{$bread->cdInstituicao}}" class="btn btn-info mb-2">Voltar</a>

                        </div>

                    </div>

                    <div id="event-create-container" class="container mt-5">

                        <div class="container my-3 ps-3 welcomediv bg-seconday">
                            <h1>Crie sua Representação</h1>
                        </div>
                        <form action="repinsta" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group" style="display:none">
                                <label for="title">Instancia:</label>
                                <select name="cdInstancia" id="cdInstancia" class="form-control">
                                    @foreach ( $instancias as $instancia)

                                        <option
                                            value="{{$instancia->cdInstancia}}"> {{$instancia->nmInstancia}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Inicio da Vigência:</label>
                                <input type="date" class="form-control" id="dtInicioVigencia"
                                       name="dtInicioVigencia"
                                >
                            </div>
                            <div class="form-group">
                                <label for="title">Fim da Vigência:</label>
                                <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia"
                                >
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
                                <label for="title">Designação Suplente:</label>
                                <input type="text" class="form-control" id="dsDesignacao" name="dsDesignacaoSuplente">
                            </div>

                            <div class="form-group">
                                <label for="title">Status:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo"
                                           value="1"
                                    >
                                    <label class="form-check-label" for="stAtivo">
                                        Ativo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo"
                                           value="0"
                                    >
                                    <label class="form-check-label" for="stAtivo">
                                        Desativado
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="title">Número Nomeação:</label>
                                    <input type="number" class="form-control" id="nuNomeacao" name="nuNomeacao">
                                </div>
                                <div class="form-group">
                                    <label for="title">Detalhes Nomeação:</label>
                                    <input type="text" class="form-control" id="fnNomeacao" name="fnNomeacao">
                                </div>
                                <div class="form-group">
                                    <label for="title">Documentos:</label>
                                    <input type="file" class="form-control" name="nmAnexo[]" multiple>
                                </div>

                            </div>
                            <br>
                    </div>

                    <div class="container d-flex justify-content-between mt-2">
                        <a href="/instancias/{{$bread->cdInstituicao}}"
                           class="btn btn-info mb-2">Voltar</a>
                        <input type="submit" class="btn btn-primary mb-2" value="Próximo">
                    </div>
                    </form>
    </div>
    


    @endif

@endsection
