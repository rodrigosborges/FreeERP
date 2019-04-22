@extends('assistencia::layouts.master')


@section('css')
  <style media="screen">
  .module-assistencia {
      border-radius: 5px;
      background-color: rgba(123,155,166,0.5);
      margin-right: 15px;

      width: 100%;
      height: 100%;


    }
    h11 {
      color:red;
    }

    #logo {
        width:50%;
        height:50%;
    }

    .panel-heading{
      font-size:150%;
    }
    .test {
      text-align: right;
    }
  </style>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@stop

@section('content')


    <form class="form-horizontal">
        <legend> Dados pessoais</legend>
        <div class="form-group">
          <label class="col-md-1 control-label" for="Nome">Nome<h11>*</h11></label>
          <div class="col-md-9">
            <input id="Nome" name="Nome" placeholder="Nome Completo" class="form-control input-md" required="" type="text">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-1 control-label" for="cpf">CPF<h11>*</h11></label>
          <div class="col-md-2">
            <input id="cpf" name="cpf" placeholder="Apenas números" class="form-control input-md" onkeypress="return isNumberKey(event)" required="" type="text" maxlength="11" pattern="[0-9]+$">
          </div>
          <label class="col-md-2 control-label" for="prependedtext">Email <h11>*</h11></label>
          <div class="col-md-5">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input id="prependedtext" name="prependedtext" class="form-control" placeholder="email@email.com" required="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-1 control-label" for="cpf">Nascimento<h11>*</h11></label>
          <div class="col-md-2">
            <input id="dtnasc" name="dtnasc" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
          </div>
          <label class="col-md-1 control-label" for="radios">Sexo <h11>*</h11></label>
          <div class="col-md-4">
            <label required="" class="radio-inline" for="radios-0" >
              <input name="sexo" id="sexo" value="feminino" type="radio" required>
              Feminino
            </label>
            <label class="radio-inline" for="radios-1">
              <input name="sexo" id="sexo" value="masculino" type="radio">
              Masculino
            </label>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-1 control-label" for="cpf">Celular<h11>*</h11></label>
          <div class= "col-md-3">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
              <input id="celnumber" name="celnumber" class="form-control input-md" placeholder="XX XXXXX-XXXX" onkeypress="return isNumberKey(event)" required="" type="text" maxlength="11" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
            OnKeyPress="formatar('## #####-####', this)">
            </div>
          </div>
          <label class="col-md-1 control-label" for="prependedtext">Telefone</label>
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
              <input id="prependedtext" name="prependedtext" class="form-control" placeholder="XX XXXX-XXXX" onkeypress="return isNumberKey(event)" type="text" maxlength="11"  pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
              OnKeyPress="formatar('## #####-####', this)">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label" for="Cadastrar"></label>
          <div class="col-md-8">
            <button id="Cadastrar" name="Cadastrar" class="btn btn-success" type="Submit">Cadastrar</button>
            <button id="Cancelar" name="Cancelar" class="btn btn-danger" type="Reset">Cancelar</button>
          </div>
        </div>

    </form>

@stop
