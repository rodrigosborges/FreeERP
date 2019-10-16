@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
    @endif
    <section>
        <div class="row">
            <div class="form-group col-6">
                <label for="f.nome">Nome:</label>
                <input type="text" class="form-control" id="f.nome" value="{{$data['funcionario']->nome}}" disabled>
            </div>

            <div class="form-group col-6">
                <label for="f.nome">Cargo:</label>
                <input type="text" class="form-control" id="f.cargo" value="{{$data['cargo']->nome}}" disabled>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-6">
                <span>Inicio Período de Aquisição:</span>
                <span>{{$data['inicio_periodo_aquisitivo']}}</span>    
            </div>

            <div class="form-group col-6">
                <span>Fim Período de Aquisição:</span>
                <span>{{$data['fim_periodo_aquisitivo']}}</span>
            </div>

            <div class="form-group col-6">
                <span>Limite Período de gozo:</span>
                <span>{{$data['limite_periodo_aquisitivo']}}</span>
            </div>
        </div>
        
    </section>

    <section>
    <form action="{{url('funcionario/ferias')}}" method="POST" id="form">
    <h4 style="text-align: center;">Período Gozo</h4>
    {{csrf_field()}}
        <div class="row">

        <input type="text" hidden name="inicio_periodo_aquisitivo" id="inicio_periodo_aquisitivo" value="{{$data['inicio_periodo_aquisitivo']}}">
        <input type="text" hidden name="fim_periodo_aquisitivo" id="fim_periodo_aquisitivo" value="{{$data['fim_periodo_aquisitivo']}}">
        <input type="text" hidden name="limite_periodo_aquisitivo" id="limite_periodo_aquisitivo" value="{{$data['limite_periodo_aquisitivo']}}">
        <input type="text" name="funcionario_id" style="display:none;" value="{{$data['funcionario']->id}}">

            <div class="form-group col-4">
                <label for="data_inicio">Data Início:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{old('data_inicio')}}">
            </div>
            
            <div class="form-group col-4">
                <label for="data_fim">Data Fim:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{old('data_fim')}}">
            </div>

            <div class="form-group col-4">
                <label for="dias_ferias">Dias de Férias:</label>
                <input type="text" id="dias_ferias"  name="dias_ferias" class="form-control" placeholder="Ex: 2" value="{{old('dias_ferias')}}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-3">
                <label for="data_pagamento">Data Pagamento:</label>
                <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" value="{{old('data_pagamento')}}">
            </div>
            
            <div class="form-group col-3">
                <label for="data_aviso">Data de Início do Aviso:</label>
                <input type="date" name="data_aviso" id="data_aviso" class="form-control" value="{{old('data_aviso')}}">
            </div>

            <div class="form-group col-3">
                <label for="saldo_total">Saldo total</label>
                <input type="text"  id="saldo_periodo" class="form-control" value="{{$data['saldo_periodo']}}" disabled>
                <input type="text" hidden name="saldo_periodo" value="{{$data['saldo_periodo']}}" >
            </div>
        </div>

        
        <div class="row">
            <div class="form-check col-12">
                <label for="pagamento_parcela13">Pagamento 1ª Parcela 13º:&nbsp</label>
                <input type="checkbox" name="pagamento_parcela13" id="pagamento_parcela13" value="{{old('pagamento_parcela13')}}">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-12">
                <label for="observacao">Observação:</label>
                <textarea rows="5" name="observacao" id="observacao" class="form-control">{{old('observacao')}}</textarea>
            </div>
        <div>      
   
    </section>
    @section('footer')
    <div class="text-right">
    <button type="submit"  class="btn btn-success ">Salvar</button>
    </div>
    </form>
    @endsection

@endsection
            
@section('script')
    <script src="{{Module::asset('funcionario:js/views/ferias/form.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{Module::asset('funcionario:js/helpers.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/form.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/validations.js')}}"></script>
    

    <script>
        $(document).ready(function(){
            $('#data_fim').on("focusout", function(){
                var data_inicio = new Date(document.getElementById('data_inicio').value);
                var data_fim = new Date(document.getElementById('data_fim').value);
                var diferenca = data_fim - data_inicio;
                var diferenca_dias = diferenca/(1000 * 60 * 60 * 24);
                
                document.getElementById('dias_ferias').value = diferenca_dias+1;
            })
        });
    </script>
@endsection

