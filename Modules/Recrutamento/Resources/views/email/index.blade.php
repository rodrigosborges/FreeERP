@extends('template')
@section('content')

    <div class="card">
    <div class="card-header d-flex justify-content-center"><h3>{{$data['title']}}</h3></div>
    <div class="card-body col-md-10 offset-md-1">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-ativos-tab" data-toggle="tab" href="#nav-ativos" role="tab" aria-controls="nav-ativos" aria-selected="true">Ativas ({{$data['emails']->count()}})</a>
                    <a class="nav-item nav-link" id="nav-inativos-tab" data-toggle="tab" href="#nav-inativos" role="tab" aria-controls="nav-inativos" aria-selected="false">Inativas ({{$data['emails_inativos']->count()}})</a>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-2 offset-md-4">
            <a class="btn btn-success " style="margin-bottom:10px;" href="{{ url('recrutamento/email/create') }}"><i class="material-icons" style=" vertical-align: middle;">add_circle_outline</i><span> Email</span></a>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-ativos" role="tabpanel" aria-labelledby="nav-ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['emails'] as $item)
                    <tr>
                        <td>{{$item->email}}</td>
                        <td>
                            <form action="{{url('recrutamento/email', [$item->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("recrutamento/email/$item->id/edit") }}'><i class="material-icons" style=" vertical-align: middle;">edit</i> Editar</a> 
                                <button type="submit" class="btn btn-danger"><i class="material-icons" style=" vertical-align: middle;">delete</i> <span>Delete</span></button>
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
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['emails_inativos'] as $item)
                    <tr>
                        <td>{{$item->email}}</td>
                        <td>
                            <a class="btn btn-info" href='{{ url("recrutamento/email/$item->id/restore") }}'><i class="material-icons" style=" vertical-align: middle;">restore_from_trash</i> <span>Restaurar</span></a> 
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