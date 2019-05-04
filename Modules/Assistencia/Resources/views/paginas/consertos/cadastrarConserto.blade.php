@extends('assistencia::layouts.master')

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
	<script>
		$("[name='nome']").on('keyup',function(){

				$.ajax({
		        type: "GET",
		        url: `${main_url}/assistencia/conserto/nomeClientes`,
		        data: {
							'nome': $(this).val()
						},
		        success: function (data) {
								$("[name='nome']").autocomplete({
									source: data,
									select: function( event, ui ) {
										inserirDados(ui.item.value)
									}
								})
		        },
		    })

		})

		function inserirDados(val){

			$.ajax({
	        type: "GET",
	        url: `${main_url}/assistencia/conserto/dadosCliente`,
	        data: {
						'nome': val
					},
	        success: function (data) {
							$("[name='nome']").val(data.nome)
							$("[name='cpf']").val(data.cpf)
							$("[name='celnumero']").val(data.celnumero)
							$("[name='email']").val(data.email)
	        },
	    })

		}
	</script>

@stop
