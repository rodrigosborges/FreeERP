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
                <h5 class="mx-3">Dados Cadastrais</h5>
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
                        <div class="col-lg-1 col-sm-1 form-group mt-2 {{(isset($cliente) ? count($telefones) : "") == 1 ? 'd-none' : ''}}">
                            <button type="button" class="btn btn-danger mt-4 btn-sm btn-block excluir_telefone"><strong>X</strong></button>
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
<script src="{{Module::asset('cliente:js/views/cliente/cliente.js')}}"></script>

@endsection