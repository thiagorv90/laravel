@extends('layout.main')

@section('title', 'Telefone Representante Suplente ')

@section('content')

    @if (is_countable($selecionado) && count($selecionado) == 0)

        @foreach ($telefones as $telefone)
            <h3>Não ha telefone para este representante: {{$telefone->nmRepresentanteSuplente}}</h3>
            <h1>Crie telefone</h1>

            <div id="event-create-container" class="container">
                <form action="telrepsup" method="post">

                    @csrf
                    <div class="form-group">
                        <label for="title">DDD:</label>
                        <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone"
                               name="nuDDDTelefone">
                    </div>
                    <div class="form-group">
                        <label for="title">Telefone:</label>
                        <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone"
                               name="nuTelefone">
                    </div>


                    <div class="form-group" style="display:none">
                        <label for="title">Representante:</label>
                        <select name="cdRepSup" id="cdRepSup" class="form-select">
                            <option value="{{$telefone->cdRepSup}}"> {{$telefone->nmRepresentanteSuplente}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Tipo:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpTelefone"
                                   id="tpTelefone" value="1">
                            <label class="form-check-label" for="tpTelefone">
                                Celular
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpTelefone"
                                   id="tpTelefone" value="0">
                            <label class="form-check-label" for="tpTelefone">
                                Fixo
                            </label>
                        </div>
                    </div>
                    <div class="container d-flex justify-content-between mt-3">
                        <a href="/repsup" class="btn btn-info">Voltar</a>
                        <input type="submit" class="btn btn-primary" value="Criar Telefone">
                    </div>
                </form>
            </div>
        @endforeach
    @else

        <h1>Contatos de {{$nome->nmRepresentanteSuplente}}</h1>
        <div class="container">

            <table class="table">
                <thead>
                <tr>

                    <th scope="col">Telefone</th>
                    <th scope="col">Opções</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($selecionado as $event)

                    <tr>

                        <td><a>{{ $event->nuTelefone }}</a></td>
                        <td class="d-flex">
                            <a href="/telrepsup/edit/{{$event->cdTelefone}}" class="btn btn-info edit-btn me-2"
                               data-bs-toggle="tooltip" data-bs-title="Editar">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <form action="/telrepsup/edit/{{ $event->cdTelefone }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn show_confirm" title='Delete'
                                        id="del"
                                        data-bs-toggle="tooltip">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>

        </div>

        <h1>Crie telefone</h1>

        <div id="event-create-container" class="container">
            <form action="telrepsup" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">DDD:</label>
                    <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone"
                           name="nuDDDTelefone"/>
                </div>

                <div class="form-group">
                    <label for="title">Telefone:</label>
                    <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone"
                           name="nuTelefone">
                </div>

                <div class="form-group" style="display:none">
                    <label for="title">Representante:</label>
                    <select name="cdRepSup" id="cdRepSup" class="form-select">
                        @foreach ($telefones as $telefone)
                            <option value="{{$telefone->cdRepSup}}"> {{$telefone->nmRepresentanteSuplente}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Tipo:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpTelefone"
                               id="tpTelefone" value="1">
                        <label class="form-check-label" for="tpTelefone">
                            Celular
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpTelefone"
                               id="tpTelefone" value="0">
                        <label class="form-check-label" for="tpTelefone">
                            Fixo
                        </label>
                    </div>
                </div>

                <div class="container d-flex justify-content-between mt-3">
                    <a href="/repsup" class="btn btn-info">Voltar</a>
                    <input type="submit" class="btn btn-primary" value="Criar Telefone">
                </div>
            </form>
        </div>

    @endif


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('#show_confirm').click(function (event) {
            var form = $(this).closest('#del');
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>
@endsection
