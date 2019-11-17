@if(isset($data['categoria']->id))
    <form id='categoriaForm' action="{{ url('avaliacaodesempenho/categoria', [$data['categoria']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}      
@else
    <form id='categoriaForm' action='{{ url("avaliacaodesempenho/categoria/store") }}' method="POST">
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

                        <label>Nome da Categoria</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">subject</i>
                                </span>
                            </div>

                            <input class="form-control nome" name='categoria[nome]' type="text" value="{{ old('categoria.nome', isset($data['categoria']) ? $data['categoria']->nome : '') }}"
                                placeholder="Digite o nome da categoria">

                        </div>

                        <span class="errors"> {{ $errors->first('categoria.nome') }} </span>

                    </div>

                </div>

            </div>

            <div class='card-footer'>

                <div class="row">

                    <a href="{{ url('avaliacaodesempenho/categoria') }}" class="btn btn-danger">Cancelar</a>

                    <button class="btn btn-success" type='submit'>Salvar</button>

                </div>

            </div>

        </div>

    </div>

</form>