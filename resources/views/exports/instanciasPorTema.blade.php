<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio Instancias Por Tema</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Tema</strong></th>
        <th scope="col"><strong>Instancia</strong></th>
        <th scope="col"><strong>Titular</strong></th>
        <th scope="col"><strong>Suplente</strong></th>
        <th scope="col"><strong>Caráter**</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
        <tr>
            <td>{{ $instancia->tema }}</td>
            <td>{{ $instancia->instancia }}</td>
            <td>{{ $instancia->repTit }}</td>
            <td>{{ $instancia->repSup }}</td>
            <td>Consultivo/Deliberativo</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
