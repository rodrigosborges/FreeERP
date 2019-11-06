<table id="tabela" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Número</th>
            <th scope="col">Cliente</th>
            <th scope="col">Valor</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pagamentos as $pagamento)
        <tr>
            <td scope="row">{{$pagamento->conserto->numeroOrdem }}</td>
            <td>{{$pagamento->cliente->nome }}</td>
            <td> R$ {{$pagamento->valor}} </td>
            <td>{{$pagamento->status}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="100%" class="text-center">
                <p class="text-center">
                    Página {{$pagamentos->currentPage()}} de {{$pagamentos->lastPage()}}
                    - Exibindo {{$pagamentos->perPage()}} registro(s) por página de {{$pagamentos->total()}}
                    registro(s) no total
                </p>
            </td>
        </tr>
        @if($pagamentos->lastPage() > 1)
        <tr>
            <td colspan="100%">
                {{ $pagamentos->links() }}
            </td>
        </tr>
        @endif
    </tfoot>
</table>
