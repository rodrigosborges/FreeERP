<div class="table-responsive">
    <table id="funcionario-table" class="table table-stripped">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="min" colspan="3">Ações</th>
                @if($status == "ativos")
                    <th class="min"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($funcionarios as $funcionario)
                <tr>
                    <td>{{$funcionario->nome}}</td>
                    @if($status == "ativos")
                    <td class="min">         
                            <a class="btn btn-warning" href='{{ url("funcionario/funcionario/$funcionario->id/edit") }}'>Editar</a>
                    </td>
                    <td class="min">
                        <a class="btn btn-secondary" href='{{ url("funcionario/funcionario/editCargo/$funcionario->id") }}'>Cargo</a>              
                    </td>
                    <td class="min">                       
                        <a class="btn btn-info" href='{{ url("funcionario/funcionario/ficha/$funcionario->id") }}'>Ficha</a>
                    </td>
                    @endif
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