@extends('layout.main')

@section('title', 'Relatórios')

@section('content')

    <div class="container">
        <h1>Relatórios</h1>
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
            <a href="{{route('exportViewAgendas')}}" class="list-group-item list-group-item-action">9. --
                Agendas --</a>
            <a href="{{route('agendaReuniao')}}" class="list-group-item list-group-item-action">10. -- Agenda Reunioes
                --</a>
        </div>
    </div>

@endsection

