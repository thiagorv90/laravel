@extends('layout.main')

@section('title', 'HDC Events')

@section('content')
<h1>Selecione o representante</h1>
<form action="autenrep" method="get">
  @csrf
  <div class="form-group">
    <label for="title">cdInstancia</label>
    <select name="cdInstancia" id="cdInstancia" class="form-control">
      @foreach ( $events as $event)
      <option value="{{$event->name}}"> {{$event->name}}</option>


      @endforeach
    </select>
    <br>
    <input type="submit" class="btn btn-primary" value="Criar Representante">
</form>






@endsection