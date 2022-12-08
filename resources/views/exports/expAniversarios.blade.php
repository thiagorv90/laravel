<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio de Aniversários</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Representante</strong></th>
        <th scope="col"><strong>Aniversário</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($representantes as $representante)
        <tr>
            <td>{{ $representante->nmRepresentanteSuplente }}</td>
            <td>{!! date('d/m', strtotime($representante->dtNascimento ))!!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
