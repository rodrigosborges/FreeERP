@extends('usuario::layouts.informacoes')
@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10">
        <div class="card mt-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0 ">Papéis</h5>
                <a href="{{url('papel/cadastrar')}}" style="text-decoration: none; padding:0">
                    <button class="text-success d-flex align-items-center p-0" style="background: none; border: 0; cursor: pointer;" type="submit" title="Cadastrar">
                        <i class="material-icons" style="font-size: 32px">add</i>
                    </button>
                </a>
            </div>
            <div class="card-body bg-light pb-0">
                <form class="d-flex mb-3" action="" method="get">
                    <input type="text" name="busca" class="form-control" placeholder="Buscar papel">
                    <button class="text-primary d-flex align-items-center ml-2" style="background: none; border: 0; cursor: pointer" type="submit" title="Buscar">
                        <i class="material-icons">search</i>
                    </button>
                </form>
                @if(isset($busca))
                    <p class="ml-1">
                        <i>
                            Exibindo resultados para: <b>{{ $busca }}</b>
                            <a class="ml-4" href="{{ url('papel') }}">Limpar Busca</a>
                        </i>
                    </p>
                @endif
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-papeisAtivos-tab" data-toggle="tab" href="#nav-papeisAtivos" role="tab" aria-controls="nav-papeisAtivos" aria-selected="false">Ativos</a>
                        <a class="nav-item nav-link" id="nav-papeisInativos-tab" data-toggle="tab" href="#nav-papeisInativos" role="tab" aria-controls="nav-papeisInativos" aria-selected="false">Inativos</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent" style="width:100%">
                    <div class="tab-pane fade show active" id="nav-papeisAtivos" role="tabpanel" aria-labelledby="nav-papeisAtivos-tab">
                        <div>
                            <table class="table table-striped table-borderless bg-white" style="border-style: solid; border-color: #dee2e6; border-width: 0 1px 1px 1px;">
                                <thead>
                                    <tr> 
                                        <th scope="col">Nome</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($papeisAtivos as $papel)
                                    <tr id="papeisAtivos">
                                        <td>{{ $papel->nome }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                @if(!$papel->trashed())
                                                <form method="GET" action="{{url('papel/'.$papel->id.'/edit')}}">
                                                    @csrf
                                                    <button class="text-warning" type="submit" style="border: 0; background: none; cursor: pointer" title="Editar">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{url('papel/'.$papel->id)}}">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="text-danger" style="background: none; border: 0; cursor: pointer" type="submit" title="Deletar">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-papeisInativos" role="tabpanel" aria-labelledby="nav-papeisInativos-tab">
                        <div>
                            <table class="table table-striped table-borderless bg-white" style="border-style: solid; border-color: #dee2e6; border-width: 0 1px 1px 1px;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($papeisInativos as $papel)
                                    <tr id="papeisInativos">
                                        <td>{{ $papel->nome }}</td>
                                        <td class="text-center"><i class="material-icons">{{ $papel->icone }}</i></td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <form method="POST" action="{{url('papel/restore/'.$papel->id)}}">
                                                    @method('put')
                                                    @csrf
                                                    <button class="text-success" type="submit" style="border: 0; background: none; cursor: pointer" title="Restaurar">
                                                        <i class="material-icons">restore_from_trash</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <nav class="d-flex justify-content-center" aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection