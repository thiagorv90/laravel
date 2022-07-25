@extends('layout.main')

@section('title', 'Agendas')

@section('content')
@if (is_countable($selecionado) && count($selecionado) == 0) 

@foreach ($agendas as $agenda)
<h3>Não ha Agenda para esta Representação(pensar em algo):</h3>
<h1> Criar Agenda</h1>

<div id="event-create-container" class="col-md-6 offset-md-3">
    <form action="agendas" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">dtAgenda:</label>
            <input type="date" class="form-control" id="dtAgenda" name="dtAgenda">
        </div>
        <div class="form-group">
            <label for="title">cdRepresentacao </label>
            <select name="cdRepresentacao" id="cdRepresentacao" class="form-select">
                
                <option value="{{$agenda->cdRepresentacao}}"> {{$agenda->cdTitular}}</option>

                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">hrAgenda:</label>
            <input type="time" class="form-control" id="hrAgenda" name="hrAgenda">
        </div>
        <div class="form-group">
            <label for="title">Assunto:</label>
            <input type="text" class="form-control" id="dsAssunto" name="dsAssunto">
        </div>
        <div class="form-group">
            <label for="title"> stAgenda</label>
            <select name="stAgenda" id="stAgenda" class="form-select">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">dsLocal:</label>
            <input type="text" class="form-control" id="dsLocal" name="dsLocal">
        </div>
        <div class="form-group">
            <label for="title">stSuplente</label>
            <select name="stSuplente" id="stSuplente" class="form-select">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">dsPauta:</label>
            <input type="textarea" class="form-control" id="dsPauta" name="dsPauta">
        </div>
        <div class="form-group">
            <label for="title">dsResumo:</label>
            <input type="textarea" class="form-control" id="dsResumo" name="dsResumo">
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

@else


<h1>Agendas da representação:</h1>
<div class="col-md-10 offset-md-1 dashboard-events-container">
  
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Assunto</th>
                <th scope="col">Pauta</th>
                <th scope="col">Opções</th>

            </tr>
        </thead>
        <tbody>

            <tr>
            @foreach ($selecionado as $event)
                <td scropt="row">{{$event->cdAgenda}}</td>
                <td><a>{{$event->dsAssunto}}</a></td>
                <td><a>{{$event->dsPauta}}</a></td>
                
                <td class="opcoes-agenda">
                  <a href="/agendas/edit/{{$event->cdAgenda}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon></a>

                    <form action="/agendas/edit/{{ $event->cdAgenda }}" method="POST">
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
<form action="/agendas/{{$event->cdAgenda}}/search" method="GET" >
    @csrf
    <div class="row">
         <div class="col-lg-10">
         <div class="form-check">
  <input class="form-check-input" type="radio" name="busca" id="busca" value="1"checked>
  <label class="form-check-label" for="busca">
    Assunto
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="busca" id="busca" value="2" checked>
  <label class="form-check-label" for="busca">
    Pauta
  </label>
</div>
             <div class="form-group">
                         <input type="text" class="form-control" value="" name="query" id="query" placeholder="busca">
             <button class="navbar-search__buttton">
                 <i class="fa fa-search"></i>
</button>
</div></div></div></form>
<br>
<h1>Agenda</h1>

<div id="event-create-container" class="col-md-6 offset-md-3">
    <form action="agendas" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">dtAgenda:</label>
            <input type="date" class="form-control" id="dtAgenda" name="dtAgenda">
        </div>
        <div class="form-group">
            <label for="title">cdRepresentacao </label>
            <select name="cdRepresentacao" id="cdRepresentacao" class="form-select">
                @foreach ($selecionado as $agenda)
                <option value="{{$agenda->cdRepresentacao}}"> {{$agenda->cdTitular}}</option>

                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">hrAgenda:</label>
            <input type="time" class="form-select" id="hrAgenda" name="hrAgenda">
        </div>
        <div class="form-group">
            <label for="title"> stAgenda</label>
            <select name="stAgenda" id="stAgenda" class="form-select">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">dsLocal:</label>
            <input type="text" class="form-control" id="dsLocal" name="dsLocal">
        </div>
        <div class="form-group">
            <label for="title">stSuplente</label>
            <select name="stSuplente" id="stSuplente" class="form-select">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">dsPauta:</label>
            <input type="textarea" class="form-control" id="dsPauta" name="dsPauta">
        </div>
        <div class="form-group">
            <label for="title">dsResumo:</label>
            <input type="textarea" class="form-control" id="dsResumo" name="dsResumo">
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>
<br>
<br>
<br>
@endif

@endsection