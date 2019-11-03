@extends('assistencia::layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row ">
            <div class="col-12">
                <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            </div>
        </div>
        <div class="form-group row">
            <form class="input-group col-6" action="{{route('consertos.buscar')}}" method="post">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="busca" placeholder="Número da ordem"
                    aria-label="Buscar OS" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit" value="Localizar" id="button-addon2"></input>
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