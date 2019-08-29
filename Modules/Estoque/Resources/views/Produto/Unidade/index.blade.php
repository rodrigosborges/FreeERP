@extends('template')
@section('title', 'Cadastro de Produto')

@section('content')

<ul class="nav nav-tabs  justify-content-center">
    <li class="nav-item">
        <a href="#ativos" class="nav-link active" role="tab" data-toggle="tab">
            Unidades Ativas
        </a>
    </li>
    <li class="nav-item">
        <a href="#inativos" class="nav-link" role="tab" data-toggle="tab">
            Unidades Inativas
        </a>
    </li>
</ul><div class=" tab-content row justify-content-center ">
    <div class="tab-pane active col-sm-10" role="tabpanel1" id="ativos">
        <table class="table text-center ">
            <thead class="">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope='col'>Ações</th>
                    <th>
                        <a class="btn btn-success btn-md" href="{{url('/estoque/produto/unidade/create')}}">
                            <i class="material-icons">note_add</i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($unidadeProduto as $unidade)
                <tr>
                    <td>{{$unidade->id}}</td>
                    <td>{{$unidade->tipo}}</td>
                    <td>
                        <a class="btn btn-lg btn-warning" href="{{url('estoque/produto/unidade/'.$unidade->id. '/edit')}}">
                            <i class="material-icons">border_color</i>
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{url('estoque/produto/unidade/'. $unidade->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-lg btn-danger">

                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="100%" class="text-center">
                        <p class="text-cetner">
                            Página {{$unidadeProduto->currentPage()}} de {{$unidadeProduto->lastPage()}}
                            -Exibido {{$unidadeProduto->perPage()}} registro(s) por página de {{$unidadeProduto->total()}}
                        </p>
                    </td>
                </tr>
                @if($unidadeProduto->lastPage() > 1)
                <tr>
                    <td colspan="100%" class="text-center">
                        {{ $unidadeProduto->links() }}
                    </td>
                </tr>
                @endif
            </tfoot>
        </table>
    </div>
    <div class="tab-pane col-sm-8" role="tabpanel1" id="inativos">
        <div class="justify-content-center">
            <table class="table text-center">
                <thead class="">
                    <td><strong>#</strong></td>
                    <td><strong>Nome</strong></td>
                    <td><strong>Ações</strong></td>
                </thead>
                <tbody>
                    @foreach($unidadesExcluidas as $inativa)
                    <tr>
                        <td>{{$inativa->id}}</td>
                        <td>{{$inativa->tipo}}</td>
                        <td>
                            <form method="POST" action="{{url('estoque/produto/unidade/ '. $inativa->id . '/restore')}}">
                                @method('put')
                                @csrf
                                <button type="submit" class="btn btn-info">Restaurar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="100%" class="text-center">
                            <p class="text-cetner">
                                Página {{$unidadesExcluidas->currentPage()}} de {{$unidadesExcluidas->lastPage()}}
                                -Exibido {{$unidadesExcluidas->perPage()}} registro(s) por página de {{$unidadesExcluidas->total()}}

                            </p>
                        </td>
                    </tr>
                    @if($unidadesExcluidas->lastPage() > 1)
                    <tr>
                        <td colspan="100%" class="text-center">
                            {{ $unidadesExcluidas->links() }}
                        </td>
                    </tr>
                    @endif
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection