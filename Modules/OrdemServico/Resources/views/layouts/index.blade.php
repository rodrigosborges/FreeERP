@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="container h-100">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-info mb-3" style="max-width: 50rem;">
                <div class="card-header bg-info text-white"> {{$data['title']}} </div>
                <div class="card-body">
                    <table id="datatable" class="table border table-hover" style="width:100%">
                        <thead>
                            <tr>
                                @foreach($data['thead'] as $coluna)
                                <th scope='col' class='text-info bg-light'>{{$coluna}}</th>
                                @endforeach
                                <th scope='col' class="bg-light "><a href="{{route($data['route'].'create')}}" class="text-white btn btn-primary">Abrir OS</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--- Gera Linhas com atributos e dados do banco --->
                            @foreach($data['model'] as $model)
                            <tr>
                                @foreach($data['row_db'] as $atributo)
                                <td>{{$model->$atributo}}</td>
                                @endforeach
                                <td></td>
                            @endforeach
                        </tbody>
                        </tfoot>
                    </table>
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

        $(".dataTables_paginate").attr('class', 'pagination');
        $(".pagination").children().attr('class', 'page-link');
        
        $("th").click(function() {
            $(".pagination").children().attr('class', 'page-link');

        });
    });
</script>
@endsection
@endsection