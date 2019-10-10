
$(document).ready(function () {
    //Busca Aparelho , se existir preenche atributos do aparelho automaticamente
    $('#aparelho_id').keyup(function () {
        $.getJSON("/ordemservico/aparelho/showAjax", {
            id: $('#aparelho_id').val()
        }, function () {
            console.log("success");
        }).done(function (data) {
            $('#tipo_aparelho').val(data.tipo_aparelho).prop('disabled', true);
            $('#marca').val(data.marca).prop('disabled', true);
        }).fail(function () {
            $('#tipo_aparelho').val("").prop('disabled', false);
            $('#marca').val("").prop('disabled', false);
        })

    });
});
