@extends('layout.main')

@section('title', 'Telefone Contatos')

@section('content')

    <div class="container">
        @if (is_countable($selecionado) && count($selecionado) == 0)
            <h3>Não ha telefones para esse contato</h3>

            @foreach ($telefones as $telefone)
                <h1>Crie Contato Telefonico para: {{ $telefone->nmContato }}</h1>

                <div id="event-create-container" class="col-md-10 offset-md-1">

                    <form action="telcon/" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">DDD:</label>
                            <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone" required
                                name="nuDDDTelefone">
                        </div>
                        <div class="form-group">
                            <label for="title">Telefone(somente números):</label>
                            <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone" required
                                name="nuTelefone">
                        </div>

                        <div class="form-group" style="display:none">
                            <label for="title">Nome Contato: </label>
                            <select name="cdContatoTelefone" id="cdContatoTelefone" class="form-select">
                                <option value="{{ $telefone->cdContato }}"> {{ $telefone->nmContato }}</option>
                            </select>
                        </div>

                        <br>

                        <div class="container d-flex justify-content-between mt-2">
                            <a href="/contatos/listacontato/{{ $telefone->cdInstancia }}"
                                class="btn btn-info mb-2">Voltar</a>
                            <input type="submit" class="btn btn-primary mb-2" value="Criar">
                        </div>
                    </form>
                </div>
            @endforeach
        @else
            @foreach ($telefones as $telefone)
                <h1>Telefone de {{ $telefone->nmContato }}</h1>
            @endforeach

            <div class="container">
                <table class="table" id="empTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Número</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>

                    @foreach ($selecionado as $event)
                    <tbody>
                        <tr>
                            <td scope="row">{{ $event->cdTelefone }}</td>
                            <td><a>{{ $event->nuTelefone }}</a></td>

                            <td class="d-flex">
                                <a href="/telcon/edit/{{ $event->cdTelefone }}" class="btn btn-info edit-btn me-2"
                                    data-bs-toggle="tooltip" data-bs-title="Editar">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>

                                <!-- Botão que chama a modal -->
                                <button class="btn btn-danger edit-btn ms-1 viewdetails" data-id='{{$event->cdTelefone }}'
                                    data-bs-toggle="tooltip" data-bs-title="Excluir">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
       
                    <!-- Modal --->
                    <div class="container">
                        <!-- Modal -->
                        <div class="modal fade" id="empModal">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header bg-danger ">
                                        <h3 class="modal-title text-white">Atenção!</h3> 
                                    </div>
                                    <div class="modal-body" id="tblempinfo"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
                   <!--Script do Modal-->
                   <script type='text/javascript'>
                    $(document).ready(function() {

                        $('#empTable').on('click', '.viewdetails', function() {
                            var empid = $(this).attr('data-id');

                            if (empid > 0) {

                                // AJAX request
                                var url = "{{ route('getEmployeeTelefoneContato', [':empid']) }}";
                                url = url.replace(':empid', empid);

                                // Empty modal data
                                $('#tblempinfo').empty();

                                $.ajax({
                                    url: url,
                                    dataType: 'json',
                                    success: function(response) {

                                        // Add employee details
                                        $('#tblempinfo').html(response.html);

                                        // Display Modal
                                        $('#empModal').modal('show');
                                    }
                                });
                            }
                        });

                    });
                </script>
            </div>

            <div class="container d-flex justify-content-between mt-2">
                <a href="/contatos/listacontato/{{ $event->cdInstancia }}" class="btn btn-info mb-2">Voltar</a>
            </div>
    </div>
    <br>
    <br>
    <br>

    <h1>Criar Contato Telefonico para o(a): {{ $event->nmContato }}</h1>

    <div id="event-create-container" class="container">

        <form action="telcon/" method="POST">
            @csrf
            <div class="form-group">

                <label for="title">Telefone:</label>
                <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone" name="nuTelefone"
                    required>
            </div>
            <div class="form-group">
                <label for="title">DDD:</label>
                <input placeholder="DDD..." type="text" class="form-control" id="nuDDDTelefone" required
                    name="nuDDDTelefone">
            </div>
            <div class="form-group" style="display:none">
                <label for="title">Contato:</label>
                <select name="cdContatoTelefone" id="cdContatoTelefone" class="form-select">
                    @foreach ($telefones as $telefone)
                        <option value="{{ $telefone->cdContato }}"> {{ $telefone->nmContato }}</option>
                    @endforeach
                </select>
            </div>

            <div class="container d-flex justify-content-between mt-2">
                <a href="/contatos/listacontato/{{ $event->cdInstancia }}" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Criar">
            </div>
        </form>
    </div>

    @endif
    </div>
@endsection
