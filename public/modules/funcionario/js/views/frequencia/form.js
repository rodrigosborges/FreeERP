
jQuery.validator.addMethod("validate_date", function(value, element) {
    var re = /([0][1-9]|[1][0-9]|[2][0-9]|[3][0-1])\/([0][1-9]|[1][0-2])\/([1][9][0-9]{2}|[2][0-9]{3})( ([0-1][0-9]|[2][0-3]):[0-5][0-9]:[0-5][0-9])/g

    return this.optional(element) || (re.test(value));
}, "Por favor, insira uma data válida no formato dd/mm/aaaa hh:mm:ss");

$(document).ready(function(){
    $(".sendForm").on('click',function(){
        if($("#form").valid()){
            if($(".novoPonto").first().hasClass("d-none")){
                $('.novoPonto').find('input,textarea').prop('disabled', true)
            }
            $(".stored-justificativa.d-none").find('textarea').prop('disabled', true)
            $(".sendForm").prop("disabled",true) 
            $("#form").submit()  
        }
    })
    $('#form').validate({
        rules: {

        },
        messages:{}
    })

    $("[name^='stored'][name$='[saida]']").change()
})

$("#addPonto").on('click', function(){
    var pontos = $(".novoPonto")
    if(pontos.length > 1 || !$(pontos).first().hasClass("d-none")){
        var newPonto = $(pontos).last().clone()

        newPonto.find('.error').remove();
        var inputs = newPonto.find('input,textarea');

        inputs.val("");

        inputs.map((i, input)=> {
            var match = $(input).attr('name').match(/\[(\d+)]/g)[0]
            var contador = parseInt(match.replace('[','').replace(']',''))+1
            var newName = $(input).attr('name').replace(match, `[${contador}]`) 
            $(input).attr('name', newName)
        })

        $(".novosPontos").append(newPonto)

        newPonto.find('input')
            .mask("00/00/0000 00:00:00")
            .removeAttr('aria-describedby')
            .rules('add', {
                required:true, 
                validate_date: true,
            })

            newPonto.find('textarea')
            .removeAttr('aria-describedby')
            .rules('add', {
                required:true, 
            })
    }else{
        $(pontos[0]).removeClass("d-none")
    }
})

$(document).on('click', ".removePonto",  function(){
    var pontos = $(".novoPonto")
    if(pontos.length > 1){
        $(this).closest(".novoPonto").remove()
    }else if(!$(this).closest(".novoPonto").hasClass('d-none')){
        $(this).closest(".novoPonto").addClass('d-none')
    }
})

$(".date-mask").mask("00/00/0000 00:00:00")

$(document).ready(function(){
    $(".date-validate").each(function(){
        $(this).rules("add", { 
            required:true,  
            validate_date: true,
        });
    })
})

$(document).on('change', '.date-stored', function(){
    var changed = false
    $(this).closest('.row').find('input').map(function(i, input){
        if($(input).val() != $(input).attr('initial'))
            changed = true
    })
    
    if($(this).closest('.row').find('textarea').attr('initial'))
        changed = true

    var text_area_content = $(this).closest('.row').find('textarea').closest('.col-md-12')

    if(changed){
        text_area_content.removeClass('d-none')
    }else{
        text_area_content.addClass('d-none')
    }
})
