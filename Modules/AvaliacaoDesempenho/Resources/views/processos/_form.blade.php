@if(isset($data['processo']->id))
    <form action="{{ url('avaliacaodesempenho/processo', [$data['processo']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}      
@else
    <form action='{{ url("avaliacaodesempenho/processo/store") }}' method="POST">
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
        
                                <label>Nome do Processo</label>
        
                                <div class='input-group'>
        
                                    <div class='input-group-prepend'>
                                        <span class="input-group-text">
                                            <i class="material-icons">android</i>
                                        </span>
                                    </div>
        
                                    <input class="form-control" name='processo[nome]' type="text" value="{{ old('processo.nome', isset($data['processo']) ? $data['processo']->nome : '') }}"
                                        placeholder="Digite o nome do processo">
        
                                    <div class="invalid-feedback">
                                        @error('processo.nome')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
        
                                </div>
        
                            </div>
        
                        </div>

                <div class='form-row'>

                    <div class='form-group col-md-6'>

                        <label>Data Inicio Processo</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='processo[data_inicio]' type="date" value="{{ old('processo.data_inicio', isset($data['processo']) ? $data['processo']->data_inicio : '') }}"
                                placeholder="Selecione a data de inicio">

                            <div class="invalid-feedback">
                                @error('processo.data_inicio')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class='form-group col-md-6'>

                        <label>Data Final Processo</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='processo[data_fim]' type="date" value="{{ old('processo.data_fim', isset($data['processo']) ? $data['processo']->data_fim : '') }}"
                                placeholder="Selecione a data final">

                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label>Responsavel pelo Processo</label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <select class="form-control" name="processo[funcionario_id]"
                                id="processo[funcionario_id]">
                                <option value="">Selecione o Funcionario Responsavel pelo Processo</option>
                                @foreach( $data['funcionarios'] as $funcionario)
                                    <option {{ old('processo.funcionario_id', isset($data['processo']) ? $data['processo']->funcionario_id : '') == $funcionario->id ? 'selected' : ''}} value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                                @endforeach
                            </select>

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