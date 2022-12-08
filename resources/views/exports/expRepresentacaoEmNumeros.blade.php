<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio Instancias Por Data</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Temas</strong></th>
        <th scope="col"><strong>totInstancias</strong></th>
        <th scope="col"><strong>totRepresentacoes</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($representacoes as $representacao)
        <tr>
            <td>{{ $representacao->nmTema }}</td>
            <td>{{ $representacao->inst_count }}</td>
            <td>{{ $representacao->rep_count }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
