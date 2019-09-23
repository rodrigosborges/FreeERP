@foreach ($questoes as $questao)

<div class="card">
    
    <div class="card-header">
        {{ $questao->enunciado }}
        <span class="float-right">{{ $questao->categoria->nome }}</span>
    </div>

    <div class="card-body">
        <ol>
            <li>{{ $questao->opt1 }}</li>
            <li>{{ $questao->opt2 }}</li>
            <li>{{ $questao->opt3 }}</li>
            <li>{{ $questao->opt4 }}</li>
            <li>{{ $questao->opt5 }}</li>
        </ol>
    </div>

    <div class="card-footer">

        <div class="row">
            {{ $questao->id }}

            <a class="btn btn-warning btn-edit {{ !empty($questao->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/questao/{{ $questao->id }}/edit"><i class="material-icons md-14 md-light">edit</i></a>
                  
            <form action="{{ url('avaliacaodesempenho/questao', [$questao->id]) }}" id="deleteForm" method="POST">
              @method('DELETE')
              {{ csrf_field() }}
              @if (empty($questao->deleted_at))
    
                <button class="btn btn-danger" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete('Deseja desativar a Questão?')"><i class="material-icons md-14">close</i></button>
    
              @else
    
                <button class="btn btn-success" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete('Deseja ativar a Questão?')"><i class="material-icons md-14">restore_from_trash</i></button>
    
              @endif
            </form>

        </div>

    </div>

</div>

@endforeach