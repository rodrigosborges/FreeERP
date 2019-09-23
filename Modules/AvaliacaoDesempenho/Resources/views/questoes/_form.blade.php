@if(isset($data['questao']->id))
    <form action="{{ url('avaliacaodesempenho/questao', [$data['questao']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
@else
    <form action='{{ url("avaliacaodesempenho/questao/store") }}' method="POST">
    {{ csrf_field() }}
@endif

    <div class='row'>

        <div class='card'>

            <div class='card-header'>

                <div class="card-title">
                    <h3>Adicionar</h3>
                </div>

                @if ($errors)
                @foreach ($errors as $error)
                <div class="text-danger">{{$error}}</div>
                @endforeach
                @endif
            </div>

            <div class='card-body'>

                <div class='form-row'>

                    <div class='form-group col-md-12'>

                        <label>Enunciado</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='questao[enunciado]' tyddt" value=''
                                placeholder="Digite o Enunciado da Questão">

                            <div class="invalid-feedback">
                                @error('processo.enunciado')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label>Categoria</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <select class="form-control" name="questao[categoria_id]" id="questao[categoria_id]">
                                <option value="">Selecione a Categoria da Questão</option>
                                @foreach( $data['categorias'] as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class='form-group col-md-12'>

                        <label>Opção 1</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='questao[opt1]' tyddt" value=''
                                placeholder="Digite a opção">

                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class='form-group col-md-12'>

                        <label>Opção 2</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='questao[opt2]' tyddt" value=''
                                placeholder="Digite a opção">

                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class='form-group col-md-12'>

                        <label>Opção 3</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='questao[opt3]' tyddt" value=''
                                placeholder="Digite a opção">

                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class='form-group col-md-12'>

                        <label>Opção 4</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='questao[opt4]' tyddt" value=''
                                placeholder="Digite a opção">

                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class='form-group col-md-12'>

                        <label>Opção 5</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='questao[opt5]' tyddt" value=''
                                placeholder="Digite a opção">

                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                </div>

            </div>

            <div class='card-footer'>

                <div class="row">

                    <a href="{{ url('avaliacaodesempenho/processo') }}" class="btn btn-danger">Cancelar</a>

                    <button class="btn btn-success" type='submit'>Salvar</button>

                </div>

            </div>

        </div>

    </div>

</form>