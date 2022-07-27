@extends('layout.main')

@section('title', 'Telefone Representante Suplente ')

@section('content')
    @if (is_countable($selecionado) && count($selecionado) == 0)
       
            <h3>Não ha telefone para esta Representante:{{$telefone->nmRepresentanteSuplente}}</h3>
            <h1>Crie telefone</h1>

            <div id="event-create-container" class="col-md-10 offset-md-1">
                <form action="telrepsup" method="POST">
                @foreach ($telefones as $telefone)
                    @csrf
                    <div class="form-group">
                        <label for="title">nuTelefone</label>
                        <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone"
                               name="nuTelefone">
                    </div>
                    <div class="form-group">
                        <label for="title">nuDDDTelefone</label>
                        <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone"
                               name="nuDDDTelefone">
                    </div>

                    <div class="form-group">
                        <label for="title">cdRepSup</label>
                        <select name="cdRepSup" id="cdRepSup" class="form-select">
                            <option value="{{$telefone->cdRepSup}}"> {{$telefone->nmRepresentanteSuplente}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">tpTelefone</label>
                        <select name="tpTelefone" id="tpTelefone" class="form-select">
                            <option value="0">Celular</option>
                            <option value="1">Fixo</option>
                        </select>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Criar Telefone">
                </form>
            </div>
        @endforeach
    @else
        
            <<h1>Contatos do(a) Representante:</h1>
            <div class="col-md-10 offset-md-1 dashboard-events-container">
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
                        <td class="alterar-deletar"><a href="/telrepsup/edit/{{$event->cdTelefone}}"
                                                       class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <form action="/telrepsup/edit/{{ $event->cdTelefone }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <br>
            <br>
            <br>
            <h1>Crie telefone</h1>

            <div id="event-create-container" class="col-md-10 offset-md-1">
                <form action="telrepsup" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">nuTelefone</label>
                        <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone"
                               name="nuTelefone">
                    </div>
                    <div class="form-group">
                        <label for="title">nuDDDTelefone</label>
                        <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone"
                               name="nuDDDTelefone">
                    </div>

                    <div class="form-group">
                        <label for="title">cdRepSup</label>
                        <select name="cdRepSup" id="cdRepSup" class="form-select">
                            @foreach ($telefones as $telefone)
                                <option value="{{$telefone->cdRepSup}}"> {{$telefone->nmRepresentanteSuplente}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">tpTelefone</label>
                        <select name="tpTelefone" id="tpTelefone" class="form-select">
                            <option value="0">Celular</option>
                            <option value="1">Fixo</option>
                        </select>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Criar Telefone">
                </form>
            </div>

        

    @endif

@endsection
