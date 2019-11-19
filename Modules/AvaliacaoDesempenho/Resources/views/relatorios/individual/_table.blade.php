<table id='table' class='table table-hover table-bordered'>

    <thead>
    
        <tr>
    
        <th class="text-center">Avaliação</th>
    
        <th class="text-center">Avaliador</th>
    
        <th class="text-center">Avaliado</th>
    
        <th class="text-center">Data Avaliação</th>

        <th class="text-center">Pontuação</th>
    
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
            ?>

            <tr>
        
                <td class="text-center align-middle">{{ $resultado->avaliacao->nome }}</td>
            
                <td class="text-center align-middle">{{ $resultado->avaliador->funcionario->nome }}</td>
            
                <td class="text-center align-middle">{{ $resultado->avaliado->funcionario->nome }}</td>
            
                <td class="text-center align-middle">{{ date("d/m/Y", strtotime($resultado->created_at)) }}</td>
                
                <td class="text-center align-middle">{{ number_format((float)($nota/($count*5))*100, 1, '.', '') }}/100</td>
                <!-- <td class="text-center align-middle">{{ $nota }}/{{ $count*5 }}</td> -->
            
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

                        <td colspan="2" style="text-align: center;"> 
                            <button id="VisualizarGeral" class="btn btn-info acoes-btn" onclick="visualizarGeral(this)">Visão Geral</button>
                        </td>
                    </tr>';
                }
            ?>

        @else

            <tr>

                <td colspan="5" style="color: red; text-align: center;">Está avaliação não foi finalizada e ainda não possui resultados.</td>

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

                <div>
                    <p><b>Media: </b>{{ number_format((float)($data['mediaGeral']/(count($data['avaliacao']->questoes)*5))*100, 1, '.', '') }}/100</p>
                    <b>Media por Categoria: </b>
                    @foreach ($data['mediaGeralCategoria'] as $key => $media)
                        @foreach ($data['categorias'] as $aux)
                            @if ($key == $aux->id)
                                <li><b>{{ $aux->nome }}: </b>{{ number_format((float)($data['mediaGeralCategoria'][$key]/($data['ocorrenciaCategorias'][$aux->id]*5))*100, 1, '.', '') }}/100</li>
                            @endif
                        @endforeach
                    @endforeach

                </div>
            
            @endif

        </div>

    </div>

</div>
@endif
      