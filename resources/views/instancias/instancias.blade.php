@extends('layout.main')

@section('title', 'Instancias')

@section('content')

    <style>
        a {
            text-decoration: none;
            color: #6f42c1;
        }

        a:hover {
            color: #452680;
        }
    </style>

    @if (is_countable($instancias) && count($instancias) == 0)

        <div class="container">
            @foreach ($instituicaos as $instituicao)
                <h3>Não ha instancia para a Instituição: {{$instituicao->nmInstituicao}}</h3>
                <h1>Crie uma instância</h1>
                <a href="/instituicoes">{{$bread->nmInstituicao}}</a>
                <div id="event-create-container" class="container">
                    <form action="instancias" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nmInstancia">Nome:</label>
                            <input placeholder="Nome..." type="text" class="form-control" id="nmInstancia" required
                                   name="nmInstancia">
                        </div>
                        <div class="form-group" style="display:none">
                            <label for="cdInstituicao">Instituição: </label>
                            <select name="cdInstituicao" id="cdInstituicao" class="form-select">
                                <option
                                    value="{{$instituicao->cdInstituicao}}"> {{$instituicao->nmInstituicao}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cdTema">Tema: </label>
                            <select name="cdTema" id="cdTema" class="form-select">
                                @foreach ($temas as $tema)
                                    <option value="{{$tema->cdTema}}"> {{$tema->nmTema}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dsMandato">Tempo de Mandato:</label>
                            <input placeholder="Mandato..." type="text" class="form-control" id="dsMandato"
                                   name="dsMandato">
                        </div>

                        <div class="form-group">
                            <label for="title">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1">
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
                                <label for="title">Classificação:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tpFederalDistrital"
                                           id="tpFederalDistrital" value="1">
                                    <label class="form-check-label" for="tpFederalDistrital">
                                        Federal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tpFederalDistrital"
                                           id="tpFederalDistrital" value="0">
                                    <label class="form-check-label" for="tpFederalDistrital">
                                        Distrital
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title">Classificação:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tpPublicoPrivado"
                                           id="tpPublicoPrivado"
                                           value="1">
                                    <label class="form-check-label" for="tpPublicoPrivado">
                                        Público
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tpPublicoPrivado"
                                           id="tpPublicoPrivado"
                                           value="0">
                                    <label class="form-check-label" for="tpPublicoPrivado">
                                        Privado
                                    </label>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="dsObjetivo">Descrição Objetivo:</label>
                                <textarea placeholder="Descrição Objetivo..." name="dsObjetivo" id="dsObjetivo"
                                          class="form-control"></textarea>
                            </div>


                            <div class="form-group">
                                <label for="title">Prioridade:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade"
                                           value="1">
                                    <label class="form-check-label" for="tpPrioridade">
                                        Baixa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade"
                                           value="2">
                                    <label class="form-check-label" for="tpPrioridade">
                                        Média
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade"
                                           value="3">
                                    <label class="form-check-label" for="tpPrioridade">
                                        Alta
                                    </label>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="dsAmeacas">Ameaças:</label>
                                <input placeholder="Ameaças..." type="text" class="form-control" id="dsAmeacas"
                                       name="dsAmeacas">
                            </div>
                            <div class="form-group">
                                <label for="dsOportunidades">Oportunidades:</label>
                                <input placeholder="Oportunidades..." type="text" class="form-control"
                                       id="dsOportunidades"
                                       name="dsOportunidades">
                            </div>
                            <div class="form-group">
                                <label for="dsObservacao">Observação:</label>
                                <textarea placeholder="Observações..." type="text" class="form-control"
                                          id="dsObservacao"
                                          name="dsObservacao"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="dsAtoNormativo">Ato Normativo:</label>
                                <textarea placeholder="Observações..." type="text" class="form-control"
                                          id="dsAtoNormativo"
                                          name="dsAtoNormativo"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="title">Carater:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                                           id="boCaraterDaInstancia"
                                           value="1">
                                    <label class="form-check-label" for="boCaraterDaInstancia">
                                        Consultivo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                                           id="boCaraterDaInstancia"
                                           value="0">
                                    <label class="form-check-label" for="boCaraterDaInstancia">
                                        Deliberativo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                                           id="boCaraterDaInstancia"
                                           value="2">
                                    <label class="form-check-label" for="boCaraterDaInstancia">
                                        Consultivo/Deliberativo
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="title">Documentos:</label>
                                    <input type="file" class="form-control" name="nmAnexo[]" multiple>
                                </div>

                            </div>
                            <br>
                            <div class="container d-flex justify-content-between mt-2">
                                <a href="/instituicoes" class="btn btn-info mb-2">Voltar</a>
                                <input type="submit" class="btn btn-primary mb-2" value="Criar">
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        @endforeach
    @else
        <h1>Instâncias</h1>
        <a href="/instituicoes">{{$bread->nmInstituicao}}</a>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Tema</th>
                    <th scope="col">Representantes</th>
                    <th scope="col">Ativo</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($instancias as $instancia)
                    <tr>
                        <td><a>{{ $instancia->nmInstancia }}</a></td>
                        <td>{{$instancia->nmTema}}</td>

                        @if($instancia->stAtivo ==1)
                            <td>Ativo</td>
                        @else
                            <td>Desativado</td>
                        @endif
                        <td>
                            <a href="/instancias/edit/{{$instancia->cdInstancia}}" class="btn btn-info edit-btn"
                               data-bs-toggle="tooltip" data-bs-title="Editar">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <a href="/contatos/listacontato/{{$instancia->cdInstancia}}" class="btn btn-info edit-btn"
                               data-bs-toggle="tooltip" data-bs-title="Contatos">
                                <ion-icon name="person-outline"></ion-icon>
                            </a>
                            <a href="/repinsta/{{$instancia->cdInstancia}}" class="btn btn-info edit-btn"
                               data-bs-toggle="tooltip" data-bs-title="Representação">
                                <ion-icon name="reader-outline"></ion-icon>
                            </a>
                            <form action="/instancias/{{$instancia->cdInstancia}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete-btn"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Deletar">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                </button>
                                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <form action="/instancias/{{$instancia->cdInstituicao}}/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="" name="query" id="query"
                           placeholder="Buscar Instância..."
                           aria-label="Buscar Instância" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/instituicoes" class="btn btn-info mb-2">Voltar</a>
            </div>
            <br>
            <h1>Crie uma instância</h1>
            <form action="instancias" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Nome:</label>
                    <input placeholder="Nome..." type="text" class="form-control" id="nmInstancia" required
                           name="nmInstancia">
                </div>
                <div class="form-group">
                    <label for="title">Tema:</label>
                    <select name="cdTema" id="cdTema" class="form-select">
                        @foreach ($temas as $tema)
                            <option value="{{$tema->cdTema}}"> {{$tema->nmTema}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="display:none">
                    <label for="title">Instituição: </label>
                    <select name="cdInstituicao" id="cdInstituicao" class="form-select">
                        @foreach ($instituicaos as $instituicao)
                            <option
                                value="{{$instituicao->cdInstituicao}}"> {{$instituicao->nmInstituicao}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="Mandato">
                    <label for="dsMandato">Site:</label>
                    <input placeholder="Site..." type="text" class="form-control" id="dsSite"
                           name="dsSite">
                </div>

                <div class="form-group" id="Mandato">
                    <label for="dsMandato">Tempo de Mandato:</label>
                    <input placeholder="Mandato..." type="text" class="form-control" id="dsMandato"
                           name="dsMandato">
                </div>

                <div class="form-group">
                    <label for="title">Classificação:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpFederalDistrital"
                               id="tpFederalDistrital" value="1">
                        <label class="form-check-label" for="tpFederalDistrital">
                            Federal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpFederalDistrital"
                               id="tpFederalDistrital" value="0">
                        <label class="form-check-label" for="tpFederalDistrital">
                            Distrital
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Classificação:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpPublicoPrivado"
                               id="tpPublicoPrivado"
                               value="1">
                        <label class="form-check-label" for="tpPublicoPrivado">
                            Público
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpPublicoPrivado"
                               id="tpPublicoPrivado"
                               value="0">
                        <label class="form-check-label" for="tpPublicoPrivado">
                            Privado
                        </label>
                    </div>

                </div>
                <div class="form-group">
                    <label for="title">Ativo:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1">
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
                        <label for="title">Descrição Objetivo:</label>
                        <textarea placeholder="Descrição Objetivo..." name="dsObjetivo" id="dsObjetivo"
                                  class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="title">Atribuições:</label>
                        <input placeholder="Atribuições..." type="number" class="form-control" id="tpAtribuicoes"
                               name="tpAtribuicoes">
                    </div>
                    <div class="form-group">
                        <label for="title">Prioridade:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade"
                                   value="0">
                            <label class="form-check-label" for="tpPrioridade">
                                Baixa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade"
                                   value="1">
                            <label class="form-check-label" for="tpPrioridade">
                                Média
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade"
                                   value="2">
                            <label class="form-check-label" for="tpPrioridade">
                                Alta
                            </label>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="title">Ameaças:</label>
                        <input placeholder="Ameaças..." type="text" class="form-control" id="dsAmeacas"
                               name="dsAmeacas">
                    </div>
                    <div class="form-group">
                        <label for="title">Oportunidades:</label>
                        <input placeholder="Oportunidades..." type="text" class="form-control"
                               id="dsOportunidades"
                               name="dsOportunidades">
                    </div>
                    <div class="form-group">
                        <label for="title">Observação:</label>
                        <textarea placeholder="Observações..." type="text" class="form-control" id="dsObservacao"
                                  name="dsObservacao"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Ato Normativo:</label>
                        <textarea placeholder="Observações..." type="text" class="form-control" id="dsAtoNormativo"
                                  name="dsAtoNormativo"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Carater:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                                   id="boCaraterDaInstancia"
                                   value="1">
                            <label class="form-check-label" for="boCaraterDaInstancia">
                                Consultivo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                                   id="boCaraterDaInstancia"
                                   value="0">
                            <label class="form-check-label" for="boCaraterDaInstancia">
                                Deliberativo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                                   id="boCaraterDaInstancia"
                                   value="2">
                            <label class="form-check-label" for="boCaraterDaInstancia">
                                Consultivo/Deliberativo
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="title">Documentos:</label>
                            <input type="file" class="form-control" name="nmAnexo[]" multiple>
                        </div>

                    </div>
                    <br>
                    <div class="container d-flex justify-content-between mt-2">
                        <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                        <input type="submit" class="btn btn-primary mb-2" value="criar">
                    </div>
            </form>
        </div>
        </div>

    @endif

@endsection
