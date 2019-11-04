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
            <a class="nav-link active" data-toggle="tab" id="pagos-tab" role="tab" href="#pagos" aria-selected="true">Pagos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" id="pendentes-tab" href="#pendentes" role="tab" aria-selected="false">Pendentes</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="pagos" role="tabpanel" aria-labelledby="home-tab">
          
        </div>
        <div class="tab-pane fade" id="pendentes" role="tabpanel" aria-labelledby="profile-tab">
           
        </div>
    </div>
    </div>

</div>

@stop
@section('js')
<script>
    table('Pago', 'pagos')
    var inicio = '';
    var fim = '';
    $('#pagos-tab').click(function(){
        inicio = $("[name='data-inicio']").val();
        fim = $("[name='data-final']").val();
        table('Pago', 'pagos') 
    })
    $(document).on('click', '#pendentes-tab', function(){
        inicio = $("[name='data-inicio']").val();
        fim = $("[name='data-final']").val();
        table('Pendente', 'pendentes') 
    })
    
    $(document).on('click', '#filtrar', function(e){
        e.preventDefault();
        inicio = $("[name='data-inicio']").val();
        fim = $("[name='data-final']").val();
        table(main_url+'/assistencia/pagamento/table/')
    })
    $(document).on('click','.page-link', function(e){
        e.preventDefault();
        var status = $(this).closest('.tab-pane').attr('id')
        tabela(status, $(this).attr('href')+'&inicio='+inicio+'&fim='+fim)
    })
    $("#filtrar").on("click", function () {
        inicio = $("[name='data-inicio']").val();
        fim = $("[name='data-final']").val();
        tabela('Pago','pagos',main_url+'/assistencia/pagamento/table/'+status'&inicio='+inicio+'&fim='+fim);
        tabela('Pendente','pendentes',main_url+'/assistencia/pagamento/table/'+status'&inicio='+inicio+'&fim='+fim);
    });
    function table(status, id, url) {
       $.get(main_url+'/assistencia/pagamento/table/'+status'&inicio='+inicio+'&fim='+fim, function(tabela){
            $('#'+id).html(tabela)
       })
        
    }
</script>
@endsection