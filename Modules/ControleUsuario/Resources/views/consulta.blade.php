@extends('template')
@section('title', 'Cadastrar')
@section('content')

<div class="row justify-content-center">
   <div class="col col-sm-10 col-md-8">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title">Buscar Usuário</h5>
            <!-- <h6 class="card-subtitle mb-2 text-muted">Perfil do usuário</h6> -->
         </div>
         <div class="card-body pb-0">
         {!!Form::open(['route'=>'usuario.listar', 'method'=>'post']) !!}
               <div class="row align-items-end">
                  <div class="col-8">
                     <div class="form-group"> 
                        <!-- <input type="text" class="form-control" placeholder="Nome Usuário"> -->
                        {!! form::text('nome',null,['placeholder'=>"Insira o nome aqui",'class'=>"form-control"]) !!}
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="data">Data de criação</label>
                       {!! Form::date('data', null, ['class'=>"form-control"]) !!}
                        <!-- <input class="form-control" type="date" id="data">  -->
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group">
                        <label for="status">Status</label>
                        {!! form::select('status',$status, null, ['class'=>'form-control']) !!}
                        <!-- <select class="form-control" id="status">
                           <option>Ativos e inativos</option>
                           <option>Somente ativos</option>
                           <option>Somente inativos</option>
                        </select> -->
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="modulo">Módulo</label>
                        {!! form::select('modulo',$modulos, null, ['class'=>'form-control']) !!}
                        <!-- <select class="form-control" id="modulo">
                           <option>Todos os módulos</option>
                           <option>Recursos Humanos</option>
                           <option>Vendas</option>
                           <option>Estoque</option>
                        </select> -->
                     </div>
                  </div>
               </div>
               <div class="row pb-2">
                  <div class="col">

                     <div class="form-check form-check-inline">
                     
                     {!! Form::checkbox("adm", null,['class'=>'form-check-label'], false) !!}
                     Administradores 
                     
                        <!-- <input class="form-check-input" type="checkbox" value="" id="administradores"> -->
                        <!-- <label class="form-check-label" for="administradores"> -->
                           <!-- Administradores
                        </label> -->
                     </div>
                     <div class="form-check form-check-inline">
                     {!! Form::checkbox("gerentes", null) !!}
                        <!-- <input class="form-check-input" type="checkbox" value="" id="gerentes">
                        <label class="form-check-label" for="gerentes"> -->
                           Gerentes
                        <!-- </label> -->
                     </div>
                     <div class="form-check form-check-inline">
                     {!! Form::checkbox("operadores", null) !!}
                        <!-- <input class="form-check-input" type="checkbox" value="" id="operadores">
                        <label class="form-check-label" for="operadores"> -->
                           OperadoresA
                        <!-- </label> -->
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col d-flex justify-content-end">
                     <div class="form-group  mr-2">
                        <button type="submit" class="btn btn-success d-flex">
                           <i class="material-icons mr-2">search</i> Buscar
                        </button>
                     </div>
                     <div class="form-group">
                        <button type="reset" class="btn btn-light d-flex">
                           <i class="material-icons mr-2">brush</i> Limpar campos
                        </button>
                     </div>
                  </div>
               </div>
               {!! Form::close() !!}

         </div>
         <ul class="list-group list-group-flush">
            <li class="list-group-item bg-secondary text-light d-flex justify-content-center">
               <i class="material-icons mr-2">list</i> Resultado da busca
            </li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Vestibulum at eros</li>
         </ul>

      </div>
   </div>
</div>

@endsection
