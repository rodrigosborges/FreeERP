<div class='container'>

    @if(isset($data['processo']->id))
        <form action="/tcc/public/avaliacaodesempenho/processos/{{$data['processo']->id}}" method="PUT">
        @csrf        
    @else
        <form action='/tcc/public/avaliacaodesempenho/processos/store' method="POST">
        @csrf
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

                            <label>Data Inicio Processo</label>

                            <div class='input-group'>

                                <div class='input-group-prepend'>
                                    <span class="input-group-text">
                                        <i class="material-icons android"></i>
                                    </span>
                                </div>

                                <input class="form-control" name='processo[data_inicio]' type="date" value=''
                                    placeholder="Selecione a data de inicio">

                                <div class="invalid-feedback"></div>

                            </div>

                        </div>

                        <div class='form-group col-md-6'>

                            <label>Data Final Processo</label>

                            <div class='input-group'>

                                <div class='input-group-prepend'>
                                    <span class="input-group-text">
                                        <i class="material-icons android"></i>
                                    </span>
                                </div>

                                <input class="form-control" name='processo[data_fim]' type="date" value=''
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
                                        <i class="material-icons android"></i>
                                    </span>
                                </div>

                                <select class="form-control" name="processo[responsavel_id]"
                                    id="processo[responsavel_id]">
                                    <option value="">Selecione o Funcionario Responsavel pelo Processo</option>
                                    <option value="1">Nikolas Lencioni</option>
                                    <option value="2">Deborah Donofrio</option>
                                </select>

                            </div>

                        </div>

                    </div>


                </div>

                <div class='card-footer'>

                    <div class="row">

                        <a href="/tcc/public/avaliacaodesempenho/processos" class="btn btn-danger">Cancelar</a>

                        <button class="btn btn-success" type='submit'>Salvar</button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>