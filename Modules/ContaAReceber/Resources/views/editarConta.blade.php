@extends('contaareceber::layouts.master')


@section('content')
    <div class="card ">
        <div class="card-header ">
            <h5>Editar conta</h5>
            <form action="{{route('conta.salvar', $conta->id)}}" method="POST">
                {{csrf_field()}}
                @include('contaareceber::_formEditarConta')
                
            </form>
        </div>
    </div>
    
    

@stop

