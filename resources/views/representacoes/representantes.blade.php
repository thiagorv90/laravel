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

    <div id="event-create-container" class="container">
        <h1>Representantes</h1>

        @if ($teste <>1)
            <a href="/instituicoes">{{$bread->nmInstituicao}}</a>><a
                href="/instancias/{{$bread->cdInstituicao}}">{{$bread->nmInstancia}}</a>
            <div class="container">


                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nome:</th>
                        <th scope="col">Status</th>
                        <th scope="col">Opções</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($incluidos as $incluido)
                        <tr>

                            <td scropt="row">{{$incluido->nmRepresentanteSuplente}}</td>

                            @if($incluido->stTitularidade ==1)
                                <td>Titular</td>
                            @else
                                <td>Suplente</td>
                            @endif

                            <td>
                                <form action="/representacoes/representantes/{{$incluido->cdRepSup}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn" data-bs-toggle="tooltip"
                                            data-bs-title="Deletar">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </diV>
        @endif

        <form action="/representacoes/representantes/{{$event->cdRepresentacao}}" method="POST"
              enctype='multipart/form-data'>
            @csrf

            <div class="form-group">
                <label for="cdRepSup">Representante: </label>
                <select name="cdRepSup" id="cdRepSup" class="form-select">
                    @foreach($representantes as $representante)
                        <option
                            value="{{$representante->cdRepSup}}"> {{$representante->nmRepresentanteSuplente}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Status:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="stTitularidade" id="stTitularidade"
                           value="1">
                    <label class="form-check-label" for="stTitularidade">
                        Titular
                    </label>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="stTitularidade" id="stTitularidade" value="0">
                <label class="form-check-label" for="stTitularidade">
                    Suplente
                </label>
            </div>
            <div class="form-group">
                <label for="title">Data de Nomeação:</label>
                <input type="date" class="form-control" id="dtInicioNomeacao" name="dtInicioNomeacao">
            </div>
            <div class="form-group" style="display:none">

                <input type="text" class="form-control" id="cdRepresentacao" value="{{$event->cdRepresentacao}}"
                       name="cdRepresentacao">
            </div>
            <input type="submit" class="btn btn-primary mb-2" value="Incluir">
        </form>
        @if ($teste <>1)
            <a href="/repinsta/{{$bread->cdInstancia}}" class="btn btn-info mb-2">Voltar</a>
        @endif

    </div>

@endsection
