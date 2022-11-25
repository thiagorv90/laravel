<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio Tipo de Instâncias</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Tipo</strong></th>
        <th scope="col"><strong>Tipo</strong></th>
        <th scope="col"><strong>Instancia</strong></th>
        <th scope="col"><strong>Titular</strong></th>
        <th scope="col"><strong>Status</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
        <tr>
            <td>@php echo $instancia->tpFederalDistrital == 1 ? "Federal" : "Distrital" @endphp</td>
            <td>@php echo $instancia->tpPublicoPrivado == 1 ? "Publico" : "Privado" @endphp</td>
            <td>{{ $instancia->nmInstancia }}</td>
            <td>{{ $instancia->nmRepresentanteSuplente }}</td>
            <td>@php echo $instancia->stAtivo == 1 ? "Ativo" : "Desativo" @endphp</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
