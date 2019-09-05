@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Estoque')
@section('body')

<div class="card d-flex justify-content-center ">
    <form action="{{url($data['url'])}}" method="POST" class="">
        @csrf
        @if(isset($data['estoque']))
        @method('PUT')
        @endif
        <!--ENTÃO, eu tenho que ver o que que vai rolar aqui nesse create...-->
    </form>
</div>
@endsection