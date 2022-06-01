@extends('layout.main')

@section('title', 'Editando instancia')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editar</h1>
  @foreach ($edit as $instituicao)
  <form action="/instancias/update/{{ $instituicao->cdInstancia}}" method="POST">

    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">Nome:</label>
      <input type="text" class="form-control" id="nmInstancia" name="nmInstancia" value="{{$instituicao->nmInstancia}}"></input>
    </div>
    <div class="form-group">
      <label for="title">cdInstituicao </label>
      <select name="cdInstituicao" id="cdInstituicao" class="form-control">

        <option value="{{$instituicao->cdInstituicao}}"> {{$instituicao->nmInstituicao}}</option>


      </select>
    </div>
    <div class="form-group">
      <label for="title">cdTema </label>
      <select name="cdTema" id="cdTema" class="form-control">

        <option value="{{$instituicao->cdTema}}"> {{$instituicao->nmTema}}</option>


      </select>
    </div>
    <div class="form-group">
      <label for="title">Mandato:</label>
      <input type="text" class="form-control" id="dsMandato" name="dsMandato" value="{{$instituicao->dsMandato}}">
    </div>
    <div class="form-group">
      <label for="title">Federal Distrital?</label>
      <select name="tpFederalDistrital" id="tpFederalDistrital" class="form-control">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">Publico, Privado?</label>
      <select name="tpPublicoPrivado" id="tpPublicoPrivado" class="form-control">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">Ativo?</label>
      <select name="stAtivo" id="stAtivo" class="form-control">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">Descrição Objetivo:</label>
      <input name="dsObjetivo" id="dsObjetivo" class="form-control" value="{{$instituicao->dsObjetivo}}"></input>
    </div>

    <div class="form-group">
      <label for="title">atribuições:</label>
      <input type="text" class="form-control" id="tpAtribuicoes" name="tpAtribuicoes" value="{{$instituicao->tpAtribuicoes}}">
    </div>
    <div class="form-group">
      <label for="title">Prioridade:</label>
      <input type="text" class="form-control" id="tpPrioridade" name="tpPrioridade" value="{{$instituicao->tpPrioridade}}">
    </div>
    <div class="form-group">
      <label for="title">Ameaças:</label>
      <input type="text" class="form-control" id="dsAmeacas" name="dsAmeacas" value="{{$instituicao->dsAmeacas}}">
    </div>
    <div class="form-group">
      <label for="title">Oportunidades:</label>
      <input type="text" class="form-control" id="dsOportunidades" name="dsOportunidades" value="{{$instituicao->dsOportunidades}}">
    </div>
    <div class="form-group">
      <label for="title">Observação:</label>
      <input type="text" class="form-control" id="dsObservacao" name="dsObservacao" value="{{$instituicao->dsObservacao}}">
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Criar Evento">
    @endforeach
  </form>
</div>




@endsection