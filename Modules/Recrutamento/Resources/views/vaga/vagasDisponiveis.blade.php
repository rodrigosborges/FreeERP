@extends('template')
@section('content')

    <div class="card">
    <div class="card-header"><h3>{{$data['title']}}</h3></div>
    <div class="card-body col-md-10 offset-md-1">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            
            <form action="{{url('recrutamento/vagasDisponiveis')}}" method="GET" class="form-inline mb-2">
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
                    <a class="nav-item nav-link active" id="nav-ativos-tab" data-toggle="tab" href="#nav-ativos" role="tab" aria-controls="nav-ativos" aria-selected="true">Disponíveis</a>
                </div>
            </nav>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-ativos" role="tabpanel" aria-labelledby="nav-ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cargo</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['vagas'] as $item)
                    <tr>
                        <td>{{$item->cargo()->first()->nome}}</td>
                        <td>{{$item->cargo()->first()->categoria()->first()->nome}}</td>
                        <td>
                            <a class="btn btn-info" href='{{ url("recrutamento/vaga/$item->id") }}'>Visualizar Vaga</a>     
                            <a class="btn btn-success" href='{{ url("recrutamento/candidato/novo/$item->id") }}'>Candidatar-se</a>     
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