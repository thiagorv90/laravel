@extends('layout.main')

@section('title', 'HDC Events')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Tema Representações.</h1>

        @if ($events->isEmpty())
            <h1>Não existe Temas de Representações com esse nome

                @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td><a>{{ $event->nmTema }}</a></td>
                                <td><a href="/temarep/edit/{{$event->cdTema}}" class="btn btn-info edit-btn">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        @endif
    </div>

@endsection
