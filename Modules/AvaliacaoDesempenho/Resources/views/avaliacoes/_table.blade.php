<table class="table table-bordered table-hover">

    <thead>
  
      <tr>
  
        <th class="text-center">#</th>
  
        <th class="text-center">Nome</th>

        <th class="text-center">Processo</th>

        <th class="text-center">Responsavel</th>

        <th class="text-center">Setor</th>

        <th class="text-center">Data Inicio</th>

        <th class="text-center">Data Fim</th>
  
        <th class="text-center">Status</th>
  
        <th class="text-center">Ações</th>
  
      </tr>
  
    </thead>
  
    <tbody>

      @if ($avaliacoes->count())
  
        @foreach($avaliacoes as $avaliacao)
    
          <tr class="{{ !empty($avaliacao->deleted_at) ? 'table-inactive' : '' }}">
    
            <td class="text-center align-middle">{{ $avaliacao->id }}</td>
    
            <td class="text-center align-middle">{{ $avaliacao->nome }}</td>

            <td class="text-center align-middle">{{ $avaliacao->processo->nome }}</td>

            <td class="text-center align-middle">{{ $avaliacao->responsavel->nome }}</td>

            <td class="text-center align-middle">{{ $avaliacao->setor->nome }}</td>

            <td class="text-center align-middle">{{ $avaliacao->data_inicio }}</td>

            <td class="text-center align-middle">{{ $avaliacao->data_fim }}</td>
            
            <td class="text-center align-middle">{{ is_null($avaliacao->deleted_at) ? 'Ativado' : 'Desativado' }}</td>
    
            <td class="text-center align-middle">
    
              <a class="btn btn-warning btn-edit {{ !empty($avaliacao->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/avaliacao/{{ $avaliacao->id }}/edit"><i class="material-icons md-14 md-light">edit</i></a>
                
              <form action="{{ url('avaliacaodesempenho/avaliacao', [$avaliacao->id]) }}" id="deleteForm_{{$avaliacao->id}}" method="POST">
                @method('DELETE')
                {{ csrf_field() }}
                @if (empty($avaliacao->deleted_at))
      
                  <button class="btn btn-danger" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{$avaliacao->id}}, 'Deseja desativar a Avaliação?')"><i class="material-icons md-14">close</i></button>
      
                @else
      
                  <button class="btn btn-success" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{$avaliacao->id}}, 'Deseja ativar a Avaliação?')"><i class="material-icons md-14">restore_from_trash</i></button>
      
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
  