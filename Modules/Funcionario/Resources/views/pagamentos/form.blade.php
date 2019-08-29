@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
<form action="{{ $data['url'] }}" id="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-md-12">
                <label for="nome" class="control-label">Nome do funcionario</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <input type="text" name="nome" id="nome" class="form-control required" value="{{$funcionario->nome}}" disabled>
                </div>
                <span class="errors"> </span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="salario" class="control-label">Salário</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">attach_money</i>
                        </span>
                    </div>
                    <!-- REFAZER -->
                    
                    <input type="text" placeholder="REFAZAERRR" name="valor" id="salario" class="form-control required money" value="">
                </div>
                <span class="errors"> </span>
            </div>
            <div class="form-group col-md-6">
                <label for="salario" class="control-label">INSS</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">attach_money</i>
                        </span>
                    </div>
                    <!-- REFAZER -->
                    <input type="text" name="inss" id="inss" class="form-control required money" value="8" disabled>
                </div>
                <span class="errors"> </span>
            </div>
        </div>
        <div class="row">
            
            <div class="form-group col-md-6">
                <label for="salario" class="control-label"> Faltas</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">attach_money</i>
                        </span>
                    </div>
                    <input type="text" name="faltas" id="faltas" class="form-control required money">
                </div>
                <span class="errors"> </span>
            </div>
            <div class="form-group col-md-6">
                <label for="salario" class="control-label"> Horas Extras</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">attach_money</i>
                        </span>
                    </div>
                    <input type="text" name="horas_extras" id="h_extra" class="form-control required money">
                </div>
                <span class="errors"> </span>
            </div>
        </div>
        <div class="row">
            
            <div class="form-group col-md-6">
                <label for="salario" class="control-label">Adicional Noturno</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">attach_money</i>
                        </span>
                    </div>
                    <input type="text" name="adicional_noturno" id="faltas" class="form-control required money">
                </div>
                <span class="errors"> </span>
            </div>
            <div class="input-group mb-5 col-md-6">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Opções</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Escolher...</option>
                    <option value="1">Salário</option>
                    <option value="2">Adiantamento</option>
                    <option value="2">Férias</option>
                </select>
                </div>
        </div>
    </form>
@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-success sendForm" type="button">{{ $data['button'] }}</button>
    </div>
@endsection

@section('script')
    <script src="{{Module::asset('funcionario:js/views/cargo/form.js')}}"></script>
@endsection