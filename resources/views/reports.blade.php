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


        <h1>Relatórios Novos</h1>
        <div class="list-group">
            <a href="{{route('expViewRepNum')}}" class="list-group-item list-group-item-action">1. -- Representação em
                Números --</a>
            <a href="{{route('expViewRelInsta')}}" class="list-group-item list-group-item-action">2. -- Relatório por Instância --</a>
            <a href="{{route('expViewRelInstiInsta')}}" class="list-group-item list-group-item-action">3. -- Relatório de Instituições por Instância --</a>
            <a href="{{route('expViewRelTipoInsta')}}" class="list-group-item list-group-item-action">4. -- Relatório de Tipo Instância --</a>
            <a href="{{route('expViewRelInstaVig')}}" class="list-group-item list-group-item-action">5. -- Relatório de Instâncias por Vigência --</a>
            <a href="{{route('expViewRelInstaRepresentantes')}}" class="list-group-item list-group-item-action">6. -- Relatório de Instâncias por Representantes --</a>
            <a href="{{route('expViewRelRepresentantes')}}" class="list-group-item list-group-item-action">7. -- Relatório de Representantes --</a>
            <a href="{{route('expViewRelAniversarios')}}" class="list-group-item list-group-item-action">8. -- Relatório de Aniversariantes --</a>
        </div>
    </div>

@endsection

