@extends('avaliacaodesempenho::avaliados/template')

@section('css')
    <link href="{{Module::asset('avaliacaodesempenho:css/avaliados/index.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="explanation">
    <p>Digite seu email e senha para ter acesso a avaliação.</p>

    <p>Está senha de acesso é válida apenas uma vez, visto que a prova deve ser realizada apenas uma vez.</p>

    <p>Portanto, seriedade e atenção as respostas.</p>

    <p>Sua senha foi enviada por email.</p>

    <div class="form">

        <p>Digite seu E-mail e Senha</p>

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