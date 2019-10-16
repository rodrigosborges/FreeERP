<div class="table-responsive">
    <table id="protocolo-table" class="table table-stripped">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="min" colspan="3">Ações</th>
                @if($status == "ativos" || $status == "meus-protocolos")
                    <th class="min"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($protocolos as $protocolo)
                <tr>
                    <td>{{$protocolo->assunto}}</td>
                    @if($status == "ativos" || $status == "meus-protocolos")
                    <td class="min">         
                        <a class="btn btn-info" href='{{ url("protocolos/protocolos/acompanhar/$protocolo->id") }}'>
                            <i class="material-icons send" style="vertical-align:middle; font-size:25px; margin-right:5px;">find_in_page</i>Acompanhar
                        </a>
                    </td>
                    <td class="min">                       
                        <a class="btn btn-warning" href='{{ url("protocolos/protocolos/encaminhar/$protocolo->id") }}'>
                            <i class="material-icons find_in_page" style="vertical-align:middle; font-size:25px; margin-right:5px;">forward</i>Encaminhar
                        </a>
                    </td>
                    @endif
                    <td class="min">
                        <form action="{{url('protocolos/protocolos', [$protocolo->id])}}" class="input-group" method="POST">
                            {{method_field('DELETE')}}
                            {{ csrf_field() }}
                            
                            <input type="submit" class="btn btn-{{$protocolo->trashed() ? 'success' : 'danger'}}" value="{{$protocolo->trashed() ? 'Reabrir' : 'Finalizar'}}"/>
                        </form>
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