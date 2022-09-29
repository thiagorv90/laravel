@extends('layout.main')

@section('title', 'Representantes')

@section('content')
<!--Estilo dos links do breadgrumps-->
<style>
    a{
        text-decoration: none;
        color: #6f42c1;
    }
    a:hover{                              
        color: #452680;
    }
</style>
    <h1>Representantes</h1>
    <div class="container mt-5">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Telefone</th>
                <th scope="col">Opções</th>
            </tr>
            </thead>
            <tbody>
                
            @foreach ($events as $event)
            
           <?php $var = explode("/", $event->TELEFONES);

           
         
        ?>
                <tr>
                    <td scropt="row">{{$event->nmRepresentanteSuplente}}</td>
                    <td>{{ $event->dsEmail }}</a></td>
                    <td>@foreach($var as $va){{$va}}<br>  @endforeach </td>
                    
                    

                    <td class="d-flex ">
                        <a href="/repsup/edit/{{$event->cdRepSup}}" class="btn btn-info edit-btn"
                           data-bs-toggle="tooltip" data-bs-title="Editar">
                            <ion-icon name="create-outline"></ion-icon>
                        </a>
                        <a href="/telrepsup/{{$event->cdRepSup}}" class="btn btn-info edit-btn ms-1"
                           data-bs-toggle="tooltip" data-bs-title="Contato">
                            <ion-icon name="call-outline"></ion-icon>
                        </a>
                           <!-- Botão que chama a modal -->
                           <button type="button" class="btn btn-danger delete-btn ms-1" data-bs-toggle="modal"
                           data-bs-target="#exampleModal" >
                            <ion-icon name="trash-outline"></ion-icon>                                  
                          </button>    
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$events->links()}}
        <br>
        <form action="/repsup/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="" name="query" id="query"
                           placeholder="Buscar Representante..."
                           aria-label="Buscar Representante" aria-describedby="button-addon2" required/>
                    <input type="submit" class="btn btn-primary" value="Buscar" id="button-addon2">
                </div>
            </form>
            <br>
    </div>
    <h1>Crie Representante</h1>

    <div id="event-create-container" class="container">
        <form action="/repsup" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Nome:</label>
                <input placeholder="Nome..." type="text" class="form-control" id="nmRepresentanteSuplente"
                       name="nmRepresentanteSuplente" required/>
            </div>
            <div class="form-group">
                <label for="title">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dtNascimento" name="dtNascimento">
            </div>
            <div class="form-group">
                <label for="title">Email Principal:</label>
                <input placeholder="Email..." type="text" class="form-control" id="dsEmail" name="dsEmail" required/>
            </div>
            <div class="form-group">
                <label for="title">Email Secundário:</label>
                <input placeholder="Email Alternativo..." type="text" class="form-control" id="dsEmailAlternativo"
                       name="dsEmailAlternativo"/>
            </div>
            <div class="form-group">
                <label for="title">Profissão:</label>
                <input placeholder="Profissão..." type="text" class="form-control" id="dsProfissao" name="dsProfissao"
                       required/>
            </div>
            <div class="form-group">
                <label for="title">Status:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="1">
                    <label class="form-check-label" for="stAtivo">
                        Ativo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="stAtivo" id="stAtivo" value="0">
                    <label class="form-check-label" for="stAtivo">
                        Desativado
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Escolaridade:</label>
                <select name="cdEscolaridade" id="cdEscolaridade" class="form-select">
                    @foreach ($escolaridades as $escolaridade)
                        <option value="{{$escolaridade->cdEscolaridade}}"> {{$escolaridade->dsEscolaridade}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">

                <label for="title">Empresa:</label>
                <select name="cdEmpresa" id="cdEmpresa" class="form-select">

                    @foreach ($empresas as $empresa)
                        <option value="{{$empresa->cdEmpresa}}"> {{$empresa->nmEmpresa}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title"> Endereço:</label>
                <input placeholder="Endereço..." name="dsEndereco" id="dsEndereco" class="form-control"
                         >
            </div>
           
            
            <div class="form-group">
                <label for="title"> Bairo:</label>
                <input placeholder="Bairro..." name="dsBairro" id="dsBairro" class="form-control"
                          >
            </div>
            <div class="form-group">
                <label for="title"> Cidade:</label>
                <input placeholder="Cidade..." name="dsCidade" id="dsCidade" class="form-control"
                         >
            </div>
            <div class="form-group">
                <label for="title"> CEP:</label>
                <input placeholder="CEP..." name="dsCEP" id="dsCEP" class="form-control"
                          >
            </div>

           
            <div class="form-group">
                    <label for="title">Observação:</label>
                    <textarea type="text" class="form-control" id="dsObservacao" name="dsObservacao" 
                           ></textarea>
                </div>
            <div class="form-group">
                <label for="title">Documentos:</label>
                <input type="file" class="form-control" name="nmAnexo[]" multiple>
            </div>
            <br>

            <input type="submit" class="btn btn-primary mb-2" value="Criar Representante">
        </form>
    </div>

    <!-- Modal ---> 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" data-bs-id="{{$event->cdRepSup}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          
          </button>
        </div>
        <div class="modal-body">
          A exclusão é permanente. Deseja prosseguir? {{$event->cdRepSup}}
        </div>
        <div class="modal-footer">
            <form action="/repsup/edit/{{$event->cdRepSup}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger delete-btn ms-1" data-bs-toggle="tooltip"data-bs-title="Deletar" >Excluir</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  

    <!--Script do Modal-->
<script>
    $('#exampleModal').on('show.bs.modal', function (event){
        var button = $(event.relatedTarget);
        var recipientId = button.data('id');
        console.log(recipientId);

        var modal = $(this);
        modal.find('#repID').val(recipientId);
    })
</script>

@endsection
