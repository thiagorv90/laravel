<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio de Reuniões</h2>

<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Pauta</strong></th>
        <th scope="col"><strong>Assunto</strong></th>
        <th scope="col"><strong>Data</strong></th>
        <th scope="col"><strong>Hora</strong></th>
        <th scope="col"><strong>Local</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($agendas as $agenda)
        <tr>
            <td>{{ $agenda->dsPauta }}</td>
            <td>{{ $agenda->dsAssunto }}</td>
            <td>{!! date('d/m/Y', strtotime($agenda->dtAgenda)) !!}</td>
            <td>{!! date('G:i', strtotime($agenda->hrAgenda)) !!}</td>
            <td>{{ $agenda->dsLocal }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
