@extends('template.main')
@section('content')
    <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
            <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Prontuário</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['alunos'] as $aluno)
                    <tr>
                        <td>{{$aluno->nome}}</td>
                        <td>{{$aluno->prontuario}}</td>
                        <td>
                            <form action="{{url('aluno', [$aluno->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("aluno/$aluno->id/edit") }}'>Editar</a> 
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="inativos" role="tabpanel" aria-labelledby="inativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Prontuário</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['alunos_deletados'] as $aluno)
                    <tr>
                        <td>{{$aluno->nome}}</td>
                        <td>{{$aluno->prontuario}}</td>
                        <td>
                            <form action="{{url('aluno', [$aluno->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-success" value="Restore"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a class="btn btn-success" href="{{ url('aluno/create') }}">Novo aluno</a>
@endsection