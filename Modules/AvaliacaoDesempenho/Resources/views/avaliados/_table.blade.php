<table class="table table-bordered table-hover table-sm">

    <thead>

        <tr>
            <td class="text-center">Nome Funcionário</td>
            <td class="text-center">Cargo</td>
            <td class="text-center">Ações</td>
        </tr>

    </thead>

    <tbody>
        
        @foreach($funcionarios as $funcionario)

            <tr>
                <td class="text-center align-middle">{{ $funcionario->nome }}</td>
                <td class="text-center align-middle">{{ $funcionario->cargo->nome }}</td>
                <td class="text-center align-middle">
                    <button id="{{$funcionario->id}}" class="avaliar btn btn-primary btn-sm">Avaliar</button>
                </td>
            </tr>

        @endforeach

    </tbody>

</table>