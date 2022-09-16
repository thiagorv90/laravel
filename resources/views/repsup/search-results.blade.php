@extends('layout.main')

@section('title', 'Search Representantes')

@section('content')

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
                        <form action="/repsup/edit/{{$event->cdRepSup}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn ms-1" data-bs-toggle="tooltip"
                                            data-bs-title="Deletar">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
@endsection
