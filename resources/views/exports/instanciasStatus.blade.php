<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatorio por Status</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Instancia</strong></th>
        <th scope="col"><strong>Ativo/Inativo</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
        <tr>
            <td>{{ $instancia->nmInstancia }}</td>
            <td>
                @if($instancia->stAtivo == true)
                    Ativo
                @else
                    Inativo
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
