@extends('assistencia::layouts.master')
@section('css')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
<div class="card text-center">

	<div class="card-body">

		<div class="row">
		  <div class="col-md-12 text-left">
				<a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
		    <a href="{{route('consertos.index')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
		  </div>
		</div>
		<div class="row justify-content-center">
			<h4>Editando ordem de serviço</h4>
		</div>
		<div class="row justify-content-center">
		    <form class="col-md-8" action="{{route('consertos.atualizar', $id)}}" method="post" enctype="multipart/form-data">
		      {{ csrf_field() }}
		      @include('assistencia::paginas.consertos._formEdit')
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

		$(document).ready(function(){
			$(document).click(function(){
				var valor = 0;
				$('#valor_peca > option:selected').each(function(ondex, element){
					valor = valor + Number.parseFloat($(element).attr('data-valor'));
				});
				$('#valor_servico > option:selected').each(function(ondex, element){
					valor = valor + Number.parseFloat($(element).attr('data-valor'));
				});
				$('#valorTotal').val(valor);
			});
		})

	</script>

	<script>
		

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
