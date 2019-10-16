@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="container h-100">
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
                                    <th scope='col' class="bg-light text-center "><a href="{{route($data['route'].'create')}}" class="text-white btn btn-primary">Abrir OS</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--- Gera Linhas com atributos e dados do banco --->
                                @foreach($data['model'] as $model)
                                <tr>
                                    @foreach($data['row_db'] as $atributo)
                                    <td>
                                        @if($atributo == 'solicitante_id')
                                        {{$model->solicitante->nome}}
                                        @elseif($atributo == 'status_id')
                                        {{$model->status->titulo}}
                                        @else
                                        {{ $model->$atributo}}
                                        @endif
                                    </td>
                                    @endforeach
                                    <td>
                                        @foreach($data['acoes'] as $acao)
                                        <a href="{{route($data['route'] . $acao['complemento-route'],$model)}}" class="{{$acao['class']}}">{{$acao['nome']}}</a>
                                        @endforeach
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
@section('js')
<script src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{Module::asset('ordemservico:css/datatable.css')}}">

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
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

        $('.dataTables_paginate').bind('DOMNodeInserted DOMNodeRemoved', function() {
            $(".pagination").children().attr('class', 'page-link');

        });
    });
</script>
@endsection
@endsection