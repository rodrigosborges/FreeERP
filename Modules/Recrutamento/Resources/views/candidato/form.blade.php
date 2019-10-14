@extends('template')
@section('content')
    
    <div class="card">
    <div class="card-header"><h3>{{$data['title']}}</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($data['model'])
                @method('PUT')
            @endif
            <h3>Candidato</h3>
            <hr> 
            <div class="form-group">
            
            <div class="form-row">
                <div class="col-md-12">    
                    <label for="nome" class="control-label">Nome</label>
                    <input type="text" name="candidato[nome]" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
                    <label class="errors"> {{ $errors->first('nome') }} </label>
                </div>
            </div>

            <div class="form-row">

                <div class="col-sm">
                    <p><b>Vaga:</b> {{$data['vaga']->cargo->first()->nome}}.</p>
                    <p><b>Categoria:</b> {{$data['vaga']->cargo->first()->categoria()->first()->nome}}.</p>
                </div>

                <div class="col">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="curriculum" id="curriculum" aria-describedby="inputcurriculum">
                            <label class="custom-file-label"  for="curriculum">Escolha o currículo</label>
                        </div>
                    </div>
                </div>
                
                <div class="col">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto" id="foto" aria-describedby="inputfoto">
                            <label class="custom-file-label"  for="foto">Escolha a foto</label>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-sm custom-file"">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" class="custom-file-input" id="foto">
                </div> -->

            </div>


            <br>
            <h3>Contato</h3>
            <hr> 

            <div class="form-row">
            <div class="col-sm">
            <label for="email" class="control-label">E-mail</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">email</i>
                    </span>
                </div>
                <input required type="text" placeholder="E-mail" name="email[email]" id="email" class="form-control" value="{{ old('email', $data['model'] ? $data['model']->email()->email : '') }}">
            </div>
                <span class="errors"> {{ $errors->first('email') }} </span>
            </div>
            

            
            <div class="col-sm">
                <label for="tipo" class="control-label">Tipo de Telefone</label>
                <select required name="telefone[tipo_telefone_id]" class="form-control tipo_telefones">
                    <option value="">Selecione</option>
                    @foreach($data['tipos_telefone'] as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $data['telefone']['tipo_telefone_id'] ? 'selected' : '' }}> {{ $item->nome }} </option>
                    @endforeach
                </select>
                <label class="errors"> {{ $errors->first('telefone.tipo') }} </label>
            </div>       

            <div class="col-sm">
                <label for="numero" class="control-label">Número</label>
                <input type="text" required name="telefone[numero]" maxlength='11' id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->telefones->numero : old('numero', "") }}">
                <label class="errors"> {{ $errors->first('telefone.numero') }} </label>
            </div>
            </div>
            </div>

            <br>
            <h3>Endereço</h3>
            <hr>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="cep" class="control-label">CEP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">location_on</i>
                                </span>
                            </div>
                            <input type="text" placeholder="CEP" name="endereco[cep]" id="cep" class="form-control cep" value="{{ old('endereco.cep', $data['model'] ? $data['model']->endereco()->cep : '') }}">
                        </div>
                        <span class="errors"> {{ $errors->first('endereco.cep') }} </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="uf" class="control-label">Estado <span class="required-symbol">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">location_on</i>
                                </span>
                            </div>
                            <select required data-cidade="{{old('endereco.cidade_id', $data['model'] ? $data['model']->endereco()->cidade_id : '')}}" name="endereco[estado_id]" id="estado_id" class="form-control estados">
                                <option value="">Selecione</option>
                                @foreach($data['estados'] as $estado))
                                    <option data-uf="{{$estado->uf}}" value="{{ $estado->id }}" {{ old('endereco.estado_id', $data['model'] ? $data['model']->endereco()->cidade->estado_id : '') == $estado->id ? 'selected' : '' }}>{{ $estado->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="errors"> {{ $errors->first('endereco.uf') }} </span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label for="cidade" class="control-label">Cidade <span class="required-symbol">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">location_on</i>
                                </span>
                            </div>
                            <select required name="endereco[cidade_id]" id="cidade_id" class="form-control cidades">
                                <option value="">Selecione</option>
                                @foreach($data['cidades'] as $cidade))
                                    <option data-uf="{{$cidade->uf}}" value="{{ $cidade->id }}" {{ old('endereco.cidade_id', $data['model'] ? $data['model']->endereco()->cidade->estado_id : '') == $cidade->id ? 'selected' : '' }}>{{ $cidade->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="errors"> {{ $errors->first('endereco.cidade_id') }} </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="bairro" class="control-label">Bairro <span class="required-symbol">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">location_on</i>
                                </span>
                            </div>
                            <input required type="text" placeholder="Bairro" name="endereco[bairro]" id="bairro" class="form-control bairro" value="{{ old('endereco.bairro', $data['model'] ? $data['model']->endereco()->bairro : '') }}">
                        </div>
                        <span class="errors"> {{ $errors->first('endereco.bairro') }} </span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="logradouro" class="control-label">Logradouro <span class="required-symbol">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">location_on</i>
                                </span>
                            </div>
                            <input required type="text" placeholder="Logradouro" name="endereco[logradouro]" id="logradouro" class="form-control logradouro" value="{{ old('endereco.logradouro', $data['model'] ? $data['model']->endereco()->logradouro : '') }}">
                        </div>
                        <span class="errors"> {{ $errors->first('endereco.logradouro') }} </span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="numero" class="control-label">Número <span class="required-symbol">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">location_on</i>
                                </span>
                            </div>
                            <input required type="text" placeholder="N°" name="endereco[numero]" id="numero" class="form-control numero" value="{{ old('endereco.numero', $data['model'] ? $data['model']->endereco()->numero : '') }}">
                        </div>
                        <span class="errors"> {{ $errors->first('endereco.numero') }} </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
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

            <input type="hidden" name="candidato[vaga_id]" value="{{$data['vaga']->id}}">
            <div class="form-group">
                <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
                <a class="btn btn-light" href="{{ url('recrutamento/vagasDisponiveis') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>

        </form>
    </div>
    </div>
    

@endsection
@section('js')
    <script>
        $('.money').mask('000.000,00', {reverse: true});
        $('.cep').mask('00000-000');
    </script>

@endsection
