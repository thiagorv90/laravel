<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Representante</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Nome</strong></th>
        <th scope="col"><strong>Tema</strong></th>
        <th scope="col"><strong>Representantes</strong></th>
        <th scope="col"><strong>E-mail</strong></th>
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
