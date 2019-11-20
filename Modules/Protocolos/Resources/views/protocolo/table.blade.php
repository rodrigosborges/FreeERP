<div class="table-responsive">
    <table id="protocolo-table" class="table table-hover">
        <thead>
            <tr class="table-primary">
                @if($status !== "caixa-saida")
                    <th>Origem</th>
                @endif
                @if($status == "despacho")
                    <th>Recebido por</th>
                @endif
                <th style="width:350px">Último Despacho</th>
                @if($status !== "despacho")
                    <th>Última modificação</th>
                @endif
                <th class="min" colspan="3">Ações</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($protocolos as $protocolo)
                <tr>
                    @if($status !== "caixa-saida")
                    <td class="align-middle">{{$protocolo->tramite->last()->origem_usuario->nome}}<br>({{$protocolo->tramite->last()->origem_usuario->setor->nome}})</td>
                    @endif
                    @if($status == "despacho")
                    <td class="align-middle">{{$protocolo->usuario_modificador->nome}}<br>({{$protocolo->usuario_modificador->setor->nome}})</td>
                    @endif
                    <td class="align-middle">{{$protocolo->tramite->last()->observacao}}</td>
                    @if($status !== "despacho")
                    <td class="align-middle">{{date('d/m/Y', strtotime($protocolo->updated_at))}}</td>
                    @endif
                    @if($status == "despacho" || $status == "inativos")
                        @if($protocolo->usuario_id ==  Auth::user()->id)
                        <td class="align-middle">
                            <form action="{{url('protocolos/protocolos', [$protocolo->id])}}" class="input-group" method="POST">
                            {{method_field('DELETE')}}
                            {{ csrf_field() }}
                                <button type="submit" class="btn btn-{{$protocolo->trashed() ? 'success' : 'danger'}} btn-sm" value="{{$protocolo->trashed() ? 'Reabrir' : 'Finalizar'}}">
                                @if($protocolo->trashed())
                                    <i class="material-icons find_in_page" style="vertical-align:middle; font-size:25px; margin-right:5px;">restore_from_trash</i> Restaurar
                                @else
                                    <i class="material-icons find_in_page" style="vertical-align:middle; font-size:25px; margin-right:5px;">delete_forever</i> Finalizar
                                @endif
                                </button>
                            </form>
                        </td>
                        @endif
                    @endif
                    @if($status !== "caixa-saida")
                    <td class="align-middle">     
                        <a class="btn btn-info btn-sm" href='{{ url("protocolos/protocolos/acompanhar/$protocolo->id") }}'>
                            <i class="material-icons send"  style="vertical-align:middle; font-size:25px; margin-right:5px;">find_in_page</i>Ver
                        </a>
                    </td>
                    @endif
                    @if($status == "caixa-entrada")
                    <td class="align-middle">
                        <a class="btn btn-dark btn-sm" href='{{ url("protocolos/protocolos/receber/$protocolo->id") }}'>
                            <i class="material-icons send" style="vertical-align:middle; font-size:25px; margin-right:5px;">move_to_inbox</i>Receber
                        </a>
                    </td>
                    @endif
                    @if($status == "caixa-saida")
                    <td class="align-middle">
                        <a class="btn btn-warning btn-sm">
                            <i class="material-icons find_in_page" style="vertical-align:middle; font-size:25px; margin-right:5px;">access_time</i>Aguardando recebimento
                        </a>
                    </td>
                    @endif
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