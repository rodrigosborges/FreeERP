@extends('template')

@section('content')
<div class="row justify-content-center text-center" style="width:100%">
<div class="col-md-8">
<div class="card ">
  <div class="row card-body justify-content-between">
  <h1>{{$data['title']}}</h1>
  <h4> Bem Vindo!! {{$_SESSION['nome']}}</h4>
  </div>
</div>
</div>


      

</div>
@endsection