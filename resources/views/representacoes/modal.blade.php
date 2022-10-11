<!-- Modal ---> 
<div class="modal" id="edit{{$incluido->cdRepSup}}">
      <div class="modal-content">
        <div class="modal-header fundo-info text-white">
          <h5 class="modal-title" id="exampleModalLabel">Editar Representação</h5>                   
        </div>

        <div class="modal-body">

        <form action="">
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label" disabled >Nome</label>
                <input class="form-control" type="text" aria-label="Disabled input example" disabled>
            </div>

            <div class="form-group">
                    <label for="title">Data de Nomeação:</label>
                    <input type="date" class="form-control" id="dtNomeacao" name="dtNomeacao" value="{{$age->dtNomeacao}}" placeholder="{{$incluido->dtNomeacao}}">
            </div>
            <br>
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1"
                           @if($age->stAtivo ==1) checked @endif >
                    <label class="form-check-label" for="stAtivo">
                        Ativo
                    </label>
            </div>

            <div class="form-check">
                    <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0"
                           @if($age->stAtivo ==0) checked @endif >
                    <label class="form-check-label" for="stAtivo">
                        Desativado
                    </label>
            </div>
        </form>    
        <input type="hidden" name="repid_id" id="repid_id" value="">
        <div class="modal-footer">
            <div>
            <button type="submit" class="btn btn-secondary " data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success ms-1">Concluir</button>
            </div>
        </div>

      </div>
    </div>
  </div>