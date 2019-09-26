@extends('usuario::layouts.login')

@section('content')
<div class="d-flex justify-content-center" style="margin-top:8%">
    <div class="card" style="width:40%">
        <div class="card-body">
            <h1 style="text-align:center">FreeErp</h1>
            <br>
            <br>

            <!-- <p>
                This view is loaded from module: {!! config('usuario.name') !!}
            </p> -->

            <form id="forgotForm" method="POST" action="{{url('/esqueciSenha')}}">
                    {{ csrf_field() }}

                    @if(session('error'))
                        <div>
                            {{session('error')}}
                        </div>
                    @endif
                    @if(session('success'))
                        <div>
                            {{session('success')}}
                        </div>
                    @endif

                    <label for="email">Email para recuperar a senha</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <br>
                    <button type="submit" class="btn btn-success">Recuperar</button>
                    <br>
                    <br>
                    <br>
                    <br>
            </form>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{Module::asset('usuario:js/login/validacao-form.js')}}"></script>
@endsection
@endsection