@extends('template')
@section('title','Categorias')
@section('content')
<h2 class="text-center">Editar</h2>
<div class='row justify-content-center'>
<div class="col-sm-6">
<form action="">
<div class="form-group">
<label for="nome">Nome:</label>
<input type="text" class="form-control" value = "{{(isset($categoria))?$categoria->nome:''}}">
</div>
<div class="form-group">
<button class="btn btn-lg btn-success">Salvar
</button>
</div>
</form>
</div>

</div>
@endsection