<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatório de Instâncias</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Instancia</strong></th>
        <th scope="col"><strong>Titular</strong></th>
        <th scope="col"><strong>Suplente</strong></th>
        <th scope="col"><strong>ClassificacaoPP</strong></th>
        <th scope="col"><strong>ClassificacaoDF</strong></th>
        <th scope="col"><strong>Objetivo</strong></th>

    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
        <tr>
            <td>{{ $instancia->nmInstancia }}</td>
            <td>{{ $instancia->repTit }}</td>
            <td>{{ $instancia->repSup }}</td>
            <td>
                @if($instancia->tpPublicoPrivado == true)
                    Publico
                @else
                    Privado
                @endif
            </td>
            <td>
                @if($instancia->tpFederalDistrital == true)
                    Federal
                @else
                    Distrital
                @endif
            </td>
            <td>{{ $instancia->dsObjetivo }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
