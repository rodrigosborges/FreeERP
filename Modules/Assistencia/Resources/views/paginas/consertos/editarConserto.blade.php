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
			<h4>Editando ordem de serviço</h4>
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
