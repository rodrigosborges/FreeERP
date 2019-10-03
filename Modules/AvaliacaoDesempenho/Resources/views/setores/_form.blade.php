@if(isset($data['processo']->id))
    <form action="{{ url('avaliacaodesempenho/setor', [$data['setor']->id]) }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}      
@else
    <form action='{{ url("avaliacaodesempenho/setor/store") }}' method="POST">
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

                        <label>Nome do Setor</label>

                        <div class='input-group'>

                            <div class='input-group-prepend'>
                                <span class="input-group-text">
                                    <i class="material-icons">android</i>
                                </span>
                            </div>

                            <input class="form-control" name='setor[nome]' type="text" value="{{ old('setor.nome', $data['setor'] ? $data['setor']->nome : '') }}"
                                placeholder="Digite o nome da setor">

                            <div class="invalid-feedback">
                                @error('setor.nome')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

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