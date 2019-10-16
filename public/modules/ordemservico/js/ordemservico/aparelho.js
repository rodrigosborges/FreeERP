
$(document).ready(function () {
    //Busca Aparelho , se existir preenche atributos do aparelho automaticamente
    $('#aparelho_id').keyup(function () {
        $.getJSON("/ordemservico/aparelho/showAjax", {
            id: $('#aparelho_id').val()
        }, function () {
            console.log("success");
        }).done(function (data) {
            $('#tipo_aparelho').val(data.tipo_aparelho).prop('readonly', true);
            $('#marca').val(data.marca).prop('readonly', true);
        }).fail(function () {
            $('#tipo_aparelho').val("").prop('readonly', false);
            $('#marca').val("").prop('readonly', false);
        })

    });
});
