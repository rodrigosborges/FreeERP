@extends('usuario::layouts.informacoes')

@section('content')

<!----Busca--->
<form method="GET" action="#">
    <div class="form-row form-group">
        {!! Form::label('busca', 'Procurar por', ['class' => 'col-sm-2 col-form-label text-right']) !!}
        <div class="col-sm-8">
            {!! Form::text('busca', isset($busca) ? $busca : null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-sm-2">
            {!! Form::submit('procurar', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
</form>



<!----- Tabs Ativos e Inativos na tabela--->
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
                        <th>Apelido</th>
                        <th>Avatar</th>
                        <th>E-mail</th>
                        <th>Papel</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['usuarios'] as $usuario)
                        <tr>
                            <td>{{$usuario->apelido}}</td>
                            <td>{{$usuario->avatar}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>{{$usuario->papel->nome}}</td>
                            <td><a  href="{{url('/usuario/' . $usuario->id.'/edit')}}"><button type="button" class=" btn-sm btn btn-success">Editar</button></a>
                            <a href= "{{('/usuario/'.$usuario->id .'/trocarSenha')}}"><button type="button" class="btn btn-primary btn-sm" >Trocar Senha</button></a>
                            <td><form method="POST" action="{{url('/usuario/' . $usuario->id)}}">
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
                        <th>Apelido</th>
                        <th>Avatar</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                     </tr>
                </thead>
                <tbody>
                    @if(isset($usuariosInativos))
                    @foreach($usuariosInativos as $usuario)
                        <tr>
                        <td>{{$usuario->apelido}}</td>
                            <td>{{$usuario->avatar}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>
                                <form method="POST" action="{{url('usuario/restore/'.$usuario->id)}}">
                                    @method('put')
                                    @csrf
                                    <button class='btn-sm btn btn-success' type="submit">Restaurar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
           
        </div>
    </div>
    </div>
    <button><a href="{{url('usuario/cadastrar')}}">Novo</a></button>
    {{$data['usuarios']->links()}}
@endsection