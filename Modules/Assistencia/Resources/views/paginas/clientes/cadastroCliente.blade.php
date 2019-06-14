@extends('assistencia::layouts.master')


@section('css')
	<style>
		.errors {
			color: red;
			font-size: 12px;
			text-align: left;

		}

	</style>

@stop

@section('content')

<div class="card">
	<div class="card-body">

		<div class="row ">
		  <div class="col-12">
				<a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
		    <a href="{{route('cliente.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
		  </div>
		</div>

		<div class="row justify-content-center">
		    <form class="col-12" action="{{route('cliente.salvar')}}" method="post" enctype="multipart/form-data">
		      {{ csrf_field() }}
		      <div>
		      	 @include('assistencia::paginas.clientes._form')
		      </div>
					<div class="text-center">
						<button class="btn btn-success">Cadastrar</button>
					</div>
		    </form>
  		</div>
	</div>
</div>

@stop

@section('js')
	<script>
		$(document).ready(function(){

			$('.cpf-mask').mask("000.000.000-00")
			
			var phone = document.querySelector(".telefone");
			if(phone.length > 10) {
				$('.telefone').mask("(00) 0 0000-0000")
			} else {
				$('.telefone').mask("(00) 0000-0000")
			}	

		})
	</script>
	<script type="text/javascript">
		var SPMaskBehavior = function (val) {
		  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
		},
		spOptions = {
		  onKeyPress: function(val, e, field, options) {
		      field.mask(SPMaskBehavior.apply({}, arguments), options);
		    }
		};

		$('.cel_sp').mask(SPMaskBehavior, spOptions);
	</script>
@stop
