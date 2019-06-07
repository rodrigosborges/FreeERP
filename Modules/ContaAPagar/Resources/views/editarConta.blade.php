@extends('contaapagar::layouts.master')


@section('content')
    <div class="card ">
        <div class="card-header ">
            <h5>Editar conta</h5>
            <form action="{{route('conta.salvar', $conta->id)}}" method="POST">
                {{csrf_field()}}
                @include('contaapagar::_formEditarConta')
                
            </form>
        </div>

        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Descrição</th>
                        <th scope="col">Data de Vencimento</th>
                        <th scope="col">Data de Pagamento</th>
                        <th scope="col">Multa</th>
                        <th scope="col">Juros</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($pagamentos as $pagamento)
                    <tr>
                        <td>{{$pagamento->nome()}}</td>
                        <td>{{$pagamento->data_vencimento}}</td>
                        <td>{{$pagamento->data_pagamento}}</td>
                        <td>R${{$pagamento->juros}}</td>
                        <td>R${{$pagamento->multa}}</td>
                        <td>R${{$pagamento->valor}}</td>
                        <td>R${{($pagamento->juros + $pagamento->multa + $pagamento->valor)}}</td>
                        <td>{{$pagamento->status_pagamento}}</td>
                        <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class='material-icons'>search</i></button> 
                        <a href="{{Route('pagamento.deletar', $pagamento->id)}}"><i class='material-icons'>delete</i></a>
                        
                        </td>

                        <!-- Modal do pagamento-->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Editar parcela</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('pagamento.salvar',$pagamento->id)}}" method="POST">
                                            {{csrf_field()}}
                                            @include('contaapagar::_formEditarPagamento')

                                            <div class="form-group col-md-2">
                                                <button class="btn btn-primary">Salvar</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </tr>

                @endforeach
                </tbody>
            </table>            
        </div>

        </div>
    </div>
    
    

@stop

