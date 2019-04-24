@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')

<div class="container text-center">
	<div class="card-body">
		<div class="row ">
		  <div class="col-md-11 text-left">
		       <a href="{{route('pecas.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
		  </div>
		</div>
		<div class="row justify-content-center">
		    <form class="col-md-4" action="{{route('pecas.atualizar',$peca->id)}}" method="post" enctype="multipart/form-data">
		      {{ csrf_field() }}
		      <input type="hidden" name="_method" value="put">
		      @include('assistencia::paginas.estoque._form_peca')
		      <button class="btn btn-success">Atualizar</button>
		    </form>
  		</div>
	</div>
</div>

@stop
