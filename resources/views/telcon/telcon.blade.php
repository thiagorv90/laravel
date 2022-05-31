@extends('layout.main')

@section('title', 'Telefone Contatos')

@section('content')

@if (is_countable($selecionado) && count($selecionado) == 0)
<h3>Não ha telefones para esse contato</h3>
@foreach ($telefones as $telefone)

<h1>Crie Contato Telefonico para o(a): {{$telefone->nmContato}}</h1>

<div id="event-create-container" class="col-md-10 offset-md-1">

    <form action="telcon/" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">nuTelefone</label>
            <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone" name="nuTelefone">
        </div>
        <div class="form-group">
            <label for="title">nuDDDTelefone</label>
            <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone" name="nuDDDTelefone">
        </div>
        <div class="form-group">
            <label for="title">cdContatoTelefone </label>
            <select name="cdContatoTelefone" id="cdContatoTelefone" class="form-select">

                <option value="{{$telefone->cdContato}}"> {{$telefone->nmContato}}</option>


            </select>
        </div>

        <br>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>
@endforeach
@else
@foreach ($telefones as $telefone)
<h1>Telefone Do(a){{$telefone->nmContato}}</h1>
@endforeach

<div class="col-md-10 offset-md-1 dashboard-events-container">
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

                <td class="alterar-deletar"> <a href="/telcon/edit/{{$event->cdTelefone}}" class="btn btn-info edit-btn">
                        <ion-icon name="create-outline"></ion-icon>
                    </a>

                    <form action="/telcon/edit/{{ $event->cdTelefone }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<br>
<br>
<br>

<h1>Crie Contato Telefonico para o (a): {{$event->nmContato}}</h1>

<div id="event-create-container" class="col-md-10 offset-md-1">

    <form action="telcon/" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">nuTelefone</label>
            <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone" name="nuTelefone">
        </div>
        <div class="form-group">
            <label for="title">nuDDDTelefone</label>
            <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone" name="nuDDDTelefone">
        </div>
        <div class="form-group">
            <label for="title">cdContatoTelefone </label>
            <select name="cdContatoTelefone" id="cdContatoTelefone" class="form-select">
                @foreach ($telefones as $telefone)
                <option value="{{$telefone->cdContato}}"> {{$telefone->nmContato}}</option>

                @endforeach
            </select>
        </div>

        <br>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>




@endif
@endsection