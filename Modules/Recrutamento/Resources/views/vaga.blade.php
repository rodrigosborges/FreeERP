@extends('template')
@section('content')
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cargo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['vaga'] as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->cargo}}</td>
                        <td>
                            <form action="{{url('recrutamento/Vaga', [$item->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("recrutamento/Vaga/$item->id/edit") }}'>Editar</a> 
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <a class="btn btn-success" href="{{ url('recrutamento/Vaga/create') }}">Nova Vaga</a>
@endsection