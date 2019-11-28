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
                    <option value="1">Serviços</option>
                    <option value="2">Técnicos</option>
                    <option value="3">Peças</option>
                </select>
            </div>
            <div class="col-6 form-group">
                <label for="">Status da ordem: </label>
                <select name="status" class="form-control">
                    <option value="1">Finalizadas e não finalizadas</option>
                    <option value="2">Apenas finalizadas</option>
                    <option value="3">Apenas não finalizadas</option>
                </select>
            </div>
            
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-success" id="gerar">Gerar</button>
        </div>
        <div class="card ">
            <div class="card-header d-flex justify-content-around">
                <h3>Relatório</h3>
                <button>imprimir</button>
            </div>
            <div class="card-body text-center relatorio ">
                Nenhum relatório gerado até o momento
            </div>
        </div>
    </div>

</div>

@stop
@section('js')
<script>
$(document).on('click', '#gerar', function(e){
    e.preventDefault();
    data_inicio = $("[name='data_inicio']").val()
    data_final = $("[name='data_final']").val()
    tipo = $("[name='tipo']").val()
    status = $("[name='status']").val()

    if(data_inicio && data_final){
        if(data_final<data_inicio){
            $('#data').text('Data final não pode ser menor que data inicial.')
        }else {
            $('#data').text(' ')
            table('Pago', 'pagos')
            table('Pendente', 'pendentes') 
        }
    }
    $.get(main_url+'/assistencia/relatorios/gerar?data_inicio='+data_inicio+'&data_final='+data_final+'&tipo='+tipo+'&status='+status, function(table){
        $('.relatorio').html(table)
    })
})

</script>
@endsection