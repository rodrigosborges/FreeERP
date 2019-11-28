
<table class="table">
<tr>
    <th>OS nº</th>

    <th>Peças</th>
</tr>
@foreach ($consertos as $conserto)
<tr>
    <td>{{$conserto->numeroOrdem}}</td>

    <?php
        $pecaOS = $pecaOS->where('idConserto', $conserto->id);
    ?>
    @foreach ($pecaOS as $peca)
        <td>
        {{$peca->itemPeca->peca->nome}} | R${{number_format( $peca->itemPeca->peca->valor_venda , 2, ',', '.')}}
        </td>
    @endforeach

</tr>
@endforeach
</table>