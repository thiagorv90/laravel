@extends('layout.main')

@section('title', 'Telefone Contatos')

@section('content')

    <div class="container">
        @if (is_countable($selecionado) && count($selecionado) == 0)
            <h3>Não ha telefones para esse contato</h3>
           
            @foreach ($telefones as $telefone)

                <h1>Crie Contato Telefonico para: {{$telefone->nmContato}}</h1>

                <div id="event-create-container" class="col-md-10 offset-md-1">

                    <form action="telcon/" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">DDD:</label>
                            <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone" required
                                   name="nuDDDTelefone">
                        </div>
                        <div class="form-group">
                            <label for="title">Telefone(somente números):</label>
                            <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone" required
                                   name="nuTelefone">
                        </div>

                        <div class="form-group" style="display:none">
                            <label for="title">Nome Contato: </label>
                            <select name="cdContatoTelefone" id="cdContatoTelefone" class="form-select">
                                <option value="{{$telefone->cdContato}}"> {{$telefone->nmContato}}</option>
                            </select>
                        </div>

                        <br>

                        <div class="container d-flex justify-content-between mt-2">
                            <a href="/contatos/listacontato/{{ $telefone->cdInstancia }}"
                               class="btn btn-info mb-2">Voltar</a>
                            <input type="submit" class="btn btn-primary mb-2" value="Criar">
                        </div>
                    </form>
                </div>
            @endforeach
        @else
            @foreach ($telefones as $telefone)

                <h1>Telefone de {{$telefone->nmContato}}</h1>

            @endforeach

            <div class="container">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Número</th>
                        <th scope="col">Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($selecionado as $event)
                        <tr>
                            <td scropt="row">{{$event->cdTelefone}}</td>
                            <td><a>{{ $event->nuTelefone }}</a></td>

                            <td class="d-flex">
                                <a href="/telcon/edit/{{$event->cdTelefone}}" class="btn btn-info edit-btn me-2"
                                   data-bs-toggle="tooltip" data-bs-title="Editar">
                                    <ion-icon name="create-outline"></ion-icon>

                                </a>

                                <form action="/telcon/edit/{{ $event->cdTelefone }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"
                                            data-bs-toggle="tooltip" data-bs-title="Apagar">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>

                                </form>
                            </td>
                        </tr>

            </div>
            @endforeach

            </tbody>
            </table>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/contatos/listacontato/{{ $event->cdInstancia }}" class="btn btn-info mb-2">Voltar</a>
            </div>
    </div>
    <br>
    <br>
    <br>

    <h1>Crie Contato Telefonico para o(a): {{$event->nmContato}}</h1>

    <div id="event-create-container" class="container">

        <form action="telcon/" method="POST">
            @csrf
            <div class="form-group">

                <label for="title">Telefone:</label>
                <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone" name="nuTelefone"
                       required>
            </div>
            <div class="form-group">
                <label for="title">DDD:</label>
                <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone" required
                       name="nuDDDTelefone">
            </div>
            <div class="form-group" style="display:none">
                <label for="title">Contato:</label>
                <select name="cdContatoTelefone" id="cdContatoTelefone" class="form-select">
                    @foreach ($telefones as $telefone)
                        <option value="{{$telefone->cdContato}}"> {{$telefone->nmContato}}</option>

                    @endforeach
                </select>
            </div>

            <div class="container d-flex justify-content-between mt-2">
                <a href="/contatos/listacontato/{{ $event->cdInstancia }}" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Criar">
            </div>
        </form>
    </div>

    @endif
    </div>
@endsection
