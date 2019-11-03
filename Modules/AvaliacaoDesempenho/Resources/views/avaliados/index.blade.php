@extends('avaliacaodesempenho::avaliados/template')

@section('css')
    <link href="{{Module::asset('avaliacaodesempenho:css/avaliados/index.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="explanation">
    <p>Digite seu email e senha para ter acesso a avaliação.</p>

    <p>Está senha de acesso é válida apenas uma vez, visto que a prova deve ser realizada apenas uma vez.</p>

    <p>Portanto, seriedade e atenção as respostas.</p>

    <p>Sua senha de acesso foi enviada por email.</p>

    <div class="form">

        <div style="display:flex; justify-content: space-between">
            <p>Digite seu E-mail e Senha</p>
            <a href="{{ url('avaliacaodesempenho/avaliacao/recuperar') }}">Reenviar Senha</a>
        </div>

        <form action="{{ url('avaliacaodesempenho/avaliacao/responder') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-row">

                <div class="form-group col-md-6">

                    <label>Email</label>

                    <div class="input-group">

                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">android</i>
                            </span>
                        </div>

                        <input class='form-control' type="text" name='avaliado[email]'>

                    </div>

                    <span class="errors"> {{ $errors->first('avaliado.email') }} </span>

                </div>

                <div class="form-group col-md-6">

                    <label>Senha</label>

                    <div class="input-group">

                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">android</i>
                            </span>
                        </div>

                        <input class='form-control' type="text" name='avaliado[token]'>

                    </div>

                    <span class="errors"> {{ $errors->first('avaliado.token') }} </span>

                </div>

            </div>

            <div class="submit-btn form-row">
                <button class="btn btn-success offset-md-3 col-md-6">Enviar</button>
            </div>

        </form>

    </div>

</div>

@endsection

@section('script')
    <script src="{{Module::asset('avaliacaodesempenho:js/avaliados/index.js')}}"></script>
@endsection