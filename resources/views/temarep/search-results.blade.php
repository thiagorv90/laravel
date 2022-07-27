@extends('layout.main')

@section('title', 'Tema Representações')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Tema Representações</h1>

        @if ($events->isEmpty())
            <h1>Não existe Temas de Representações com esse nome</h1>

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
                                <td><a href="/temarep/edit/{{$event->cdTema}}" class="btn btn-info edit-btn"
                                       data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        @endif
    </div>

@endsection
