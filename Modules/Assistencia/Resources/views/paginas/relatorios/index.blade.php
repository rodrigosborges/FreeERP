@extends('assistencia::layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h3>Gerar Relatórios</h3>
            <a href="{{url('/assistencia/tecnico')}}"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
    </div>
    <div class="card-body">
    <form id="form">
        <div class="row">
            <div class="form-group col-lg-4 col-12">
                <label for="data-inicio">Data inicial</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">calendar_today</i></span>
                    </div>
                    <input type="date" name="data_inicio" class="form-control">
                </div>
            </div>
            <div class="form-group col-lg-4 col-12">
                <label for="data-final">Data final</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">calendar_today</i></span>
                    </div>
                    <input type="date" name="data_final" class="form-control">
                </div>  
            </div>
            <div id="data" width="100%" class="errors col-12 text-center"></div>
            
            
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="">Relatório desejado: </label>
                <select class="form-control" name="tipo">
                    <option value="">Técnicos</option>
                </select>
            </div>
            
        </div>
    
    </form>
        

        

        

   
    </div>

</div>

@stop
@section('js')
<script>
$(document).on('click', '#filtrar', function() {
    var data_inicio = $("[name='data-inicio']").val();
    var data_fim = $("[name='data-final']").val();

    if(data_inicio && data_fim){
        if(data_fim<data_inicio){
            $('#data').text('Data final não pode ser menor que data inicial!')
        }else {
            $('#data').text(' ')
            table('Pago', 'pagos')
            table('Pendente', 'pendentes') 
        }
    }else {
        $('#data').text(' ')
        table('Pago', 'pagos')
        table('Pendente', 'pendentes') 
    }


    

})
</script>
@endsection