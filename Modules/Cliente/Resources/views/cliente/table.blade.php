<div class="table-responsive">
    <table class="table">
        <tbody>
            <tr scope="row">
                <th scope="col">Nome</th>
                <th scope="col">Documento</th>
                <th scope="col">Telefones</th>
                <th colspan=3 scope="col">Ação</th>
            </tr>
            @foreach ($clientes as $cliente)
            <tr scope="row">
                <td>{{$cliente->nome}}</td>
                <td>{{$cliente->getDocumento()}}</td> 
                <td>{{$cliente->telefonesAll()}}</td>

                @if(!($cliente->trashed()))
                    <td><a href="{{url('cliente/'.$cliente->id.'/pedido')}}" class="btn btn-primary">Pedidos</a></td>
                    <td><a href="{{route('cliente.edit', $cliente->id)}}" class="btn btn-outline-info">Editar</a></td>
                    <td>
                        <form action="{{url('/cliente/cliente/'.$cliente->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Apagar</button>
                        </form>
                    </td> 
                @else
                <td>
                    <form action="{{url('/cliente/cliente/'.$cliente->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-success">Restaurar</button>
                    </form>
                </td> 
                @endif
            </tr>  
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="100%" class="text-center">
                    <p class="text-center">
                        {{$clientes->currentPage()}} de {{$clientes->lastPage()}}
                        páginas
                    </p>
                </td>
            </tr>
            @if($clientes->lastPage() > 1)
            <tr>
                <td colspan="100%">
                    {{ $clientes->links() }}
                </td>
            </tr>
            @endif
        </tfoot>
    </table>
</div>
