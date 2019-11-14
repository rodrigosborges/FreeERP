
$(document).ready(function () {
    $('#cep').mask('00000-000');

    var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.sp_celphones').mask(SPMaskBehavior, spOptions);

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


    $("#cep").blur(function () {
    //Buscando Informações  de cep 
    $.getJSON("https://viacep.com.br/ws/" + $('#cep').val() + "/json/", {}, function () {
        console.log("success");
    }).done(function (data) {
        if (data.erro) {
            alert("CEP não encontrado");
            
            $(".bairro").val("").prop('readonly', false);

            $(".logradouro").val("").prop('readonly', false);

            $(".complemento").val("").prop('readonly', false);

            $('.estados').removeAttr("readonly");
            $(".estados").css("pointer-events","auto");

            
            $('.localidade').removeAttr("readonly");
            $(".localidade").css("pointer-events","auto");
        }
        else {
            $(".bairro").val(data.bairro).prop('readonly', true);

            $(".logradouro").val(data.logradouro).prop('readonly', true);

            $("#complemento").val(data.complemento).prop('readonly', true);

            $(".estados option").each(function () {
                if($(this).data("uf") == data.uf){
                    $(this).attr('selected', 'selected')
                }
            });

            $(".cidades option").each(function () {
                if ($(this).text() == data.localidade) {
                    $(this).attr('selected', 'true');
                }
            });
            $('.estados').css('pointer-events', 'none');
            $('.estados').attr("readonly","true");
            
            $('.cidades').css('pointer-events', 'none');
            $('.cidades').attr("readonly", 'true');

            $('.numero').focus();

        }
    })

})})
