@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')


<style>
    a {
        text-decoration: none;
        color: #6f42c1;
    }

    a:hover {
        color: #452680;
    }

    .welcomediv{
    color: white;
    background: rgb(153, 114, 187);
    background: linear-gradient(90deg, rgba(156,104,203,1) 35%, rgba(182,154,233,1) 100%);
    border: 2px solid rgb(255, 255, 255);
    box-shadow: #ebe9e9 1px 1px 4px 3px; 
    font-family: 'Montserrat', sans-serif;
    transition: all 1.5s;
    padding: 3px;
    }
</style>

    <div id="event-create-container" class="container">
        
        <div class="container my-3 ps-2 welcomediv">
        <h1>Agenda</h1>
        </div>
        
        <a href="/instituicoes">{{$bread->nmInstituicao}}</a>><a
            href="/instancias/{{$bread->cdInstituicao}}">{{$bread->nmInstancia}}</a>>{{$bread->nmRepresentanteSuplente}}

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Representantes</th>
                <th scope="col">Status</th>

                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            @foreach($repre as $instancia)
                <tr>
                    <td><a>{{ $instancia->nmRepresentanteSuplente }}</a></td>


                    @if($instancia->stTitularidade ==1)
                        <td>Titular</td>
                    @else
                        <td>Suplente</td>
                    @endif
                    <td>
                        <a href="/instancias/edit/" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Editar">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                        <a href="/contatos/listacontato/" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Contatos">
                            <ion-icon name="person-outline"></ion-icon>
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @foreach ($selecionado as $age)

            <form action="/agendas/update/{{ $age->cdAgenda}}" method="POST">
                @csrf

                @method('PUT')

                <div class="form-group">
                    <label for="date">Data:</label>
                    <input type="text" placeholder="{{ $age->dtAgenda }}" onfocus="(this.type='date')" id="dtAgenda"
                           name="dtAgenda" class="form-control"
                           @if(auth()->user()->statusadm ==0) Readonly @endif></input>
                </div>

                <div class="form-group">
                    <label for="title">Hora:</label>
                    <input type="text" class="form-control" id="hrAgenda" name="hrAgenda" value="{{$age->hrAgenda}}"
                           @if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>
                <div class="form-group">
                    <label for="title">Assunto:</label>
                    <input type="text" class="form-control" id="dsAssunto" name="dsAssunto" value="{{$age->dsAssunto}}"
                           @if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>


                <div class="form-group">
                    <label for="title">Status:</label>
                    <div class="form-check">
                        @if(auth()->user()->statusadm ==1)
                            <input class="form-check-input" type="radio" name="stAgenda" id="stAgenda" value="1"
                                   @if($age->stAgenda ==1) checked
                                   @endif @if(auth()->user()->statusadm ==0) Readonly @endif >

                            <label class="form-check-label" for="stAgenda">
                                Ativo
                            </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAgenda" id="stAgenda" value="0"
                               @if($age->stAgenda ==0) checked
                               @endif @if(auth()->user()->statusadm ==0) Readonly @endif >
                        <label class="form-check-label" for="stAgenda">
                            Desativado
                        </label>
                        @else
                            <input class="form-check-input" type="hidden" name="stAgenda" id="stAgenda"
                                   value="{{$age->stAgenda}}">
                            @if($age->stAgenda ==1)

                                <td>Ativo</td>
                            @else
                                <td>Desativado</td>
                            @endif

                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Local:</label>
                    <input type="text" class="form-control" id="dsLocal" name="dsLocal" value="{{$age->dsLocal}}"
                           @if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>

                <div class="form-group">
                    <label for="title">Suplente:</label>
                    <div class="form-check">
                        @if(auth()->user()->statusadm ==1)
                            <input class="form-check-input" type="radio" name="stSuplente" id="stSuplente" value="1"
                                   @if($age->stSuplente ==1) checked
                                   @endif @if(auth()->user()->statusadm ==0) Readonly @endif >
                            <label class="form-check-label" for="stSuplente">
                                Ativo
                            </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stSuplente" id="stSuplente" value="0"
                               @if($age->stSuplente ==0) checked
                               @endif @if(auth()->user()->statusadm ==0) Readonly @endif >
                        <label class="form-check-label" for="stSuplente">
                            Desativado
                        </label>
                        @else
                            <input class="form-check-input" type="hidden" name="stSuplente" id="stSuplente"
                                   value="{{$age->stSuplente}}">
                            @if($age->stSuplente ==1)
                                <td>Ativo</td>
                            @else
                                <td>Desativado</td>
                            @endif
                        @endif

                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Pauta:</label>
                    <input type="textarea" class="form-control" id="dsPauta" name="dsPauta" value="{{$age->dsPauta}}"
                           @if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>
                <div class="form-group">
                    <label for="title">Resumo:</label>
                    <textarea type="textarea" class="form-control" id="dsResumo" name="dsResumo"
                    >{{$age->dsResumo}}</textarea>
                </div>

                <br>
                <div class="container d-flex justify-content-between mt-2">
                    <a href="/agendas/{{ $age->cdRepresentacao }}" class="btn btn-info mb-2">Voltar</a>
                    <input type="submit" class="btn btn-primary mb-2" value="Salvar">
                </div>
            </form>
            <div class="container my-3 ps-2 welcomediv">
            <h1>Documentos da Agenda</h1>
            </div>
            @foreach ($anexo as $ane)

                <form action="/agendas/files/{{$ane->nmAnexo}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        @if(auth()->user()->statusadm ==1)
                            <button type="submit" class="btn btn-danger delete-btn" data-bs-toggle="tooltip"
                                    data-bs-title="Deletar">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        @endif
                        <label for="title">&nbsp;Arquivo:</label>
                        <a href="{{url('/downloadAgen',urlencode($ane->nmAnexo))}}">{{$ane->nmOriginal}}</a>


                    </div>
                </form>
            @endforeach

            <form action="/agendas/file/{{$age->cdAgenda}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Documento:</label>
                    <input type="file" class="form-control" id="nmAnexo" name="nmAnexo[]" multiple>
                </div>
                <div class="container d-flex justify-content-between mt-2">
                    <a href="/agendas/{{ $age->cdRepresentacao }}" class="btn btn-info mb-2">Voltar</a>
                    <input type="submit" class="btn btn-primary mb-2" value="Salvar"></div>

            </form>
    </div>
    @endforeach

@endsection
