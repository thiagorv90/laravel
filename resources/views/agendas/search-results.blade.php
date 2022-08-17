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
                                <a href="/agendas/edit/{{$event->cdAgenda}}" class="btn btn-info edit-btn me-1"
                                   data-bs-toggle="tooltip" data-bs-title="Editar">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                                <form action="/agendas/edit/{{ $event->cdAgenda }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn" data-bs-toggle="tooltip"
                                            data-bs-title="Deletar">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </form>

                            </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="container d-flex justify-content-between mt-2">


                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>

            </div>
        @endif
    </div>
@endsection
