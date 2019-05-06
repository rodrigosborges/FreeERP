@extends('template')
@section('title', 'Login')

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        {!!Form::open(['route'=>'validar.login', 'method'=>'post']) !!}
        <p>Acesso ao sistema</p>
        <div class="form-group">
            <label for="email">E-mail</label>
            {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Usuario']) !!}
            <span class="errors"> {{ $errors->first('email') }} </span>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            {!! Form::password('password', ['class'=>'form-control','placeholder'=>'Senha']) !!}
            <span class="errors"> {{ $errors->first('password') }} </span>
        </div>
        <div class="form-group">
            <label>
                {!!Form::submit('Entrar', ['class'=>'btn btn-primary'])!!}
            </label>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection