$('#moduloForm').validate({
    rules: {
        nome: {
            required: true,
            remote: main_url + '/modulo/check-unique/' + modulo_id,
        },
        icone:{
            required:true,
        }
    },
    messages: {
        nome: {
            required: "<span style='color:red'>Informe o Nome</span>",
            remote: "<span style='color:red'>Modulo já cadastrado</span>"
        },
        icone: {
            required: "<span style='color:red'>Informe o Icone</span>",
        }
    }
});