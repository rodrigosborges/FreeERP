@extends('assistencia::layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row ">
            <div class="col-12">
                <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            </div>
        </div>
        <div class="form-group row">
            <form class="input-group col-lg-9 col-sm-12" >
                {{ csrf_field() }}
                <input type="text" class="form-control" name="busca" placeholder="Pesquise por nome">
                <div class="input-group-append">
                    <button class="btn btn-info" id="buscar"  type="submit"><i class="fas fa-search"></i></button>
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