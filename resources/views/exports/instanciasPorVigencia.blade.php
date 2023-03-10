<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio Por Vigencia do Mandato</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Instancia</strong></th>
        <th scope="col"><strong>Mandato</strong></th>
        <th scope="col"><strong>Designacao</strong></th>
        <th scope="col"><strong>Vigência Inicial</strong></th>
        <th scope="col"><strong>Vigência Final</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
        <tr>
            <td>{{ $instancia->nmInstancia }}</td>
            <td>{{ $instancia->dsMandato }}</td>
            <td>{{ $instancia->dsDesignacao }}</td>
            <td>{!! date('d/m/Y', strtotime($instancia->dtInicioVigencia)) !!}</td>
            <td>{!! date('d/m/Y', strtotime($instancia->dtFimVigencia)) !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
