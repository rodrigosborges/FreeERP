@extends('cliente::template') @section('title','Cadastro de Cliente') @section('body')

<div class="container">
    
    <form id="form" method="POST" action="{{ url('cliente/cliente') }}">
            <div class="row text-center">
                <div class="col my-3">
                    <h5>Dados Cadastrais</h5>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="tipo_pessoa" class="">Pessoa</label>
                    <div  class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons">person</i></span>
                            </div>
                            <select class="custom-select" name='tipo_pessoa' id="tipo_pessoa">
                            <option value="">Selecione</option>
                            @foreach($tipo_cliente as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->nome}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-9">
                        <label for="documento.documento">Selecione o tipo de Pessoa</label>
                        <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">description</i></span>
                                </div>
                            <input type="text" id="documento.documento" class="form-control" name="documento[documento]" disabled>
                        </div>
                    </div>
                <div class="form-group col-md">
                    <label for="nome" class="">Nome</label>
                    <input type="text" class="form-control required" name="cliente[nome]" id="nome">
                </div>
                <div class="form-group col-md d-none" id="div_nome_fantasia">
                    <label for="nome_fantasia" class="">Nome Fantasia</label>
                    <input type="text" class="form-control" name="cliente[nome_fantasia]" id="nome_fantasia">
                </div>
                <div class="form-group col-12">
                    <label for="email" class="">E-mail</label>
                    <input type="email" name="email[email]" class="form-control" id="email">
                </div>
                
            </div>
            <div class='row text-center'>
                <div class="col my-3">
                    <h5>Contato</h5>
                </div>
            </div>
            <div id="telefones">

                <div class="row my-3 telefone-div">
                    <div class="form-group col">
                        <label for="telefone" class="">Número</label>
                        <input type="text" class="form-control input-telefone" name="telefone[][numero]">
                    </div>
                    <div class="form-group col">
                        <label for="tipo_telefone" class="">Tipo</label>
                        <select class="custom-select" name="telefone[][tipo_telefone_id]" id="tipo_telefone">
                            <option value="">Selecione</option>
                            @foreach($tipo_telefone as $tipo){
                            <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" id="adicionar_telefone" class="btn btn-primary">Adicionar</button>
            <button type="button" id="excluir_telefone" class="btn btn-primary">Excluir</button>
        
        
            <div class="row text-center">
                <div class="col my-3 ">
                    <h5>Endereço</h5>
                    
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group col-lg-2">
                    <label for="cep" class="">CEP</label>
                    <input type="text" class="form-control" name="endereco[cep]" id="cep">
                </div>
                <div class="form-group col-lg-8">
                    <label for="logradouro" class="">Logradouro</label>
                    <input type="text" class="form-control" name="endereco[logradouro]">
                </div>
                <div class="form-group col-lg-2">
                    <label for="numero" class=" text-left">Número</label>
                    <input type="text" class="form-control" name="endereco[numero]">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group col">
                    <label for="complemento" class=" text-left">Complemento</label>
                    <input type="text" class="form-control" name="endereco[complemento]">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group col-4">
                    <label for="bairro" class="">Bairro</label>
                    <input type="text" class="form-control" name="endereco[bairro]">
                </div>
                <div class="form-group col">
                    <label for="estado" class="">Estado</label>
                    <select class="custom-select" name="endereco[estado_id]" id="estado">
                        <option value="">Selecione</option>
                        @foreach($estados as $estado){
                        <option value="{{$estado->id}}" uf="{{$estado->uf}}">{{ $estado->nome }}</option>
                        }
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label for="cidade" class="">Cidade</label>
                    <select class="custom-select" name="endereco[cidade_id]" id="cidade"></select>
                </div>
            </div>
            </h1> <button type="submit" class="btn btn-success sendForm">Enviar</button>
        
    </form>

</div>


@endsection @section('script')
<script src="{{Module::asset('cliente:js/views/cliente/validations.js')}}"></script>

<script>
    $(document).ready(function() {
        escolheMascaraTel($(".input-telefone"))
        $("[name='endereco[cep]']").mask('99999-999')

       

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
                            
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                           
                            $("[name='endereco[cep]']").addClass('alert alert-danger')
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



    $(document).on('click', '#adicionar_telefone', function() {

        if ($(".telefone-div").length < 4) {
            var telefone = $(".telefone-div").first().clone()
            telefone.find('select, input').val("")
            telefone.appendTo($("#telefones"))
            escolheMascaraTel($(".input-telefone").last())
        }

    })

    $(document).on('click', '#excluir_telefone', function() {

        if ($(".telefone-div").length > 1) {
            $(".telefone-div").last().remove()
        }

    })
    $(document).on('change', '#tipo_pessoa', function() {
        

       
        $("[name='documento[documento]']").rules('remove'); 
        var documento = $("[name='documento[documento]']")

        if ($('#tipo_pessoa').val() == 2) {
            documento.prop("disabled", false);
            $("[name='cliente[nome]']").parent().find('label').text("Razão social")
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
            $("[name='cliente[nome]']").parent().find('label').text("Nome") 
            documento.parent().parent().find('label').text("CPF")
            documento.attr("placeholder", "Ex: 451.658.200-50")
            documento.mask('999.999.999-99')

            $("#div_nome_fantasia").addClass("d-none");

        } else {
            documento.prop("disabled", true);
            documento.val("");
            documento.parent().find('label').text("Selecione o tipo de Pessoa")
        }

    })



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
</script>

<script>
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
        $.get('/api/cidades/' + estado_id, function(cidades) {
                $('#cidade').empty()
                $('#cidade').append("<option value=''>Selecione</option>")
                $.each(cidades, function(key, value) {
                    if(nome_cidade == value.nome){
                        $('#cidade').append('<option selected value=' + value.id + '>' + value.nome + '</option>')
                    }else{
                        $('#cidade').append('<option  value=' + value.id + '>' + value.nome + '</option>')
                    }
                })
        })
        
    }
</script>

@endsection