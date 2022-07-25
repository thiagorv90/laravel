<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio de Instancias Por Prioridade</h2>
<table class="table">
    <thead>
    <tr>
        <th><strong>Instancia</strong></th>
        <th><strong>Prioridade</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
        <tr>
            <td>{{ $instancia->nmInstancia }}</td>
            <td>{{ $instancia->tpPrioridade }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
