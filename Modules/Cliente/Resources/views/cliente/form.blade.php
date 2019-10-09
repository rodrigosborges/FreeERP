@extends('cliente::template') 
@section('title')
    @if(isset($cliente))
        Edição de cliente - {{$cliente->nome}}
    @else
        Cadastro de Cliente
    @endif
@endsection
@section('css')
<style>
.mensagem-erro{
    color: red;
    list-style-type: none;
}
</style>
@endsection
@section('body')


    
    <form id="form" method="POST" action="{{isset($cliente) ? url('/cliente/cliente/'.$cliente->id) : url('/cliente/cliente')}}">
            @if(isset($cliente)) 
                @method('put')
            @endif
            
            <div class="row my-3">
                <h5 class="mx-3 center">Dados Cadastrais</h5>
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="tipo_pessoa" class="">Pessoa</label>
                    <select class="custom-select required" name='cliente[tipo_cliente_id]' id="tipo_pessoa">
                        <option value="" disabled selected>Selecione</option>
                        @foreach($tipo_cliente as $tipo)
                        <option value="{{$tipo->id}}" {{ old('cliente.tipo_cliente_id', isset($cliente) ? $cliente->tipo_cliente_id : "") == $tipo->id ? 'selected' : '' }}>{{$tipo->nome}}</option>

                        @endforeach
                    </select>
                    <span class="mensagem-erro">{{$errors->first('cliente.tipo_cliente_id')}}</span>
                    
                </div>
                <div class="form-group col-md">
                    <label for="nome">{{old('cliente.tipo_cliente_id', isset($cliente) ? $cliente->tipo_cliente_id : "") == 1 ? 'Nome' : 'Razão Social'}}</label>
                    <input type="text" class="form-control required" name="cliente[nome]" id="nome" value="{{ old('cliente.nome', isset($cliente) ? $cliente->nome : '') }}">
                    <span class="mensagem-erro">{{$errors->first('cliente.nome')}}</span>
                </div>
                <div class="form-group col-md {{old('cliente.tipo_cliente_id', isset($cliente) ? $cliente->tipo_cliente_id : "") == 1 ? 'd-none' : ''}}" id="div_nome_fantasia">
                    <label for="nome_fantasia">Nome Fantasia</label>
                    <input type="text" class="form-control" name="cliente[nome_fantasia]" id="nome_fantasia" value="{{ old('cliente.nome_fantasia', isset($cliente->nome_fantasia) ? $cliente->nome_fantasia : '') }}">
                    <span class="mensagem-erro">{{$errors->first('cliente.nome_fantasia')}}</span>
                </div>
                
            </div>
            <div>
                <div class="documento-div">
                    <div class="form-group">
                        @if(empty($cliente))
                             <label for="numero_documento">Selecione o tipo de Pessoa</label>
                             <input type="text" class="form-control required" name="documento[documento]" disabled value="{{ old('documento[documento]') }}">
                        @else
                            <label for="numero_documento">{{$cliente->documento->tipo_documento->nome}}</label>
                            <input type="text" class="form-control required" name="documento[documento]" value="{{ old('documento.documento', isset($cliente->documento) ? $cliente->documento->numero : '') }}">
                        @endif
                        <span class="mensagem-erro">{{$errors->first('documento.documento')}}</span>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                
                    <h6 class="mx-3">Contato</h6>
                
            </div>

            <div class="row">
                <div class="form-group col-12">
                    <label for="email">E-mail</label>
                    <input type="email" name="email[email]" class="form-control required" id="email" value="{{ old('email.email', isset($cliente->email) ? $cliente->email->email : '') }}">
                    <span class="mensagem-erro">{{$errors->first('email.email')}}</span>
                </div>
            </div>
            
            <?php
            $telefones = old('telefones', isset($cliente) ? $cliente->telefones : [[]]);       
            ?>
            
            <div id="telefones"> 
                @foreach($telefones as $key => $telefone)
                    <div class="row telefone-div">
                        <div class="form-group col">
                            <label for="telefone">Número</label>
                            <input type="text" class="form-control input-telefone required" name="telefones[{{$key}}][numero]" value="{{ isset($telefone['numero']) ? $telefone['numero'] : "" }}">
                            <span class="mensagem-erro">{{$errors->first('telefones.'.$key.'.numero')}}</span>
                        </div>
                        <div class="form-group col">
                            <label for="tipo_telefone">Tipo</label>
                            <select class="custom-select required" name="telefones[{{$key}}][tipo_telefone_id]">
                                <option value="" disabled selected>Selecione</option>
                                @foreach($tipo_telefone as $tipo){
                                    <option value="{{$tipo->id}}" {{ (isset($telefone['tipo_telefone_id']) ? $telefone['tipo_telefone_id'] : "") == $tipo->id ? 'selected' : '' }}>{{$tipo->nome}}</option>
                                }
                                @endforeach
                            </select>
                            <span class="mensagem-erro">{{$errors->first('telefones.'.$key.'.tipo_telefone_id')}}</span>
                        </div>
                        <div class="col-1 d-none mt-4">
                            <button type="button" class="btn btn-danger btn-block excluir_telefone"><strong>X</strong></button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary adicionar_telefone">Adicionar</button>
            
            <div class="row my-3">
                
                    <h5 class="mx-3">Endereço</h5>
                
            </div>
            <div class="row">
                <div class="form-group col-3">
                    <label for="cep" class="">CEP</label>
                    <input type="text" class="form-control" name="endereco[cep]" id="cep" value="{{ old('endereco.cep', isset($cliente) ? $cliente->endereco->cep : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.cep')}}</span>
                </div>
                <div class="form-group col-7">
                    <label for="logradouro" class="">Logradouro</label>
                    <input type="text" class="form-control required" name="endereco[logradouro]" value="{{ old('endereco.logradouro', isset($cliente) ? $cliente->endereco->logradouro : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.logradouro')}}</span>
                </div>
                <div class="form-group col-2">
                    <label for="numero" class=" text-left">Número</label>
                    <input type="text" class="form-control required" name="endereco[numero]" value="{{ old('endereco.numero', isset($cliente) ? $cliente->endereco->numero : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.numero')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="complemento" class=" text-left">Complemento</label>
                    <input type="text" class="form-control" name="endereco[complemento]" value="{{ old('endereco.complemento', isset($cliente) ? $cliente->endereco->complemento : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.complemento')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="bairro" class="">Bairro</label>
                    <input type="text" class="form-control required" name="endereco[bairro]" value="{{ old('endereco.bairro', isset($cliente) ? $cliente->endereco->bairro : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.bairro')}}</span>
                </div>
                <div class="form-group col">
                    <label for="estado" class="">Estado</label>
                    <select class="custom-select required" cidade="{{ old('endereco.cidade_id', isset($cliente) ? $cliente->endereco->cidade_id : "")}}" name="endereco[estado_id]" id="estado">
                        <option value="" disabled selected>Selecione</option>
                        @foreach($estados as $estado){
                            <option value="{{$estado->id}}" uf="{{$estado->uf}}" {{ old('endereco.estado_id', isset($cliente) ? $cliente->endereco->cidade->estado_id : "") == $estado->id ? 'selected' : '' }}>{{ $estado->nome }}</option>
                        }
                        @endforeach
                    </select>
                    <span class="mensagem-erro">{{$errors->first('endereco.estado_id')}}</span>
                </div>
                <div class="form-group col">
                    <label for="cidade" class="">Cidade</label>
                    <select class="custom-select required" name="endereco[cidade_id]" id="cidade">
                        
                    </select>   
                    <span class="mensagem-erro">{{$errors->first('endereco.cidade_id')}}</span>
                </div>
            </div>
            </h1> <button type="submit" class="btn btn-success sendForm">Enviar</button>
        
    </form>



