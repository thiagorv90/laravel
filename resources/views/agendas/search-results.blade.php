@extends('layout.main')

@section('title', 'HDC Events')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Agendas</h1>
        @if ($events->isEmpty())
            <h1>Não existe Agendas com o campo solicitado.</h1>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Pauta</th>
                    <th scope="col">Assunto</th>
                    <th scope="col">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td><a>{{ $event->dsPauta }}</a></td>
                        <td><a>{{ $event->dsAssunto }}</a></td>
                        <td>
                            <div class="container d-flex">
                                <a href="/agendas/edit/{{$event->cdAgenda}}" class="btn btn-info edit-btn me-1">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                                <form action="/agendas/edit/{{ $event->cdAgenda }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </form>

                            </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
