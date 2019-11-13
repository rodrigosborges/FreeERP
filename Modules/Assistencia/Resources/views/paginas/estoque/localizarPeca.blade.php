@extends('assistencia::layouts.master')


@section('css')

@stop

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h3>Peças</h3>
            <a href="{{url('/assistencia/servicos/localizar')}}"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
    </div>
    <div class="card-body">
        
        <div class="row form-group">
            <form class="input-group col-6" action="{{route('pecas.buscar')}}" method="post">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="busca" placeholder="Nome da peça" aria-label="Buscar"
                    aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-info" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="col-6">
                <div class="text-right">
                    <a href="{{route('pecas.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar
                            Peça</button></a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped">
                    <div class="row">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Nome</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Ações</th>
                            </tr>

                        </thead>
                    </div>
                    <div class="row">
                        <tbody>
                            @foreach ($pecas as $peca)
                            <tr class="text-center">
                                <td scope="row">{{$peca->nome }}</td>
                                <td>R$ {{number_format( $peca->valor_venda , 2, ',', '.')}}</td>
                                <td scope="row">{{number_format($peca->quantidade) }}</td>
                                <td>
                                    <a href="{{route('pecas.editar',$peca->id)}}"><button type="button"
                                            class="btn btn-dark">Editar</button></a>
                                    <a href="{{route('pecas.deletar',$peca->id)}}"><button type="button"
                                            class="btn btn-danger">Deletar</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <p class="text-center">
                                        Página {{$pecas->currentPage()}} de {{$pecas->lastPage()}} páginas

                                    </p>
                                </td>
                            </tr>
                            @if($pecas->lastPage() > 1)
                            <tr>
                                <td colspan="100%">
                                    {{ $pecas->links() }}
                                </td>
                            </tr>
                            @endif
                        </tfoot>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>









@stop