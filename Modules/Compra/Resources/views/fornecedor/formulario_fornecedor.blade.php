@extends('template')
@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <h3>Fornecedor</h3>
        <div class="form-group">
            <label for="nome" class="control-label">Nome do Fornecedor</label>
            <input type="text" required name="fornecedor[nome]" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
            <label class="errors"> {{ $errors->first('fornecedor.nome') }} </label>
        </div>

        <div class="form-group">
            <label for="email" class="control-label">E-mail</label>
            <input type="email" required name="email[email]" id="email" class="form-control" value="{{ $data['model'] ? $data['model']->email : old('email', "") }}">
            <label class="errors"> {{ $errors->first('email.email') }} </label>
        </div>

        <strong><h6 class="mt-5 mb-3">Endereço</h6></strong>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="cep" class="control-label">CEP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">location_on</i>
                            </span>
                        </div>
                        <input required type="text" placeholder="CEP" name="endereco[cep]" id="cep" class="form-control" value="{{ old('endereco.cep', $data['model'] ? $data['model']->endereco()->cep : '') }}">
                    </div>
                    <span class="errors"> {{ $errors->first('endereco.cep') }} </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="uf" class="control-label">UF</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">location_on</i>
                            </span>
                        </div>
                        <select name="endereco[estado_id]" id="estado_id" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($data['estados'] as $estado))
                                <option value="{{ $estado->id }}" {{ old('endereco.estado_id', $data['model'] ? $data['model']->endereco()->cidade->estado_id : '') == $estado->id ? 'selected' : '' }}>{{ $estado->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="errors"> {{ $errors->first('endereco.uf') }} </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cidade" class="control-label">Cidade</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">location_on</i>
                            </span>
                        </div>
                        <select name="endereco[cidade_id]" id="cidade_id" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($data['cidades'] as $cidade))
                                <option value="{{ $cidade->id }}" {{ old('endereco.cidade_id', $data['model'] ? $data['model']->endereco()->cidade_id : '') == $cidade->id ? 'selected' : '' }}>{{ $cidade->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="errors"> {{ $errors->first('endereco.cidade_id') }} </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="bairro" class="control-label">Bairro</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">location_on</i>
                            </span>
                        </div>
                        <input required type="text" placeholder="Bairro" name="endereco[bairro]" id="bairro" class="form-control" value="{{ old('endereco.bairro', $data['model'] ? $data['model']->endereco()->bairro : '') }}">
                    </div>
                    <span class="errors"> {{ $errors->first('endereco.bairro') }} </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="logradouro" class="control-label">Logradouro</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">location_on</i>
                            </span>
                        </div>
                        <input required type="text" placeholder="Logradouro" name="endereco[logradouro]" id="logradouro" class="form-control" value="{{ old('endereco.logradouro', $data['model'] ? $data['model']->endereco()->logradouro : '') }}">
                    </div>
                    <span class="errors"> {{ $errors->first('endereco.logradouro') }} </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="numero" class="control-label">Número</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">location_on</i>
                            </span>
                        </div>
                        <input required type="text" placeholder="N°" name="endereco[numero]" id="numero" class="form-control" value="{{ old('endereco.numero', $data['model'] ? $data['model']->endereco()->numero : '') }}">
                    </div>
                    <span class="errors"> {{ $errors->first('endereco.numero') }} </span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="complemento" class="control-label">Complemento</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">location_on</i>
                            </span>
                        </div>
                        <input type="text" placeholder="Complemento" name="endereco[complemento]" id="complemento" class="form-control" value="{{ old('endereco.complemento', $data['model'] ? $data['model']->endereco()->complemento : '') }}">
                    </div>
                    <span class="errors"> {{ $errors->first('endereco.complemento') }} </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="tipo" class="control-label">Tipo de Telefone</label>
            <select required name="telefone[tipo_telefone_id]" class="form-control tipo_telefones">
                <option value="">Selecione</option>
                @foreach($data['tipos_telefone'] as $item)
                    <option value="{{ $item->id }}" {{ isset($telefone['tipo_telefone_id']) && $telefone['tipo_telefone_id'] == $item->id ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach
            </select>
            <label class="errors"> {{ $errors->first('tipo') }} </label>
        </div>



        <div class="form-group">
            <label for="numero" class="control-label">Número</label>
            <input type="text" required name="telefone[numero]" id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('numero', "") }}">
            <label class="errors"> {{ $errors->first('numero') }} </label>
        </div>










        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('compra/fornecedor') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>
    </form>

@endsection