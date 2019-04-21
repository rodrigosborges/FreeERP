$(document).ready(function() {

    $(".integer").mask("#")
    $(".double").mask("#")
    $('.money').mask('000.000,00', {reverse: true});

    jQuery.validator.setDefaults({
        errorPlacement: function (error, element) {
            if(element.parents('form').hasClass('form-inline'))
            error.attr('hidden','hidden');
            element.parents('.form-group').append(error);
        },
    
        highlight: function(element, errorClass, validClass){
            var icon  = '<div class="input-group-append check-icon"><span class="input-group-text"><i class="fa fa-exclamation validate-icon" aria-hidden="true" style="color:#f44336"></i></span></div>';
            $(element).addClass(errorClass)
            $(element).parents('.form-group').find('label.error').remove();
        },
    
        success: function(label){
            label.parents('.form-group').find('.input-group').find('.check-icon').remove();
            label.parents('.form-group').find('label.error').remove();
        },
    
        onfocusout: function(element) {
            this.element(element);
        },
    });
})

function setLoading(target) {
    var loading = $('<h3></h3>').attr({'class': 'text-center'})
    var img = $('<img />').attr({'src': main_url+"/modules/funcionario/img/load.svg"})
    img.appendTo(loading)
    target.html(loading)
}

search = (url, target) => {
    setLoading(target)
    $.ajax({
        type: "GET",
        url: url,
        data: $("#form").serialize(),
        success: function (data) {
            target.html(data)
        },
        error: function (jqXHR, exception) {
            $("#results").html("<div class='alert alert-danger'>Desculpe, ocorreu um erro. <br> Recarregue a página e tente novamente</div>")
        },
    })
}

ativosInativos = (url) => {
    search(`${url}/ativos`, $("#ativos"))
    search(`${url}/inativos`, $("#inativos"))

    $("#ativos").on('click', 'ul.pagination a', function(e){
        e.preventDefault()
        search($(this).attr('href'), $("#ativos"))
    })

    $("#inativos").on('click', 'ul.pagination a', function(e){
        e.preventDefault()
        search($(this).attr('href'), $("#inativos"))
    })
}

$.validator.addMethod(
    "regex",
    function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Insira um formato válido."
);