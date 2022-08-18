@extends('layout.main')

@section('title', 'HDC Events')

@section('content')

    <div id="event-create-container" class="container">

        @if ($events->isEmpty())
            <h1>Não existe contato desta instância</h1>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/contatos/listacontato/{{ $event->cdInstancia }}" class="btn btn-info mb-2">Voltar</a>

            </div>
        @else
            <h1>Contatos</h1>
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
                        <td><a>{{ $event->nmContato }}</a></td>
                        <td><a href="/contatos/edit/{{$event->cdContato}}" class="btn btn-info edit-btn"
                               data-bs-toggle="tooltip" data-bs-title="Editar">
                                <ion-icon name="create-outline"></ion-icon>
                            </a> <a href="/telcon/{{$event->cdContato}}" class="btn btn-info edit-btn"
                                    data-bs-toggle="tooltip" data-bs-title="Contato">
                                <ion-icon name="call-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/contatos/listacontato/{{ $event->cdInstancia }}" class="btn btn-info mb-2">Voltar</a>

            </div>
        @endif
    </div>

@endsection
