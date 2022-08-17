@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <div class="container d-flex align-items-center">
    <h2>Relatorio Por Vigencia do Mandato</h2>
        <a href="{{route('porVigencia')}}" class="btn btn-primary ms-2"
           data-bs-toggle="tooltip" data-bs-title="Download">
            <ion-icon name="arrow-down-outline"></ion-icon>
        </a>
    </div>


        <form action="{{route('filtradoInstanciaPorVigencia')}}" method="GET">

            <div class="input-group mb-2 inicio">
                <label for="dataInicio" class="input-group-text">Inicio da Vigência: </label>
                <input type="date" class="form-control" name="dataInicio" id="inicio-vigencia">
            </div>

            <div class="input-group mb-2">
                <label for="dataFim" class="input-group-text">Data Final</label>
                <input type="date" class="form-control" name="dataFim" id="fim-vigencia">
            </div>


            <input type="submit" class="btn btn-primary" value="Filtrar" id="butao-filtrar">
        </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Instancia</strong></th>
            <th scope="col"><strong>Vigência</strong></th>
            <th scope="col"><strong>Designacao</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($instancias as $instancia)
            <tr>
                <td>{{ $instancia->nmInstancia }}</td>
                <td><strong>{{ $instancia->dtInicioVigencia }}</strong> até <strong>{{ $instancia->dtFimVigencia }}</strong></td>
                <td>{{ $instancia->dsDesignacao }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/reports" class="btn btn-primary">Voltar</a>
@endsection
