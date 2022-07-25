<html>
<body>
<br>
<br>
<br>
<br>
<br>
<h2>Relatório de Representacao em Numeros</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><strong>Tema</strong></th>
        <th scope="col"><strong>totInstancias</strong></th>
        <th scope="col">{{ $instancias->count() }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($instancias as $instancia)
        <tr>
            <td>{{ $instancia->nmTema }}</td>
            <td>{{ $instancia->nmInstancia }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
