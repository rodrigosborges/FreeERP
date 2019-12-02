@extends('avaliacaodesempenho::avaliados/template')

@section('css')
    <link href="{{Module::asset('avaliacaodesempenho:css/avaliados/recuperar.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class='recuperar-senha-box'>

    <div>
        <p>Digite o email cadastrado no sistema</p>
        <p>Enviaremos novamente seu token.</p>
    </div>

    <form action="{{ url('avaliacaodesempenho/avaliacao/reenviar') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-row">

            <div class="form-group col-md-12">

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

        </div>

        <div class="submit-btn form-row">
            <button class="btn btn-success offset-md-3 col-md-6">Enviar</button>
        </div>

    </form>

</div>
@endsection