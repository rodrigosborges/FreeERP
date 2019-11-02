function somenteNumeros(campo) {
    campo.value =  campo.value.replace(/[^0-9]/g, "");
}

function somenteLetras(campo) {
    campo.value =  campo.value.replace(/[0-9]/g, "");
}