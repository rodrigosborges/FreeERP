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
            
            <div class="row my-5 d-flex justify-content-center">
                <h4>Dados Cadastrais</h4>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="tipo_pessoa" class="">Pessoa</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">list</i></span>
                            </div>
                            <select class="custom-select required" name='cliente[tipo_cliente_id]' id="tipo_pessoa">
                                <option value="" disabled selected>Selecione</option>
                                @foreach($tipo_cliente as $tipo)
                                <option value="{{$tipo->id}}" {{ old('cliente.tipo_cliente_id', isset($cliente) ? $cliente->tipo_cliente_id : "") == $tipo->id ? 'selected' : '' }}>{{$tipo->nome}}</option>

                                @endforeach
                            </select>
                            <span class="mensagem-erro">{{$errors->first('cliente.tipo_cliente_id')}}</span>
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="nome">{{old('cliente.tipo_cliente_id', isset($cliente) ? $cliente->tipo_cliente_id : "") == 2 ? 'Razão Social' : 'Nome'}}</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">person</i></span>
                            </div>
                    <input type="text" class="form-control required" name="cliente[nome]" id="nome" value="{{ old('cliente.nome', isset($cliente) ? $cliente->nome : '') }}">
                    <span class="mensagem-erro">{{$errors->first('cliente.nome')}}</span>
                    </div>
                </div>
                <div class="form-group col-md {{old('cliente.tipo_cliente_id', isset($cliente) ? $cliente->tipo_cliente_id : "") == 2 ? '' : 'd-none'}}" id="div_nome_fantasia">
                    <label for="nome_fantasia">Nome Fantasia</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">business</i></span>
                            </div>
                    <input type="text" class="form-control required" name="cliente[nome_fantasia]" id="nome_fantasia" value="{{ old('cliente.nome_fantasia', isset($cliente->nome_fantasia) ? $cliente->nome_fantasia : '') }}">
                    <span class="mensagem-erro">{{$errors->first('cliente.nome_fantasia')}}</span>
                    </div>
                </div>
                
            </div>
            <div>
                <div class="documento-div">
                    <div class="form-group">
                            <label for="numero_documento">{{ old('documento.documento', isset($cliente) ? $cliente->documento->tipo_documento->nome : 'Selecione o tipo de pessoa') }}</label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">description</i></span>
                                    </div>
                            <input type="text" class="form-control required" name="documento[documento]" {{(empty($cliente) ? 'disabled' : '') }} value="{{ old('documento.documento', isset($cliente->documento) ? $cliente->documento->numero : '') }}">
                            <span class="mensagem-erro">{{$errors->first('documento.documento')}}</span>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row my-5 d-flex justify-content-center">
                
               <h5>Contato</h5>
                
            </div>

            <div class="row">
                <div class="form-group col-12">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">email</i></span>
                            </div>
                    <input type="email" name="email[email]" class="form-control required" id="email" value="{{ old('email.email', isset($cliente->email) ? $cliente->email->email : '') }}">
                    <span class="mensagem-erro">{{$errors->first('email.email')}}</span>
                    </div>
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
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">phone</i></span>
                                    </div>
                            <input type="text" class="form-control input-telefone required" name="telefones[{{$key}}][numero]" value="{{ isset($telefone['numero']) ? $telefone['numero'] : "" }}">
                            <span class="mensagem-erro">{{$errors->first('telefones.'.$key.'.numero')}}</span>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="tipo_telefone">Tipo</label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">list</i></span>
                                    </div>
                            <select class="custom-select required" name="telefones[{{$key}}][tipo_telefone_id]">
                                <option value="" disabled selected>Selecione</option>
                                @foreach($tipo_telefone as $tipo){
                                    <option value="{{$tipo->id}}" {{ (isset($telefone['tipo_telefone_id']) ? $telefone['tipo_telefone_id'] : "") == $tipo->id ? 'selected' : '' }}>{{$tipo->nome}}</option>
                                }
                                @endforeach
                            </select>
                            <span class="mensagem-erro">{{$errors->first('telefones.'.$key.'.tipo_telefone_id')}}</span>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 form-group mt-2 {{(isset($telefones) ? count($telefones) : "") == 1 ? 'd-none' : ''}}">
                            <button type="button" class="btn btn-danger mt-4 btn-sm btn-block excluir_telefone"><strong>X</strong></button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-success adicionar_telefone">Adicionar Número</button>
            
            <div class="row my-5 d-flex justify-content-center">
                
                <h5>Endereço</h5>
                
            </div>
            <div class="row">
                <div class="form-group col-3">
                    <label for="cep" class="">CEP</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">map</i></span>
                            </div>
                    <input type="text" class="form-control" name="endereco[cep]" id="cep" value="{{ old('endereco.cep', isset($cliente) ? $cliente->endereco->cep : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.cep')}}</span>
                    </div>
                </div>
                <div class="form-group col-7">
                    <label for="logradouro" class="">Logradouro</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">house</i></span>
                            </div>
                    <input type="text" class="form-control required" name="endereco[logradouro]" value="{{ old('endereco.logradouro', isset($cliente) ? $cliente->endereco->logradouro : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.logradouro')}}</span>
                    </div>
                </div>
                <div class="form-group col-2">
                    <label for="numero" class=" text-left">Número</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">looks_one</i></span>
                            </div>
                    <input type="text" class="form-control required" name="endereco[numero]" value="{{ old('endereco.numero', isset($cliente) ? $cliente->endereco->numero : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.numero')}}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="complemento" class=" text-left">Complemento</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">house</i></span>
                            </div>
                    <input type="text" class="form-control" name="endereco[complemento]" value="{{ old('endereco.complemento', isset($cliente) ? $cliente->endereco->complemento : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.complemento')}}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="bairro" class="">Bairro</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">location_city</i></span>
                            </div>
                    <input type="text" class="form-control required" name="endereco[bairro]" value="{{ old('endereco.bairro', isset($cliente) ? $cliente->endereco->bairro : '') }}">
                    <span class="mensagem-erro">{{$errors->first('endereco.bairro')}}</span>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="estado" class="">Estado</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">map</i></span>
                            </div>
                    <select class="custom-select required" cidade="{{ old('endereco.cidade_id', isset($cliente) ? $cliente->endereco->cidade_id : "")}}" name="endereco[estado_id]" id="estado">
                        <option value="" disabled selected>Selecione</option>
                        @foreach($estados as $estado){
                            <option value="{{$estado->id}}" uf="{{$estado->uf}}" {{ old('endereco.estado_id', isset($cliente) ? $cliente->endereco->cidade->estado_id : "") == $estado->id ? 'selected' : '' }}>{{ $estado->nome }}</option>
                        }
                        @endforeach
                    </select>
                    <span class="mensagem-erro">{{$errors->first('endereco.estado_id')}}</span>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="cidade" class="">Cidade</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">location_city</i></span>
                            </div>
                    <select class="custom-select required" name="endereco[cidade_id]" id="cidade">
                        
                    </select>   
                    <span class="mensagem-erro">{{$errors->first('endereco.cidade_id')}}</span>
                    </div>
                </div>
            </div>
            </h1> <button type="submit" class="btn btn-primary sendForm">Enviar</button>
        
    </form>



@endsection @section('script')
<script src="{{Module::asset('cliente:js/views/cliente/validations.js')}}"></script>
<script src="{{Module::asset('cliente:js/views/cliente/cliente.js')}}"></script>

@endsection