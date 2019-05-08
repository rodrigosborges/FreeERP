@extends('template')

@section('content')
<div class="row justify-content-center">
<h1>{{$data['title']}}</h1>
    <p> id: {{$data['usuario']->id}}</p>
    <p> Nome: {{$_SESSION['email']}}</p>
    <p> email:</p>
    <p><a href="{{ route('user.logoff') }}"> logoff</a></p>

</div>
@endsection