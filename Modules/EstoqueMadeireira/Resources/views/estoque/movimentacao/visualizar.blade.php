@extends('estoquemadeireira::estoque.template')

@section('title', 'Estoque do Produto #'.$e->produtos->last()->id)

@section('body')

    
    <div class="container" style="justify-content: center">
        <div class="card">
            <div class="card-header">
            Estoque do Produto #{{$e->produtos->last()->id}}
            </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="produto">Produto</label>
                            <input class="form-control" type="text" name="produto" disabled value="{{$e->produtos->last()->nome}}"> 
                        </div>
                        <div class="form-group col-3">
                             <label for="tipoUnidade">Tipo de Unidade</label>
                             <input class ="form-control" name="tipoUnidade" type="text" disabled value="{{$e->tipoUnidade->nome}}({{$e->tipoUnidade->quantidade_itens}} itens)">
                        </div>
                        <div class="form-group col-3">
                             <label for="quantidadeEstoque">Estoque Atual</label>
                             <input class ="form-control" name="quantidadeEstoque" type="text" disabled value="{{$e->quantidade}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center mt-3">
                            <a href="{{url('/estoque/movimentacao/alterar/'. $e->id. '/adicionar')}}"><button class="btn btn-success btn-sm">Adicionar Estoque</button></a>
                            @if($e->quantidade == 0)
                                <a href="{{url('/estoque/movimentacao/alterar/'. $e->id. '/remover')}}"><button disabled class="btn btn-danger btn-sm ">Remover Estoque</button></a>
                            @else 
                                <a href="{{url('/estoque/movimentacao/alterar/'. $e->id. '/remover')}}"><button  class="btn btn-danger btn-sm ">Remover Estoque</button></a>
                            @endif
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">Relatório de Movimentação</div>
                        <table class="table text-center ">
                            <thead class="">
                                
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Detalhes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimentacao as $m)
                                    <tr>
                                        <td >{{$m->id}}</td>
                                        @if($m->quantidade > 0)
                                           <td class="text-success">+{{$m->quantidade}}</td>
                                        @else
                                           <td class="text-danger">{{$m->quantidade}}</td>
                                        @endif
                                        <td>{{$m->created_at}}</td>
                                        <td><a href="{{url('/estoque/movimentacao/' . $m->id)}}"><button class="btn btn-sm btn-primary"><i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a></td>
                                    </tr>                                  
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        <p class="text-cetner">
                                            Página {{$movimentacao->currentPage()}} de {{$movimentacao->lastPage()}}
                                            -Exibido {{$movimentacao->perPage()}} registro(s) por página de {{$movimentacao->total()}}
                                        </p>
                                    </td>
                                </tr>
                                @if($movimentacao->lastPage() > 1)
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        {{ $movimentacao->links() }}
                                    </td>
                                </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
    </div>  

@endsection
<script>
    function moeda(i) {
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    }
    </script>