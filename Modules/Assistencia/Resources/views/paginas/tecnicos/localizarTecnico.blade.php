@extends('assistencia::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h3>Técnicos</h3>
            <a href="{{url('/assistencia/consertos')}}"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
    </div>
    <div class="card-body">
        
        <div class="row">
            <form class="input-group mb-3 col-md-6" action="{{route('tecnico.buscar')}}" method="post">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="busca" placeholder="Nome do técnico"
                    aria-label="Buscar técnico" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-info" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="col-md-6">
                <div class="text-right">
                    <a href="{{route('tecnico.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar
                            técnico</button></a>
                </div>
            </div>
        </div>
        @include('assistencia::paginas.tecnicos._table')
    </div>
</div>

@stop