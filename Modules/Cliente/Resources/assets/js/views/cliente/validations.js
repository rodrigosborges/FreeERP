$('#form').validate({
    rules: {
        "cliente[nome]": {
            maxlength: 100,
        },
        "cliente[nome_fantasia]": {
            maxlength: 100,
        },
        "email[email]": {
            maxlength: 50,
        },
        "endereco[logradouro]": {
            maxlength: 50
        },
        "endereco[numero]": {
            digits: true
        },
        "endereco[bairro]": {
            maxlength: 50
        },

    },

    messages: {}
})