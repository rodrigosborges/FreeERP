@extends('assistencia::layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h3>Pagamentos</h3>
            <a href="{{url('/assistencia/tecnico')}}"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row d-flex justify-content-center">
            
            <div class="input-group form-group col-lg-3 col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="material-icons">calendar_today</i></span>
                </div>
                <input type="date" name="data-inicio" class="form-control">
            </div>
            <div class="input-group form-group col-lg-3 col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="material-icons">calendar_today</i></span>
                </div>
                <input type="date" name="data-final" class="form-control">
            </div>  
            <button id="filtrar" class="btn btn-info form-group ">
                Filtrar
            </button>
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