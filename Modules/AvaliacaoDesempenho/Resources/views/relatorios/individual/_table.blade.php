<table id='table' class='table table-hover table-bordered'>

    <thead>
    
        <tr>
    
        <th class="text-center">Avaliação</th>
    
        <th class="text-center">Avaliador</th>
    
        <th class="text-center">Avaliado</th>
    
        <th class="text-center">Data Avaliação</th>
    
        <th class="text-center">Ações</th>
    
        </tr>
    
    </thead>
      
    <tbody>
    
        @if ($result->count())
    
            @foreach($result as $resultado)
        
            <tr class="{{ !empty($resultado->deleted_at) ? 'table-inactive' : '' }}">
        
                <td class="text-center align-middle">{{ $resultado->avaliacao->funcionario->nome }}</td>
            
                <td class="text-center align-middle">{{ $resultado->avaliador->funcionario->nome }}</td>
            
                <td class="text-center align-middle">{{ $resultado->avaliado->nome }}</td>
            
                <td class="text-center align-middle">{{ date("d/m/Y", strtotime($resultado->created_at)) }}</td>
            
                <td class="text-center align-middle acoes">
            
                    <a class="btn btn-info acoes-btn" title="Show"
                    href="/tcc/public/avaliacaodesempenho/relatorio/{{ $resultado->id }}/show"><i
                        class="material-icons md-18 md-light">search</i></a>
            
                </td>
        
            </tr>
        
            @endforeach
    
        @endif
    
    </tbody>
    
</table>
      