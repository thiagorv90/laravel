@extends('layout.main')

@section('title', 'HDC Events')

@section('content')

    <h1>Ola mundo</h1>
    @foreach ($empresas as $empresa)
        <p> Empresa: {{$empresa->nmEmpresa}}</p>

    @endforeach
    <form action="/" method="POST">
        <input type="text" name="nmEmpresa" id="nmEmpresa">
        <input type="submit" value="Criar">
    </form>

@endsection


