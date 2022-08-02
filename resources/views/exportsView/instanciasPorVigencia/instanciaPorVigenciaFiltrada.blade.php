@extends('layout.main')

@section('title', 'Relatório de Instancias')

@section('content')
    <h2>Relatorio Por Vigencia do Mandato</h2>
    <a href="{{route('porVigencia')}}" class="btn btn-primary"
       data-bs-toggle="tooltip" data-bs-title="Download">
        <ion-icon name="arrow-down-outline"></ion-icon>
    </a>


    <form action="" method="GET">
        <div class="input-group mb-2 inicio">
            <label for="" class="input-group-text">Inicio da Vigência: </label>
            <input type="date" class="form-control" name="dataInicio" id="inicio-vigencia">
            <input type="submit" class="btn btn-primary" value="Filtrar" id="butao-filtrar">
        </div>
    </form>

    {{--    <div class="input-group mb-2 fim">--}}
    {{--        <label for="" class="input-group-text">Fim da Vigência:</label>--}}
    {{--        <input type="date" class="form-control">--}}
    {{--    </div>--}}

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
                <td><a class="inicio-vigencia">{{ $instancia->dtInicioVigencia }}</a> até <a
                        class="fim-vigencia">{{ $instancia->dtFimVigencia }}</a></td>
                <td>{{ $instancia->dsDesignacao }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
