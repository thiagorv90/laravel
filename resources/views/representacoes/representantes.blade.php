@extends('layout.main')

@section('title', 'Editando Representações')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Representantes</h1>
        @if ($teste <>1)
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
                                <form action="/representacoes/representantes/{{$event->cdRepSup}}" method="POST">
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
                        Representante
                    </label>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="stTitularidade" id="stTitularidade" value="0">
                <label class="form-check-label" for="stTitularidade">
                    Suplente
                </label>
            </div>
            <div class="form-group" style="display:none">

                <input type="text" class="form-control" id="cdRepresentacao" value="{{$event->cdRepresentacao}}"
                       name="cdRepresentacao">
            </div>
            <input type="submit" class="btn btn-primary mb-2" value="Incluir">
        </form>
        <input type="submit" class="btn btn-primary mb-2" value="Salvar">


    </div>

@endsection
