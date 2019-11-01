{{Form::label('telefone','Telefone')}}
<div class='telefones'>
    <div class='form-inline  mb-2'>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">phone</i>
                    </span>
                </div>
                {{Form::text('telefone[][numero]',$value=null,array('id'=>'telefone','class' => 'telefone form-control','placeholder'=>'Telefone'))}}
            </div>
            <a class="btn btn-primary adicionar-telefone  ml-2 text-white">Adicionar</a>
            <a class="remover-telefone btn text-white btn-danger ml-2">Remover</a>
        </div>
    
</div>