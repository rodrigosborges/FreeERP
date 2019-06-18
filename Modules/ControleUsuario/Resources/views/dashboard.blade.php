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
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <p>Card Title</p>
    </div>
    <div class="card-body">
      <h5 class="card-title"> Papeis - {{$usuario->nome}}</h5>
      <div class="table-responsive-md">
      <table class="table text-center" >
      <thead class="thead-dark">
      <tr>
        <th scope="col">Modulo</th>
        <th scope="col">Papel</th>
        <th scope="col" colspan="3"><a class="btn btn-success"><i class="material-icons">note_add</i></a></th>
      </tr>
      </thead>
      
     @foreach($usuario->atuacoes as $atuacao)
     <tr>
     <td>{{$atuacao->modulo->nome}}</td>
      <td>{{$atuacao->papel->nome}}</td>
      <td><a href="#" class="btn btn-info btn-sm"><i class="material-icons">remove_red_eye</i></a></td>
      <td><a href="#" data-id="{{$atuacao->id}}" data-toggle="modal" data-target="#editModal" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a></td>
      <td><a href="#" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></a></td>
     @endforeach
     </table>
     </div>
    </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Atuação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection