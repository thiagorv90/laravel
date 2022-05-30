<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Instancias</th>
            <th scope="col">Data Nomeacao</th>
            <th scope="col">Vigencia</th>
            <th scope="col">Mandato</th>
            <th scope="col">Designacao</th>
            <th scope="col">Nomeacao</th>
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