jQuery.validator.addMethod("verificaespaco", function(value, element) {
    return value.indexOf(" ") == -1 ;
  }, "<span style='color:red'>Não pode conter espaços</span>");
    $("#usuarioForm").validate({
        rules:{
            apelido:{
                required:true,
                minlength: 3,
                maxlength:50,
                remote: main_url+'/usuario/check-unique/'+usuario_id,
                verificaespaco: true
            },
            avatar: {
                accept: "image/jpeg,image/png",
                filesize: 1048576  
            },
            papel:{
                required:true
            },
            email:{
                required:true,
                email:true,
                remote: main_url+'/usuario/check-unique/'+usuario_id
            },
            password:{
                required:true,
                minlength:8,
                maxlength:16,
                verificaespaco: true
            },
            repeat_password:{
                required:true,
                equalTo: "#password",
                verificaespaco: true
            },
        },
        messages:{
            apelido:{
                required:"<span style='color:red'>Preencha o campo Apelido</span>",
                minlength:"<span style='color:red'>Apelido tem que ter no minímo 3 caracteres</span>",
                maxlength:"<span style='color:red'>Apelido tem que ter no máximo 50 caracteres</span>",
                remote:"<span style='color:red'>Apelido indisponível</span>"
            },
            avatar:{
                accept:"<span style='color:red'>Utilize imagens de extensão JPG ou PNG</span>",
                filesize: "<span style='color:red'>Imagem abaixo de 1 MB</span>",
            } ,
            papel:{
                required:"<span style='color:red'>Selecione um Papel</span>",
            },
            email:{
                required:"<span style='color:red'>Preencha o campo Email</span>",
                email:"<span style='color:red'>Insira um email válido (exemplo@exemplo.com)</span>",
                remote:"<span style='color:red'>Email indisponível</span>"
            },
            password:{
                required:"<span style='color:red'>Preencha o campo Senha</span>",
                minlength:"<span style='color:red'>Senha tem que ter no minímo 8 caracteres</span>",
                maxlength:"<span style='color:red'>Senha tem que ter no máximo 16 caracteres</span>"
            },
            repeat_password:{
                required:"<span style='color:red'>Preencha o campo Confirmar Senha</span>",
                equalTo: "<span style='color:red'>O campo Confirmar Senha tem que ser igual ao campo Senha</span>"
            },
        }
    });