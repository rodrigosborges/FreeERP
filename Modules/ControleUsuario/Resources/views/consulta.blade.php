@extends('template')
@section('title', 'Cadastrar')
@section('content')

<div class="row justify-content-center">

   <div class="col col-sm-10 col-md-8">

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Buscar Usuário</h5>
            </div>

        <div class="card-body">

         {!!Form::open(['route'=>'usuario.listar', 'method'=>'post']) !!}
               <div class="row align-items-end">
                  <div class="col-8">
                     <div class="form-group">
                        {!! form::text('nome',null,['placeholder'=>"Insira o nome aqui",'class'=>"form-control"]) !!}
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="data">Data de criação</label>
                       {!! Form::date('data', null, ['class'=>"form-control"]) !!}
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                     <div class="form-group">
                        <label for="status">Status</label>
                        {!! form::select('status',$status, null, ['class'=>'form-control']) !!}
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="modulo">Módulo</label>
                        {!! form::select('modulo',$modulos, null, ['class'=>'form-control']) !!}
                     </div>
                  </div>
               </div>

               <div class="row pb-3 align-items-center">
                   <div class="col d-flex justify-content-between">
                        <div class="form-check form-check-inline">
                            {!! Form::checkbox("adm", null,['class'=>'form-check-label'], false) !!}
                                Administradores
                        </div>
                        <div class="form-check form-check-inline">
                            {!! Form::checkbox("gerentes", null,['class'=>'form-check-label']) !!}
                                Gerentes
                        </div>
                        <div class="form-check form-check-inline">
                            {!! Form::checkbox("operadores", null,['class'=>'form-check-label']) !!}
                                Operadores
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col d-flex justify-content-around ">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success d-flex">
                                <i class="material-icons mr-2">search</i> Buscar
                            </button>
                        </div>

                        <div class="form-group">
                            <button type="reset" class="btn btn-light d-flex">
                                <i class="material-icons mr-2">brush</i> Limpar
                            </button>
                        </div>

                    </div>

                </div>
                {!! Form::close() !!}
        </div>
    </div>
        <div class="row">
            <div class="col">
                <table class="table table-dark table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Primeiro</th>
                            <th scope="col">Último</th>
                            <th scope="col">Nickname</th>
                        </tr>
                    </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Mark</td>
                                  <td>Otto</td>
                                  <td>@mdo</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Jacob</td>
                                  <td>Thornton</td>
                                  <td>@fat</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Larry</td>
                                  <td>the Bird</td>
                                  <td>@twitter</td>
                                </tr>
                              </tbody>
                            </table>

                </div>


            </div>
        </div>

        </div>
</div>

@endsection
