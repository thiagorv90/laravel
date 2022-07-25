@extends('layout.main')

@section('title', '')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        @foreach($insta as $ist)
            <form>
                <h1>Instancia : {{$ist->nmInstancia}}</h1>

                <div class="form-group">
                    <label for="title">Nome Instancia:</label>
                    <label for="title">{{$ist->nmInstancia}}</label>
                </div>
                <div class="form-group">
                    <label for="title">Instituição:</label>
                    <label for="title">{{$ist->nmInstituicao}}</label>

                </div>
                <div class="form-group">
                    <label for="title">Federeal Distrital:</label>
                    @if($ist->tpFederalDistrital == 1)
                        <label for="title">Sim</label>
                    @else
                        <label for="title">Não</label>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">Publico ou Privado:</label>
                    @if($ist->tpPublicoPrivado == 1)
                        <label for="title">Publico</label>
                    @else
                        <label for="title">Privado</label>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">Ativo:</label>
                    @if($ist->stAtivo == 1)
                        <label for="title">Sim</label>
                    @else
                        <label for="title">Não</label>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">Objetivo</label>
                    <label for="title">{{$ist->dsObjetivo}}</label>

                </div>

                <div class="form-group">
                    <label for="title">atribuições:</label>
                    <label for="title">{{$ist->tpAtribuicoes}}</label>
                </div>

                <div class="form-group">
                    <label for="title">Prioridade:</label>
                    <label for="title">{{$ist->tpPrioridade}}</label>
                </div>

                <div class="form-group">
                    <label for="title">Ameaças:</label>
                    <label for="title">{{$ist->dsAmeacas}}</label>
                </div>

                <div class="form-group">
                    <label for="title">Oportunidades:</label>
                    <label for="title">{{$ist->dsOportunidades}}</label>
                </div>

                <div class="form-group">
                    <label for="title">Observações:</label>
                    <label for="title">{{$ist->dsObservacao}}</label>
                </div>
                <br>
            </form>
        @endforeach
    </div>

@endsection
