@extends('usuario::layouts.informacoes')
<!-- @section('title', 'Exemplo') -->

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div class='card'>
            <div class='card-header'><h2 class="my-2">Trocar Senha</h1></div>
                <div class="card-body">
                    <form method="POST" action="{{ url('usuario/'.$usuario->id . '/trocarSenha') }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input class="form-control" type="password" name="password">
                        {{$errors->first('password')}}
                    </div>
                    <div class="form-group">
                        <label>Confirmar Senha</label>
                        <input class="form-control" type="password" name="repeat_password">
                    </div>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection