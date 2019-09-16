<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Assunto</th>
                <th class="min">Ações</th>
                @if($status == "ativos")
                    <th class="min"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($protocolos as $protocolo)
                <tr>
                    <td>{{$protocolo->assunto}}</td>
                    @if($status == "ativos")
                        <td class="min">                       
                            <a class="btn btn-success" href=''>Finalizar</a>
                        </td>
                    @endif
                    <td class="min">
                        <a class="btn btn-primary" href=''>Encaminhar</a>
                    </td>
                    <td class="min">
                        <a class="btn btn-dark" href=''>Adicionar comentário</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="100%" class="text-center">
                <p class="text-center">
                    Página {{$protocolos->currentPage()}} de {{$protocolos->lastPage()}}
                    - Exibindo {{$protocolos->perPage()}} registro(s) por página de {{$protocolos->total()}}
                    registro(s) no total
                </p>
                </td>     
            </tr>
            @if($protocolos->lastPage() > 1)
            <tr>
                <td colspan="100%">
                {{ $protocolos->links() }}
                </td>
            </tr>
            @endif
        </tfoot>
    </table>
</div>
