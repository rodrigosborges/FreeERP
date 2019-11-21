@extends('assistencia::layouts.master')

@section('content')

<div class="card">
    <div class="card-header ">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h3>Clientes</h3>
            <a href="{{url('/assistencia/estoque/pecas/localizar')}}"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
    </div>
    <div class="card-body">
        
        <div class="form-group row">
            <form class="input-group col-lg-9 col-sm-12" >
                {{ csrf_field() }}
                <input type="text" class="form-control" name="busca" placeholder="Pesquise por nome">
                <div class="input-group-append">
                    <button class="btn btn-info" id="buscar"  type="submit"><i class="material-icons">search</i></button>
                </div>
            </form>
            <div class="col-lg-3 col-sm-12 text-center">
                <a href="{{route('cliente.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar
                        Cliente</button></a>
            </div>
        </div>
        <div class="row-center table">
            
        </div>

    </div>
</div>
@stop
@section('js')
<script>
$(document).ready(function(){
    tabela(main_url+'/assistencia/cliente/table')
    var busca = '';
    $(document).on('click','.page-link', function(e){
        e.preventDefault();
        tabela($(this).attr('href')+"&busca="+busca)
    })
    $(document).on('click', '#buscar', function(e){
        e.preventDefault();
        busca = $("[name='busca']").val();
        tabela(main_url+'/assistencia/cliente/table?busca='+busca)
    })
})

function tabela(url){
    $.get(url, function(table){
        $('.table').html(table);
    })
}
</script>
@endsection