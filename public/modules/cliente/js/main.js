jQuery.validator.setDefaults({

    errorClass: 'error', 
    errorElement: 'div',
    keyUp: true,

    errorPlacement: function (error, e) {
        error.hide().appendTo(e.parents('.form-group')).fadeIn()
    },

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.error').remove();
    },

    success: function(div){
        div.parents('.form-group').find('.input-group').find('.check-icon').remove();
        div.parents('.form-group').find('div.error').remove();
    },

    onfocusout: function(element) {
        this.element(element);
    },
});

$(document).ready(function() {

    $(".integer").mask("#")
    $(".double").mask("#")
    $('.money').mask('000.000,00', {reverse: true});

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