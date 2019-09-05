@extends('usuario::layouts.informacoes')


@section('content')
<div class="card">
    <!----Busca--->
    <div class='card-header'>
    <br>
        <form method="GET" action="#">
                    <div class="form-row form-group">
                        {!! Form::label('busca', 'Procurar por', ['class' => 'col-sm-2 col-form-label text-right']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('busca', isset($busca) ? $busca : null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary d-flex ml-2">
                            <i class="material-icons mr-2">search</i>
                            Buscar
                        </button>
                        </div>
                    </div>
                </form>
    </div>
    <div class="card-body">
            
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
                                    <td><a  href="{{url('/papel/' . $papel->id.'/edit')}}"><button type="button" class="col-3 btn-sm btn btn-success" style="float:right;padding-right:5px;">Editar</button></a></td>
                                    <td>
                                        <form method="POST" action="{{url('/papel/' . $papel->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="col-3 btn-sm btn btn-danger" style="float:left;padding-left:5px;">Deletar</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$papeis->links()}}
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
                            @if(isset($papeisInativos))
                            @foreach($papeisInativos as $papel)
                                <tr>
                                <td>{{$papel->nome}}</td>
                                    <td>
                                        <form method="POST" action="{{url('papel/restore/'.$papel->id)}}">
                                            @method('put')
                                            @csrf
                                            <button class="btn-sm btn btn-warning" type="submit">Restaurar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$papeisInativos->links()}}
                </div>
            </div>

            </div>
            <a href="{{url('papel/cadastrar')}}" style="color:white"><button class="btn btn-primary"><i class="material-icons" style="float:left;padding-right:5px">add_circle_outline</i> Novo</button></a>
            
        </div>
    </div>
@endsection