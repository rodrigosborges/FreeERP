<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Mensagem</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{date("d/m/Y H:i:s", strtotime($log->created_at))}}</td>
                    <td>{{$log->mensagem}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan=2>Não há registro de logs</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="100%" class="text-center">
                <p class="text-center">
                    Página {{$logs->currentPage()}} de {{$logs->lastPage()}}
                    - Exibindo {{$logs->perPage()}} registro(s) por página de {{$logs->total()}}
                    registro(s) no total
                </p>
                </td>     
            </tr>
            @if($logs->lastPage() > 1)
            <tr>
                <td colspan="100%">
                {{ $logs->links() }}
                </td>
            </tr>
            @endif
        </tfoot>
    </table>
</div>