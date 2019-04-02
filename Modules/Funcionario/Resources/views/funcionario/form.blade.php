@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
    <form action="{{ $data['url'] }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <strong><h6 class="mb-3">Dados Básicos</h6></strong>
        <hr>
        <div class="form-group row">
            <div class="col-md-8">
                <label for="nome" class="control-label">Nome</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <input type="text" placeholder="Nome" name="funcionario[nome]" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', '') }}">
                    <span class="errors"> {{ $errors->first('funcionario.nome') }} </span>
                </div>
            </div>

            <div class="col-md-4">
                <label for="data_nascimento" class="control-label">Data de Nascimento</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">date_range</i>
                        </span>
                    </div>
                    <input type="text" placeholder="00/00/0000" name="funcionario[data_nascimento]" id="data_nascimento" class="form-control" value="{{ $data['model'] ? $data['model']->data_nascimento : old('data_nascimento', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('funcionario.data_nascimento') }} </span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-2">
                <label for="sexo" class="control-label">Sexo</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <select required name="funcionario[sexo]" class="form-control">
                            <option value="">Selecione</option>
                            <option value="0">Feminino</option>
                            <option value="1">Masculino</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label for="estado_civil_id" class="control-label">Estado Civil</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <select required name="funcionario[estado_civil_id]" class="form-control">
                        <option value="">Selecione</option>
                        @foreach($data['estado_civil'] as $item)
                            <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->estado_civil_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                        @endforeach 
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label for="cargo_id" class="control-label">Cargo</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">work</i>
                        </span>
                    </div>
                    <select required name="funcionario[cargo_id]" class="form-control">
                        <option value="">Selecione</option>
                        @foreach($data['cargos'] as $item)
                            <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->cargo_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                        @endforeach 
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label for="data_admissao" class="control-label">Data de Admissão</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">date_range</i>
                        </span>
                    </div>
                    <input type="text" placeholder="00/00/0000" name="funcionario[data_admissao]" id="data_admissao" class="form-control" value="{{ $data['model'] ? $data['model']->data_admissao : old('data_admissao', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('funcionario.data_admissao') }} </span>
            </div>
        </div>

        <?php
            $documentos = old('documentos') !== null ? old('documentos') : ($data['model'] ? $data['model']->documentos : ['documentos']);
        ?>

        <strong><h6 class="mt-5 mb-3">Documentos</h6></strong>
        <hr>
        <div id="documentos">
            @foreach($documentos as $key => $documento)
                <div key="{{$key}}" class="form-group row doc">
                    <div class="col-md-2">
                        <label for="tipo" class="control-label">Nome</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">description</i>
                                </span>
                            </div>
                            <input type="text" placeholder="Nome" name="documentos[{{$key}}][tipo]" id="tipo_{{$key}}" class="form-control documentos" value="{{ $data['model'] ? $data['model']->tipo : old('tipo', '') }}">
                        </div>
                        <span class="errors"> {{ $errors->first('documentos.tipo') }}</span>
                    </div>
                    <div class="col-md-4">
                        <label for="numero_documento" class="control-label">Número</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">description</i>
                                </span>
                            </div>
                            <input type="text" placeholder="Número" name="documentos[{{$key}}][numero]" id="numero_documento_{{$key}}" class="form-control documentos" value="{{ $data['model'] ? $data['model']->numero : old('numero', '') }}">
                        </div>
                        <span class="errors"> {{ $errors->first('documentos.numero') }} </span>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Comprovante</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">archive</i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="documentos[{{$key}}][comprovante]" id="comprovante_{{$key}}" class="custom-file-input documentos" value="{{ $data['model'] ? $data['model']->comprovante : old('comprovante', '') }}">
                                <label for="comprovante" class="custom-file-label">Comprovante</label>   
                            </div>
                        </div>
                        <span class="errors"> {{ $errors->first('documentos.comprovante') }}</span>
                    </div>
                    <div class="col-md-2 mt-2">
                        <br>  
                        <i class="btn btn-info border text-center material-icons add-doc">add</i>
                        <i class="btn btn-danger border text-center material-icons del-doc">delete</i>
                    </div>
                </div>
            @endforeach
        </div>


        <strong><h6 class="mt-5 mb-3">Endereço</h6></strong>
        <hr>
        <div class="form-group row">
            <div class="col-md-2">
                <label for="cep" class="control-label">CEP</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">location_on</i>
                        </span>
                    </div>
                    <input type="text" placeholder="CEP" name="endereco[cep]" id="cep" class="form-control" value="{{ $data['model'] ? $data['model']->cep : old('endereco.cep', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('endereco.cep') }} </span>
            </div>
            <div class="col-md-2">
                <label for="uf" class="control-label">UF</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">location_on</i>
                        </span>
                    </div>
                    <input type="text" placeholder="UF" name="endereco[uf]" id="uf" class="form-control" value="{{ $data['model'] ? $data['model']->uf : old('endereco.uf', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('endereco.uf') }} </span>
            </div>
            <div class="col-md-4">
                <label for="cidade" class="control-label">Cidade</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">location_on</i>
                        </span>
                    </div>
                    <input type="text" placeholder="Cidade" name="endereco[cidade]" id="cidade" class="form-control" value="{{ $data['model'] ? $data['model']->cidade : old('endereco.cidade', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('endereco.cidade') }} </span>
            </div>
            <div class="col-md-4">
                <label for="bairro" class="control-label">Bairro</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">location_on</i>
                        </span>
                    </div>
                    <input type="text" placeholder="Bairro" name="endereco[bairro]" id="bairro" class="form-control" value="{{ $data['model'] ? $data['model']->bairro : old('endereco.bairro', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('endereco.bairro') }} </span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-5">
                <label for="logradouro" class="control-label">Logradouro</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">location_on</i>
                        </span>
                    </div>
                    <input type="text" placeholder="Logradouro" name="endereco[logradouro]" id="logradouro" class="form-control" value="{{ $data['model'] ? $data['model']->logradouro : old('endereco.logradouro', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('endereco.logradouro') }} </span>
            </div>
            <div class="col-md-2">
                <label for="numero" class="control-label">Número</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">location_on</i>
                        </span>
                    </div>
                    <input type="text" placeholder="N°" name="endereco[numero]" id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('endereco.numero', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('endereco.numero') }} </span>
            </div>
            <div class="col-md-5">
                <label for="complemento" class="control-label">Complemento</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">location_on</i>
                        </span>
                    </div>
                    <input type="text" placeholder="Complemento" name="endereco[complemento]" id="complemento" class="form-control" value="{{ $data['model'] ? $data['model']->complemento : old('endereco.complemento', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('endereco.complemento') }} </span>
            </div>
        </div>

        <strong><h6 class="mt-5 mb-3">Contato</h6></strong>
        <hr>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="email" class="control-label">E-mail</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">email</i>
                        </span>
                    </div>
                    <input type="text" placeholder="E-mail" name="contato[email]" id="email" class="form-control" value="{{ $data['model'] ? $data['model']->email : old('contato.email', '') }}">
                </div>
                <label class="errors"> {{ $errors->first('contato.email') }} </label>
            </div>
        </div>
        <div id="telefones">
            <div class="form-group row tel">
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">phone</i>
                            </span>
                        </div>
                        <input type="text" placeholder="Telefone" name="telefone[][numero]" id="numero_telefone" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('telefone.numero', '') }}">
                    </div>
                    <span class="errors"> {{ $errors->first('telefone.numero') }}</span>
                </div>
                <div class="col-md-2">
                    <i class="btn btn-info border text-center material-icons add-tel">add</i>
                    <i class="btn btn-danger border text-center material-icons del-tel">delete</i>
                </div>
            </div>
        </div>

        <!-- <strong><h6 class="mt-4 mb-3">Dependentes</h6></strong>
        <hr>
        <div class="form-group row">
            <div class="col-md-8">
                <label for="nome_dependente" class="control-label">Nome</label>
                <input type="text" placeholder="Nome" name="dependentes[nome]" id="nome_dependente" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('dependentes.nome', '') }}">
                <label class="errors"> {{ $errors->first('dependentes.nome') }} </label>
            </div>
            <div class="col-md-4">
                <label for="data_nascimento_dependente" class="control-label">Data de Nascimento</label>
                <input type="text" placeholder="00/00/0000" name="dependentes[data_nascimento]" id="data_nascimento_dependente" class="form-control" value="{{ $data['model'] ? $data['model']->data_nascimento : old('dependentes.data_nascimento', '') }}">
                <label class="errors"> {{ $errors->first('dependentes.data_nascimento') }} </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="cpf_dependente" class="control-label">CPF</label>
                <input type="text" placeholder="E-mail" name="dependentes[cpf]" id="cpf_dependente" class="form-control" value="{{ $data['model'] ? $data['model']->cpf : old('dependentes.cpf', '') }}">
                <label class="errors"> {{ $errors->first('dependentes.cpf') }} </label>
            </div>
            <div class="col-md-6">
                <label for="comprovante_dependente" class="control-label">Carteira de Vacinação</label>
                <input type="file" placeholder="E-mail" name="dependentes[comprovante]" id="comprovante_dependente" class="form-control-file" value="{{ $data['model'] ? $data['model']->comprovante : old('dependentes.comprovante', '') }}">
                <label class="errors"> {{ $errors->first('dependentes.comprovante') }} </label>
            </div>
        </div>
        -->

        <div class="text-right">
            <!-- <button class="btn btn-success sendForm">{{$data['model'] ? 'Editar' : 'Cadastrar'}}</button> -->
            <button type="submit" class="btn btn-success">{{$data['model'] ? 'Editar' : 'Cadastrar'}}</button>
        </div>
    </form>
