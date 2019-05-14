@extends('contaapagar::layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Nova categoria</h3>
    </div>
    <div class="card-body">
        <form action="{{route('categoria.salvar')}}" method="post">
            @include('contaapagar::_form')
            
        </form>
    </div>
</div>

@stop