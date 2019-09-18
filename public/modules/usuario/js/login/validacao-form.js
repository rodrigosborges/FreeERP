$('#loginForm').validate({
    rules:{
        apelido: {
            required:true
        },
        password:{
            required:true
        }
    },
    messages:{
        apelido:{
            required:"<span style='color:red'>Informe o Apelido</span>",
        },
        password:{
            required:"<span style='color:red'>Informe a Senha</span>",
        }
    }
});