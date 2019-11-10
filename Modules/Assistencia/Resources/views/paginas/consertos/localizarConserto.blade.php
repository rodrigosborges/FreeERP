@extends('assistencia::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h3>Ordens de serviço</h3>
            <a href="{{url('/assistencia/cliente')}}"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
    </div>
    <div class="card-body">
        
        <div class="form-group row">
            <form class="input-group col-6" action="{{route('consertos.buscar')}}" method="post">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="busca" placeholder="Número da ordem"
                    aria-label="Buscar OS" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-info" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="col-6">
                <div class="text-right">
                    <a href="{{route('consertos.cadastrar')}}"><button type="button" class="btn btn-info">Nova
                            OS</button></a>
                </div>
            </div>
        </div>
        <div class="row-center">
            @include('assistencia::paginas.consertos._table')
        </div>


    </div>
</div>

@stop