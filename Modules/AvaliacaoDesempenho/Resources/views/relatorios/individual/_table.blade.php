<table id='table' class='table table-hover table-bordered'>

    <?php 
        $classificacao = 'Não Concluido';

        if (isset($data)) {
            $mediageral = number_format((float)($data['mediaGeral']/(count($data['avaliacao']->questoes)*5))*100, 1, '.', '');

            if ($mediageral <= 20)
                $classificacao = 'Insatisfatório';
            elseif ($mediageral <= 40)
                $classificacao = 'Satisfatório';
            elseif ($mediageral <= 60)
                $classificacao = 'Bom';
            elseif ($mediageral <= 80)
                $classificacao = 'Ótimo';
            else
                $classificacao = 'Excelente';
        }
    
    ?>

    <thead>
    
        <tr>
    
        <th class="text-center">Avaliação</th>
    
        <th class="text-center">Avaliador</th>
    
        <th class="text-center">Avaliado</th>
    
        <th class="text-center">Data Avaliação</th>

        <th class="text-center">Pontuação</th>

        <th class="text-center">Classificação</th>
    
        <th class="text-center">Ações</th>
    
        </tr>
    
    </thead>
      
    <tbody>
    
        @if ($result->count())
    
            @foreach($result as $resultado)

            <?php 
                $nota = 0;
                $count = 0;
                foreach (json_decode($resultado->respostas) as $resposta) {
                    $nota += $resposta;
                    $count++;
                }

                $notafinal = number_format((float)($nota/($count*5))*100, 1, '.', '');
            ?>

            <tr>
        
                <td class="text-center align-middle">{{ $resultado->avaliacao->nome }}</td>
            
                <td class="text-center align-middle">{{ $resultado->avaliador->funcionario->nome }}</td>
            
                <td class="text-center align-middle">{{ $resultado->avaliado->funcionario->nome }}</td>
            
                <td class="text-center align-middle">{{ date("d/m/Y", strtotime($resultado->created_at)) }}</td>
                
                <td class="text-center align-middle">{{ $notafinal }}/100</td>
                
                <td class="text-center align-middle">

                    @if ($notafinal <= 20)
                        Insatisfatório
                    @elseif ($notafinal <= 40)
                        Satisfatório
                    @elseif ($notafinal <= 60)
                        Bom
                    @elseif ($notafinal <= 80)
                        Ótimo
                    @else
                        Excelente
                    @endif

                </td>
            
                <td class="text-center align-middle acoes">
            
                    <a class="btn btn-info acoes-btn" title="Show"
                    href="/tcc/public/avaliacaodesempenho/relatorio/individual/{{ $avaliacao->tipo->id }}/{{ $resultado->id }}/show"><i
                        class="material-icons md-18 md-light">search</i></a>
            
                </td>
        
            </tr>
        
            @endforeach

            <?php 
                if ($avaliacao->tipo->id != 1) {
                    echo '<tr>
                        <td colspan="2" style="text-align: center;"><b>Resultado Geral: </b>'.$avaliacao->nome.'</td>
                        <td colspan="2" style="text-align: center;"><b>Gestor: </b>'.$avaliacao->avaliados[0]->funcionario->nome.'</td>
                        <td colspan="2" style="text-align: center;"><b>Classificação: </b>'.$classificacao.'</td>

                        <td style="text-align: center;"> 
                            <button id="VisualizarGeral" class="btn btn-info acoes-btn" onclick="visualizarGeral(this)">Visão Geral</button>
                        </td>
                    </tr>';
                }
            ?>

        @else

            <tr>

                <td colspan="7" style="color: red; text-align: center;">Está avaliação não foi finalizada e ainda não possui resultados.</td>

            </tr>
    
        @endif
    
    </tbody>
    
</table>

@if (isset($data))
<div class='gestor hidden'>
    <hr>

    <div class="card">
            
        <div class="card-body">
            
            @if ($data['avaliacao']->status->id != 3)

                <div style='color: red;'>A Avaliação ainda está em andamento. Por isso ainda não é possivel mostrar seu resultado final.</div>

            @else

                <div>
                    <p><b>Avaliação: </b>{{ $data['avaliacao']->nome }}</p>
                    <p><b>Gestor: </b>{{ $data['avaliacao']->avaliados[0]->funcionario->nome }}</p>
                    <p><b>Setor: </b>{{ $data['avaliacao']->setor->nome }}</p>
                    <p><b>Numero de Questões: </b>{{ count($data['avaliacao']->questoes) }}</p>
                    <p><b>Numero de Categorias: </b>{{ count($data['categorias']) }}</p>
                </div>
                
                <?php $mediageral = number_format((float)($data['mediaGeral']/(count($data['avaliacao']->questoes)*5))*100, 1, '.', '') ?>

                <div>
                    <p><b>Media: </b>{{ $mediageral }}/100</p>
                    <b>Media por Categoria: </b>
                    @foreach ($data['mediaGeralCategoria'] as $key => $media)
                        @foreach ($data['categorias'] as $aux)
                            @if ($key == $aux->id)
                                <li><b>{{ $aux->nome }}: </b>{{ number_format((float)($data['mediaGeralCategoria'][$key]/($data['ocorrenciaCategorias'][$aux->id]*5))*100, 1, '.', '') }}/100</li>
                            @endif
                        @endforeach
                    @endforeach

                    <p style="margin-top: 20px;">
                        <b>Resultado:</b>
                        @if ($mediageral <= 20)
                            Insatisfatório
                        @elseif ($mediageral <= 40)
                            Satisfatório
                        @elseif ($mediageral <= 60)
                            Bom
                        @elseif ($mediageral <= 80)
                            Ótimo
                        @else
                            Excelente
                        @endif
                    </p>

                </div>
            
            @endif

        </div>

    </div>

</div>
@endif
      