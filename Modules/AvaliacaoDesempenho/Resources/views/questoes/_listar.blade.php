@if ($result->count())

  @foreach ($result as $questao)

  <div class="card">
      
      <div class="card-header">
        <b>Categoria: {{ $questao->categoria->nome }}</b>
        <b>{{ !empty($questao->deleted_at) ? ' | DESATIVADA' : '' }}</b>
      </div>

      <div class="card-body {{ !empty($questao->deleted_at) ? 'inactive' : '' }}">
        
        <b>Enunciado:</b>
        <p>{{ $questao->enunciado }}</p>

        <hr>

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

              <a class="btn btn-warning btn-edit acoes-btn {{ !empty($questao->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/questao/{{ $questao->id }}/edit"><i class="material-icons md-18 md-light">edit</i></a>
                    
              <form action="{{ url('avaliacaodesempenho/questao', [$questao->id]) }}" id="deleteForm_{{$questao->id}}" method="POST">
                @method('DELETE')
                {{ csrf_field() }}
                @if (empty($questao->deleted_at))
      
                  <button class="btn btn-danger acoes-btn" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{$questao->id}}, 'Deseja desativar a Questão?')"><i class="material-icons md-20">close</i></button>
      
                @else
      
                  <button class="btn btn-success acoes-btn" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{$questao->id}}, 'Deseja ativar a Questão?')"><i class="material-icons md-20">cached</i></button>
      
                @endif
              </form>

          </div>

      </div>

  </div>

  @endforeach

@else

  <div class="alert alert-warning">Não foram encontrados registros.</div>

@endif