@endsection @section('script')
<script src="{{Module::asset('cliente:js/views/cliente/validations.js')}}"></script>

<script>
    $(document).ready(function() {
        escolheMascaraTel($(".input-telefone"))
        $("[name='endereco[cep]']").mask('99999-999')
        setDocumento()
        telefones()
        getCidades($('[name="endereco[estado_id]"]').val(), $('[name="endereco[estado_id]"]').attr('cidade'))
       

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
            $("[name='cliente[nome]']").parent().find('label').text("Razão Social")
             $("[name='documento[documento]']").rules('add', {
                cnpj: true
            }); 


            documento.parent().find('label').text("CNPJ")
            documento.attr("placeholder", "Ex: 24.953.166/0001-90")
            documento.mask('99.999.999/9999-99')

            $("#div_nome_fantasia").removeClass("d-none");
        } else if ($('#tipo_pessoa').val() == 1){
            
            $("[name='documento[documento]']").rules('add', {
                cpf: true
            }); 

            documento.prop("disabled", false);
            $("[name='cliente[nome]']").parent().find('label').text("Nome")
            documento.parent().find('label').text("CPF")
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
        $.get(main_url+'/api/cidades/' + estado_id, function(cidades) {
                $('#cidade').empty()
                $('#cidade').append("<option value='' disabled selected>Selecione</option>")
                $.each(cidades, function(key, value) {
                    if(nome_cidade == value.nome || nome_cidade == value.id){
                        $('#cidade').append('<option selected value=' + value.id + '>' + value.nome + '</option>')
                    }else{
                        $('#cidade').append('<option  value=' + value.id + '>' + value.nome + '</option>')
                    }
                })
        })
        
    }
</script>

@endsection