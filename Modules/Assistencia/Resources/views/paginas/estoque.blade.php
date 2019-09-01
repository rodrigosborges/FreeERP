@extends('assistencia::layouts.master')


@section('title', 'Assistencia')

@section('content')
<div class="card">
    <div class="card-body">

        <div class="row ">
            <div class="col-md-11 text-left">
                <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="{{route('pecas.localizar')}}">
                <h3>Peças</h3?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('servicos.localizar')}}">
                <h3>Mão de Obra</h3?>
            </a>
        </li>
    </ul>

</div>


@stop