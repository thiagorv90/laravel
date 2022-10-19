@extends('layout.main')

@section('title', 'Editando Representações')

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
        <div class="container my-3 ps-3 welcomediv bg-seconday">
            <h1>Editar Representantes</h1>
        </div>
        <a href="/instituicoes">{{$bread->nmInstituicao}}</a>><a
                            href="/instancias/{{$bread->cdInstituicao}}">{{$bread->nmInstancia}}</a>
        <div class="container">


            <table class="table" id='empTable'>
                <thead>
                <tr>
                    <th scope="col">Nome:</th>
                    <th scope="col">Tiluridade</th>
                    <th scope="col">Inicio Nomeação</th>
                    <th scope="col">Fim Nomeação</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Opções</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($representantes as $incluido)
                    <tr>

                        <td scropt="row">{{$incluido->nmRepresentanteSuplente}}</td>

                        @if($incluido->stRepresentante ==1)
                            <td>Titular</td>
                        @else
                            <td>Suplente</td>

                        @endif
                        @if ($incluido->dtInicioNomeacao == '')
                            <td></td>
                        @else
                            <td>{!! date('d/m/Y', strtotime($incluido->dtInicioNomeacao)) !!}</td>
                        @endif
                        @if ($incluido->dtFimNomeacao == '')
                            <td></td>
                        @else

                            <td>{!! date('d/m/Y', strtotime($incluido->dtFimNomeacao)) !!}</td>
                        @endif
                        @if($incluido->stTitularidade ==1)
                            <td>Ativo</td>
                        @else
                            <td>Inativo</td>

                        @endif
                        <td>
                            <!-- Botão que chama a modal -->
                            <button class="btn btn-info edit-btn viewdetails" data-id='{{ $incluido->cdRepSup }}'
                                    data-bs-toggle="tooltip" data-bs-title="Editar">
                                <ion-icon name="create-outline"></ion-icon>
                            </button>


                            <button class="btn btn-danger delete-btn ml-2 deldetails"
                                    data-id='{{ $incluido->cdRepSup }}'
                                    data-bs-toggle="tooltip" data-bs-title="Deletar">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        @foreach ($selecionado as $age)
            <form action="/representacoes/edit/{{$age->cdRepresentacao}}" method="POST"
                  enctype='multipart/form-data'>
                @csrf
                @endforeach
                <div class="form-group">
                    <label for="cdRepSup">Representante: </label>
                    <select name="cdRepSup" id="cdRepSup" class="form-select">
                        @foreach($titulares as $representante)
                            <option
                                value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Status:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stRepresentante" id="stRepresentante"
                               value="1">
                        <label class="form-check-label" for="stRepresentante">
                            Titular
                        </label>
                    </div>
                </div>
                <div class="form-check">

                    <input class="form-check-input" type="radio" name="stRepresentante" id="stRepresentante" value="0">
                    <label class="form-check-label" for="stRepresentante">
                        Suplente
                    </label>
                </div>
                <div class="form-group">
                    <label for="title">Data de Nomeação:</label>
                    <input type="date" class="form-control" id="dtInicioNomeacao" name="dtInicioNomeacao">
                </div>
                <div class="form-group">
                                <label for="dsAmeacas">Designação:</label>
                                <input placeholder="Designação..." type="text" class="form-control" id="dsDesiginacao"
                                       name="dsDesiginacao">
                            </div>
                            <div class="form-group">
                                <label for="dsOportunidades">Nomeação:</label>
                                <input placeholder="Nomeação..." type="text" class="form-control"
                                       id="dsNomeacao"
                                       name="dsNomeacao">
                            </div>
                <br>
                <input type="submit" class="btn btn-primary mb-2" value="Incluir">
            </form>

            <div class="container my-3 ps-3 welcomediv bg-seconday">
                <h1>Editar Representação</h1>
            </div>

            @foreach ($selecionado as $age)

                <form action="/representacoes/update/{{ $age->cdRepresentacao}}" method="POST"
                      enctype='multipart/form-data'>
                    @csrf

                    @method('PUT')

                    <div class="form-group" style="display:none">
                        <label for="title">Inicio Vigencia:</label>
                        <input type="text" class="form-control" id="cdRepresentacao" name="cdRepresentacao"
                               value="{{$age->cdRepresentacao}}">
                    </div>
                    <div class="form-group" style="display:none">
                        <label for="title">Instancias:</label>
                        <select id="cdInstancia" name="cdInstancia" class="form-select">
                            @foreach($lista as $i)
                                <option value="{{$i->cdInstancia}}"
                                        @if ($age->cdInstancia == $i->cdInstancia) selected @endif >
                                    {{ $i->nmInstancia }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Inicio Vigencia:</label>
                        <input type="date" class="form-control" id="dtInicioVigencia" name="dtInicioVigencia"
                               value={{$age->dtInicioVigencia}}>
                    </div>

                    <div class="form-group">
                        <label for="title">Fim Vigencia:</label>
                        <input type="date" class="form-control" id="dtFimVigencia" name="dtFimVigencia"
                               value={{$age->dtFimVigencia}}>
                    </div>

                    <div class="form-group">
                        <label for="title">Status:</label>
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
                            <label for="title">Obsvervação:</label>
                            <textarea placeholder="Observação..." name="dsObservacao" rows="10"
                                          id="dsObservacao"

                                          class="form-control">{{$age->dsObservacao}}</textarea>
                        </div>

                    <div class="container d-flex justify-content-between mt-2">
                        <a href="/repinsta/ {{ $age->cdInstancia }}" class="btn btn-info mb-2">Voltar</a>
                        <input type="submit" class="btn btn-primary mb-2" value="Salvar">
                    </div>
                </form>
    </div>
    <div class="container my-3 ps-3 welcomediv bg-seconday">
        <h1>Documentos da Representação</h1>
    </div>
    @foreach ($anexo as $ane)

        <form action="/representacoes/files/{{$ane->nmAnexo}}" method="POST">
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


    <form action="/representacoes/file/{{$age->cdRepresentacao}}" method="POST" enctype="multipart/form-data">
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

    <!-- Modal --->
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="empModal">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Representante</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="tblempinfo">

                    </div>
                    <div class="modal-footer">
                        <button id="certo" type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal --->
        <div class="container">
            <!-- Modal Delete-->
            <div class="modal fade" id="empModaldel">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Exclusão</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="tblempinfodel">

                        </div>

                    </div>
                </div>
            </div>
            <!--Script do Modal delete-->
            <script type='text/javascript'>

                $(document).ready(function () {

                    $('#empTable').on('click', '.deldetails', function () {


                        var empid = $(this).attr('data-id');

                        if (empid > 0) {

                            // AJAX request
                            var url = "{{ route('delEmployeeDetails',[':empid']) }}";
                            url = url.replace(':empid', empid);

                            // Empty modal data
                            $('#tblempinfodel').empty();

                            $.ajax({
                                url: url,
                                dataType: 'json',
                                success: function (response) {

                                    // Add employee details
                                    $('#tblempinfodel').html(response.html);

                                    // Display Modal
                                    $('#empModaldel').modal('show');

                                }
                            });
                        }
                    });

                });
            </script>


            <!--Script do Modal-->
            <script type='text/javascript'>

                $(document).ready(function () {

                    $('#empTable').on('click', '.viewdetails', function () {


                        var empid = $(this).attr('data-id');

                        if (empid > 0) {

                            // AJAX request
                            var url = "{{ route('getEmployeeDetails',[':empid']) }}";
                            url = url.replace(':empid', empid);

                            // Empty modal data
                            $('#tblempinfo').empty();

                            $.ajax({
                                url: url,
                                dataType: 'json',
                                success: function (response) {

                                    // Add employee details
                                    $('#tblempinfo').html(response.html);

                                    // Display Modal
                                    $('#empModal').modal('show');

                                }
                            });
                        }
                    });

                });
            </script>

@endsection
