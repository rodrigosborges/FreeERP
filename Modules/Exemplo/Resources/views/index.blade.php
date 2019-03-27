@extends('template')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('exemplo.name') !!}
    </p>
@stop
