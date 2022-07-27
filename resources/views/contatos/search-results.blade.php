@extends('layout.main')

@section('title', 'HDC Events')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Contatos</h1>
        @if ($events->isEmpty())
            <h1>Não existe contato desta instância
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
        @endif
    </div>

@endsection
