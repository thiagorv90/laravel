@extends('layout.main')

@section('title', 'Instancias')

@section('content')
    @if (is_countable($instancias) && count($instancias) == 0)

        <div class="container">
            @foreach ($instituicaos as $instituicao)
                <h3>Não ha instancia para a Instituição:{{$instituicao->nmInstituicao}}</h3>
                <h1>Crie uma instância</h1>
                <div id="event-create-container" class="col-md-10 offset-md-1">
                    <form action="instancias" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Nome:</label>
                            <input placeholder="Nome..." type="text" class="form-control" id="nmInstancia"
                                   name="nmInstancia">
                        </div>
                        <div class="form-group">
                            <label for="title">Instituição: </label>
                            <select name="cdInstituicao" id="cdInstituicao" class="form-select">
                                <option
                                    value="{{$instituicao->cdInstituicao}}"> {{$instituicao->nmInstituicao}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Tema: </label>
                            <select name="cdTema" id="cdTema" class="form-select">
                                @foreach ($temas as $tema)
                                    <option value="{{$tema->cdTema}}"> {{$tema->nmTema}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Mandato:</label>
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
                                <input placeholder="Observações..." type="text" class="form-control" id="dsObservacao"
                                       name="dsObservacao">
                            </div>
                            <div class="form-group">
                                <label for="title">Ato Normativo:</label>
                                <input placeholder="Observações..." type="text" class="form-control" id="dsAtoNormativo"
                                       name="dsAtoNormativo">
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

                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Criar Instância">
                    </form>
                </div>
            @endforeach
            @else
                <h1>Instâncias</h1>
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
                                <td>{{$instancia->nmRepresentanteSuplente}}</td>
                                @if($instancia->stAtivo ==1)
                                    <td>Ativo</td>
                                @else
                                    <td>Desativado</td>
                                @endif
                                <td><a href="/instancias/{{$instancia->cdInstancia}}" class="btn btn-info edit-btn">
                                        <ion-icon name="search-outline"></ion-icon>
                                    </a>
                                    <a href="/instancias/edit/{{$instancia->cdInstancia}}"
                                       class="btn btn-info edit-btn">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <a href="/contatos/listacontato/{{$instancia->cdInstancia}}"
                                       class="btn btn-info edit-btn">
                                        <ion-icon name="person-outline"></ion-icon>
                                    </a>
                                    <a href="/repinsta/{{$instancia->cdInstancia}}" class="btn btn-info edit-btn">
                                        <ion-icon name="reader-outline"></ion-icon>
                                    </a>
                                    


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
                    <br>
                    <h1>Crie uma instância</h1>
                    <form action="instancias" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Nome:</label>
                            <input placeholder="Nome..." type="text" class="form-control" id="nmInstancia"
                                   name="nmInstancia">
                        </div>
                        <div class="form-group">
                            <label for="title">Instituição: </label>
                            <select name="cdInstituicao" id="cdInstituicao" class="form-select">
                                @foreach ($instituicaos as $instituicao)
                                    <option
                                        value="{{$instituicao->cdInstituicao}}"> {{$instituicao->nmInstituicao}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Tema:</label>
                            <select name="cdTema" id="cdTema" class="form-select">
                                @foreach ($temas as $tema)
                                    <option value="{{$tema->cdTema}}"> {{$tema->nmTema}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Mandato:</label>
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
                                <input placeholder="Observações..." type="text" class="form-control" id="dsObservacao"
                                       name="dsObservacao">
                            </div>
                            <div class="form-group">
                                <label for="title">Ato Normativo:</label>
                                <input placeholder="Observações..." type="text" class="form-control" id="dsAtoNormativo"
                                       name="dsAtoNormativo">
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

                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary mb-2" value="Criar Instância">
                    </form>
                </div>
        </div>
        </div>
    @endif

@endsection
