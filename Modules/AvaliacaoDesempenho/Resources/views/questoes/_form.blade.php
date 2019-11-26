@if(isset($data['questao']->id))
    <form id="questaoForm" action="{{ url('avaliacaodesempenho/questao', [$data['questao']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
@else
    <form id="questaoForm" action='{{ url("avaliacaodesempenho/questao/store") }}' method="POST">
    {{ csrf_field() }}
@endif

    <div class='row'>

        <div class='card'>

            <div class='card-header'>

                <div class="card-title">
                    <h3>Adicionar</h3>
                </div>

            </div>

            <div class='card-body'>

                <div class='form-row'>

                    <div class='form-group col-md-12'>

                        <label>Enunciado</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">subject</i>
                                </span>
                            </div>

                            <input class="form-control enunciado" name='questao[enunciado]' type='text' value="{{ old('questao.enunciado', isset($data['questao']) ? $data['questao']->enunciado : '') }}"
                                placeholder="Digite o Enunciado da Questão">

                        </div>

                    <span class="errors"> {{ $errors->first('questao.enunciado') }} </span>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label>Categoria</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">list</i>
                                </span>
                            </div>

                            <select class="form-control categoria" name="questao[categoria_id]" id="questao[categoria_id]">
                                <option value="">Selecione a Categoria da Questão</option>
                                @foreach( $data['categorias'] as $categoria)
                                    <option {{ old('questao.categoria_id', isset($data['questao']) ? $data['questao']->categoria_id : '') == $categoria->id ? 'selected' : ''}} value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                        <span class="errors"> {{ $errors->first('questao.categoria_id') }} </span>

                    </div>

                </div>

                <div class="form-row">

                    <div class='form-group col-md-12'>

                        <label>Descrição</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">done</i>
                                </span>
                            </div>

                            <textarea class='form-control' name='questao[descricao]'>{{ old('questao.descricao', isset($data['questao']) ? $data['questao']->descricao : '') }}</textarea>

                        </div>

                        <span class="errors"> {{ $errors->first('questao.descricao') }} </span>

                    </div>

                </div>

            </div>

            <div class='card-footer'>

                <div class="row">

                    <a href="{{ url('avaliacaodesempenho/questao') }}" class="btn btn-danger">Cancelar</a>

                    <button class="btn btn-success" type='submit'>Salvar</button>

                </div>

            </div>

        </div>

    </div>

</form>