$('#loginForm').validate({
    rules:{
        login: {
            required:true
        },
        password:{
            required:true
        }
    },
    messages:{
        login:{
            required:"<span style='color:red'>Informe o Apelido ou email</span>",
        },
        password:{
            required:"<span style='color:red'>Informe a Senha</span>",
        }
    }
});