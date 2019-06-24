@extends('template')
@section('title', 'Cadastrar')
@section('content')

<div class="row justify-content-center justify-items-center ">
    <div class="col col-sm-10 col-md-8">

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Buscar Usuário</h5>
            </div>

            <div class="card-body">
            {!!Form::open(['route'=>'teste_bt', 'method'=>'post']) !!}

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
                        {!! form::select('modulo',$modulos , null, ['class'=>'form-control']) !!}
                     </div>
                  </div>
               </div>
        <!--
               <div class="row pb-3 align-items-center justify-content-center">
                   <div class="col col-md-10 col-sm-10 d-flex justify-content-between">

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
        -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-sm-10 d-flex justify-content-around">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success d-flex" action="/teste_bt">
                                <i class="material-icons mr-2">search</i> Buscar
                            </button>
                        </div>

                        <div class="form-group">
                            <button type="reset" class="btn btn-light d-flex" id="bt1">
                                <i class="material-icons mr-2">brush</i> Limpar
                            </button>
                        </div>

                    </div>

                </div>
                {!! Form::close() !!}

                <div class="row justify-content-center " style='min-width:150px'>
                    <div class="col-12" >

                        <table class="table table-sm table-dark table-striped table-bordered text-center
                        justify-content-center"  >
                        <thead>
                            <tr>
                                <th scope="col-3">ID</th>
                                <th scope="col-3">Nome</th>
                                <th scope="col-5">E-mail</th>
                                <th scope="col-3">Status</th>                                                                
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lista as $user)
                            <tr>

                                <th scope="row">{{ $user->id }}</th>
                                    <td>{{$user->nome}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if( is_null($user->deleted_at) )
                                            {{ "Ativo" }}
                                        @else
                                            {{ "Inativo" }}
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-around">
                                            
                                        {!!Form::open(['route'=>'usuario.abrir', 'method'=>'post']) !!}
                                                {!! Form::hidden('id', $user->id) !!}
                                                    {!!Form::submit('Editar',['class'=>'btn btn-warning d-flex '])!!}
                                            {!!Form::close()!!}
.
                                            {!!Form::open(['route'=>'usuario.delete', 'method'=>'post']) !!}
                                                {!! Form::hidden('id', $user->id) !!}

                                                    @if( is_null($user->deleted_at) )
                                                        @method('delete')
                                                    @endif

                                          <input type="submit" class="id btn d-flex" style="visibility: hidden"
                                                value="{{( is_null($user->deleted_at) )?'Desativar':'Reativar' }}" > 

                                            {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                 </div>

            </div> {{--  Fecha Card-Body  --}}

        </div> {{--  Fecha o Card  --}}

    </div> {{--  Fecha a Coluna inteira  --}}

</div> {{--  :Fecha a linha  --}}

@endsection
@section('js')
<script>
   $(document).ready(function(){
    //$('.id').css("visibility","hidden");
       
       
       $( ".id" ).each(function(index) {
            
            if( $( this ).val() == "Reativar" ){
                $( this ).addClass("btn-info");
            }else{
                $( this ).addClass("btn-danger");
            }
            var hid = $( this ).css('visibility');
            
            if( hid == "hidden" ){
                $(this).css("visibility","visible");
            }
        });

       
   });
</script>
@endsection