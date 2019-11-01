
$(document).ready(function () {
    //Busca Aparelho , se existir preenche atributos do aparelho automaticamente
    $("input[name='aparelho[numero_serie]'").keyup(function () {
        $.getJSON("/ordemservico/aparelho/showAparelho", {
            numero_serie: $(this).val()
        }).done(function (data) {
            $("input[name='aparelho[tipo_aparelho]'").val(data.tipo_aparelho).prop('readonly', true);
            $("input[name='aparelho[marca]'").val(data.marca).prop('readonly', true);
            $("input[name='aparelho[modelo]'").val(data.marca).prop('readonly', true);
        }).fail(function () {
            $("input[name='aparelho[tipo_aparelho]'").val("").removeAttr('readonly');
            $("input[name='aparelho[marca]'").val("").removeAttr('readonly');
            $("input[name='aparelho[modelo]'").val("").removeAttr('readonly');
        })

    });
});
