@extends('layout.main')

@section('title', 'Editando Representações')

@section('content')
    <div class="container">
        <h1>SGR</h1>
        <ul>
{{--            <li><a href="{{route('excel')}}">excell</a></li>--}}
            <li><a href="{{route('porInstancia')}}">2. Por Instancia</a></li>
            <li><a href="{{route('porRepresentante')}}">3. Por Representante</a></li>
{{--            <li><a href="{{route('teste')}}">users</a></li>--}}
        </ul>
    </div>
@endsection
