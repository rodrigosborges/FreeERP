@extends('template')
@section('title', 'Cadastrar')
@section('content')
   
<div class="row justify-content-center">
    <div class="col col-sm-10 col-md-8 col-lg-6">	
       <div class="form-group">
          <input type="email" class="form-control" placeholder="Buscar">
       </div>
    </div>
       <button type="submit" class="btn btn-primary d-flex align-items-center">
          <i class="material-icons mr-2">search</i>Buscar
       </button>

       <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPZAO</button>
          <div class="dropdown-menu">
             <a class="dropdown-item" href="#">opcao0</a>
             <a class="dropdown-item" href="#">opcao1</a>
             <a class="dropdown-item" href="#">opcao 2</a>
    </div>
    
</div>


@endsection