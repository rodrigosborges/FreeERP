<div class="container text-center">
	<div class="card-body">
		<div class="row ">
		  <div class="col-md-11 text-left">
		      <a href="{{route('cliente.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
		  </div>
		</div>
		<div class="row justify-content-center">
		    <form class="col-md-8" action="{{route('concertos.salvar')}}" method="post" enctype="multipart/form-data">
		      {{ csrf_field() }}
		      <div>
		      	 @include('assistencia::paginas.concertos._form')
		      </div>
		      <button class="btn btn-success">Salvar</button>
		    </form>
  		</div>
	</div>
</div>