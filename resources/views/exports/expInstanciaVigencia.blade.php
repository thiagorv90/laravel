<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio de Instâncias por Vigência</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Instituição</strong></th>
        <th scope="col"><strong>Instância</strong></th>
        <th scope="col"><strong>Titular</strong></th>
        <th scope="col"><strong>Designação</strong></th>
        <th scope="col"><strong>Nomeação</strong></th>
        <th scope="col"><strong>Início</strong></th>
        <th scope="col"><strong>Fim</strong></th>
        <th scope="col"><strong>Status</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
    <tr>
        <td>{{ $instancia->nmInstituicao }}</td>
        <td>{{ $instancia->nmInstancia }}</td>
        <td>{{ $instancia->nmRepresentanteSuplente }}</td>
        <td>@php echo $instancia->dsDesiginacao != null ?  $instancia->dsDesiginacao : "--" @endphp</td>
        <td>@php echo $instancia->dsNomeacao != null ? $instancia->dsNomeacao : "--" @endphp</td>
        <td>{!! date('d/m/Y', strtotime($instancia->dtInicioVigencia ))!!}</td>
        <td>{!! date('d/m/Y', strtotime($instancia->dtFimVigencia ))!!}</td>
        <td>@php echo $instancia->stAtivo == 1 ? "Ativo" : "Desativo" @endphp</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
