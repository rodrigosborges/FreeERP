@extends('template')
@section('title', 'Papéis')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Página de Papéis</h1>
        </div>
    </div>

    <div class="row">
        <div class="table table-responsive">
            <table class="table table-bordered" id="table">
                <tr>
                    <th width="150px">Nº</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Criado em:</th>
                    <th>Criado por:</th>
                    <th class="text.center" width="150px">
                        <a href="#" claa="create-modal btn btn-sucess btn-sm">
                            <i class="glyphicon glyphicon-plus"></i>
                        </a>
                    </th>
                </tr>
                {{ csrf_field() }}
                <?php $no=1 ?>
                @foreach ($papeis as $papel)
                    <tr class="papel{{$papel->id}}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $papel->nome }}</td>
                        <td>{{ $papel->descricao }}</td>
                        <td>{{ $papel->created_at }}</td>
                        <td></td>
                        <td>
                            <a href="#" class="show-modal btn btn-info btn-sm" 
                            data-id="{{$papel->id}}"
                            data-nome="{{$papel->nome}}" 
                            data-descricao="{{$papel->descricao}}"
                            data-usuario="">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="#" class="edit-modal btn btn-warning btn-sm"
                            data-id="{{$papel->id}}"
                            data-nome="{{$papel->nome}}"
                            data-descricao="{{$papel->descricao}}"
                            data-usuario="">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <a href="#" class="delete-modal btn btn-danger btn-sm"
                            data-id="{{$papel->id}}"
                            data-nome="{{$papel->nome}}"
                            data-descricao="{{$papel->descricao}}"
                            data-usuario="">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>

                @endforeach
            </table>
        </div>

    </div>


@endsection