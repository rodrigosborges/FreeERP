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
