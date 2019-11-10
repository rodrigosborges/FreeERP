@extends('assistencia::layouts.master')
@section('css')
<style>
.error {
    color:red;
    width: 100%;
}
</style>
@endsection
@section('content')
<div class="card ">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h4>Editar cliente</h4>
            <a href="{{route('cliente.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
        </div>
    </div>
    <div class="card-body">


        <div class="row justify-content-center">
            <form class="col-12" action="{{route('cliente.atualizar',$cliente->id)}}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('assistencia::paginas.clientes._form')
                <div class="text-center">
                    <button class="btn btn-success">Atualizar</button>
                </div>

            </form>
        </div>

    </div>
</div>

@stop

@section('js')
<script src="{{Module::asset('assistencia:js/bibliotecas/views/cliente/cliente.js')}}"></script>
<script>

</script>
@stop