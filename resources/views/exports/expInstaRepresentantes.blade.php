<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio de Representantes</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Representante</strong></th>
        <th scope="col"><strong>Instância</strong></th>
        <th scope="col"><strong>Designação</strong></th>
        <th scope="col"><strong>Nomeação</strong></th>
        <th scope="col"><strong>Início</strong></th>
        <th scope="col"><strong>Fim</strong></th>
        <th scope="col"><strong>Status</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($representacoes as $representacao)
        <tr>
            <td>{{ $representacao->nmRepresentanteSuplente }}</td>
            <td>{{ $representacao->nmInstancia }}</td>
            <td>@php echo $representacao->dsDesiginacao != null ?  $representacao->dsDesiginacao : "--" @endphp</td>
            <td>@php echo $representacao->dsNomeacao != null ? $representacao->dsNomeacao : "--" @endphp</td>
            <td>{!! date('d/m/Y', strtotime($representacao->dtInicioVigencia ))!!}</td>
            <td>{!! date('d/m/Y', strtotime($representacao->dtFimVigencia ))!!}</td>
            <td>@php echo $representacao->stAtivo == 1 ? "Ativo" : "Desativo" @endphp</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
