{{$periodo}}
<table class="table">
<tr>
    <th>OS nº</th>

    <th>Técnicos</th>
</tr>
@foreach ($consertos as $conserto)
<tr>
    <td>{{$conserto->numeroOrdem}}</td>

    <td>{{$conserto->tecnico->nome}}</td>

</tr>

@endforeach
</table>