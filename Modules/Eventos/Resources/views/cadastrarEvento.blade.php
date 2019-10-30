@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    <style>
        button{
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" align="center">
        <h1>Pessoas</h1>
        <h2>Oops! Para visualizar, cadastrar, editar ou remover pessoas de um evento, primeiro você deve
        cadastrar o evento!</h2>
        <button class="btn btn-primary" onclick="window.location='{{ url("/eventos/exibir") }}'">Cadastrar evento</button>
    </div>
@endsection