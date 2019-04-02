<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cargos as $cargo)
                <tr>
                    <td>{{$cargo->nome}}</td>
                    <td class="min">                       
                        <a class="btn btn-warning" href='{{ url("funcionario/cargo/$cargo->id/edit") }}'>Editar</a>
                    </td>
                    <td class="min">
                        <form action="{{url('funcionario/cargo', [$cargo->id])}}" class="input-group" method="POST">
                            {{method_field('DELETE')}}
                            {{ csrf_field() }}
                            @if(!$cargo->funcionarios()->count())
                                <input type="submit" class="btn btn-danger" value="Deletar"/>
                            @endif
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