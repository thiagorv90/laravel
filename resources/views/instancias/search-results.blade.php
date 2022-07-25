@extends('layout.main')

@section('title', 'HDC Events')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Instancia</h1>
  
  
  
  @if ($events->isEmpty())
  <h1>Não existe instancias com esse nome. 


  
 @else

 <table class="table">
        <thead>
            <tr>
                
            
                <th scope="col">Nome</th>
                <th scope="col">Opções</th>
               
            </tr>
        </thead>
        <tbody>
        @foreach ($events as $event)
                <tr>
                    
                
             
                    <td><a >{{ $event->nmInstancia }}</a></td>
                    
                    <td>       <a href="/instancias/{{$event->cdInstancia}}"  class="btn btn-info edit-btn"><ion-icon name="search-outline"></ion-icon></a>   
                     <a href="/instancias/edit/{{$event->cdInstancia}}"  class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> </a> 
                     <a href="/contatos/listacontato/{{$event->cdInstancia}}"  class="btn btn-info edit-btn"><ion-icon name="person-outline"></ion-icon> </a> 
                     <a href="/repinsta/{{$event->cdInstancia}}"  class="btn btn-info edit-btn"><ion-icon name="reader-outline"></ion-icon> </a>         
</tr>
@endforeach          
              
        </tbody>
    </table>
    


@endif
</div>

@endsection