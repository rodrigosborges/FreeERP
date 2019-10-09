
    $("#papelForm").validate({
        rules: {
            nome: {
                required:true,
                minlength:3,
                maxlength:30,
                lettersonly:true
            }
        },
        messages:{
            nome: {
                required: "<span style='color:red'>Favor insira um nome!</span>",
                minlength: "<span style='color:red'>Mínimo 3 caracteres!</span>",
                maxlength: "<span style='color:red'>Máximo 30 caracteres!</span>",
            }
        }
    });
    
    jQuery.validator.addMethod("lettersonly", function(value, element) 
    {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "<span style='color:red'>Apenas letras e espaços!</span>");