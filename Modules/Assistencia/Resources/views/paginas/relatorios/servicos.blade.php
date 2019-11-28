
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
    @foreach ($itemServico as $servico)
        <td>
            {{$servico->servico->nome}} | R${{number_format( $servico->servico->valor , 2, ',', '.')}}
        </td>
    @endforeach

</tr>

@endforeach
</table>