{{Form::label('telefone','Telefone')}}
<div class='telefones'>
    <div class='form-inline'>
        <div class="form-group  mx-sm-3 mb-2">
            {{Form::text('telefone',$value=null,array('class' => 'form-control','placeholder'=>'Telefone'))}}
        </div>
        <a class="btn btn-primary adicionar-telefone mb-2 ml-2 text-white">Adicionar</a>
        <a  class="remover-telefone btn text-white btn-danger mb-2 ml-2">Remover</a>
    </div>
</div>