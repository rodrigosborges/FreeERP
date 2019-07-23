@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')
<div class="card text-center">
	<div class="card-header">
		<h3>Editar técnico</h3>
	</div>	
	<div class="card-body">
		<div class="row ">
		  <div class="col-md-11 text-left">
				<a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
		    <a href="{{route('tecnico.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
		  </div>
		</div>
		<div class="row justify-content-center">
		    <form class="col-md-8" action="{{route('tecnico.atualizar',$tecnico->id)}}" method="post" enctype="multipart/form-data">
		      {{ csrf_field() }}
		      <input type="hidden" name="_method" value="put">
		      @include('assistencia::paginas.tecnicos._form')
		      <button class="btn btn-success">Atualizar</button>
		    </form>
	  	</div>
	</div>
</div>

@stop
@section('js')
	<script>
		$(document).ready(function(){

			$('.cpf-mask').mask("000.000.000-00")

		})
	</script>
@stop
