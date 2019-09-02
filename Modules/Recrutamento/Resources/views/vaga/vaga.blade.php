@extends('template')
@section('content')

    <div class="card ">
    <div class="card-header"><h3>Vaga</h3></div>
    <div class="card-body">
    <div class="float-right">
        <a class="btn btn-success float-right" style="margin-bottom:10px;" href="{{ url('recrutamento/vaga/create') }}">Nova Vaga</a>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['vaga'] as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->cargo}}</td>
                        <td>
                            <form action="{{url('recrutamento/vaga', [$item->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("recrutamento/vaga/$item->id/edit") }}'>Editar</a> 
                                <a class="btn btn-info" href='{{ url("recrutamento/vaga/candidatos/$item->id") }}'>Visualizar Candidatos</a> 
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