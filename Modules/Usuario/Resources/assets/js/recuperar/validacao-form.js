$.validator.addMethod("caractere_especial", function(value) {
    return /\W/.test(value) // consists of only these
 });
 $.validator.addMethod("uma_minuscula", function(value) {
    return /[a-z]+/.test(value) // consists of only these
 });
 $.validator.addMethod("uma_maiuscula", function(value) {
    return /[A-Z]+/.test(value) // consists of only these
 });
 $.validator.addMethod("um_numero", function(value) {
    return /[0-9]+/.test(value) // consists of only these
 });

$('#loginForm').validate({
    rules:{
        password: {
            required:true,
            minlength: 8,
            maxlength: 16,
            caractere_especial: true,
            uma_minuscula: true,
            uma_maiuscula: true,
            um_numero: true
        },
        repeat_password:{
            required:true
        }
    },
    messages:{
        password:{
            required:"<span style='color:red'>Digite a sua senha</span>",
            caractere_especial: "<span style='color:red'>Insira ao menos um caratere especial.</span>",
            minlength: "<span style='color:red'>Insira ao menos 8 caracteres.</span>",
            maxlength: "<span style='color:red'>Insira no máximo 16 caracteres.</span>",
            uma_minuscula: "<span style='color:red'>Insira ao menos uma letra minúscula.</span>",
            uma_maiuscula: "<span style='color:red'>Insira ao menos uma letra maiúscula.</span>",
            um_numero: "<span style='color:red'>Insira ao menos um número.</span>"
        },
        repeat_password:{
            required:"<span style='color:red'>Informe a Senha</span>",
        }
    }
});