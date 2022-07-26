@extends('layout.main')

@section('title', 'Representantes')

@section('content')

    <h1>Crie Representante</h1>

    <div id="event-create-container" class="container">
        <form action="/repsup" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Nome:</label>
                <input placeholder="Nome..." type="text" class="form-control" id="nmRepresentanteSuplente"
                       name="nmRepresentanteSuplente" required/>
            </div>
            <div class="form-group">
                <label for="title">Email Principal:</label>
                <input placeholder="Email..." type="text" class="form-control" id="dsEmail" name="dsEmail" required/>
            </div>
            <div class="form-group">
                <label for="title">Email Secundário:</label>
                <input placeholder="Email Alternativo..." type="text" class="form-control" id="dsEmailAlternativo"
                       name="dsEmailAlternativo" required/>
            </div>
            <div class="form-group">
                <label for="title">Profissão:</label>
                <input placeholder="Profissão..." type="text" class="form-control" id="dsProfissao" name="dsProfissao"
                       required/>
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
            </div>
            <div class="form-group">
                <label for="title">Escolaridade:</label>
                <select name="cdEscolaridade" id="cdEscolaridade" class="form-select">
                    @foreach ($escolaridades as $escolaridade)
                        <option value="{{$escolaridade->cdEscolaridade}}"> {{$escolaridade->dsEscolaridade}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">

                <label for="title">Empresa:</label>
                <select name="cdEmpresa" id="cdEmpresa" class="form-select">

                    @foreach ($empresas as $empresa)
                        <option value="{{$empresa->cdEmpresa}}"> {{$empresa->nmEmpresa}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title"> Endereço:</label>
                <textarea placeholder="Endereço..." name="dsEndereco" id="dsEndereco" class="form-control"
                          required></textarea>
            </div>

            <div class="form-group">
                <label for="title">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dtNascimento" name="dtNascimento">
            </div>
            <br>
            <input type="submit" class="btn btn-primary" value="Criar Representante">
        </form>
    </div>

    <div class="container mt-5">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($events as $event)
                <tr>
                    <td scropt="row">{{$event->cdRepSup}}</td>
                    <td><a>{{ $event->nmRepresentanteSuplente }}</a></td>

                    <td><a href="/repsup/edit/{{$event->cdRepSup}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                        <a href="/telrepsup/{{$event->cdRepSup}}" class="btn btn-info edit-btn">
                            <ion-icon name="call-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
