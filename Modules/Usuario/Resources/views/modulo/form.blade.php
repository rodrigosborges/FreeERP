@extends('usuario::layouts.informacoes')
<!-- @section('title', 'Exemplo') -->

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div>
            @if(Session::has('sucesso'))
            <p>{{Session::get('sucesso')}}</p>
            @endif

            @if(Session::has('erro'))
            <p>{{Session::get('erro')}}</p>
            @endif
        </div>
        <h2 class="my-4">Cadastrar Módulo</h1>
            <form method="post" action="{{url('modulo')}}">
                @csrf

                <div class="form-group">
                    <input class="form-control" type="text" name="nome" placeholder="Nome do módulo">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="icone" placeholder="Ícone do módulo">
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
    </div>
</div>
@endsection