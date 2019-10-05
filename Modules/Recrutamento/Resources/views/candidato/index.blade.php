@extends('template')
@section('content')

    <div class="card">
    <div class="card-header"><h3>{{$data['title']}}</h3></div>
    <div class="card-body col-md-10 offset-md-1">
    <div class="row">
        <div class="col-sm-12 col-md-12">
        <form action="{{url('recrutamento/candidato/')}}" method="GET" class="form-inline mb-2">
            <input class="form-control mr-sm-2" type="search" placeholder="Nome do Candidato" name="pesquisa" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-ativos-tab" data-toggle="tab" href="#nav-ativos" role="tab" aria-controls="nav-ativos" aria-selected="true">Ativos</a>
                    <a class="nav-item nav-link" id="nav-inativos-tab" data-toggle="tab" href="#nav-inativos" role="tab" aria-controls="nav-inativos" aria-selected="false">Inativos</a>
                </div>
            </nav>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-ativos" role="tabpanel" aria-labelledby="nav-ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['candidatos'] as $item)
                    <tr>
                        <td>{{$item->nome}}</td>
                        <td>
                            <form action="{{url('recrutamento/candidato', [$item->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-primary" href='{{ url("recrutamento/candidato/$item->id") }}'>Visualizar</a> 
                                <a class="btn btn-primary" href='{{ url("recrutamento/mensagem/enviarMensagem/$item->id") }}'>Enviar Mensagem</a> 
                                <a class="btn btn-primary" href='{{ url("recrutamento/candidato/addEtapa/$item->id") }}'>Etapas</a> 
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
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['candidatos_inativos'] as $item)
                    <tr>
                        <td>{{$item->nome}}</td>
                        <td>
                            <a class="btn btn-info" href='{{ url("recrutamento/candidato/$item->id/restore") }}'>Restaurar</a> 
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