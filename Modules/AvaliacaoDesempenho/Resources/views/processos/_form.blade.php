@if(isset($data['processo']->id))
    <form id="processoForm" action="{{ url('avaliacaodesempenho/processo', [$data['processo']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}      
@else
    <form id="processoForm" action='{{ url("avaliacaodesempenho/processo/store") }}' method="POST">
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
        
                                <label>Nome do Processo</label>
        
                                <div class='input-group'>
        
                                    <div class='input-group-prepend'>
                                        <span class="input-group-text">
                                            <i class="material-icons">description</i>
                                        </span>
                                    </div>
        
                                    <input class="form-control nome" name='processo[nome]' type="text" value="{{ old('processo.nome', isset($data['processo']) ? $data['processo']->nome : '') }}"
                                        placeholder="Digite o nome do processo">

                                </div>

                                <span class="errors"> {{ $errors->first('processo.nome') }} </span>
        
                            </div>
        
                        </div>

                <div class='form-row'>

                    <div class='form-group col-md-6'>

                        <label>Data Inicio Processo</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">date_range</i>
                                </span>
                            </div>

                            <input class="form-control data data_inicio" name='processo[data_inicio]' type="text" value="{{ old('processo.data_inicio', isset($data['processo']) ? $data['processo']->data_inicio : '') }}"
                                placeholder="Selecione a data de inicio">

                        </div>

                        <span class="errors"> {{ $errors->first('processo.data_inicio') }} </span>

                    </div>

                    <div class='form-group col-md-6'>

                        <label>Data Final Processo</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">date_range</i>
                                </span>
                            </div>

                            <input class="form-control data data_fim" name='processo[data_fim]' type="text" value="{{ old('processo.data_fim', isset($data['processo']) ? $data['processo']->data_fim : '') }}"
                                placeholder="Selecione a data final">

                        </div>

                        <span class="errors"> {{ $errors->first('processo.data_fim') }} </span>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label>Responsavel pelo Processo</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">people</i>
                                </span>
                            </div>

                            <select class="form-control responsavel" name="processo[funcionario_id]"
                                id="processo[funcionario_id]">
                                <option value="">Selecione o Funcionario Responsavel pelo Processo</option>
                                @foreach( $data['funcionarios'] as $funcionario)
                                    <option {{ old('processo.funcionario_id', isset($data['processo']) ? $data['processo']->funcionario_id : '') == $funcionario->id ? 'selected' : ''}} value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                                @endforeach
                            </select>

                        </div>
                        
                        <span class="errors"> {{ $errors->first('processo.funcionario_id') }} </span>

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