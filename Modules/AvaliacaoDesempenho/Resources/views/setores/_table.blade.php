<table class="table table-bordered table-hover">

    <thead>
  
      <tr>
  
        <th class="text-center">Nome</th>
  
        <th class="text-center">Status</th>
  
        <th class="text-center">Ações</th>
  
      </tr>
  
    </thead>
  
    <tbody>

      @if ($setores->count())
  
        @foreach($setores as $setor)
    
          <tr class="{{ !empty($setor->deleted_at) ? 'table-inactive' : '' }}">
    
            <td class="text-center align-middle">{{ $setor->nome }}</td>
    
            <td class="text-center align-middle">{{ is_null($setor->deleted_at) ? 'Ativado' : 'Desativado' }}</td>
    
            <td class="text-center align-middle acoes">
    
              <a class="btn btn-warning btn-edit acoes-btn {{ !empty($setor->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/setor/{{ $setor->id }}/edit"><i class="material-icons md-18 md-light">edit</i></a>
                
              <form action="{{ url('avaliacaodesempenho/setor', [$setor->id]) }}" id="deleteForm_{{$setor->id}}" method="POST">
                @method('DELETE')
                {{ csrf_field() }}
                @if (empty($setor->deleted_at))
      
                  <button class="btn btn-danger acoes-btn" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{$setor->id}}, 'Deseja desativar a Setor?')"><i class="material-icons md-18">close</i></button>
      
                @else
      
                  <button class="btn btn-success acoes-btn" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{$setor->id}}, 'Deseja ativar a Setor?')"><i class="material-icons md-18">restore_from_trash</i></button>
      
                @endif
              </form>
    
            </td>
    
          </tr>
    
        @endforeach

      @else
    
        <div class="alert alert-warning">Não foram encontrados registros.</div>

      @endif
  
    </tbody>
  
  </table>
  