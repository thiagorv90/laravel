@extends('layout.main')

@section('title', 'Relatórios')

@section('content')

    <div class="container">
        <h1>Relatórios</h1>
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
            <a href="{{route('expViewRelReunioesMensais')}}" class="list-group-item list-group-item-action">9. -- Relatório de Reunioes Mensais --</a>
        </div>
    </div>

@endsection

