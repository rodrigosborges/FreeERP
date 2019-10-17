@extends('cliente::template')
@section('content')
    <div class="card">
        <div class="card-header row">
            <div class="col-12">
                <h3>Lista de clientes</h3>
            </div>
            <form class="input-group col-lg-7 col-sm-10">
                <input type="text" class="form-control" name="busca" placeholder="Localizar cliente por nome">
                <div class="input-group-append">
                    <input class="btn btn-outline-success" value="Localizar" id="busca">
                </div>
            </form>
            <div class="col text-right">
                <a href="{{url('/cliente/cliente/create')}}"><button class="btn btn-success">Adicionar cliente</button></a> 
            </div>
            
        </div>
            
        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab"  aria-selected="true">Ativos</a>
            </li>
            <li class="nav-item">   
                <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab"  aria-selected="false">Inativos</a>
            </li>
        </ul>

        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                    
                </div>
                <div class="tab-pane fade" id="inativos" role="tabpanel" aria-labelledby="inativos-tab">
                    
                </div>   
            </div>
             
            
        </div>
        

    </div>
    

    
@stop
@section('script')
<script>
    $(document).ready(function(){
        tabela('ativos', main_url+'/cliente/cliente/table/ativos');
        tabela('inativos', main_url+'/cliente/cliente/table/inativos');
        var busca = '';
        $(document).on('click','.page-link', function(e){
            e.preventDefault();
            var status = $(this).closest('.tab-pane').attr('id')
            tabela(status, $(this).attr('href')+"&busca="+busca)
        })
        $(document).on('click', '#busca', function(){
            busca = $("[name='busca']").val();
            tabela('ativos', main_url+'/cliente/cliente/table/ativos?busca='+busca);
            tabela('inativos', main_url+'/cliente/cliente/table/inativos?busca='+busca);
        })
    })
    function tabela(status, url){
        setLoading($('#'+status))
        $.get(url, function(table){
            $('#'+status).html(table);
        })
    }
</script>
@endsection