@extends('layout.main')

@section('title', 'Editando instancia')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Editar</h1>
        @foreach ($edit as $instituicao)
            <form action="/instancias/update/{{ $instituicao->cdInstancia}}" method="POST">

                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Nome:</label>
                    <input type="text" class="form-control" id="nmInstancia" name="nmInstancia"
                           value="{{$instituicao->nmInstancia}}">
                </div>
                <div class="form-group" style="display:none">
                    <label for="title">Instituição: </label>
                    <select name="cdInstituicao" id="cdInstituicao" class="form-control">

                        <option value="{{$instituicao->cdInstituicao}}"> {{$instituicao->nmInstituicao}}</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Tema: </label>
                    <select name="cdTema" id="cdTema" class="form-control">
                    <option value="{{$instituicao->cdTema}}"> {{$instituicao->nmTema}}</option>
                    @foreach($tema as $tem)
                            <option value="{{$tem->cdTema}}"> {{$tem->nmTema}}</option>
                        @endforeach

                    </select>
                </div>
               
               
                        <div class="form-group" id="Mandato" >
                            <label for="dsMandato">Mandato:</label>
                            <input placeholder="Mandato..." type="text" class="form-control" id="dsMandato" value="{{$instituicao->dsMandato}}"
                                   name="dsMandato">
                        </div>
                       
                <div class="form-group">
                    <label for="title">Classificação:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpFederalDistrital" id="tpFederalDistrital"
                               value="1" @if($instituicao->tpFederalDistrital ==1) checked @endif >
                        <label class="form-check-label" for="tpFederalDistrital">
                            Federal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpFederalDistrital" id="tpFederalDistrital"
                               value="0" @if($instituicao->tpFederalDistrital ==0) checked @endif >
                        <label class="form-check-label" for="tpFederalDistrital">
                            Distrital
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Classificação:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpPublicoPrivado" id="tpPublicoPrivado"
                               value="1" @if($instituicao->tpPublicoPrivado ==1) checked @endif >
                        <label class="form-check-label" for="tpPublicoPrivado">
                            Público
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpPublicoPrivado" id="tpPublicoPrivado"
                               value="0" @if($instituicao->tpPublicoPrivado ==0) checked @endif >
                        <label class="form-check-label" for="tpPublicoPrivado">
                            Privado
                        </label>
                    </div>

                </div>
                <div class="form-group">
                    <label for="title">Status:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                               @if($instituicao->stAtivo ==1) checked @endif >
                        <label class="form-check-label" for="stAtivo">
                            Ativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                               @if($instituicao->stAtivo ==0) checked @endif >
                        <label class="form-check-label" for="stAtivo">
                            Desativado
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="title">Descrição Objetivo:</label>
                        <textarea name="dsObjetivo" id="dsObjetivo" class="form-control"
                              >{{$instituicao->dsObjetivo}}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="title">Prioridade:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade" value="1"
                                   @if($instituicao->tpPrioridade ==1) checked @endif >
                            <label class="form-check-label" for="tpPrioridade">
                                Baixa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade" value="2"
                                   @if($instituicao->tpPrioridade ==2) checked @endif >
                            <label class="form-check-label" for="tpPrioridade">
                                Média
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade" value="3"
                                   @if($instituicao->tpPrioridade ==3) checked @endif >
                            <label class="form-check-label" for="tpPrioridade">
                                Alta
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dsAmeacas">Ameaças:</label>
                    <input type="text" class="form-control" id="dsAmeacas" name="dsAmeacas"
                           value="{{$instituicao->dsAmeacas}}">
                </div>
                <div class="form-group">
                    <label for="dsOportunidades">Oportunidades:</label>
                    <input type="text" class="form-control" id="dsOportunidades" name="dsOportunidades"
                           value="{{$instituicao->dsOportunidades}}">
                </div>
                <div class="form-group">
                    <label for="dsObservacao">Observação:</label>
                    <textarea type="text" class="form-control" id="dsObservacao" name="dsObservacao"
                           >{{$instituicao->dsObservacao}}</textarea>
                </div>
                <div class="form-group">
                    <label for="dsAtoNormativo">Ato Normativo:</label>
                    <textarea placeholder="Observações..." type="text" class="form-control" id="dsAtoNormativo"
                           name="dsAtoNormativo" >{{$instituicao->dsAtoNormativo}}</textarea>
                </div>
                <div class="form-group">
                    <label for="title">Carater:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                               id="boCaraterDaInstancia"
                               value="1" @if($instituicao->boCaraterDaInstancia ==1) checked @endif >
                        <label class="form-check-label" for="boCaraterDaInstancia">
                            Consultivo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                               id="boCaraterDaInstancia"
                               value="0" @if($instituicao->boCaraterDaInstancia ==0) checked @endif >
                        <label class="form-check-label" for="boCaraterDaInstancia">
                            Deliberativo
                        </label>
                    </div>
                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="boCaraterDaInstancia"
                                           id="boCaraterDaInstancia"
                                           value="2" @if($instituicao->boCaraterDaInstancia ==2) checked @endif >
                                    <label class="form-check-label" for="boCaraterDaInstancia">
                                    Consultivo/Deliberativo
                                    </label>
                                </div>

                </div>
                <br>
                <div class="container d-flex justify-content-between mt-2">
                    <a href="/instancias/{{$instituicao->cdInstituicao}}" class="btn btn-info mb-2">Voltar</a>
                    <input type="submit" class="btn btn-primary mb-2" value="Salvar">
                </div>
                @endforeach

            </form>
            <h1>Documentos da Instancia</h1>
            @foreach ($anexo as $ane)

                <form action="/instancias/files/{{$ane->nmAnexo}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger delete-btn" data-bs-toggle="tooltip"
                                data-bs-title="Deletar">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                        <label for="title">&nbsp;Arquivo:</label>
                        <a href="{{url('/downloadAgen',urlencode($ane->nmAnexo))}}">{{$ane->nmOriginal}}</a>


                    </div>
                </form>
            @endforeach


            <form action="/instancias/file/{{$instituicao->cdInstancia}}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="title">Documentos:</label>
                    <input type="file" class="form-control" id="nmAnexo" name="nmAnexo[]" multiple>
                </div>
                <div class="container d-flex justify-content-between mt-2">
                    <a href="/instancias/{{$instituicao->cdInstituicao}}" class="btn btn-info mb-2">Voltar</a>
                    <input type="submit" class="btn btn-primary mb-2" value="Incluir"></div>
            </form>
    </div>

    </div>

@endsection
