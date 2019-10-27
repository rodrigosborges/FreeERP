<!-- Modal -->
<div class="modal fade" id="definir-prioridade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Definir Prioridade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'form-prioridade' , 'method'=>'post')) }}
                {{Form::token()}}

                <div class="form-group">
                    <div class="form-row">
                        <div id='prioridade'>
                            {{Form::label('Prioridade')}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    {{Form::submit( 'Salvar mudanças',array('class'=>"btn btn-primary") )}}
                </div>
                {{ Form::close() }}


            </div>
        </div>
    </div>
</div>
