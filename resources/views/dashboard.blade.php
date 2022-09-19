@extends('layout.main')

@section('title', 'Relatórios')

@section('content')

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #61338B;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #61338B;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <h1>Bem vindos ao SGR</h1>
    <h3 id="sem">Agendas da Semana</h3>
    <h3 id="me" style="display:none">Agendas do Mês</h3>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <label class="switch"><input type="checkbox"><span class="slider round hide-off"></span></label>
    <div id="semana" class="container mt-5">
            
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Representante</th>
                <th scope="col">Nome da Instancia</th>
                <th scope="col">Data da Agenda</th>
                <th scope="col">Hora da Agenda</th>
                <th scope="col">Assunto da Agenda</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($selecionado as $sel)
                <tr>
                    <td scope="col">{{$sel->nmRepresentanteSuplente}}</td>
                    <td scope="col">{{ $sel->nmInstancia }}</td>
                    <td scope="col">{!! date('d/m/Y', strtotime($sel->dtAgenda)) !!}</td>
                    <td scope="col">{!! date('G:i', strtotime($sel->hrAgenda)) !!}</td>
                    <td scope="col">{{ $sel->dsAssunto }}</td>
                    <td><a href="/agendas/edit/{{$sel->cdAgenda}}" class="btn btn-info edit-btn"
                                           data-bs-toggle="tooltip" data-bs-title="Agenda">
                                            <ion-icon name="book-outline"></ion-icon>
                                        </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div id="mes" class="container mt-5" style="display:none">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Representante</th>
                <th scope="col">Nome da Instancia</th>
                <th scope="col">Data da Agenda</th>
                <th scope="col">Hora da Agenda</th>
                <th scope="col">Assunto da Agenda</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mes as $me)
                <tr>
                    <td>{{$me->nmRepresentanteSuplente}}</td>
                    <td><a>{{ $me->nmInstancia }}</a></td>
                    <td>{!! date('d/m/Y', strtotime($me->dtAgenda)) !!}</td>
                    <td>{!! date('G:i', strtotime($me->hrAgenda)) !!}</td>
                    <td><a>{{ $me->dsAssunto }}</a></td>
                    <td><a href="/agendas/edit/{{$me->cdAgenda}}" class="btn btn-info edit-btn"
                                           data-bs-toggle="tooltip" data-bs-title="Agenda">
                                            <ion-icon name="book-outline"></ion-icon>
                                        </a></td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).on('click', '.hide-off', function () {
            $('#mes').show();
            $('#me').show();
            $('#semana').hide();
            $('#sem').hide();
            $(this).removeClass('hide-off');
            $(this).addClass('hide-on');
        })

        $(document).on('click', '.hide-on', function () {
            $('#mes').hide();
            $('#semana').show();
            $('#me').hide();
            $('#sem').show();
            $(this).removeClass('hide-on');
            $(this).addClass('hide-off');
        })
    </script>

@endsection

