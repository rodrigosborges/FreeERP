$(document).ready(function () {
    //Gerando opção do datalist de titulos
    function gerarOpcao(itens) {
        itens.forEach(item => {
            $('#titulos').append('<option value=' + item.titulo + ">");
        });
    }

    //Buscando Titulo de problema 
    $.getJSON("/ordemservico/problema/showProblemas", {}, function () {
        console.log("success");
    }).done(function (data) {
        gerarOpcao(data);

    }).fail(function () {
        console.log("error");
    })
});