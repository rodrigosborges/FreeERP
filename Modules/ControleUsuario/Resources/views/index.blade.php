@extends('controleusuario::layouts.master')

@section('content')
    <h1>{{$data['title']}}</h1>
    <p> id: {{$data['usuario']->id}}</p>
    <p> Nome: {{$_SESSION['email']}}</p>
    <p> email: </p>
    <p>
        This view is loaded from module: {!! config('controleusuario.name') !!}
    </p>
@stop
