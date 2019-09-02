@extends('usuario::layouts.informacoes')
<!-- @section('title', 'Exemplo') -->

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Cadastrar Módulo</h5>
            </div>
            <div>
                <form class="card-body d-flex flex-column" method="post" action="{{url('modulo')}}">
                    @csrf

                    <div class="form-group">
                        <input class="form-control" type="text" name="nome" placeholder="Nome do módulo">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="icone" placeholder="Ícone do módulo">
                    </div>
                    <buttom type="submit" class="btn btn-success d-flex mb-3 align-self-start">
                        <i class="material-icons mr-2">save</i>Salvar
                    </buttom>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection