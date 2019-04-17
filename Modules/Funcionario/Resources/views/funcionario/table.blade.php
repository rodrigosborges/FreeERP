<div class="table-responsive">
    <table id="funcionario-table" class="table table-stripped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th class="min">Ações</th>
                @if($status == "ativos")
                    <th class="min"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($funcionarios as $funcionario)
                <tr>
                    <td>{{$funcionario->nome}}</td>
                    <td>{{$funcionario->cargo->nome}}</td>
                    <td class="min">                       
                        @if($status == "ativos")
                            <a class="btn btn-warning" href='{{ url("funcionario/funcionario/$funcionario->id/edit") }}'>Editar</a>
                        @endif
                    </td>
                    <td class="min">
                        <form action="{{url('funcionario/funcionario', [$funcionario->id])}}" class="input-group" method="POST">
                            {{method_field('DELETE')}}
                            {{ csrf_field() }}
                                <input type="submit" class="btn btn-{{$funcionario->trashed() ? 'success' : 'danger'}}" value="{{$funcionario->trashed() ? 'Restaurar' : 'Deletar'}}"/>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="100%" class="text-center">
                <p class="text-center">
                    Página {{$funcionarios->currentPage()}} de {{$funcionarios->lastPage()}}
                    - Exibindo {{$funcionarios->perPage()}} registro(s) por página de {{$funcionarios->total()}}
                    registro(s) no total
                </p>
                </td>     
            </tr>
            @if($funcionarios->lastPage() > 1)
            <tr>
                <td colspan="100%">
                {{ $funcionarios->links() }}
                </td>
            </tr>
            @endif
        </tfoot>
    </table>
</div>