@endsection

@section('script')
<script>

//FUNÇÃO PARA CLONAR UM ELEMENTO
function clonar(target, local) {
    if($(target).length < 4) {
        $(target).last().clone().appendTo(local)
    } else { 
        alert("Número máximo atingido!")
    }
}

//FUNÇÃO PARA REMOVER UM ELEMENTO
function remover(target, buttonClicked) {
    if($(target).length > 1) {
        $(buttonClicked).closest(target).remove()
    } else {
        alert("Deve ter pelo menos um!")
    }
}

//FUNÇÃO PARA LIMPAR O ÚLTIMO ELEMENTO ADICIONADO
function limparUltimoInput(input){
    $(input).last().val("")
}

//ADICIONA E REMOVE TELEFONES
$(document).on("click", ".add-tel", function() {
    clonar(".tel", "#telefones")
    limparUltimoInput(".tel input")
})

$(document).on("click", ".del-tel", function() {
    remover(".tel", $(this))
})
//###########################

//ADICIONA E REMOVE DOCUMENTOS
$(document).on("click", ".add-doc", function() {
    clonar(".doc", "#documentos")
    limparUltimoInput(".doc input")
    $('.documentos').each(function(i, documento){
        console.log($(documento).attr('name'))
    })
})

$(document).on("click", ".del-doc", function() {
    remover(".doc", $(this))
})
//###########################
</script>
@endsection