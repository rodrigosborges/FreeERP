@extends('template')
@section('title', 'Cadastrar')

@section('content')
<div class="row justify-content-center">
    <div class="col col-sm-10 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cadastrar Usuário</h5>
                <h6 class="card-subtitle mb-2 text-muted">Perfil do usuário</h6>
                {!!Form::open(['route'=>'validar.cadastro', 'method'=>'post']) !!}
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <label for="exampleFormControlFile1">
                                <i class="material-icons text-muted" style="font-size: 100px; cursor:pointer">add_a_photo</i>
                            </label>
                            <input type="file" class="form-control-file" name="foto" id="exampleFormControlFile1" style="display: none" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10">
                        <div class="form-group">
                                <input type="text" class="form-control" name="name" id="nome"
                                    placeholder="Nome">
                                    <span class="errors alert-danger"> {{ $errors->first('name') }} </span>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                                    placeholder="Email">
                                    <span class="errors alert-danger"> {{ $errors->first('email') }} </span>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                                <span class="errors alert-danger"> {{ $errors->first('password') }} </span>
                            </div>
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <i class="material-icons mr-2">save</i> Salvar dados de perfil
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="card-footer d-flex justify-content-around align-items-center pt-4">
                <p class="text-primary d-flex align-items-center">
                    <i class="material-icons mr-2">edit</i> Perfil do usuário
                </p>
                <p class="text-muted d-flex align-items-center">
                    <i class="material-icons mr-2">timer</i> Módulos e permissões
                </p>
            </div>
        </div>
    </div>
</div>
@endsection