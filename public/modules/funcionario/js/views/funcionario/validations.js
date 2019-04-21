//VALIDAÇÕES
$('#form').validate({
    rules: {
        "endereco[numero]": {
            number: true
        }
    },
    messages:{}
})