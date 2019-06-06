@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')
<div class="card ">
	<div class="card-body">

		<div class="row">
		  <div class="col-12">
				<a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
		    <a href="{{route('cliente.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
		  </div>
		</div>

		<div class="row justify-content-center">
	    <form class="col-12" action="{{route('cliente.atualizar',$cliente->id)}}" method="post" enctype="multipart/form-data">
	      {{ csrf_field() }}
	      <input type="hidden" name="_method" value="put">
	      @include('assistencia::paginas.clientes._form')
				<div class="text-center">
					<button class="btn btn-success">Atualizar</button>
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
@stop