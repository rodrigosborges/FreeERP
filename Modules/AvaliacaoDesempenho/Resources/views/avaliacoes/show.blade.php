@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/avaliacoes/show.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="row">

    <div class="col-md 12">

        <div class="card card-primary">

            <div class="card-header">
                <p class="card-title">Detalhes Avaliação: {{ $data['avaliacao']->nome }} | Status:
                    {{ $data['avaliacao']->status->nome }} {{ $data['avaliacao']->trashed() ? " | INATIVO" : ""}}</p>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="info">

                        @if ($data['avaliacao']->tipo->id == 1)

                        <div>
                            <p><b>Responsável:</b> {{ $data['avaliacao']->responsavel->nome }}</p>
                            <p><b>Tipo de Avaliação:</b> Avaliar Funcionários</p>
                            <p><b>Setor:</b> {{ $data['avaliacao']->setor->nome }}</p>
                            @foreach ($data['avaliacao']->avaliadores as $avaliador)
                                <p><b>Avaliador:</b> {{ $avaliador->funcionario->nome }}</p>
                            @endforeach
                        </div>

                        <div>
                            <p><b>Data Inicio:</b> {{ $data['avaliacao']->data_inicio }}</p>
                            <p><b>Data Fim:</b> {{ date("d/m/Y", strtotime($data['avaliacao']->data_fim)) }}</p>                            
                            <p><b>Qtd de Avaliados:</b> {{ count($data['setor']->funcionarios)-1 }}</p>
                        </div>

                        @else

                        <div>
                            <p><b>Responsável:</b> {{ $data['avaliacao']->responsavel->nome }}</p>
                            <p><b>Tipo de Avaliação:</b> Avaliar Gestores</p>
                            <p><b>Setor:</b> {{ $data['avaliacao']->setor->nome }}</p>
                            <p><b>Qtd de Avaliadores:</b> {{ count($data['setor']->funcionarios)-1 }}</p>
                        </div>
                        
                        <div>
                            <p><b>Data Inicio:</b> {{ $data['avaliacao']->data_inicio }}</p>
                            <p><b>Data Fim:</b> {{ date("d/m/Y", strtotime($data['avaliacao']->data_fim)) }}</p>
                            @foreach ($data['avaliacao']->avaliados as $avaliado)
                                <p><b>Gestor Avaliado:</b> {{ $avaliado->funcionario->nome }}</p>
                            @endforeach
                        </div>

                        @endif

                    </div>

                    <div class="detalhes">

                        <table class="table table-bordered table-hover">

                            <thead class="thead-light">

                                <tr>

                                    <th class="text-center">{{ $data['avaliacao']->tipo->id == 1 ? 'Avaliados' : 'Avaliadores' }}</th>

                                    <th class="text-center">Cargo</th>

                                    <th class="text-center">Status</th>

                                    <th class="text-center">Respondido em</th>

                                </tr>

                            </thead>

                            @if ($data['avaliacao']->tipo->id == 1)

                                <?php $funcionarios = $data['avaliacao']->avaliados ?>

                            @else

                                <?php $funcionarios = $data['avaliacao']->avaliadores ?>

                            @endif

                            <tbody>
                                
                                @foreach ($funcionarios as $key => $funcionario)

                                    <tr>

                                        <td class="text-center align-middle">{{ $funcionario->funcionario->nome }}</td>
                                        <td class="text-center align-middle">{{ $funcionario->funcionario->cargo->nome }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $funcionario->concluido == 0 ? 'Pendente' : 'Concluido' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $funcionario->concluido == 0 ? '' : date("d/m/Y", strtotime($funcionario->updated_at)) }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
@endsection