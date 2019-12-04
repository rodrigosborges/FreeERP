{{$periodo}}
<table class="table">

<tr>
    <th>OS nº</th>

    <th>Serviços</th>
</tr>
<?php
        $tudo = 0;
    
    ?>
@foreach ($consertos as $conserto)

<tr>
    <td>{{$conserto->numeroOrdem}}</td>

    <?php

        $i = $itemServico->where('idConserto', $conserto->id);
    ?>

    @if(count($i) > 0)
        @foreach ($i as $servico)
            <td>
                {{ $servico->servico->nome }} | R${{number_format( $servico->servico->valor , 2, ',', '.')}}
            </td>
            <?php
                $tudo = $tudo + $servico->servico->valor;
            ?>
        @endforeach
        
    @else
        <td>Nenhum serviço para esta OS</td>

    @endif
    

</tr>

@endforeach
<tfoot>
    <tr>
        <td>Valor total: </td>
        <td>R${{number_format( $tudo , 2, ',', '.')}}</td>
    </tr>
</tfoot>
</table>