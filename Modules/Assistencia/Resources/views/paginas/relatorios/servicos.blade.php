{{$periodo}}
<table class="table">
<tr>
    <th>OS nº</th>

    <th>Serviços</th>
</tr>
@foreach ($consertos as $conserto)
<tr>
    <td>{{$conserto->numeroOrdem}}</td>

    <?php
        $itemServico = $itemServico->where('idConserto', $conserto->id);
    ?>
    @if(count($itemServico) > 0)
        @foreach ($itemServico as $servico)
            <td>
                {{$servico->servico->nome}} | R${{number_format( $servico->servico->valor , 2, ',', '.')}}
            </td>
        @endforeach
    @else
        <td>Nenhum serviço para esta OS</td>
    @endif
</tr>

@endforeach
</table>