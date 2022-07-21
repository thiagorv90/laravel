@extends('layout.main')

@section('title', 'dashboard')

@section('content')

    <h1>Instancias:</h1>


    <div class="col-md-10 offset-md-1 dashboard-title-container">

    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="#">

                <input type="text" name="search" placeholder="Find something"
                       class="bg-transparent placeholder-black font-semibold text-sm" value="{{ request('search') }}">
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>

            <th scope="col">Nome</th>
            <th scope="col">Tema</th>
            <th scope="col">Representantes</th>
            <th scope="col">email</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>

                <td><a>{{ $instancia->nmInstancia }}</a></td>
                <td>{{$instancia->nmTema}}</td>
                <td>{{$instancia->nmRepresentanteSuplente}}</td>
                <td>{{$instancia->dsEmail}}</td>
                <td>
                    <a href="/instancias/{{$instancia->cdInstancia}}" class="btn btn-info edit-btn">
                        <ion-icon name="search-outline"></ion-icon>
                    </a>
                    @if(auth()->user()->statusadm ==1)
                        <a href="/instancias/edit/{{$instancia->cdInstancia}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                    @endif
                    @if($instancia->dsEmail ==auth()->user()->email)
                        <a href="/instancias/edit/{{$instancia->cdInstancia}}" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                    @endif

            </tr>
        @endforeach
        </tbody>
    </table>


    </div>

@endsection
