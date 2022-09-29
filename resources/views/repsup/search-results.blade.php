@extends('layout.main')

@section('title', 'Search Representantes')

@section('content')


<style>
    a{
        text-decoration: none;
        color: #6f42c1;
    }
    a:hover{
        color: #452680;
    }
</style>

    <div  class="container mt-5">
        <h1>Representantes</h1>
        @if ($events->isEmpty())
            <h1>Não existe Representantes com esse nome
           @endif
   
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
</div>

<!-- Modal ---> 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" data-bs-id="/repsup/edit/{{$event->cdRepSup}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          
          </button>
        </div>
        <div class="modal-body">
          A exclusão é permanente. Deseja prosseguir? 
        </div>
        <div class="modal-footer">
            <form action="/repsup/edit/{{$event->cdRepSup}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger delete-btn ms-1" data-bs-toggle="tooltip"data-bs-title="Deletar">Excluir</button>
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

