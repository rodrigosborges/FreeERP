@if(isset($data['avaliacao']->id))
    <form id='avaliacaoForm' action="{{ url('avaliacaodesempenho/avaliacao', [$data['avaliacao']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
@else
    <form id='avaliacaoForm' action='{{ url("avaliacaodesempenho/avaliacao/store") }}' method="POST">
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

                        <label>Nome da Avaliação</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">description</i>
                                </span>
                            </div>

                            <input class="form-control" name='avaliacao[nome]' type="text" value="{{ old('avaliacao.nome', isset($data['avaliacao']) ? $data['avaliacao']->nome : '') }}"
                                placeholder="Digite o nome da avaliacao">

                        </div>

                        <span class="errors"> {{ $errors->first('avaliacao.nome') }} </span>

                    </div>

                </div>

                <div class='form-row'>

                    <div class='form-group col-md-6'>

                        <label>Data Inicio Avaliação</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">date_range</i>
                                </span>
                            </div>

                            <input class="form-control date" name='avaliacao[data_inicio]' type="text" value="{{ old('avaliacao.data_inicio', isset($data['avaliacao']) ? $data['avaliacao']->data_inicio : '') }}"
                                placeholder="Selecione a data de inicio">

                        </div>

                        <span class="errors"> {{ $errors->first('avaliacao.data_inicio') }} </span>

                    </div>

                    <div class='form-group col-md-6'>

                        <label>Data Final Avaliação</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">date_range</i>
                                </span>
                            </div>

                            <input class="form-control date" name='avaliacao[data_fim]' type="text" value="{{ old('avaliacao.data_fim', isset($data['avaliacao']) ? $data['avaliacao']->data_fim : '') }}"
                                placeholder="Selecione a data final">

                        </div>

                        <span class="errors"> {{ $errors->first('avaliacao.data_fim') }} </span>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label>Processo</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">description</i>
                                </span>
                            </div>

                            <select class="form-control" name="avaliacao[processo_id]"
                                id="avaliacao[processo_id]">
                                <option value="">Selecione o Processo ao qual a Avaliação pertence</option>
                                @foreach( $data['processos'] as $processo)
                                    <option {{ old('avaliacao.processo_id', isset($data['avaliacao']) ? $data['avaliacao']->processo_id : '') == $processo->id ? 'selected' : ''}} value="{{ $processo->id }}">{{ $processo->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                        <span class="errors"> {{ $errors->first('avaliacao.processo_id') }} </span>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-8">

                        <label>Responsavel</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">people</i>
                                </span>
                            </div>

                            <select class="form-control" name="avaliacao[funcionario_id]"
                                id="avaliacao[funcionario_id]">
                                <option value="">Selecione o Funcionario responsavel pela Avaliação</option>
                                @foreach( $data['funcionarios'] as $funcionario)
                                    <option {{ old('avaliacao.funcionario_id', isset($data['avaliacao']) ? $data['avaliacao']->funcionario_id : '') == $funcionario->id ? 'selected' : ''}} value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                        <span class="errors"> {{ $errors->first('avaliacao.funcionario_id') }} </span>

                    </div>

                    <div class="form-group col-md-4">

                        <label>Setor</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">style</i>
                                </span>
                            </div>

                            <select class="form-control {{ isset($data['avaliacao']) ? 'readonly' : '' }}" name="avaliacao[setor_id]"
                                id="avaliacao[setor_id]">
                                <option value="">Selecione o Setor a ser avaliado</option>
                                @foreach( $data['setores'] as $setor)
                                    <option {{ old('avaliacao.setor_id', isset($data['avaliacao']) ? $data['avaliacao']->setor_id : '') == $setor->id ? 'selected' : ''}} value="{{ $setor->id }}">{{ $setor->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                        <span class="errors"> {{ $errors->first('avaliacao.setor_id') }} </span>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label>Tipo de Avaliação</label>

                        <br>
                        <input type="radio" name='avaliacao[tipo_id]' value='2' {{ isset($data['avaliacao']) && $data['avaliacao']->gestor == 0 ? 'checked' : '' }}> Avaliar Gestores
                        <br>
                        <input type="radio" name='avaliacao[tipo_id]' value='1' {{ isset($data['avaliacao']) && $data['avaliacao']->gestor == 1 ? 'checked' : '' }}> Avaliar Funcionários

                    </div>

                    <span class="errors"> {{ $errors->first('avaliacao.tipo_id') }} </span>

                </div>

                <hr>

                <h4>QUESTÕES</h4>

                <div id="input-questoes" class="input-questoes">
                    @if (isset($data['avaliacao']))

                      @foreach ($data['avaliacao']->questoes as $key => $questao)
                        <div class='row input-questao'>
                          <input class='name-questao' type='hidden' name='avaliacao[questoes][{{ $key }}]' value={{ $questao->id }}></input>

                          <div>
                            <h6 class='questao-count'></h6>
                            <p><b>Enunciado: </b>{{ $questao->enunciado }}</p>
                          </div>

                          <button type='button' class='btn btn-danger btn-sm float-right' onclick="excluirQuestao({{ $key }})"><i class="material-icons md-18">close</i>
                        </div>
                      @endforeach

                    @endif
                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                        <input id='questoes' type="text" class='form-control'>

                    </div>

                    <span class="errors"> {{ $errors->first('avaliacao.questoes') }} </span>
                    <span class="errors"> {{ $errors->first('avaliacao.questoes.*') }} </span>

                </div>

                <div id='questaoCard' class="form-row hidden">

                    <div class="card">

                        <div class="card-header"></div>

                        <div class="card-body">

                            <div class="enunciado"></div>
                            <div class="options">
                                <ul></ul>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type='button' class="btn btn-primary btn-sm float-right save-card">Salvar</button>
                        </div>

                    </div>

                </div>

            </div>

            <div class='card-footer'>

                <div class="row">

                    <a href="{{ url('avaliacaodesempenho/avaliacao') }}" class="btn btn-danger">Cancelar</a>

                    <button class="btn btn-success" type='submit'>Salvar</button>

                </div>

            </div>

        </div>

    </div>

</form>
