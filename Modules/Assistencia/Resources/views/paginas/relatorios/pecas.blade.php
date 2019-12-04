{{$periodo}}
<table class="table">
<tr>
    <th>OS nº</th>

    <th>Peças</th>
</tr>
<?php
    $tudo = 0;
    
?>
@foreach ($consertos as $conserto)
<tr>
    <td>{{$conserto->numeroOrdem}}</td>

    <?php
        $p = $pecaOS->where('idConserto', $conserto->id);
    ?>
    @if(count($p) > 0)
        @foreach ($p as $peca)
            <td>
            {{$peca->itemPeca->peca->nome}} | R${{number_format( $peca->itemPeca->peca->valor_venda , 2, ',', '.')}}
            </td>
            <?php
                $tudo = $tudo + $peca->itemPeca->peca->valor_venda ;
            ?>
        @endforeach
    @else
        <td>Nenhum paça para esta OS</td>
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