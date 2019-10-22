@if(isset($data['avaliacao']->id))
    <form action="{{ url('avaliacaodesempenho/avaliacao', [$data['avaliacao']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}      
@else
    <form action='{{ url("avaliacaodesempenho/avaliacao/store") }}' method="POST">
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

                        <label>Nome da Avaliação</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='avaliacao[nome]' type="text" value="{{ old('avaliacao.nome', isset($data['avaliacao']) ? $data['avaliacao']->nome : '') }}"
                                placeholder="Digite o nome da avaliacao">

                            <div class="invalid-feedback">
                                @error('avaliacao.nome')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                </div>

                <div class='form-row'>

                    <div class='form-group col-md-6'>

                        <label>Data Inicio Avaliação</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='avaliacao[data_inicio]' type="date" value="{{ old('avaliacao.data_inicio', isset($data['avaliacao']) ? $data['avaliacao']->data_inicio : '') }}"
                                placeholder="Selecione a data de inicio">

                            <div class="invalid-feedback">
                                @error('avaliacao.data_inicio')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class='form-group col-md-6'>

                        <label>Data Final Avaliação</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='avaliacao[data_fim]' type="date" value="{{ old('avaliacao.data_fim', isset($data['avaliacao']) ? $data['avaliacao']->data_fim : '') }}"
                                placeholder="Selecione a data final">

                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label>Processo</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
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

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-8">

                        <label>Responsavel</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
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

                    </div>

                    <div class="form-group col-md-4">

                        <label>Setor</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <select class="form-control" name="avaliacao[setor_id]" {{ isset($data['avaliacao']) ? 'disabled' : '' }}
                                id="avaliacao[setor_id]">
                                <option value="">Selecione o Setor a ser avaliado</option>
                                @foreach( $data['setores'] as $setor)
                                    <option {{ old('avaliacao.setor_id', isset($data['avaliacao']) ? $data['avaliacao']->setor_id : '') == $setor->id ? 'selected' : ''}} value="{{ $setor->id }}">{{ $setor->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label>Tipo de Avaliação</label>
                        
                        <br>
                        <input type="radio" name='avaliacao[tipo_id]' value='2' {{ isset($data['avaliacao']) && $data['avaliacao']->gestor == 0 ? 'checked' : '' }}> Avaliar Gestores
                        <br>
                        <input type="radio" name='avaliacao[tipo_id]' value='1' {{ isset($data['avaliacao']) && $data['avaliacao']->gestor == 1 ? 'checked' : '' }}> Avaliar não Gestores

                    </div>

                </div>

                <hr>

                <h4>QUESTÕES</h4>

                <div class="form-row">

                    <div class="form-group col-md-12">
                        
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                        <select id="selectQuestoes" class="form-control selectpicker select-questoes" data-live-search="true"></select>

                    </div>

                </div>

                <div id='questaoCard' class="form-row hidden">

                    <div class="card">

                        <div class="card-header"></div>

                        <div class="card-body"></div>

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