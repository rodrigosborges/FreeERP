@extends('cliente::template') @section('title','Cadastro de Pedidos') @section('body')

<div class="container">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="card my-3">
                        <div class="card-header">
                            <div class='row'>
                                <h3>Dados Cadastrais</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row my-3">
                                <div class="form-group col-md-2">
                                    <label for="tipo_pessoa" class="col-form-label col-form-label-lg h6">Pessoa</label>
                                    <select class="custom-select" name='tipo_pessoa' id="tipo_pessoa">
                                                    <option value="">Selecione</option>
                                                @foreach($tipo_cliente as $tipo){
                                                    <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                                }
                                                @endforeach
                                                
                                            </select>
                                </div>
                                <div class="form-group col-md">

                                    <label for="nome" class="col-form-label col-form-label-lg h6">Nome:</label>

                                    <input type="text" class="form-control" name="nome" id="nome">
                                </div>
                                <div class="form-group col-md d-none" id="div_nome_fantasia">

                                    <label for="nome_fantasia" class="col-form-label col-form-label-lg h6">Nome Fantasia:</label>

                                    <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia">
                                </div>
                                <div class="form-group col-12">
                                    <label for="email" class="col-form-label col-form-label-lg h6">E-mail:</label>
                                    <input type="email" name="email[email]" class="form-control" id="email">
                                </div>
                            </div>
                            <div id="telefones">
                                <div class="row my-3 telefone-div">
                                    <div class="form-group col-4">
                                        <label for="telefone" class="col-form-label col-form-label-lg h6">Número de
                                            Telefone:</label>
                                        <input type="text" class="form-control input-telefone" name="telefone">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="tipo_telefone" class="col-form-label col-form-label-lg h6">Tipo de
                                            Telefone:</label>
                                        <select class="custom-select" name="tipo_telefone" id="tipo_telefone">
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
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header">
                            <div class="row">
                                <h3>Documentação</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row my-3 documento-div">
                                <div class="form-group col-6">
                                    <label for="numero_documento" class="col-form-label col-form-label-lg h6">Número de
                                        Documento:</label>
                                    <input type="text" class="form-control" name="numero_documento">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header">
                            <div class="row">
                                <h3>Endereço</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row my-3">
                                <div class="form-group col-3">
                                    <label for="cep" class="col-form-label col-form-label-lg h6">Cep:</label>
                                    <input type="text" class="form-control" name="endereco[cep]" id="cep">
                                </div>
                                <div class="form-group col-6">
                                    <label for="logradouro" class="col-form-label col-form-label-lg h6">Logradouro:</label>
                                    <input type="text" class="form-control" name="endereco[logradouro]">
                                </div>
                                <div class="form-group col-2">
                                    <label for="numero" class="col-form-label col-form-label-lg h6 text-left">Número:</label>
                                    <input type="text" class="form-control" name="endereco[numero]">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="form-group col-4">
                                    <label for="bairro" class="col-form-label col-form-label-lg h6">Bairro:</label>
                                    <input type="text" class="form-control" name="endereco[bairro]">
                                </div>
                                <div class="form-group col">
                                        <label for="estado" class="col-form-label col-form-label-lg h6">Estado:</label>
                                        <select class="custom-select" name="endereco[estado]" id="estado">
                                            <option value="">Selecione</option>
                                            @foreach($estados as $estado){
                                                <option value="{{$estado->id}}">{{ $estado->nome }}</option>
                                            }
                                            @endforeach
                                            </select>
                                    </div>
                                
                            </div>
                            <div class="row my-3">
                                    <div class="form-group col">
                                            <label for="cidade" class="col-form-label col-form-label-lg h6">Cidade:</label>
                                            <select class="custom-select" name="endereco[cidade]" id="cidade">
                                                {{-- <option value="">Selecione</option>
                                                @foreach($estados as $estado){
                                                    <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                                }
                                                @endforeach--}}
                                                </select> 
                                        </div>
                                <div class="form-group col">
                                    <label for="complemento" class="col-form-label col-form-label-lg h6 text-left">Complemento:</label>
                                    <input type="text" class="form-control" name="endereco[complemento]">
                                </div>
                            </div>
                        </div>
                    </div>
                    </h1> <button type="submit" class="btn btn-success">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection @section('script')

<script>
    
    
    $(document).ready(function(){
        escolheMascaraTel($(".input-telefone"))
        $("[name='endereco[cep]']").mask('99999-999')
        
        function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("[name='endereco[logradouro]']").val("");
                $("[name='endereco[bairro]']").val("");
                
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
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("[name='endereco[logradouro]']").val("...");
                        $("[name='endereco[bairro]']").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("[name='endereco[logradouro]']").val(dados.logradouro);
                                $("[name='endereco[bairro]']").val(dados.bairro);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                $("[name='endereco[cep]']")
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
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
        var documento = $("[name='numero_documento']")
        
        if ($('#tipo_pessoa').val() == 2) {

            $("[name='nome']").parent().find('label').text("Razão social:")

            
            documento.parent().find('label').text("CNPJ:")
            documento.attr("placeholder", "Ex: 24.953.166/0001-90")
            documento.mask('99.999.999/9999-99')
            
            $("#div_nome_fantasia").removeClass("d-none");
        } else {
            
            $("[name='nome']").parent().find('label').text("Nome:")
            documento.parent().find('label').text("CPF:")
            documento.attr("placeholder", "Ex: 451.658.200-50")
            documento.mask('999.999.999-99')
            
            $("#div_nome_fantasia").addClass("d-none");

        }

    })  
        


    function escolheMascaraTel(element) {
        

        var SPMaskBehavior = function (val) {
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
    $('#estado').change(function () {
                    
                    var idEstado = $(this).val();

                    if(idEstado) {
                        $.get('/api/cidades/' + idEstado, function (cidades) {
                        
                            $('#cidade').empty()
                            $('#cidade').append("<option value=''>Selecione</option>")
                        
                        
                            
                            $.each(cidades, function (key, value) {
                                $('#cidade').append('<option value=' + value.id + '>' + value.nome + '</option>')
                            
                            })
                        }) 
                    }
                    else {
                        $('#cidade').empty()
                        $('#cidade').append("<option value=''>Selecione</option>")
                    }
                          
    });
   
   
</script>

@endsection