@extends('template') @section('title', 'Exemplo') @section('content')

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
                                <div class="form-group col-6">

                                    <label for="nome" class="col-form-label col-form-label-lg h6">Nome:</label>

                                    <input type="email" class="form-control" id="nome">
                                </div>
                                <div class="form-group col-6">
                                    <label for="email" class="col-form-label col-form-label-lg h6">E-mail:</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="form-group col-4">
                                    <label for="telefone" class="col-form-label col-form-label-lg h6">Número de
                                        Telefone:</label>
                                    <input type="text" class="form-control" id="telefone">
                                </div>
                                <div class="form-group col-3">
                                    <label for="tipo_telefone" class="col-form-label col-form-label-lg h6">Tipo de
                                        Telefone:</label>
                                    <select class="custom-select" id="tipo_documento">

                                        <option value="1" selected>CPF</option>
                                        <option value="2">CNPJ</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header">
                            <div class="row">
                                <h3>Documentação</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row my-3">
                                <div class="form-group col-6">
                                    <label for="numero_documento" class="col-form-label col-form-label-lg h6">Número de
                                        Documento:</label>
                                    <input type="text" class="form-control" id="numero_documento"
                                        placeholder="Ex: 451.658.200-50">
                                </div>
                                <div class="form-group col-3">
                                    <label for="tipo_documento" class="col-form-label col-form-label-lg h6">Tipo de
                                        Documento:</label>
                                    <select class="custom-select" id="tipo_documento">

                                        <option value="1" selected>CPF</option>
                                        <option value="2">CNPJ</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="form-group col-4">
                                    <label for="comprovante_documento"
                                        class="col-form-label col-form-label-lg h6">Comprovante
                                        de Documentação:</label>
                                    <input type="file" class="form-control-file" id="comprovante_documento">
                                    <small id="comprovante_help" class="form-text text-muted">Apenas arquivos com as
                                        extensões:
                                        jpg, png, pdf</small>
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
                                <div class="form-group col-2">
                                    <label for="cep" class="col-form-label col-form-label-lg h6">Cep:</label>
                                    <input type="cep" class="form-control" id="cep">
                                </div>
                                <div class="form-group col-5">
                                    <label for="logradouro"
                                        class="col-form-label col-form-label-lg h6">Logradouro:</label>
                                    <input type="logradouro" class="form-control" id="logradouro">
                                </div>
                                <div class="form-group col-1">
                                    <label for="numero"
                                        class="col-form-label col-form-label-lg h6 text-left">Número:</label>
                                    <input type="numero" class="form-control" id="numero">
                                </div>
                                <div class="form-group col-4">
                                    <label for="bairro" class="col-form-label col-form-label-lg h6">Bairro:</label>
                                    <input type="bairro" class="form-control" id="bairro">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="form-group col-4">
                                    <label for="cidade" class="col-form-label col-form-label-lg h6">Cidade:</label>
                                    <input type="cidade" class="form-control" id="cidade">
                                </div>
                                <div class="form-group col-3">
                                    <label for="estado"
                                        class="col-form-label col-form-label-lg h6 text-left">Estado:</label>
                                    <select class="custom-select" id="tipo_documento">

                                        <option value="1" selected>CPF</option>
                                        <option value="2">CNPJ</option>

                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="complemento"
                                        class="col-form-label col-form-label-lg h6 text-left">Complemento:</label>
                                    <input type="complemento" class="form-control" id="complemento">
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
@endsection