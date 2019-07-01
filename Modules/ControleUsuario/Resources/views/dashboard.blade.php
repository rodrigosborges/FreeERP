@extends('template')
<!--Lista de Papeis do Usuario -->
@section('content')
<div class="row justify-content-center text-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <p>Bem vindo <b>{{$usuario->nome}}</b></p>
      </div>
      <div class="card-body">
        <h5 class="card-title">Meus Papéis</h5>
        <div class="table-responsive-md">
          <table class="table text-center">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Modulo</th>
                <th scope="col">Papel</th>
                <th scope="col" colspan="3">
                  <p>Opções</p>
                </th>
              </tr>
            </thead>

            @foreach($usuario->atuacoes as $atuacao)
            <tr>
              <td>{{$atuacao->modulo->nome}}</td>
              <td>{{$atuacao->papel->nome}}</td>
              <td><a href="#" class="btn btn-info btn-sm"><i class="material-icons">remove_red_eye</i></a></td>
              <td><a href="#" data-id="{{$atuacao->id}}" id="btnEdit" data-toggle="modal" data-target="#editModal" data-id="{{$atuacao->id}}" class="btnEdit btn btn-warning btn-sm"><i class="material-icons">edit</i></a></td>
              <td><a href="#" class="btn btn-danger btn-sm" data-id="{{$atuacao->id}}" id="btnEdit" data-toggle="modal" data-target="#deleteModal"><i class="material-icons">delete</i></a></td>
              @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-center text-center" style="margin: 15px;">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4>Minhas Informações</h4>
      </div>
      <div class="card-body">
        <div class="form-group">
        
        <p class="msg alert"></p>
          <div class="row justify-content-center">
          
          {{ csrf_field() }}
            <label for="exampleFormControlFile1">
              <i class="material-icons text-muted" style="font-size: 100px; cursor:pointer" id='foto_pefil'>add_a_photo</i>
            </label>
            <input type="file" class="form-control-file" name="foto" id="exampleFormControlFile1" style="display: none">
          </div>
          <input type="hidden" name="id" value="{{$_SESSION['id']}}">
        </div>
        <div class="row justify-content-center">
          <div class="col-10">
            <div class="form-group">
              <input type="text" class="form-control" value="{{$_SESSION['nome']}}" name="name" id="nome" placeholder="Nome">
              <p class="feedback alert-nome alert "></p>

            </div>
            <div class="form-group">
              <input type="email" class="form-control" value="{{$_SESSION['email']}}" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
              <p class="feedback alert-email alert"></p>

            </div>
            <div class="form-group">
              <input type="password" class="form-control" value="" name="password" id="password" placeholder="Senha">
              <p class="feedback alert-senha alert"></p>

            </div>
            <button type="submit" id="btnCadastrar" class="btn btn-primary d-flex align-items-center">Atualizar</button>
          </div>
        </div>
      
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Atuação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class="msg alert alert-success">Dados salvos</p>
      <form action="">
        <div class="form-group">
          <label for="modulo-atuacao">Módulo</label>
          <select name="" id="moduloSelect" class="form-control">
           
          </select>
        </div>
        <div class="form-group">
        <label for="papel-atuacao">Papel</label>
        <select name="" id="papelSelect" class="form-control">
       
        </select>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label" display="none">
                <input type="radio" id="dataIndeterminada" class="form-check-input" value="indefinido" name="optionVencimento" >Tempo indeterminado
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" id="definirData" value="definido" name="optionVencimento" checked >Definir validade
            </label>
        </div>

        
        <div class="form-group" id="vencimento"><input class="form-control" id="dataVencimento" type="date"></div>
      </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" disabled>Salvar mudanças</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal 2 -->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remover Atuação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class="alert alert-warning">Você relmente deseja remover esta atuação?</p>
      <div class="table-responsive-md">
      <table class="table text-center">
      <thead class="thead-dark"></thead>
      <tr>
        <td colspan="2">Dados da Atuação</td>
      </tr>
        <tr>
          <th scope="col">Modulo</th>
          <th scope="col">Papel</th>
          
        </tr>
        </thead>
        <tr>
        <td>Vendas</td>
        <td>Operador</td>
        </tr>
        </table>
      </div>
        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" >Sim, excluir</button>
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    var id;
    //função de atualizar usuário
    $('#btnCadastrar').click(function(e){
      e.preventDefault()
      $('.msg').removeClass("alert-warning");
      $('.msg').removeClass("alert-danger");
      $('.msg').removeClass("alert-success");
        $('.msg').hide()
        var nome = $('#nome').val().trim()
        var email = $('#email').val().trim()
        var senha= $('#password').val();
        var regex_email = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        if(nome.length<4){
          $('.msg').html("O campo <b>nome</b> deve conter mais de 3 caracteres")
          $('.msg').fadeIn()
          $('.msg').addClass("alert-warning");
          $('#nome').focus();
        }else if(!regex_email.test(email)){
          $('.msg').html("O  <b>email</b> inserido não é um email válido")
          $('.msg').fadeIn()
          $('.msg').addClass("alert-warning");
          $('#email').focus();
        }else if(senha.length<6){
          $('.msg').html("A <b>senha</b> deve conter no mínimo 6 caracteres")
          $('.msg').fadeIn()
          $('.msg').addClass("alert-warning");
          $('#password').focus();

        } else{
          $.ajax({
            url:'updateUsuario',
            data:{'_token':$('input[name=_token]').val(),
            'nome':nome,
            'email': email,
            'senha':senha,
            'id':$("input[type=hidden][name=id").val()
           
            },
            type:"POST",
            datatype:"json"
          }).done(function(e){
            console.log("foi"+e)
            var mensagem = $.parseJSON(e)['mensagem'];
            var sucesso = $.parseJSON(e)['sucesso'];
            if(sucesso){
           
            $('.msg').removeClass('alert-warning')
            $('.msg').addClass('alert-success')
            $('#btnCadastrar').attr('disabled','disabled');
          }else{
            $('.msg').addClass('alert-danger')
            $('.msg').removeClass('alert-success')
            $('.msg').removeClass('alert-warning')

          }
          $('.msg').html(mensagem);
          $('.msg').fadeIn();
          }).fail(function(){
            console.log("fail");
          })
        }
    })
    $('.btnEdit').click(function(){
    
      id =(this).dataset.id;
      $.ajax({
        url:'buscarModulos',
        type:'POST',
        data:{'_token':$('input[name=_token]').val()}
      }).done(function(e){
        console.log("ok:->"+e);
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
        console.log("option 1 ->" + options1);
        console.log("option 2 ->" + options2);
        $('#moduloSelect').html(options1)
        $('#papelSelect').html(options2)
      }).fail(function(){
        console.log(falha)
      })

    })
    
  });
</script>
@endsection