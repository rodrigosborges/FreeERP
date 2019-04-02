@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
    <form action="{{ $data['url'] }}" id="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <div class="row">
            <div class="form-group col-md-12">
                <label for="nome" class="control-label">Nome</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <input type="text" placeholder="Ex: Vendedor" name="nome" id="nome" class="form-control required" value="{{ $data['model'] ? $data['model']->nome : old('nome', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('nome') }} </span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="horas_semanais" class="control-label">Horas semanais</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">access_time</i>
                        </span>
                    </div>
                    <input type="text" placeholder="Ex: 40" name="horas_semanais" id="horas_semanais" class="form-control required integer" value="{{ $data['model'] ? $data['model']->horas_semanais : old('horas_semanais', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('horas_semanais') }} </span>
            </div>
            <div class="form-group col-md-6">
                <label for="salario" class="control-label">Salário</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">attach_money</i>
                        </span>
                    </div>
                    <input type="text" placeholder="Ex: 998,00" name="salario" id="salario" class="form-control required money" value="{{ $data['model'] ? $data['model']->salario : old('salario', '') }}">
                </div>
                <span class="errors"> {{ $errors->first('salario') }} </span>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-success sendForm" type="button">{{$data['button']}}</button>
    </div>
@endsection

@section('script')
    <script src="{{Module::asset('funcionario:js/views/cargo/form.js')}}"></script>
@endsection