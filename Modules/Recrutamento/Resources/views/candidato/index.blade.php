@extends('template')
@section('content')

    <div class="card ">
    <div class="card-header"><h3>Candidatos</h3></div>
    <div class="card-body">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
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
                                <a class="btn btn-info" href='{{ url("recrutamento/candidato/$item->id") }}'>Visualizar</a> 
                                <a class="btn btn-info" href="{{url('recrutamento/entrevista/marcarEntrevista/'.$item->id)}}">Marcar Entrevista</a> 
                                <a class="btn btn-success" href='#'>Contratar</a> 
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
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