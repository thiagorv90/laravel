@extends('layout.main')

@section('title', 'Telefone Representante Suplente ')

@section('content')

    <style>
        .welcomediv {
            color: white;
            background: rgb(153, 114, 187);
            background: linear-gradient(90deg, rgb(186, 143, 223) 35%, rgba(182, 154, 233, 1) 100%);
            border: 2px solid rgb(255, 255, 255);
            box-shadow: #ebe9e9 1px 1px 4px 3px;
            font-family: 'Montserrat', sans-serif;
            transition: all 1.5s;
            padding: 3px;
        }
    </style>


    @if (is_countable($selecionado) && count($selecionado) == 0)

        @foreach ($telefones as $telefone)
            <h3>Não ha telefone para este representante: {{ $telefone->nmRepresentanteSuplente }}</h3>

            <div class="container my-3 ps-3 welcomediv">
                <h1>Crie telefone</h1>
            </div>

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
                            <option value="{{ $telefone->cdRepSup }}"> {{ $telefone->nmRepresentanteSuplente }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Tipo:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpTelefone" id="tpTelefone" value="1">
                            <label class="form-check-label" for="tpTelefone">
                                Celular
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tpTelefone" id="tpTelefone" value="0">
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

        <div class="container my-3 ps-3 welcomediv bg-seconday">
            <h1>Contatos de: {{ $nome->nmRepresentanteSuplente }}</h1>
        </div>


        <div class="container">

            <table class="table" id="empTable">
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
                            <a href="/telrepsup/edit/{{ $event->cdTelefone }}" class="btn btn-info edit-btn me-2"
                               data-bs-toggle="tooltip" data-bs-title="Editar">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>

                            <!-- Botão que chama a modal -->
                            <button class="btn btn-danger edit-btn ms-1 viewdetails" data-id='{{ $event->cdTelefone }}'
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

                <!--Script do Modal-->
                <script type='text/javascript'>
                    $(document).ready(function () {

                        $('#empTable').on('click', '.viewdetails', function () {
                            var empid = $(this).attr('data-id');

                            if (empid > 0) {

                                // AJAX request
                                var url = "{{ route('getEmployeeTelefone', [':empid']) }}";
                                url = url.replace(':empid', empid);

                                // Empty modal data
                                $('#tblempinfo').empty();

                                $.ajax({
                                    url: url,
                                    dataType: 'json',
                                    success: function (response) {

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


            </table>
        </div>

        <div class="container my-3 ps-3 welcomediv">
            <h1>Criar telefone</h1>
        </div>

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
                    <input placeholder="Telefone..." type="text" class="form-control" id="nuTelefone" name="nuTelefone">
                </div>

                <div class="form-group" style="display:none">
                    <label for="title">Representante:</label>
                    <select name="cdRepSup" id="cdRepSup" class="form-select">
                        @foreach ($telefones as $telefone)
                            <option value="{{ $telefone->cdRepSup }}"> {{ $telefone->nmRepresentanteSuplente }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Tipo:</label>
                    <div class="form-check">
                        <input class="form-check-input" required type="radio" name="tpTelefone" id="tpTelefone"
                               value="1">
                        <label class="form-check-label" for="tpTelefone">
                            Celular
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpTelefone" id="tpTelefone"
                               value="0">
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
