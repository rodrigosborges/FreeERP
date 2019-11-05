@extends('assistencia::layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        Lista de pagamentos
    </div>
    <div class="card-body">
        <div class="row">
            
            <label class="col-form-label" for="data-inicio">Data inicial: </label>
            <input type="date" name="data-inicio" class="col-sm-4 form-control">

            <label class="col-form-label" for="data-final">Data final:  </label>
            <input type="date" name="data-final" class="col-sm-4 form-control">
    
            <div class="col-sm-2">
                <button id="filtrar" class="btn btn-outline-primary">
                    Filtrar
                </button>
            </div>
        </div>
        

        
    
    <ul class="nav justify-content-center nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab"  id="pagos-tab" role="tab" href="#pagos" aria-selected="true">Pagos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab"  id="pendentes-tab" href="#pendentes" role="tab" aria-selected="false">Pendentes</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" data-status="Pago" id="pagos" role="tabpanel" aria-labelledby="home-tab">
          
        </div>
        <div class="tab-pane fade" id="pendentes" data-status="Pendente"  role="tabpanel" aria-labelledby="profile-tab">
           
        </div>
    </div>
    </div>

</div>

@stop
@section('js')
<script>
    
    var inicio = '';
    var fim = '';
    var page = '';
    table('Pago', 'pagos')
    $(document).on('click', '#pagos-tab',  function(){
        table('Pago', 'pagos') 
    })
    $(document).on('click', '#pendentes-tab', function(){
        table('Pendente', 'pendentes') 
    })
    $(document).on('click','.page-link', function(e){
        e.preventDefault();
        var id = $(this).closest('.tab-pane').attr('id')
        var status = $(this).closest('.tab-pane').attr('data-status')
        var page = $(this).attr('href').split('=')
        table(status,id,page[1])
        
    })
   
   $(document).on('click', '#filtrar', function() {
        table('Pago', 'pagos')
        table('Pendente', 'pendentes') 

   })
    function table(status, id, page=null) {
        inicio = $("[name='data-inicio']").val();
        fim = $("[name='data-final']").val();
        console.log('asfas')
        $.get(main_url+'/assistencia/pagamento/table/'+status+'?page='+page+'&inicio='+inicio+'&fim='+fim, function(tabela){
                $('#'+id).html(tabela)
        })
        
    }
</script>
@endsection