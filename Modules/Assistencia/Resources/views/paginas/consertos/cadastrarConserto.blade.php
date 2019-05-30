@extends('assistencia::layouts.master')
@section('css')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
	<?php 
		$valorTotal = 0;
	?> 

	<div class="card text-center">

		<div class="card-body">

			<div class="row">
			<div class="col-md-12 text-left">
					<a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
				<a href="{{route('consertos.index')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
			</div>
			</div>
			<div class="row justify-content-center">
				<h4>Nova ordem de serviço</h4>
			</div>
			<div class="row justify-content-center">
				<form class="col-md-8" action="{{route('consertos.salvar')}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				@include('assistencia::paginas.consertos._form')
				<button class="btn btn-success">Salvar</button>
				</form>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
	
	<script>
		$(document).ready(function() {
			$('.multi-select').select2();
			
		});
		
	</script>
	<script>
		$('#valor_peca').change(function(){
			var idPecas = $(this).val();
			foreach (idPecas as idPeca){
				$valorTotal = $valorTotal + $pecas->find(idPeca)->valor_venda;
			}
			
			console.log(arr)
		})
		$('#valor_servico').change(function(){
			var idServicos = $(this).val();
			foreach (idServicos as idServico) {
				$valorTotal = $valorTotal + $servicos->find(idServico)->valor;
			}
			console.log(arr)
		})
	</script>
	<script>
		$("[name='selecionarMao']").on('keyup',function(){

				$.ajax({
						type: "GET",
						url: `${main_url}/assistencia/conserto/nomeServicos`,
						data: {
							'selecionarMao': $(this).val()
						},
						success: function (data) {
								$("[name='selecionarMao']").autocomplete({
									source: data,
									select: function( event, ui ) {
										inserirServico(ui.item.value)
									}
								})
						},
				})

		})
		function inserirServico(val){

			$.ajax({
	        type: "GET",
	        url: `${main_url}/assistencia/conserto/dadosServicos`,
	        data: {
						'nome': val
					},
	        success: function (data) {
	        		$("[name='idMaoObra']").val(data.id)
							$("[name='nome_servico']").val(data.nome)
							$("[name='valor_servico']").val(data.valor)
	        },
	    })

		}

		$("[name='selecionarPeca']").on('keyup',function(){

				$.ajax({
						type: "GET",
						url: `${main_url}/assistencia/conserto/nomePecas`,
						data: {
							'selecionarPeca': $(this).val()
						},
						success: function (data) {
								$("[name='selecionarPeca']").autocomplete({
									source: data,
									select: function( event, ui ) {
										inserirPeca(ui.item.value)
									}
								})
						},
				})

		})
		function inserirPeca(val){

			$.ajax({
	        type: "GET",
	        url: `${main_url}/assistencia/conserto/dadosPecas`,
	        data: {
						'nome': val
					},
	        success: function (data) {
	        				$("[name='idPeca']").val(data.id)
							$("[name='nome_peca']").val(data.nome)
							$("[name='valor_peca']").val(data.valor_venda)
	        },
	    })

		}


		$("[name='selecionarCliente']").on('keyup',function(){

				$.ajax({
		        type: "GET",
		        url: `${main_url}/assistencia/conserto/nomeClientes`,
		        data: {
							'selecionarCliente': $(this).val()
						},
		        success: function (data) {
								$("[name='selecionarCliente']").autocomplete({
									source: data,
									select: function( event, ui ) {
										inserirDadosCliente(ui.item.value)
									}
								})
		        },
		    })

		})

		function inserirDadosCliente(val){

			$.ajax({
	        type: "GET",
	        url: `${main_url}/assistencia/conserto/dadosCliente`,
	        data: {
						'nome': val
					},
	        success: function (data) {
	        				$("[name='idCliente']").val(data.id)
							$("[name='nome']").val(data.nome)
							$("[name='cpf']").val(data.cpf)
							$("[name='celnumero']").val(data.celnumero)
							$("[name='email']").val(data.email)
	        },
	    })

		}

		$("[name='selecionarTecnico']").on('keyup',function(){

				$.ajax({
		        type: "GET",
		        url: `${main_url}/assistencia/conserto/nomeTecnicos`,
		        data: {
							'selecionarTecnico': $(this).val()
						},
		        success: function (data) {
								$("[name='selecionarTecnico']").autocomplete({
									source: data,
									select: function( event, ui ) {
										inserirDadosTecnico(ui.item.value)
									}
								})
		        },
		    })

		})

		function inserirDadosTecnico(val){

			$.ajax({
	        type: "GET",
	        url: `${main_url}/assistencia/conserto/dadosTecnico`,
	        data: {
						'nome': val
					},
	        success: function (data) {
	        				$("[name='idTecnico']").val(data.id)
							$("[name='nome-tecnico']").val(data.nome)
							$("[name='cpf-tecnico']").val(data.cpf)
	        },
	    })

		}

	</script>

@stop
