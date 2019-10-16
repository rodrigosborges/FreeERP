$(document).ready(function () {


    //Buscando cidades só daquele estado 

    $('#uf').change(function () {
        var uf = $(this).val();
        $.get('/ordemservico/cidades/showJson/' + uf, function (busca) { // pesquisa pela url com a rota /get-cidades/uf-selecionada
            $('#localidade').empty();
            $.each(busca, function (key, value) {
                $('#localidade').append('<option value=' + value.id + '>' + value.nome + '</option>'); // adicionando as opções da filtragem da UF
            });
        });
    });

    $("#cep").blur(function () {
        //Buscando Informações  de cep 
        $.getJSON("https://viacep.com.br/ws/" + $('#cep').val() + "/json/", {}, function () {
            console.log("success");
        }).done(function (data) {
            if (data.erro) {
                alert("CEP não encontrado");

                $("#bairro").val("").prop('readonly', false);;

                $("#logradouro").val("").prop('readonly', false);

                $("#complemento").val("").prop('readonly', false);

                $('#uf').removeAttr("readonly");
                $("#uf").css("pointer-events","auto");

                
                $('#localidade').removeAttr("readonly");
                $("#localidade").css("pointer-events","auto");
            }
            else {
                $("#bairro").val(data.bairro).prop('readonly', true);;

                $("#logradouro").val(data.logradouro).prop('readonly', true);

                $("#complemento").val(data.complemento).prop('readonly', true);

                $("#uf option").each(function () {
                    if ($(this).text() == data.uf) {
                        $(this).attr('selected', 'true');
                    }
                });

                $("#localidade option").each(function () {
                    if ($(this).text() == data.localidade) {
                        $(this).attr('selected', 'true');
                    }
                });
                $('#uf').css('pointer-events', 'none');
                $('#uf').attr("readonly","true");
                
                $('#localidade').css('pointer-events', 'none');
                $('#localidade').attr("readonly", 'true');
            }
        }).fail(function () {
        })
    })
});