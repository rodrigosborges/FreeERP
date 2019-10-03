@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
<div class="card col-md-12 text-left" >
  <div class="card-body">
    <form action="">
    <div class="form-row">
    <div class="form-group col-md-3">
            
            <input type="text" class="form-control" disabled value="{{$data['funcionario']->nome}}">
        </div>
        <div class="form-group col-md-3">
            <label for="">Cid Atestado</label>
            <input type="text" class="form-control">
        </div>

        <div class="form-group col-md-3">
            <label for="">Data de Inicio</label>
            <input type="date" class="form-control">
        </div>     

        <div class="form-group col-md-3">
            <label for="">Data de Fim</label>
            <input type="date" class="form-control">
        </div>

        <div class="form-group col-md-3">
            <label for="">Quantidade de Dias</label>
            <input type="text" class="form-control">
        </div>

    </div>
    </form>
  </div>
</div>
@endsection