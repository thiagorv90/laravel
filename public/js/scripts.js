function validaData() {
    var dataInicio = document.getElementById("dtInicioVigencia").value;
    var dataFim = document.getElementById("dtFimVigencia").value;

    if (dataInicio > dataFim) {
        alert('A data final precisa ser maior que data inicial!');
    }
};