@extends('layout.main')

@section('title', 'Editando Telefone Contato')

@section('content')

    <div id="event-create-container" class="container">
        <h1>Agenda</h1>
        @foreach ($selecionado as $age)
        
            <form action="/agendas/update/{{ $age->cdAgenda}}" method="POST">
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="date">Data:</label>
                    <input type="text" class="form-control" id="dtAgenda" name="dtAgenda" value="{{$age->dtAgenda}}" @if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>
                <div class="form-group">
                    <label for="title">Representante:</label>
                    <select id="cdRepresentacao" name="cdRepresentacao" class="form-control"  >

                        <option value="{{$age->cdRepresentacao}}">
                            {{ $age->nmRepresentanteSuplente }}
                        </option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Hora:</label>
                    <input type="text" class="form-control" id="hrAgenda" name="hrAgenda" value="{{$age->hrAgenda}}"@if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>
                <div class="form-group">
                    <label for="title">Assunto:</label>
                    <input type="text" class="form-control" id="dsAssunto" name="dsAssunto" value="{{$age->dsAssunto}}"@if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>

                
                <div class="form-group">
                    <label for="title">Status:</label>
                    <div class="form-check">
                    @if(auth()->user()->statusadm ==1)
                        <input class="form-check-input" type="radio" name="stAgenda" id="stAgenda" value="1"
                               @if($age->stAgenda ==1) checked @endif @if(auth()->user()->statusadm ==0) Readonly @endif >
                               
                        <label class="form-check-label" for="stAgenda">
                            Ativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stAgenda" id="stAgenda" value="0"
                               @if($age->stAgenda ==0) checked @endif @if(auth()->user()->statusadm ==0) Readonly @endif >
                        <label class="form-check-label" for="stAgenda">
                            Desativado
                        </label>
                        @else 
                        <input class="form-check-input" type="hidden" name="stAgenda" id="stAgenda" value="{{$age->stAgenda}}">
                        @if($age->stAgenda ==1)
                        
                                    <td>Ativo</td>
                                @else
                                    <td>Desativado</td>
                                @endif
                                
                        @endif
                    </div>
                    </div>
                <div class="form-group">
                    <label for="title">Local:</label>
                    <input type="text" class="form-control" id="dsLocal" name="dsLocal" value="{{$age->dsLocal}}"@if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>
                
                <div class="form-group">
                    <label for="title">Suplente:</label>
                    <div class="form-check">
                    @if(auth()->user()->statusadm ==1)
                        <input class="form-check-input" type="radio" name="stSuplente" id="stSuplente" value="1"
                               @if($age->stSuplente ==1) checked @endif @if(auth()->user()->statusadm ==0) Readonly @endif >
                        <label class="form-check-label" for="stSuplente">
                            Ativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stSuplente" id="stSuplente" value="0"
                               @if($age->stSuplente ==0) checked @endif @if(auth()->user()->statusadm ==0) Readonly @endif >
                        <label class="form-check-label" for="stSuplente">
                            Desativado
                        </label>
                        @else
                        <input class="form-check-input" type="hidden" name="stSuplente" id="stSuplente" value="{{$age->stSuplente}}">
                        @if($age->stSuplente ==1)
                                    <td>Ativo</td>
                                @else
                                    <td>Desativado</td>
                                @endif
                        @endif

                    </div>
                    </div>
                <div class="form-group">
                    <label for="title">Pauta:</label>
                    <input type="textarea" class="form-control" id="dsPauta" name="dsPauta" value="{{$age->dsPauta}}"@if(auth()->user()->statusadm ==0) Readonly @endif>
                </div>
                <div class="form-group">
                    <label for="title">Resumo:</label>
                    <textarea type="textarea" class="form-control" id="dsResumo" name="dsResumo"
                           >{{$age->dsResumo}}</textarea>
                </div>
                <br>
                <div class="container d-flex justify-content-between mt-2">
                <a href="javascript:history.back()" class="btn btn-info mb-2">Voltar</a>
                <input type="submit" class="btn btn-primary mb-2" value="Alterar">
</div>
            </form>
        @endforeach
    </div>


@endsection
