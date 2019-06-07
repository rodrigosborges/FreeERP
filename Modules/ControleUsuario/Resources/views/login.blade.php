@extends('template')
@section('title', 'Login')

@section('content')
<!--<div class="row justify-content-center align-items-center" style="height:100%">
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
</div> -->

<div class="row justify-content-center text-center" id="container">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card ">
            <div class="card-header">
                <h4>Acessar</h4>
            </div>
            <div class="card-body">
                <div class="form col-sm-10  ">
                    {!!Form::open(['route'=>'validar.login', 'method'=>'post']) !!}
               
                    <div class="form-group">
                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
                            <span class="errors alert-danger"> {{ $errors->first('email') }} </span>
                        </div>
                        <div class="form-group">
                        {!! Form::password('password', ['class'=>'form-control','placeholder'=>'Senha']) !!}
                            <span class="errors alert-danger"> {{ $errors->first('password') }} </span>
                        </div>
                        
                        {!!Form::submit('Entrar', ['class'=>'btn btn-primary d-flex align-items-center'])!!}
                    {!!Form::close()!!}


                </div>
            </div>
        </div>
    </div>
</div>


@endsection