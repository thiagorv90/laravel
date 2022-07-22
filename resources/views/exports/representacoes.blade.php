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
        <th scope="col"><strong>Instancias</strong></th>
        <th scope="col"><strong>*Data Nomeacao</strong></th>
        <th scope="col"><strong>Vigencia</strong></th>
        <th scope="col"><strong>Mandato</strong></th>
        <th scope="col"><strong>Designacao</strong></th>
        <th scope="col"><strong>Nomeacao</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($representacoes as $representacao)
        <tr>
            <td>{{ $representacao->nmRepresentanteSuplente }}</td>
            <td>{{ $representacao->nmInstancia }}</td>
            <td>Data Nomeacao</td>
            <td>{{ $representacao->dtInicioVigencia }} - {{ $representacao->dtFimVigencia }}</td>
            <td>{{ $representacao->dsMandato }}</td>
            <td>{{ $representacao->dsDesignacao }}</td>
            <td>{{ $representacao->dsNomeacao}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
