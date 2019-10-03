@foreach ($questoes as $questao)

<div class="card">
    
    <div class="card-header">
      <b>{{ $questao->enunciado }}</b>
      <b>{{ !empty($questao->deleted_at) ? ' | DESATIVADA' : '' }}</b>
        <span class="float-right">
          <b>Categoria: {{ $questao->categoria->nome }}</b>
        </span>
    </div>

    <div class="card-body {{ !empty($questao->deleted_at) ? 'inactive' : '' }}">
      <b>Alternativas:</b>
      <ul>
          <li>a) - {{ $questao->opt1 }}</li>
          <li>b) - {{ $questao->opt2 }}</li>
          <li>c) - {{ $questao->opt3 }}</li>
          <li>d) - {{ $questao->opt4 }}</li>
          <li>e) - {{ $questao->opt5 }}</li>
      </ul>
    </div>

    <div class="card-footer">

        <div class="row">

            <a class="btn btn-warning btn-edit {{ !empty($questao->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/questao/{{ $questao->id }}/edit"><i class="material-icons md-14 md-light">edit</i></a>
                  
            <form action="{{ url('avaliacaodesempenho/questao', [$questao->id]) }}" id="deleteForm_{{$questao->id}}" method="POST">
              @method('DELETE')
              {{ csrf_field() }}
              @if (empty($questao->deleted_at))
    
                <button class="btn btn-danger" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{$questao->id}}, 'Deseja desativar a Questão?')"><i class="material-icons md-14">close</i></button>
    
              @else
    
                <button class="btn btn-success" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{$questao->id}}, 'Deseja ativar a Questão?')"><i class="material-icons md-14">restore_from_trash</i></button>
    
              @endif
            </form>

        </div>

    </div>

</div>

@endforeach