
    $(document).ready(function() {
        escolheMascaraTel($(".input-telefone"))
        $("[name='endereco[cep]']").mask('99999-999')
        setDocumento()
        telefones()
        
        if($('[name="endereco[estado_id]"]').val()){
            getCidades($('[name="endereco[estado_id]"]').val(), $('[name="endereco[estado_id]"]').attr('cidade'))
        }

        //Quando o campo cep perde o foco.
        $("[name='endereco[cep]']").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    
                    

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("[name='endereco[logradouro]']").val(dados.logradouro);
                            $("[name='endereco[bairro]']").val(dados.bairro);

                            var estado = $(`select[name='endereco[estado_id]'] option[uf='${dados.uf}']`);
                            estado.attr('selected', 'selected');
                            
                            
                            getCidades(estado.val(),dados.localidade);
                            $("[name='endereco[numero]']").focus();
                            
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                           
                            
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    
                    
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                
            }
        });

    });


    function telefones() {
        
        $(document).on('click', '.adicionar_telefone', function() {

            $('.excluir_telefone').parent().removeClass('d-none');
                if($(".telefone-div").length < 4){
                var telefone = $(".telefone-div").last().clone();
                
                var inputs = telefone.find('select, input');
                inputs.val("");
                inputs.map((i, input)=> {
                    var match = $(input).attr('name').match(/\[(\d+)]/g)[0]
                    var contador = parseInt(match.replace('[','').replace(']',''))+1
                    var newName = $(input).attr('name').replace(match, `[${contador}]`)
                    $(input).attr('name', newName)
                })

                
                telefone.appendTo($("#telefones"))
                escolheMascaraTel($(".input-telefone").last())
                }
        })

        $(document).on('click', '.excluir_telefone', function() {

        if ($(".telefone-div").length == 2) {
            $(this).closest('.telefone-div').remove();
            $('.excluir_telefone').parent().addClass('d-none')
        }

        else if($('.telefone-div').length >= 2) {
            $(this).closest('.telefone-div').remove();
        }

        })
    }

    $(document).on('change', '#tipo_pessoa', function() {
        
        setDocumento()
        
    })


    function setDocumento() {
        $("[name='documento[documento]']").rules('remove'); 
        var documento = $("[name='documento[documento]']")
        
        if ($("[name='cliente[tipo_cliente_id]']").val() == 2) {
            documento.prop("disabled", false);
            $("[name='cliente[nome]']").parent().parent().find('label').text('Razão Social')
            
         
             $("[name='documento[documento]']").rules('add', {
                cnpj: true
            }); 

            
            documento.parent().parent().find('label').text("CNPJ")
            documento.attr("placeholder", "Ex: 24.953.166/0001-90")
            documento.mask('99.999.999/9999-99')

            $("#div_nome_fantasia").removeClass("d-none");
            
        } else if ($('#tipo_pessoa').val() == 1){
            
            $("[name='documento[documento]']").rules('add', {
                cpf: true
            }); 

            documento.prop("disabled", false);
            $("[name='cliente[nome]']").parent().parent().find('label').text('Nome')
            documento.parent().parent().find('label').text("CPF")
            documento.attr("placeholder", "Ex: 451.658.200-50")
            documento.mask('999.999.999-99')

            $("#div_nome_fantasia").addClass("d-none");

        } else {
            documento.prop("disabled", true);
            documento.val("");
            documento.parent().find('label').text("Selecione o tipo de Pessoa")
        }

    }
    function escolheMascaraTel(element) {


        var SPMaskBehavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },

            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $(element).mask(SPMaskBehavior, spOptions);
    }



    $('#estado').change(function() {

        var idEstado = $(this).val();
        console.log(idEstado)
        if (idEstado) {
            getCidades(idEstado);
        } else {
            $('#cidade').empty()
            $('#cidade').append("<option value=''>Selecione</option>")
        }

    });
    function getCidades(estado_id,nome_cidade=null){
        $.get(main_url+'/api/cidades/' + estado_id, function(cidades) {
                $('#cidade').empty()
                $('#cidade').append("<option value=''>Selecione</option>")
                $.each(cidades, function(key, value) {
                    if(nome_cidade == value.nome || nome_cidade == value.id){
                        $('#cidade').append('<option selected value=' + value.id + '>' + value.nome + '</option>')
                    }else{
                        $('#cidade').append('<option  value=' + value.id + '>' + value.nome + '</option>')
                    }
                })
        })
        
    }
