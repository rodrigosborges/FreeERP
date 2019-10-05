<form action="" id="SearchForm" class="search-form col-md-12" method="POST">
        {{ csrf_field() }}
        
        <div class="form-row">

            <div class="form-group col-md-6">

                <div class="input-group">
        
                    <div class="input-group-prepend">
        
                        <span class="input-group-text">
                            <i class="material-icons">android</i>
                        </span>
    
                    </div>
                        
                    <input type="text" class="form-control" name="_nome" placeholder="Busque por Nome">
        
                </div>
        
            </div>
    
            <div class="form-group col-md-6">
        
                <div class="input-group">
        
                    <div class="input-group-prepend">
        
                        <span class="input-group-text">
                            <i class="material-icons">android</i>
                        </span>
        
                    </div>
                    
                    <select name="_processo" id="_processo" class="form-control">
                        <option value="">Busque por Processo</option>
                        @foreach ($data['processos'] as $processo)
                            <option value="{{ $processo->id }}">{{ $processo->nome }}</option>                        
                        @endforeach
                    </select>
        
                </div>
        
            </div>
    
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
    
                <div class="input-group">
        
                    <div class="input-group-prepend">
        
                        <span class="input-group-text">
                            <i class="material-icons">android</i>
                        </span>
        
                    </div>
                    
                    <select name="_responsavel" id="_responsavel" class="form-control">
                        <option value="">Busque por Responsável</option>
                        @foreach ($data['funcionarios'] as $funcionario)
                            <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>                        
                        @endforeach
                    </select>
        
                </div>
        
            </div>

            <div class="form-group col-md-6">
    
                <div class="input-group">
        
                    <div class="input-group-prepend">
        
                        <span class="input-group-text">
                            <i class="material-icons">android</i>
                        </span>
        
                    </div>
                    
                    <select name="_setor" id="_setor" class="form-control">
                        <option value="">Busque por Setor</option>
                        @foreach ($data['setores'] as $setor)
                            <option value="{{ $setor->id }}">{{ $setor->nome }}</option>                        
                        @endforeach
                    </select>
        
                </div>
        
            </div>

        </div>
    
        <div class="form-row">
    
                <div class="form-group col-md-4">
            
                    <div class='input-group'>
    
                        <div class='input-group-prepend'>
                            <span class="input-group-text">
                                <i class="material-icons">android</i>
                            </span>
                        </div>
    
                        <input class="form-control" name='_data_inicio' type="date"
                            placeholder="Busque por Data de Inicio">
    
                    </div>
            
                </div>
    
                <div class="form-group col-md-4">
            
                    <div class='input-group'>
    
                        <div class='input-group-prepend'>
                            <span class="input-group-text">
                                <i class="material-icons">android</i>
                            </span>
                        </div>
    
                        <input class="form-control" name='_data_fim' type="date"
                            placeholder="Busque por Data de Finalização">
    
                    </div>
            
                </div>
    
                <div class="form-group col-md-3">
        
                    <div class="input-group">
            
                        <div class="input-group-prepend">
            
                            <span class="input-group-text">
                                <i class="material-icons">android</i>
                            </span>
            
                        </div>
                        
                        <select name="_status" id="_status" class="form-control">
                            <option value="">Busque por Status</option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
            
                    </div>
            
                </div>
                
                <div class="col-md-1">
                    <button type="button" class="btn btn-success submit-btn" id="submit-btn">Buscar</button>
                </div>
        
            </div>
    
    </form>