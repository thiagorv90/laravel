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

        /*
        .welcomediv{
            background: #f7f5f5;
            box-shadow: #e0e0e0 1px 1px 5px 4px;
            padding: 10px;
        }*/
        .welcomediv {
            background: #b69ae9;
            box-shadow: #ebe0fd 1px 1px 5px 4px;
            color: rgb(255, 255, 255);
            font-family: 'Montserrat', sans-serif;
            overflow: hidden;
            padding: 20px;
            box-sizing: border-box;
            color: #fff;
            border-radius: 8px;
            position: relative;
        }

        .welcomediv3 {
            width: 160%;
            height: 316px;
            opacity: .1;
            background: #fff;
            position: absolute;
            border-radius: 50%;
        }

    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:wght@300&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

    <div class="container mt-2 welcomediv">
        <h2>Bem vindos ao SGR</h2>
        <h4 id="sem">Agendas da Semana</h4>
        <h4 id="me" style="display:none">Agendas do Mês</h4>
        <label class="switch"><input type="checkbox"><span class="slider round hide-off"></span></label>
        <div class="welcomediv3">
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </div>
    <div id="semana" class="container mt-5">

        @if (is_countable($selecionado) && count($selecionado)  == 0)
            <div class="alert alert-danger d-flex align-items-center mt-4 mb-3" role="alert">
                <div>
                    <h6>Não existem agendas marcadas nesta semana.</h6>   <!--Alerta-->
                </div>
            </div>
        @else

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
        @endif
    </div>


    <div id="mes" class="container mt-5" style="display:none">

        @if (is_countable($mes) && count($mes)  == 0)
            <div class="alert alert-danger d-flex align-items-center mt-4 mb-3 " role="alert">
                <div>
                    <h6>Não existem agendas marcadas para este mês.</h6>   <!--Alerta-->
                </div>
            </div>
        @else

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
        @endif
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

