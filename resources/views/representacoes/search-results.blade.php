@extends('layout.main')

@section('title', 'HDC Events')

@section('content')


<style>
    a {
        text-decoration: none;
        color: #6f42c1;
    }

    a:hover {
        color: #452680;
    }
</style>

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Contatos</h1>
        @if ($events->isEmpty())
            <h1>Não existe Instituições com esse nome
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
                                <td><a>{{ $event->nmInstituicao }}</a></td>
                                <td><a href="/representacoes/edit/{{$event->cdRepresentacao}}"
                                       class="btn btn-info edit-btn">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <a href="/repsup/edit/{{$event->cdTitular}}" class="btn btn-info edit-btn">
                                        <ion-icon name="person-outline"></ion-icon>
                                    </a>
                                    <a href="/agendas/{{$event->cdRepresentacao}}" class="btn btn-info edit-btn">
                                        <ion-icon name="book-outline"></ion-icon>
                                    </a>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        @endif
    </div>

@endsection
