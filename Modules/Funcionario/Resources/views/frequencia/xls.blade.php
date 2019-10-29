<html>
    <table class="table">
        <thead >
            <tr>
                <th colspan="1">
                    <b>Funcionário:</b>
                </th>
                <th colspan="3">
                    {{$data['funcionario']->nome}}
                </th>
            </tr>
            <tr>
                <th colspan="1">
                    <b>Período de referência:</b>
                </th>
                <th colspan="3">
                    {{ ucfirst(strftime('%B de %Y', strtotime($data['pontos'][0]->entrada))) }}
                </th>
            </tr>
            <tr>
                <th colspan="1">
                    <b>Tempo trabalhado:</b>
                </th>
                <th colspan="3">
                    {{ $data['total'] }}
                </th>
            </tr>
            <tr></tr>
            <tr style="border: 1px solid black;">
                <th align="center" style="background-color: #E0E0E0; width: 22px; border: 1px solid black; font-weight: bold;">Dia</th>
                <th align="center" style="background-color: #E0E0E0; width: 22px; border: 1px solid black; font-weight: bold;">Entrada</th>
                <th align="center" style="background-color: #E0E0E0; width: 22px; border: 1px solid black; font-weight: bold;">Saída</th>
                <th align="center" style="background-color: #E0E0E0; width: 22px; border: 1px solid black; font-weight: bold;">Tempo trabalhado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['pontos'] as $ponto)
                <tr>
                    <td align="center" style="border: 1px solid black;">{{ $ponto->get_day() }}</td>
                    <td align="center" style="border: 1px solid black;">{{ $ponto->get_time_entrada() }}</td>
                    <td align="center" style="border: 1px solid black;">{{ $ponto->get_time_saida() }}</td>
                    <td align="center" style="border: 1px solid black;">{{ $ponto->time_worked() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</html>