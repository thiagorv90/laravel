@extends('layout.main')

@section('title', 'Telefone Representante Suplente ')

@section('content')
    @if (is_countable($selecionado) && count($selecionado) == 0)
        @foreach ($telefones as $telefone)
            <h3>Não ha telefone para este representante: {{$telefone->nmRepresentanteSuplente}}</h3>
            <h1>Crie telefone</h1>

            <div id="event-create-container" class="container">
                <form action="telrepsup" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Telefone:</label>
                        <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone"
                               name="nuTelefone">
                    </div>
                    <div class="form-group">
                        <label for="title">DDD:</label>
                        <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone"
                               name="nuDDDTelefone">
                    </div>

                    <div class="form-group">
                        <label for="title">Representante:</label>
                        <select name="cdRepSup" id="cdRepSup" class="form-select">
                            <option value="{{$telefone->cdRepSup}}"> {{$telefone->nmRepresentanteSuplente}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Tipo:</label>
                        <select name="tpTelefone" id="tpTelefone" class="form-select">
                            <option value="0">Celular</option>
                            <option value="1">Fixo</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary mt-2" value="Criar Telefone">
                </form>
            </div>
        @endforeach
    @else
            <h1>Contatos de </h1>
            <div class="container">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($selecionado as $event)

                    <tr>
                        <td scropt="row">{{$event->cdTelefone}}</td>
                        <td><a>{{ $event->nuTelefone }}</a></td>
                        <td class="d-flex">
                            <a href="/telrepsup/edit/{{$event->cdTelefone}}"  class="btn btn-info edit-btn me-2"
                               data-bs-toggle="tooltip" data-bs-title="Editar">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <form action="/telrepsup/edit/{{ $event->cdTelefone }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn"
                                        data-bs-toggle="tooltip" data-bs-title="Apagar">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @endforeach


                    </tbody>
                </table>

            </div>

            <h1>Crie telefone</h1>

            <div id="event-create-container" class="container">
                <form action="telrepsup" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">DDD:</label>
                        <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone"
                               name="nuDDDTelefone"/>
                    </div>

                    <div class="form-group">
                        <label for="title">Telefone:</label>
                        <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone"
                               name="nuTelefone">
                    </div>

                    <div class="form-group">
                        <label for="title">Representante:</label>
                        <select name="cdRepSup" id="cdRepSup" class="form-select">
                            @foreach ($telefones as $telefone)
                                <option value="{{$telefone->cdRepSup}}"> {{$telefone->nmRepresentanteSuplente}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Tipo:</label>
                        <select name="tpTelefone" id="tpTelefone" class="form-select">
                            <option value="0">Celular</option>
                            <option value="1">Fixo</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary mt-3 mb-2" value="Criar Telefone">
                </form>
            </div>


    @endif

@endsection
