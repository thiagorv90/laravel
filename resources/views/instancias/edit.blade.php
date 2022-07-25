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
      <div class="form-check">
  <input class="form-check-input" type="radio" name="tpFederalDistrital" id="tpFederalDistrital" value="1" @if($instituicao->tpFederalDistrital ==1) checked @endif >
  <label class="form-check-label" for="tpFederalDistrital">
    Federal
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="tpFederalDistrital" id="tpFederalDistrital"  value="0" @if($instituicao->tpFederalDistrital ==0) checked @endif  >
  <label class="form-check-label" for="tpFederalDistrital">
    Distrital
  </label>
</div>
          </div>
    <div class="form-group">
      <label for="title">Publico, Privado?</label>
      <div class="form-check">
  <input class="form-check-input" type="radio" name="tpPublicoPrivado" id="tpPublicoPrivado" value="1" @if($instituicao->tpPublicoPrivado ==1) checked @endif >
  <label class="form-check-label" for="tpPublicoPrivado">
    Público
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="tpPublicoPrivado" id="tpPublicoPrivado"  value="0" @if($instituicao->tpPublicoPrivado ==0) checked @endif  >
  <label class="form-check-label" for="tpPublicoPrivado">
    Privado
  </label>
</div>
      
    </div>
    <div class="form-group">
      <label for="title">Ativo?</label>
      <div class="form-check">
  <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1" @if($instituicao->stAtivo ==1) checked @endif >
  <label class="form-check-label" for="stAtivo">
    Ativo
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo"  value="0" @if($instituicao->stAtivo ==0) checked @endif  >
  <label class="form-check-label" for="stAtivo">
    Desativado
  </label>
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
      <div class="form-check">
  <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade" value="1" @if($instituicao->tpPrioridade ==1) checked @endif  >
  <label class="form-check-label" for="tpPrioridade">
    Baixa
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade"  value="2" @if($instituicao->tpPrioridade ==2) checked @endif   >
  <label class="form-check-label" for="tpPrioridade">
    Média
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="tpPrioridade" id="tpPrioridade"  value="3" @if($instituicao->tpPrioridade ==3) checked @endif  >
  <label class="form-check-label" for="tpPrioridade">
    Alta
  </label>
</div>
</div> 
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