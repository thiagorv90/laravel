<html>
    <body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1>Teste qualquer coisa</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Tema</th>
            <th scope="col">Representantes</th>
            <th scope="col">email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($instancias as $instancia)
        <tr>
            <td>{{ $instancia->nmInstancia }}</td>
            <td>{{$instancia->nmTema}}</td>
            <td>{{$instancia->nmRepresentanteSuplente}}</td>
            <td>{{$instancia->dsEmail}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>