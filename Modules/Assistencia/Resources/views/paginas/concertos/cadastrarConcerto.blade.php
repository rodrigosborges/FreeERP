@extends('assistencia::layouts.master')

@section('content')
<div class="container text-center">
	<div class="card-body">
		<div class="row">
		  <div class="col-md-11 text-left">
		      <a href="{{route('cliente.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
		  </div>
		</div>
		<div class="row justify-content-center">
			<h3>Nova ordem de serviço</h3>
		</div>
		<div class="row justify-content-center">
		    <form class="col-md-8" action="{{route('concertos.salvar')}}" method="post" enctype="multipart/form-data">
		      {{ csrf_field() }}
		      <div>
						<form class="" action="index.html" method="post">
							<div class="row">
							  <div class="input-group col">
							    <label for="numeroOrdem">N Ordem</label>
							    <input class="form-control" name="numeroOrdem" type="text" placeholder="{{ $id }}" readonly>
							  </div>
							</div>
							<div class="row">
							  <div class="input-group col">
							    <label for="data_entrada">Data de entrada</label>
							    <div class="input-group-prepend">
							      <span class="input-group-text" id="nascimento"><i class="material-icons">calendar_today</i></span>
							      <input class="form-control" name="data_entrada" type="text" value="{{ date('d/m/Y') }}" readonly>
							    </div>

							    <div class="input-group col">
							      <label for="situacao">Situação</label>
							      <select class="custom-select " id="situacao" name="situacao">
							        <option selected>Aguardando autorização do orçamento</option>
							        <option value="1">Autorizado</option>
							        <option value="2">Em reparo</option>
							        <option value="3">Aguardando retirada do cliente</option>
							      </select>
							   </div>
							  </div>
							</div>

							<div class="row">
							  <div class="input-group col">
							    <div class="input-group-prepend">
							      <span class="input-group-text" id="cliente"><i class="material-icons">person</i></span>
							    </div>
							    <input class="form-control" name="nome" type="text" placeholder="Nome completo" value="{{isset($cliente->nome) ? $cliente->nome : ''}}">
							  </div>
							  <div class="input-group col">
							    <div class="input-group-prepend">
							      <span class="input-group-text" id="cliente"><i class="material-icons">account_box</i></span>
							      <input type="text" class="form-control cpf-mask" name="cpf" placeholder="XXX.XXX.XXX-XX" value="{{isset($cliente->cpf) ? $cliente->cpf : ''}}">
							    </div>

							  </div>

							</div>

							<div class="row">
							  <div class="input-group col">
							    <div class="input-group-prepend">
							      <span class="input-group-text" id="email"><i class="material-icons">email</i></span>
							    </div>
							    <input class="form-control" type="email" name="email" placeholder="E-mail" id="email-input" value="{{isset($cliente->email) ? $cliente->email : ''}}">
							  </div>
							  <div class="input-group col">
							    <div class="input-group-prepend">
							      <span class="input-group-text" id="telefone"><i class="material-icons">phone</i></span>
							    </div>
							    <input id="telefone" name="telefonenumero" class="form-control input-md" placeholder="(XX) X XXXX-XXXX" onkeypress="return isNumberKey(event)" required="" type="text" maxlength="11" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
							    OnKeyPress="formatar('## #####-####', this)" value="{{isset($cliente->telefonenumero) ? $cliente->telefonenumero : ''}}">
							  </div>
							</div>

							<ul class="nav nav-tabs" id="myTab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Peças</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mão de obra</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
							  </li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
						  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
						  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
						</div>



							status


							modelo_aparelho
							marca_aparelho
							serial_aparelho
							imei_aparelho

							Defeito/reclamação

							Observações



							peca_nome
							peca_valor

							servico_nome
							servico_valor

							valor_total


						</form>

		      <button class="btn btn-success">Salvar</button>
		    </form>
  		</div>
	</div>
</div>
@stop
