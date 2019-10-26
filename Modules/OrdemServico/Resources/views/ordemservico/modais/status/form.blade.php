@extends('ordemservico::layouts.index')
@section('acoes')
<button type="button" class="btn btn-outline-info btn-sm status-button">
    Atualizar Status
</button>

@endsection
@section('modal')

<!-- Modal -->
<div class="modal fade" id="atualizar-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Atualizar Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class='modal-body'>
                {{ Form::open(array('id' => 'form' , 'method'=>'post')) }}
                {{Form::token()}}
                {{Form::label("status_id",'Status Atual: ')}}

                {{Form::select("status_id",$data['status'],$value=null,array('class' => 'form-control'))}}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                {{Form::submit( 'Confirmar',array('class'=>"btn btn-primary") )}}

                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>
@endsection

@section('js-add')
<script>
    $(document).ready(function() {
        $(".status-button").click(function() {
     
            var linha = $(this).parent().parent();

            var idOS = linha.find("td:eq(0)").text().trim();

            $.get("/ordemservico/os/status/" + idOS + "/showStatusOS", function(data) {
                $('select').val(data);
            });

            $("#form").attr("action", '/ordemservico/os/status/' + idOS + '/updateStatus');

            $('#atualizar-status').modal('show');

        });
    });
</script>
@endsection