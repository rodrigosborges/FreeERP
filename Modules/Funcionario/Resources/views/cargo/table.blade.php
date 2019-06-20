<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="min">Ações</th>
                @if($status == "ativos")
                    <th class="min"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($cargos as $cargo)
                <tr>
                    <td>{{$cargo->nome}}</td>
                    @if($status == "ativos")
                        <td class="min">                       
                            <a class="btn btn-warning" href='{{ url("funcionario/cargo/$cargo->id/edit") }}'>Editar</a>
                        </td>
                    @endif
                    <td class="min">
                        <form action="{{url('funcionario/cargo', [$cargo->id])}}" class="input-group" method="POST">
                            {{method_field('DELETE')}}
                            {{ csrf_field() }}
                                <input type="submit" class="btn btn-{{$cargo->trashed() ? 'success' : 'danger'}}" value="{{$cargo->trashed() ? 'Restaurar' : 'Deletar'}}"/>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="100%" class="text-center">
                <p class="text-center">
                    Página {{$cargos->currentPage()}} de {{$cargos->lastPage()}}
                    - Exibindo {{$cargos->perPage()}} registro(s) por página de {{$cargos->total()}}
                    registro(s) no total
                </p>
                </td>     
            </tr>
            @if($cargos->lastPage() > 1)
            <tr>
                <td colspan="100%">
                {{ $cargos->links() }}
                </td>
            </tr>
            @endif
        </tfoot>
    </table>
</div>