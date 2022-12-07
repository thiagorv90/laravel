<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio de Reunioes Mensais</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Instancia</strong></th>
        <th scope="col"><strong>Titular</strong></th>
        <th scope="col"><strong>Pauta</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($reunioes as $reuniao)
        <tr>
            <td>{{ $reuniao->nmInstancia }}</td>
            <td>{{ $reuniao->nmRepresentanteSuplente }}</td>
            <td>{{ $reuniao->dsPauta }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
