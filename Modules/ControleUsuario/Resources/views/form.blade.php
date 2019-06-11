@extends('template')
@section('title', 'Cadastrar')

@section('content')
<div class="row justify-content-center">
    <div class="col col-sm-10 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-body">
            <p class="feedback feedback-done alert "></p>
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
                            <p class="feedback alert-nome alert "></p>
                            <span class="errors alert-danger">  {{ $errors->first('name') }} </span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" value="{{$data['model'] ? $data['model']->email :''}}" name="email" id="email" aria-describedby="emailHelp"
                            placeholder="Email">
                            <p class="feedback alert-email alert"></p>
                            <span class="errors alert-danger"> {{ $errors->first('email') }} </span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                            <p class="feedback alert-senha alert"></p>
                            <span class="errors alert-danger"> {{ $errors->first('password') }} </span>
                        </div>
                        <button type="submit" id="btnCadastrar" class="btn btn-primary d-flex align-items-center">{{$data['button']}}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="card-footer d-flex justify-content-around align-items-center pt-4">
                <p class="text-primary d-flex align-items-center">
                    <i class="material-icons mr-2">edit</i> Perfil do usuário
                </p>
                <a href="#" class="text-muted d-flex align-items-center" id="moduloPermissao" data-toggle="modal"data-target="#formPapel">
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
        <div class="form-group">
        <select class="form-control" id="selectModulo">
           
        </select>
        </div>
        <div class="form-group">
        <select class="form-control" id="selectPapel">
           
        </select>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label" display="none">
                <input type="radio" id="dataIndeterminada" class="form-check-input" value="indefinido" name="optionVencimento" checked>Tempo indeterminado
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" id="definirData" value="definido" name="optionVencimento" >Definir validade
            </label>
        </div>

        
        <div class="form-group" id="vencimento"><input class="form-control" id="dataVencimento" type="date"></div>

    </div>
         
        </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="btnSalvarAtuacao">
                    <span class="glyphicon glyphicon-plus"></span>Salvar
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Fechar
                </button>
            </div>
        </div>
    </div>
</div>
@section('js')
<script>
$(document).ready(function(){
    var modulo=""
    var papel=""
    var atuacao=""
    var vencimento="";
    
    $('#btnCadastrar').click(function(e){
        $('#feedback-done').removeClass("alert-danger");
        
        $('.feedback').hide();
        e.preventDefault()
        var nome= $('#nome').val()
        var email=$('#email').val()
        var senha= $('#password').val();
        var regex_email = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
     //  alert("nome:"+ nome +" - Email:" +email +" - senha:"+ senha)
     if(nome==""){
        $('.alert-nome').html("O campo <b>Nome</b> não pode ser vazio");
        $('.alert-nome').addClass('alert-warning');
        $('.alert-nome').fadeIn();
        $('#nome').focus();
         }
     else if(nome.length <4){
         $('.alert-nome').html("O campo <b>Nome</b> deve possuir mais de 3 caracteres");
         $('.alert-nome').addClass('alert-warning');
         $('.alert-nome').fadeIn();
        $('#nome').focus()
         //nome curto
     }else if(email==""){
        $('.alert-email').html("O campo <b>Email</b> Não pode ser vazio");
        $('.alert-email').addClass('alert-warning');
        $('.alert-email').fadeIn();
        $('#email').focus()
     }else if(!regex_email.test(email)){
        $('.alert-email').html("O <b>Email</b> inserido não é um email válido");
        $('.alert-email').addClass('alert-warning');
        $('.alert-email').fadeIn();

     }
     else if(senha==""){
        $('.alert-senha').html("O campo <b>Senha</b> Não pode ser vazio");
        $('.alert-senha').addClass('alert-warning');
        $('.alert-senha').fadeIn();
        $('#password').focus()
             //senha vazia
      }
     else if(senha.length<6){
        $('.alert-senha').html("O campo <b>Senha</b> deve conter no mínimo 6 caracteres");
        $('.alert-senha').addClass('alert-warning');
        $('.alert-senha').fadeIn();
        $('#password').focus()
        
         //senha curta
     }else{
         
         if($('#btnCadastrar').html()=="Cadastrar")
            cadastrarUsuario(nome,email,senha);
         else
           atualizarUsuario(nome,email,senha);
         
     }
    });
$('#divModulo').hide();
$('#moduloPermissao').click(function(){
    $.ajax({
        url:'buscarModulos',
        type:'POST',
        data:{'_token':$('input[name=_token]').val()}
    }).done(function(e){
      //  console.log("done->"+e)
      console.log(e)
        var modulos = $.parseJSON(e)['modulos'];
        var papeis = $.parseJSON(e)['papeis'];
        var options1 ="<option value='-1' selected>Selecione</option>";
        var options2 ="<option value='-1' selected>Selecione</option>";
        $.each(modulos, function(chave,valor){
            options1+='<option value="'+ valor['id'] + '">'+valor['nome'] +"</option>"

        });
        $.each(papeis,function(chave,valor){
            options2 += '<option value="'+ valor['id'] + '">'+valor['nome'] +"</option>"
        })
        $('#selectModulo').html(options1)
        $('#selectPapel').html(options2)
       // console.log(options1);
    }).fail(function(){
       // console.log("falha")
    })
})
$('#addPapel').click(function(){
 
 
    $('#addPapel').hide();  
    $('#divModulo').fadeIn(150);
    $("#vencimento").hide();
    
});
$('#definirData').click(function(){
    $('#vencimento').fadeIn("slow");
   
})
$('#dataIndeterminada').click(function(){
    $('#vencimento').fadeOut("slow");
});
$('#btnSalvarAtuacao').click(function(){
   // alert($("input[type=radio][name='optionVencimento']:checked").val());
    modulo = $('#selectModulo').val();
    papel = $('#selectPapel').val();
    vencimento=""
    validadeAtuacao =$("input[type=radio][name='optionVencimento']:checked").val();
   if(validadeAtuacao!="indefinido"){
    vencimento = $("#dataVencimento").val()
    if(vencimento==""){
       alert("DATA Vazia")
   }else{
       alert("data de vencimento:"+ vencimento)
   }
   }
   
});
function cadastrarUsuario(nome,email,senha){
    $.ajax({
        url:'cadastrarUsuario',
        data:{'_token':$('input[name=_token]').val(),
              'nome': nome,
              'email':email,
              'senha':senha,
              'papel':papel,
              'modulo':modulo,
              'vencimento':vencimento
              },
        type:"POST",
        datatype:"JSON"
    }).done(function(e){
        var sucesso = $.parseJSON(e)['sucesso'];
        var mensagem = $.parseJSON(e)['mensagem'];
        if(sucesso){
            $('.feedback-done').addClass('alert-success')
            $('.feedback-done').removeClass('alert-danger')
        }
        else{
            $('.feedback-done').addClass('alert-danger')
            $('.feedback-done').removeClass('alert-success')
        }
        $('.feedback-done').fadeIn('slow');
        $('.feedback-done').html(mensagem);
        console.log("done->"+e)
    }).fail(function(){
        console.log("Falha")
    })
    
  //  console.log("papel"+ papel +" modulo"+ modulo+ " e vencimento"+ vencimento)
}
function atualizarUsuario(nome,email,senha){
    
}
});

</script>
@endsection