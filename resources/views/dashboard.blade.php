@extends('layout.main')

@section('title', 'Editando Representações')

@section('content')

    <div class="container">
        <h1>Relatórios</h1>

        <div class="container d-flex justify-content-evenly">
            <div class="list-group">
                {{--                            <li><a href="{{route('excel')}}">excell</a></li>--}}
                <a href="{{route('repEmNumeros')}}" class="list-group-item list-group-item-action">1. Representação em
                    Números *</a>
                <a href="{{route('porInstancia')}}" class="list-group-item list-group-item-action">2. Por Instancia </a>
                <a href="{{route('porRepresentante')}}" class="list-group-item list-group-item-action">3. Por
                    Representante</a>
                <a href="{{route('porStatus')}}" class="list-group-item list-group-item-action">4. Por Status</a>
                <a href="{{route('porTema')}}" class="list-group-item list-group-item-action">5. Por Tema*</a>
                <a href="{{route('porPrioridade')}}" class="list-group-item list-group-item-action">6. Por
                    Prioridade</a>
                <a href="{{route('porVigencia')}}" class="list-group-item list-group-item-action">7. Por Vigência de
                    Mandato</a>
                <a href="{{route('porData')}}" class="list-group-item list-group-item-action">8. Por Data de Reuniao</a>

                {{--                            <li><a href="{{route('teste')}}">users</a></li>--}}
            </div>

            <div class="list-group">
                <a href="{{route('exportViewInstancias')}}" class="list-group-item list-group-item-action">0. --
                    Instancias --</a>
                <a href="{{route('exportViewRepresentacoesNum')}}" class="list-group-item list-group-item-action">1. --
                    Representacoes Numeros --</a>
                <a href="{{route('exportViewInstId')}}" class="list-group-item list-group-item-action">2. -- Por
                    Instancia --</a>
                <a href="{{route('exportViewRepresentacoes')}}" class="list-group-item list-group-item-action">3. --
                    Representantes --</a>
                <a href="{{route('exportViewInstStatus')}}" class="list-group-item list-group-item-action">4. -- Por
                    Status --</a>
                <a href="{{route('exportViewInstTema')}}" class="list-group-item list-group-item-action">5. -- Por Tema
                    --</a>
                <a href="{{route('exportViewInstPrioridade')}}" class="list-group-item list-group-item-action">6. -- Por
                    Prioridade --</a>
                <a href="{{route('exportViewInstVigencia')}}" class="list-group-item list-group-item-action">7. -- Por
                    Vigência de Mandato --</a>
                <a href="{{route('exportViewInstData')}}" class="list-group-item list-group-item-action">8. -- Por Data
                    --</a>
            </div>
        </div>

    </div>
@endsection

