@extends('layout.main')

@section('title', 'Instituições')

@section('content')
<h1>Instituições</h1>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)

            <tr>
                <td scropt="row">{{$event->cdInstituicao}}</td>
                <td><a>{{ $event->nmInstituicao }}</a></td>

                <td> <a href="/instituicoes/edit/{{$event->cdInstituicao}}" class="btn btn-info edit-btn">
                        <ion-icon name="create-outline"></ion-icon>
                    </a>
                    <a href="/instancias/{{$event->cdInstituicao}}" class="btn btn-info edit-btn">
                        <ion-icon name="clipboard-outline"></ion-icon>
                    </a>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<br>
<form action="/instituicoes/{{$event->cdInstituicao}}/search" method="GET" >
    @csrf
    <div class="row">
         <div class="col-lg-10">
             <div class="form-group">
             <input type="text" class="form-control" value="" name="query" id="query" placeholder="busca">
             <button class="navbar-search__buttton">
                 <i class="fa fa-search"></i>
</button>
</div></div></div></form>
<br>
<h1>Crie sua Instituição</h1>

<div id="event-create-container" class="col-md-10 offset-md-1">
    <form action="instituicoes" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">cdTipoInstituicao</label>
            <select name="cdTipoInstituicao" id="cdTipoInstituicao" class="form-select">
                @foreach ($instituicoes as $instituicoe)
                <option value="{{$instituicoe->cdTipoInstancia}}"> {{$instituicoe->dsTipoInstancia}}</option>

                @endforeach
            </select>
        </div>

        <div id="form-instituicao" class="form-group">
            <label for="title">nmInstituicao</label>
            <div class="input-group mb-3">
                <input placeholder="Nome Instituição..." type="text" class="form-control" id="nmInstituicao" name="nmInstituicao" aria-label="Nome Instituicao" aria-describedby="button-addon2" required />
    
                <input type="submit" class="btn btn-primary" value="Criar Instituição" class="btn btn-outline-secondary" id="button-addon2">
            </div>
        </div>
    </form>
</div>


@endsection