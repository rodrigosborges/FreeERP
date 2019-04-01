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
                <input type="text" placeholder="Nome" name="funcionario[nome]" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', '') }}">
                <label class="errors"> {{ $errors->first('funcionario.nome') }} </label>
            </div>

            <div class="col-md-4">
                <label for="data_nascimento" class="control-label">Data de Nascimento</label>
                <input type="text" placeholder="00/00/0000" name="funcionario[data_nascimento]" id="data_nascimento" class="form-control" value="{{ $data['model'] ? $data['model']->data_nascimento : old('data_nascimento', '') }}">
                <label class="errors"> {{ $errors->first('funcionario.data_nascimento') }} </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-2">
                <label for="sexo" class="control-label">Sexo</label>
                <select required name="funcionario[sexo]" class="form-control">
                        <option value="">Selecione</option>
                        <option value="0">Feminino</option>
                        <option value="1">Masculino</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="estado_civil_id" class="control-label">Estado Civil</label>
                <select required name="funcionario[estado_civil_id]" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($data['estado_civil'] as $item)
                        <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->estado_civil_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                    @endforeach 
                </select>
            </div>
            <div class="col-md-3">
                <label for="cargo_id" class="control-label">Cargo</label>
                <select required name="funcionario[cargo_id]" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($data['cargos'] as $item)
                        <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->cargo_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                    @endforeach 
                </select>
            </div>
            <div class="col-md-4">
                <label for="data_admissao" class="control-label">Data de Admissão</label>
                <input type="text" placeholder="00/00/0000" name="funcionario[data_admissao]" id="data_admissao" class="form-control" value="{{ $data['model'] ? $data['model']->data_admissao : old('data_admissao', '') }}">
                <label class="errors"> {{ $errors->first('funcionario.data_admissao') }} </label>
            </div>
        </div>

        <strong><h6 class="mt-4 mb-3">Documentos</h6></strong>
        <hr>
        <div class="form-group row">
            <div class="col-md-2">
                <label for="tipo" class="control-label">Tipo</label>
                <input type="text" placeholder="Tipo de doc." name="documentos[tipo]" id="tipo" class="form-control" value="{{ $data['model'] ? $data['model']->tipo : old('tipo', '') }}">
                <label class="errors"> {{ $errors->first('documentos.tipo') }} </label>
            </div>
            <div class="col-md-5">
                <label for="numero_documento" class="control-label">Número</label>
                <input type="text" placeholder="Número" name="documentos[numero]" id="numero_documento" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('numero', '') }}">
                <label class="errors"> {{ $errors->first('documentos.numero') }} </label>
            </div>
            <div class="col-md-5">
                <label for="comprovante" class="control-label">Comprovante</label>
                <input type="file" name="documentos[comprovante]" id="comprovante" class="form-control-file" value="{{ $data['model'] ? $data['model']->comprovante : old('comprovante', '') }}">
                <label class="errors"> {{ $errors->first('documentos.comprovante') }} </label>
            </div>

        </div>

        <strong><h6 class="mt-4 mb-3">Endereço</h6></strong>
        <hr>
        <div class="form-group row">
            <div class="col-md-2">
                <label for="cep" class="control-label">CEP</label>
                <input type="text" placeholder="CEP" name="endereco[cep]" id="cep" class="form-control" value="{{ $data['model'] ? $data['model']->cep : old('endereco.cep', '') }}">
                <label class="errors"> {{ $errors->first('endereco.cep') }} </label>
            </div>
            <div class="col-md-1">
                <label for="uf" class="control-label">UF</label>
                <input type="text" placeholder="UF" name="endereco[uf]" id="uf" class="form-control" value="{{ $data['model'] ? $data['model']->uf : old('endereco.uf', '') }}">
                <label class="errors"> {{ $errors->first('endereco.uf') }} </label>
            </div>
            <div class="col-md-5">
                <label for="cidade" class="control-label">Cidade</label>
                <input type="text" placeholder="Cidade" name="endereco[cidade]" id="cidade" class="form-control" value="{{ $data['model'] ? $data['model']->cidade : old('endereco.cidade', '') }}">
                <label class="errors"> {{ $errors->first('endereco.cidade') }} </label>
            </div>
            <div class="col-md-4">
                <label for="bairro" class="control-label">Bairro</label>
                <input type="text" placeholder="Bairro" name="endereco[bairro]" id="bairro" class="form-control" value="{{ $data['model'] ? $data['model']->bairro : old('endereco.bairro', '') }}">
                <label class="errors"> {{ $errors->first('endereco.bairro') }} </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-5">
                <label for="logradouro" class="control-label">Logradouro</label>
                <input type="text" placeholder="Logradouro" name="endereco[logradouro]" id="logradouro" class="form-control" value="{{ $data['model'] ? $data['model']->logradouro : old('endereco.logradouro', '') }}">
                <label class="errors"> {{ $errors->first('endereco.logradouro') }} </label>
            </div>
            <div class="col-md-1">
                <label for="numero" class="control-label">Número</label>
                <input type="text" placeholder="N°" name="endereco[numero]" id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('endereco.numero', '') }}">
                <label class="errors"> {{ $errors->first('endereco.numero') }} </label>
            </div>
            <div class="col-md-6">
                <label for="complemento" class="control-label">Complemento</label>
                <input type="text" placeholder="Complemento" name="endereco[complemento]" id="complemento" class="form-control" value="{{ $data['model'] ? $data['model']->complemento : old('endereco.complemento', '') }}">
                <label class="errors"> {{ $errors->first('endereco.complemento') }} </label>
            </div>
        </div>

        <strong><h6 class="mt-4 mb-3">Contato</h6></strong>
        <hr>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="email" class="control-label">E-mail</label>
                <input type="text" placeholder="E-mail" name="contato[email]" id="email" class="form-control" value="{{ $data['model'] ? $data['model']->email : old('contato.email', '') }}">
                <label class="errors"> {{ $errors->first('contato.email') }} </label>
            </div>
        </div>
        <div id="telefones">
            <div class="form-group row tel">
                <div class="col-md-6">
                    <input type="text" placeholder="Telefone" name="telefone[numero]" id="numero_telefone" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('telefone.numero', '') }}">
                    <label class="errors"> {{ $errors->first('telefone.numero') }} </label>
                </div>
                <div class="col-md-2">
                    <i class="btn btn-info border text-center add-tel">+</i>
                    <i class="btn btn-danger border text-center del-tel">-</i>
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
        <div class="text-right">
            <button class="btn btn-success" type="submit">{{$data['model'] ? 'Editar' : 'Cadastrar'}}</button>
        </div> -->
    </form>
@endsection

@section('script')
<script>
//ADICIONA E REMOVE TELEFONES (transferir para outro arquivo)
    $(document).on("click", ".add-tel", function() {
        if($(".tel").length < 4) {
            $(".tel").last().clone().appendTo("#telefones")
            $(".telefones").last().val('')
            $(".tel").last().find('label').remove()
            //mascararTel(".telefones")
        } else { 
            alert("Número máximo de telefones permitidos atingido!")
        }
    })

    const numerosRemovidos = []

    $(document).on("click", ".del-tel", function() {
        if($(".tel").length > 1) {
            numerosRemovidos.push($(this).closest(".tel").attr('id'))
            $(this).closest(".tel").remove()
            $(".add-tel").last().show()
        } else {
            Swal.fire({
                type: 'warning',
                title: 'Atenção!',
                text: 'O indivíduo deve ter pelo menos um telefone!',
            })
        }
        $("#numeros_removidos").val(numerosRemovidos)
    })
    //###########################
</script>
@endsection