@extends('layout.main')

@section('title', 'Editando Representante')

@section('content')

<style>
    
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

    @foreach ($selecionado as $age)
        <div id="event-create-container" class="container">

            <div class="container my-3 ps-3 welcomediv bg-seconday">
                <h1>Editar dados</h1>
           

            <h5>Representante: {{$age->nmRepresentanteSuplente}}</h5>
            </div>

            <form action="/repsup/update/{{ $age->cdRepSup}}" method="POST">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="date">Nome:</label>
                    <input type="text" class="form-control" id="nmRepresentanteSuplente" name="nmRepresentanteSuplente"
                           value="{{$age->nmRepresentanteSuplente}}">
                </div>
                <div class="form-group">
                    <label for="title">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="dtNascimento" name="dtNascimento"
                           value="{{$age->dtNascimento}}">
                </div>

                <div class="form-group">
                    <label for="title">Escolaridade:</label>
                    <select id="cdEscolaridade" name="cdEscolaridade" class="form-select">
                        @foreach($escola as $e)
                            <option value="{{$e->cdEscolaridade}}"
                                    @if ($age->cdEscolaridade == $e->cdEscolaridade) selected @endif >
                                {{ $e->dsEscolaridade }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" id="dsEmail" name="dsEmail" value="{{$age->dsEmail}}"
                           required>
                </div>

                <div class="form-group">
                    <label for="title">Email Alternativo:</label>
                    <input type="text" class="form-control" id="dsEmailAlternativo" name="dsEmailAlternativo"
                           value="{{$age->dsEmailAlternativo}}">
                </div>
                <div class="form-group">
                    <label for="title">Profissão:</label>
                    <input type="text" class="form-control" id="dsProfissao" name="dsProfissao"
                           value="{{$age->dsProfissao}}">
                </div>
                <div class="form-group">
                    <label for="title">Empresa:</label>
                    <select id="cdEmpresa" name="cdEmpresa" class="form-select">
                        @foreach($lista as $emp)
                            <option value="{{$age->cdEmpresa}}">
                                {{ $emp->nmEmpresa }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Ativo:</label>


                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                               @if($age->stAtivo ==1) checked @endif >
                        <label class="form-check-label" for="stAtivo">
                            Ativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                               @if($age->stAtivo ==0) checked @endif >
                        <label class="form-check-label" for="stAtivo">
                            Desativado
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Endereço:</label>
                    <input name="dsEndereco" id="dsEndereco" class="form-control" value="{{$age->dsEndereco}}"
                    >
                </div>


                <div class="form-group">
                    <label for="title"> Bairro:</label>
                    <input name="dsBairro" id="dsBairro" class="form-control" value="{{$age->dsBairro}}"
                    >
                </div>
                <div class="form-group">
                    <label for="title"> Cidade:</label>
                    <input name="dsCidade" id="dsCidade" class="form-control" value="{{$age->dsCidade}}"
                    >
                </div>
                <div class="form-group">
                    <label for="title"> CEP:</label>
                    <input name="dsCEP" id="dsCEP" class="form-control" value="{{$age->dsCEP}}"
                    >
                </div>

                <div class="form-group">
                    <label for="title">Observação:</label>
                    <textarea type="text" rows="10" class="form-control" id="dsObservacao" name="dsObservacao"
                    >{{$age->dsObservacao}}</textarea>
                </div>
                <br>
                <div class="container d-flex justify-content-between mt-2">
                    <a href="/repsup" class="btn btn-info mb-2">Voltar</a>

                    <input type="submit" class="btn btn-primary mb-2" value="Salvar">

                </div>
            </form>
           
            <div id="" class="container my-3 ps-3 welcomediv">
            <h1>Documentos do(a) Representante</h1>
            </div>
            @foreach ($anexo as $ane)

                <form action="/repsup/files/{{$ane->nmAnexo}}" method="POST">
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


            <form action="/repsup/file/{{$age->cdRepSup}}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="title">Documentos:</label>
                    <input type="file" class="form-control" id="nmAnexo" name="nmAnexo[]" multiple>
                </div>
                <div class="container d-flex justify-content-between mt-2">
                    <a href="/representacoes/{{$age->cdInstancia}}" class="btn btn-info mb-2">Voltar</a>
                    <input type="submit" class="btn btn-primary mb-2" value="Incluir"></div>
            </form>
        </div> @endforeach

        </div>



        @endsection
