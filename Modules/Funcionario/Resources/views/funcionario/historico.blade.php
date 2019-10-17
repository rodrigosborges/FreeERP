@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')

@section('footer')
    <div class="d-flex justify-content-end">
    <a class="btn btn-success" href="{{url('funcionario/funcionario')}}">Voltar</a>
    </div>

@endsection

@endsection