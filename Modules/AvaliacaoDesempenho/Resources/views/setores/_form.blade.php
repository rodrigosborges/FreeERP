@if(isset($data['setor']->id))
    <form id="setorForm" action="{{ url('avaliacaodesempenho/setor', [$data['setor']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}      
@else
    <form id="setorForm" action='{{ url("avaliacaodesempenho/setor/store") }}' method="POST">
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

                    <div class='form-group col-md-6'>

                        <label>Nome do Setor</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">subject</i>
                                </span>
                            </div>

                            <input class="form-control nome" name='setor[nome]' type="text" value="{{ old('setor.nome', isset($data['setor']) ? $data['setor']->nome : '') }}"
                                placeholder="Digite o nome da setor">

                        </div>

                        <span class="errors"> {{ $errors->first('setor.nome') }} </span>

                    </div>

                    <div class='form-group col-md-6'>

                        <label>Gestor</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">subject</i>
                                </span>
                            </div>

                            <select class="form-control gestor" name="setor[gestor_id]" id="setor[gestor_id]">
                                <option value="">Selecione o Gestor do Setor</option>
                                @foreach( $data['funcionarios'] as $funcionario)
                                    <option {{ old('setor.gestor_id', isset($data['setor']) ? $data['setor']->gestor_id : '') == $funcionario->id ? 'selected' : ''}} value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                        <span class="errors"> {{ $errors->first('setor.gestor_id') }} </span>

                    </div>

                </div>

            </div>

            <div class='card-footer'>

                <div class="row">

                    <a href="{{ url('avaliacaodesempenho/setor') }}" class="btn btn-danger">Cancelar</a>

                    <button class="btn btn-success" type='submit'>Salvar</button>

                </div>

            </div>

        </div>

    </div>

</form>