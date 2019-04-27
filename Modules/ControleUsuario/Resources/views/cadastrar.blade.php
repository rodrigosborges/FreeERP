@extends('template')
@section('title', 'Cadastrar')

@section('content')
<div class="row justify-content-center">
    <div class="col col-sm-10 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cadastrar Usuário</h5>
                <h6 class="card-subtitle mb-2 text-muted">Perfil do usuário</h6>
                <form>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <label for="exampleFormControlFile1">
                                <i class="material-icons text-muted" style="font-size: 100px; cursor:pointer">add_a_photo</i>
                            </label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" style="display: none">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                            </div>
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <i class="material-icons mr-2">save</i> Salvar dados de perfil
                            </button>
                        </div>
                    </div>
                </form>
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