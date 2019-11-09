@if ($result->count())

<table id='table'>

    <thead>

        <tr>

            <th></th>

        </tr>

    </thead>

    <tbody>

        @foreach ($result as $questao)
        <tr>

            <td>

                <div class="card">

                    <div class="card-header question-header">

                        <div class="row">

                            <div>

                                <b>Categoria: {{ $questao->categoria->nome }}</b>
                                <b>{{ !empty($questao->deleted_at) ? ' | DESATIVADA' : '' }}</b>

                            </div>

                            <div class="row">

                                <a class="btn btn-warning btn-edit acoes-btn {{ !empty($questao->deleted_at) ? 'disabled' : '' }}"
                                    title="Editar"
                                    href="/tcc/public/avaliacaodesempenho/questao/{{ $questao->id }}/edit"><i
                                        class="material-icons md-18 md-light">edit</i></a>

                                <form action="{{ url('avaliacaodesempenho/questao', [$questao->id]) }}"
                                    id="deleteForm_{{$questao->id}}" method="POST">
                                    @method('DELETE')
                                    {{ csrf_field() }}
                                    @if (empty($questao->deleted_at))

                                    <button class="btn btn-danger acoes-btn" type="button" id="btn-delete"
                                        title="Desativar"
                                        onclick="confirmDelete({{$questao->id}}, 'Deseja desativar a Questão?')"><i
                                            class="material-icons md-20">close</i></button>

                                    @else

                                    <button class="btn btn-success acoes-btn" type="button" id="btn-delete"
                                        title="Ativar"
                                        onclick="confirmDelete({{$questao->id}}, 'Deseja ativar a Questão?')"><i
                                            class="material-icons md-20">cached</i></button>

                                    @endif
                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="card-body {{ !empty($questao->deleted_at) ? 'inactive' : '' }}">

                        <b>Enunciado:</b>
                        <p>{{ $questao->enunciado }}</p>

                        <hr>

                        <b>Alternativas:</b>
                        <ul class='opt-list'>
                            <li><b>a)</b> {{ $questao->opt1 }}</li>
                            <li><b>b)</b> {{ $questao->opt2 }}</li>
                            <li><b>c)</b> {{ $questao->opt3 }}</li>
                            <li><b>d)</b> {{ $questao->opt4 }}</li>
                            <li><b>e)</b> {{ $questao->opt5 }}</li>
                        </ul>

                    </div>

                </div>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@else

<div class="alert alert-warning">Não foram encontrados registros.</div>

@endif