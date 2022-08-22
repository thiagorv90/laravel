<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio de Agendas Por Periodo</h2>


<table class="table">
        <thead>
        <tr>
            <th scope="col"><strong>Nome da Instituição</strong></th>
            <th scope="col"><strong>Representante</strong></th>
            <th scope="col"><strong>Data da Agenda</strong></th>
            <th scope="col"><strong>Hora da Agenda</strong></th>
            <th scope="col"><strong>Assunto da Agenda</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach($agendas as $agenda)
            <tr>
                <td>{{ $agenda->nmInstituicao }}</td>
                <td>{{ $agenda->nmRepresentanteSuplente }}</td>
                <td>{!! date('d/m/Y', strtotime($agenda->dtAgenda)) !!}</td>
                <td>{!! date('G:i', strtotime($agenda->hrAgenda)) !!}</td>
                <td>{{ $agenda->dsAssunto }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
