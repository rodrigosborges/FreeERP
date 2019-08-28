@extends('usuario::layouts.informacoes')


@section('content')

<form action="{{url('/papel/search/')}}" method="get"></form>
    <nav class="nav nav-tabs">
    <a href="#ativos" data-toggle="tab" class="nav-item nav-link active show">
        Ativos
    </a>
    <a href="#inativos" data-toggle="tab" class="nav-item nav-link">
        Inativos
    </a>
</nav>

<div class="tab-content">
    <div id="ativos" class="tab-pane fade in active show">
        <div class="text-center">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($papeis as $papel)
                        <tr>
                            <td>{{$papel->nome}}</td>
                            <td><a  href="{{url('/papel/' . $papel->id.'/edit')}}"><button type="button" class=" btn-sm btn btn-success">Editar</button></a></td>
                            <td>
                                <form method="POST" action="{{url('/papel/' . $papel->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn-sm btn btn-danger">Deletar</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="inativos" class="tab-pane fade">
        <div class="text-center">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                     </tr>
                </thead>
                <tbody>
                    @foreach($papeisInativos as $papel)
                        <tr>
                        <td>{{$papel->nome}}</td>
                            <td>
                                <form method="POST" action="{{url('papel/restore/'.$papel->id)}}">
                                    @method('put')
                                    @csrf
                                    <button type="submit">Restaurar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
    </div>
    <button><a href="{{url('papel/cadastrar')}}" class="btn btn-primary">Novo</a></button>

@endsection