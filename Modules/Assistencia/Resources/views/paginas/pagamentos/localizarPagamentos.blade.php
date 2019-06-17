@extends('assistencia::layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        Lista de pagamentos
    </div>
    <div class="card-body">
        <div class="table-responsive">
             <table id="tabela" class="table table-striped">
                <div class="row">
                  <thead>
                    <tr>
                      <th scope="col">Numero</th>
                      <th scope="col">Cliente</th>
                      <th scope="col">Valor</th>
                      <th scope="col">Status</th>
                    </tr>

                  </thead>
                </div>
                <div class="row">
                  <tbody>
                    @foreach ($pagamentos as $pagamento)
                      <tr>
                        <td scope="row">{{$pagamento->id }}</td>
                        <td>{{$pagamento->conserto->cliente->nome }}</td> 
                        <td>{{ $pagamento->conserto->valor }}</td>
                        <td>{{$pagamento->status}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </div>
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
            
        </div>
    </div>
    
</div>
    
@stop