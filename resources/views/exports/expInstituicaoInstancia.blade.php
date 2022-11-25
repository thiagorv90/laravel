<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio Instituicoes</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Instituição</strong></th>
        <th scope="col"><strong>Instância</strong></th>
        <th scope="col"><strong>Titular</strong></th>
        <th scope="col"><strong>Status</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
        <tr>
            <td>{{ $instancia->nmInstituicao }}</td>
            <td>{{ $instancia->nmInstancia }}</td>
            <td>{{ $instancia->nmRepresentanteSuplente }}</td>
            <td>@php echo $instancia->stAtivo == 1 ? "Ativo" : "Desativo" @endphp</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
