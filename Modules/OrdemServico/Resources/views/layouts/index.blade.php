@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="container h-100">

    @yield('cards')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-info ">
                <div class="card-header bg-info text-white"> {{$data['title']}} </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered text-center border table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    @foreach($data['thead'] as $coluna)
                                    <th scope='col' class='text-info bg-light'>{{$coluna}}</th>
                                    @endforeach
                                    @if($data['create'])
                                    <th scope='col' class="bg-light text-center "><a href="{{route($data['route'].'create')}}" class="text-white btn btn-primary">Abrir OS</a></th>
                                    @else
                                    <th scope='col' class="bg-light text-info text-center ">Ações</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <!--- Gera Linhas com atributos e dados do banco --->
                                @foreach($data['model'] as $model)
                                <tr>
                                    @foreach($data['row_db'] as $atributo)
                                    <td>
                                        <!--- Se o atributo for chave estrangeira , puxar o nome ao invés do id -->
                                        @if($atributo == 'solicitante_id')
                                        {{$model->solicitante->nome}}
                                        @elseif($atributo == 'status_id')
                                        {{$model->status->titulo}}
                                        @elseif($atributo == 'problema_id')
                                        {{$model->problema->titulo}}
                                        <!--- Mostrar prioridades -->
                                        @elseif($atributo == 'prioridade')
                                        @if($model->$atributo == 3)
                                        <span class="badge badge-success text-white">Baixa</span>
                                        @elseif($model->$atributo == 2)
                                        <span class="badge badge-warning text-white">Média</span>
                                        @elseif($model->$atributo == 1)
                                        <span class="badge badge-danger text-white">Alta</span @endif @else {{ $model->$atributo}} @endif </td> @endforeach <td>
                                        @foreach($data['acoes'] as $acao)
                                        <a href="{{route($data['route'] . $acao['complemento-route'],$model)}}" class="{{$acao['class']}}">{{$acao['nome']}}</a>
                                        @endforeach
                                        @yield('acoes')
                                    </td>
                                    @endforeach
                            </tbody>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('modal')

@section('js')
<script src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{Module::asset('ordemservico:css/datatable.css')}}">

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pageLength": 5,
            "lengthChange": false,
            'info': false,
            "language": {
                "emptyTable": "<center>Nenhum registro cadastrado</center>",
                "zeroRecords": "<center>Não Encontrado</center>",
                "loadingRecords": "Carregando...",
                "search": "",

                "paginate": {
                    "previous": 'Anterior',
                    "next": "Proximo",
                }
            }
        });
        $(".dataTables_filter").children().children().attr("placeholder", "Buscar...");
        $(".dataTables_filter").children().append('<i  class="icon-search material-icons mr-2">search</i>');

        $(".dataTables_paginate").addClass('pagination ml-2');
        $(".pagination").children().addClass('page-link');
        $(".pagination > span").attr('class', 'd-flex');
        $(".pagination > span").children().addClass('page-link');
        $('.dataTables_paginate').bind('DOMNodeInserted DOMNodeRemoved', function() {
            $(".pagination").children().addClass('page-link');
            $(".pagination > span").attr('class', 'd-flex');
            $(".pagination > span").children().addClass('page-link');

        });
    });
</script>

@yield('js-add')
@endsection
@endsection