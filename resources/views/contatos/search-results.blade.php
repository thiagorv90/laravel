@extends('layout.main')

@section('title', 'HDC Events')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Contatos</h1>
 

<form action="{{route('searchco')}}" method="GET" >
     <div class="row">
         <div class="col-lg-10">
             <div class="form-group">
             <input type="text" class="form-control" value="" name="query" id="query" placeholder="busca">
             <button class="navbar-search__buttton">
                 <i class="fa fa-search"></i>
</button>
</div></div></div></form>
@foreach ($events as $event)
    <table class="table">
        <thead>
            <tr>
                
            
                <th scope="col">Nome</th>
                <th scope="col">Opções</th>
               
            </tr>
        </thead>
        <tbody>
           
                <tr>
                    
                
                    
                    <td><a >{{ $event->nmContato }}</a></td>
                    
                    <td>         <a href="/contatos/edit/{{$event->cdContato}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon></a>          
</tr>
                   
            @endforeach    
        </tbody>
    </table>
    
</div>

@endsection