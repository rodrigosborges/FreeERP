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
                    {{ ucfirst(strftime('%B de %Y', strtotime($data['pontos'][0]->created_at))) }}
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
            @for($i=0; $i < count($data['pontos']); $i+=2)
                <tr>
                    <td align="center" style="border: 1px solid black;">{{ $data['pontos'][$i]->get_day() }}</td>
                    <td align="center" style="border: 1px solid black;">{{ $data['pontos'][$i]->get_time() }}</td>
                    <td align="center" style="border: 1px solid black;">{{ $data['pontos'][$i+1]->get_time() }}</td>
                    <td align="center" style="border: 1px solid black;">{{ $data['pontos'][$i]->timeTo($data['pontos'][$i+1]) }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</html>