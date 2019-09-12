@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')

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
        </div>

        
    </section>

    <section>
    <form action="{{url('funcionario/ferias')}}" method="POST">
    <h4>Período Gozo</h4>
    {{csrf_field()}}
        <div class="row">
        <input type="text" hidden name="inicio_periodo_aquisitivo" id="inicio_periodo_aquisitivo" value="{{$data['inicio_periodo_aquisitivo']}}">
        <input type="text" hidden name="fim_periodo_aquisitivo" id="fim_periodo_aquisitivo" value="{{$data['fim_periodo_aquisitivo']}}">

            <div class="form-group col-4">
                <label for="data_inicio">Data Início:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control">
            </div>
            
            <div class="form-group col-4">
                <label for="data_fim">Data Fim:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control">
            </div>

            <div class="form-group col-4">
                <label for="dias_ferias">Dias de Férias:</label>
                <input type="text" id="dias_ferias" maxlength="2" name="dias_ferias" class="form-control" placeholder="Ex: 2">
            </div>
        </div>
        <input type="text" name="funcionario_id" style="display:none;" value="{{$data['funcionario']->id}}">

        

        <div class="row">
            <div class="form-group col-3">
                <label for="data_pagamento">Data Pagamento:</label>
                <input type="date" name="data_pagamento" id="data_pagamento" class="form-control">
            </div>
            
            <div class="form-group col-3">
                <label for="data_aviso">Data de Início do Aviso:</label>
                <input type="date" name="data_aviso" id="data_aviso" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-8">
                <label for="situacao_ferias">Situação das Férias:</label>
                <select name="situacao_ferias" class="form-control" id="situacao_ferias">
                    <option value=""selected>Selecionar</option>
                    <option value="marcadas">Marcadas</option>
                    <option value="naoMarcadas">Não Marcadas</option>
                </select>
            </div>

        </div>

        <div class="row">
            <div class="form-check col-12">
                <label for="pagamento_parcela13">Pagamento 1ª Parcela 13º:&nbsp</label>
                <input type="checkbox" name="pagamento_parcela13" id="pagamento_parcela13" class="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-12">
                <label for="observacao">Observação:</label>
                <textarea rows="5" name="observacao" id="observacao" class="form-control"></textarea>
            </div>
        <div>

        <button type="submit"  class="btn btn-success ">Enviar</button>
        
        
    </form>
    </section>

@endsection



@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{Module::asset('funcionario:js/helpers.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/form.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/validations.js')}}"></script>
    
@endsection