@extends('template')
@section('title', 'Cadastrar')

@section('content')
<div class="row justify-content-center">
    <div class="col col-sm-10 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$data['title']}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Perfil do usuário</h6>
                @if($data['model'])
                {!!Form::open(array('route'=>'validar.edicao', 'method'=>'post')) !!}
                {!! Form::hidden('id', $data['model']->id) !!}
                @method('PUT')
                @else
                {!!Form::open(array('route'=>'validar.cadastro', 'method'=>'post')) !!}
                @endif

                {{ csrf_field() }}


                <div class="form-group">
                    <div class="row justify-content-center">
                        <label for="exampleFormControlFile1">
                            <i class="material-icons text-muted" style="font-size: 100px; cursor:pointer">add_a_photo</i>
                        </label>
                        <input type="file" class="form-control-file" name="foto" id="exampleFormControlFile1" style="display: none">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$data['model'] ? $data['model']->nome :''}}" name="name" id="nome"
                            placeholder="Nome">
                            <span class="errors alert-danger">  {{ $errors->first('name') }} </span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" value="{{$data['model'] ? $data['model']->email :''}}" name="email" id="email" aria-describedby="emailHelp"
                            placeholder="Email">
                            <span class="errors alert-danger"> {{ $errors->first('email') }} </span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                            <span class="errors alert-danger"> {{ $errors->first('password') }} </span>
                        </div>
                        <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <i class="material-icons mr-2">save</i> {{$data['button']}}
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="card-footer d-flex justify-content-around align-items-center pt-4">
                <p class="text-primary d-flex align-items-center">
                    <i class="material-icons mr-2">edit</i> Perfil do usuário
                </p>
                <a href="#" class="text-muted d-flex align-items-center" data-toggle="modal"data-target="#formPapel">
                    <i class="material-icons mr-2">timer</i> Módulos e permissões
                </a>
            </div>
        </div>
    </div>
    <!-- agora vai -->
</div>
@endsection

<!-- MODAL -->
<div id="formPapel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="material-icons mr-2">timer</i> Módulos e permissões</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
        <div >
         
        </div>
        <div class="modal-body">
         <div class="conteudo" >
         <a href="#" id="addPapel" >
                    <i class=" text-center material-icons mr-2">note_add</i> Adicionar Papel
                </a>
         </div>
      
         <div class="form-group " id="divModulo">
         <label for="selectModulo"><span><a class="material-icons" data-toggle="voltar" data-placement="top">
            keyboard_backspace</a ></span>
            Módulo de atuação
        </label>
        <select class="form-control" id="selectModulo">
            <option selected>Selecione</option>
            <option>Compras</option>
            <option>Funcionários</option>
            <option>Frota</option>
        </select>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio" >Definir validade
            </label>
        </div>

        <div class="form-check-inline">
            <label class="form-check-label" display="none">
                <input type="radio" class="form-check-input" name="optradio" checked>Tempo indeterminado
            </label>
        </div>
        <div class="form-group"><input class="form-control" type="date"></div>

    </div>
         
        </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit" id="btnDeletePapel">
                    <span class="glyphicon glyphicon-plus"></span>Excluir
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Fechar
                </button>
            </div>
        </div>
    </div>
</div>
@section('js')
<script>
$(document).ready(function(){
$('#divModulo').hide();
$('#addPapel').click(function(){
 
    $('#addPapel').hide();
    $('#divModulo').fadeIn(150);
    
})
});

</script>
@endsection