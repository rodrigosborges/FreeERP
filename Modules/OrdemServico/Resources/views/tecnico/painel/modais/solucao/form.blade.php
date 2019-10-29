<!-- Modal -->
<div class="modal fade" id="solucao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Relatar Solução</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class='modal-body'>
                {{ Form::open(array('id' => 'form-solucao' , 'method'=>'post')) }}
                {{Form::token()}}
                {{Form::textarea("solucao[descricao]", $value=null ,array('class' => 'form-control','id' =>'descricao','placeholder'=>'Descrição'))}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                {{Form::submit( 'Confirmar',array('class'=>"btn btn-primary") )}}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
