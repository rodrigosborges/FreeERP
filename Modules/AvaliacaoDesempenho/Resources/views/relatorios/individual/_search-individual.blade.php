<form action="" id="SearchForm" class="search-form col-md-12" method="POST">
    {{ csrf_field() }}
    
    <div class="form-row">
    
        <div class="form-group col-md-5">
    
            <div class="input-group">
    
                <div class="input-group-prepend">
    
                    <span class="input-group-text">
                        <i class="material-icons">list</i>
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

        <div class="form-group col-md-6">
    
            <div class="input-group">
    
                <div class="input-group-prepend">
    
                    <span class="input-group-text">
                        <i class="material-icons">style</i>
                    </span>
    
                </div>
                
                <select name="_avaliacao" id="_avaliacao" class="form-control" disabled>
                    <option value="">Busque por Avaliacao</option>
                </select>
    
            </div>
    
        </div>
        
        <div class="col-md-1">
            <button type="button" class="btn btn-success submit-btn" id="submit-btn" disabled>Buscar</button>
        </div>

    </div>

</form>