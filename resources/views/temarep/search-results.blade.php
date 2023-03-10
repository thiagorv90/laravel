@extends('layout.main')

@section('title', 'Tema Representações')

@section('content')

    <div id="event-create-container" class="container">


        @if ($events->isEmpty())
            <h1>Não existe Temas de Representações com esse nome</h1>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/temarep" class="btn btn-info mb-2">Voltar</a>
            </div>

        @else
            <h1>Tema Representações</h1>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="container d-flex justify-content-between mt-2">
                <a href="/temarep" class="btn btn-info mb-2">Voltar</a>
            </div>
        @endif
    </div>

@endsection
