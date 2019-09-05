@extends('funcionario::template')

@section('body')

<form action="{{url('funcionario/ferias')}}" method="PUT">
    <h4>Agora Vai</h4>
    {{csrf_field()}}
        <div class="row">

            <div class="form-group col-4">
                <label for="data_inicio">Data Início:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control"  value="{{ (isset($ferias) ?  $ferias->data_inicio : '')}}">
            </div>
            
            <div class="form-group col-4">
                <label for="data_fim">Data Fim:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control"value="{{ (isset($ferias) ?  $ferias->data_fim : '')}}">
            </div>

            <div class="form-group col-4">
                <label for="dias_ferias">Dias de Férias:</label>
                <input type="text" id="dias_ferias" maxlength="2" name="dias_ferias" class="form-control" placeholder="Ex: 2" value="{{ (isset($ferias) ?  $ferias->dias_ferias : '')}}">
            </div>
         </div>

       <!-- <input type="text" name="funcionario_id" style="display:none;" value="{{ (isset($ferias) ?  $ferias->funcionario_id : '')}}"> -->

        

        <div class="row">
            <div class="form-group col-3">
                <label for="data_pagamento">Data Pagamento:</label>
                <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" value="{{ (isset($ferias) ?  $ferias->data_pagamento : '')}}">
            </div>
            
            <div class="form-group col-3">
                <label for="data_aviso">Data de Início do Aviso:</label>
                <input type="date" name="data_aviso" id="data_aviso" class="form-control" value="{{ (isset($ferias) ?  $ferias->data_aviso : '')}}">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-8">
                <label for="situacao_ferias">Situação das Férias:</label>
                <select name="situacao_ferias" class="form-control" id="situacao_ferias" value="{{ (isset($ferias) ?  $ferias->situacao_ferias : '')}}">
                    <option value=""selected>Selecionar</option>
                    <option @if($ferias->situacao_ferias == 'marcadas')selected @endif value="Marcadas">Marcadas</option>
                    <option @if($ferias->situacao_ferias == 'naoMarcadas')selected @endif value="Nao_Marcadas">Não Marcadas</option>
                </select>
            </div>
            
        </div>

        <div class="row">
            <div class="form-check col-12">
                <label for="pagamento_parcela13">Pagamento 1ª Parcela 13º:&nbsp</label>
                <input type="checkbox" name="pagamento_parcela13" id="pagamento_parcela13"  @if($ferias->pagamento_parcela13 == 1) checked @endif">
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