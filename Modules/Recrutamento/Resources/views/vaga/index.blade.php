@extends('template')
@section('content')

    <div class="card">
    <div class="card-header"><h3>{{$data['title']}}</h3></div>
    <div class="card-body col-md-10 offset-md-1">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <form action="{{url('recrutamento/vaga/')}}" method="GET" class="form-inline mb-2">
                <select name="pesquisa" class="form-control mr-sm-2" id="pesquisa">
                    <option value="">Selecione uma Categoria</option>
                    @foreach($data['categorias'] as $item)
                    <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-ativos-tab" data-toggle="tab" href="#nav-ativos" role="tab" aria-controls="nav-ativos" aria-selected="true">Ativos</a>
                    <a class="nav-item nav-link" id="nav-inativos-tab" data-toggle="tab" href="#nav-inativos" role="tab" aria-controls="nav-inativos" aria-selected="false">Inativos</a>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-2 offset-md-2">
            <a class="btn btn-success " style="margin-bottom:10px;" href="{{ url('recrutamento/vaga/create') }}">Nova Vaga</a>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-ativos" role="tabpanel" aria-labelledby="nav-ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['vagas'] as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->cargo()->first()->nome}}</td>
                        <td>
                            <form action="{{url('recrutamento/vaga', [$item->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("recrutamento/vaga/$item->id/edit") }}'>Editar</a>
                                <a class="btn btn-primary" href='{{ url("recrutamento/vaga/candidatos/$item->id") }}'>Visualizar Candidatos</a>  
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-inativos" role="tabpanel" aria-labelledby="nav-inativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['vagas_inativas'] as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->cargo()->first()->nome}}</td>
                        <td>
                            <a class="btn btn-info" href='{{ url("recrutamento/vaga/$item->id/restore") }}'>Restaurar</a> 
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
   
    </div>
    </div>
    
@endsection