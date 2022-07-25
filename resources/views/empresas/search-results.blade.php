@extends('layout.main')

@section('title', 'HDC Events')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Empresas</h1>
  
  
  
  @if ($events->isEmpty())
  <h1>Não existe Empresa com esse nome. 


  
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
                    
                
             
                    <td><a >{{ $event->nmEmpresa }}</a></td>
                    
                    <td>         <a href="/empresa/edit/{{$event->cdEmpresa}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon></a>          
</tr>
@endforeach          
              
        </tbody>
    </table>
    


@endif
</div>

@endsection