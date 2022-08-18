@extends('layout.main')

@section('title', 'HDC Events')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">

        @if ($events->isEmpty())
            <h1>Não existe instancias com esse nome.</h1>
            <div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>

            </div>
        @else
            <h1>Instancia</h1>
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
                        <td><a>{{ $event->nmInstancia }}</a></td>
                        <td>
                            </a>
                            <a href="/instancias/edit/{{$event->cdInstancia}}" class="btn btn-info edit-btn"
                               data-bs-toggle="tooltip" data-bs-title="Editar">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <a href="/contatos/listacontato/{{$event->cdInstancia}} " data-bs-toggle="tooltip"
                               data-bs-title="Contatos"
                               class="btn btn-info edit-btn">
                                <ion-icon name="person-outline"></ion-icon>
                            </a>
                            <a href="/repinsta/{{$event->cdInstancia}}" class="btn btn-info edit-btn"
                               data-bs-toggle="tooltip" data-bs-title="Representações">
                                <ion-icon name="reader-outline"></ion-icon>
                            </a>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Alterar">
            </div>
        @endif
    </div>

@endsection
