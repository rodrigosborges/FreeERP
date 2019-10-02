@extends('funcionario::template')
@section('title')
    {{$data['title']}}
@endsection
@section('body')

<form action="{{url('funcionario/ferias' .'/'. $data['ferias']->id)}}" method="POST">
 
    @method('PUT')  
    {{csrf_field()}}
           
        <div class="row">

            <div class="form-group col-4">
                <label for="data_inicio">Data Início:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control"  value="{{$data['ferias']->data_inicio }}">
            </div>
            
            <div class="form-group col-4">
                <label for="data_fim">Data Fim:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control"  value="{{$data['ferias']->data_fim }}">
            </div>

            <div class="form-group col-4">
                <label for="dias_ferias">Dias de Férias:</label>
                <input type="text" id="dias_ferias" maxlength="2" name="dias_ferias" class="form-control" placeholder="Ex: 2"  value="{{$data['ferias']->dias_ferias }}">
            </div>
         </div>

         <input type="text" name="funcionario_id" style="display:none;"  value="{{$data['ferias']->funcionario_id }}"> 

        <div class="row">
            <div class="form-group col-3">
                <label for="data_pagamento">Data Pagamento:</label>
                <input type="date" name="data_pagamento" id="data_pagamento" class="form-control"  value="{{$data['ferias']->data_pagamento }}">
            </div>
            
            <div class="form-group col-3">
                <label for="data_aviso">Data de Início do Aviso:</label>
                <input type="date" name="data_aviso" id="data_aviso" class="form-control"  value="{{$data['ferias']->data_aviso }}">
            </div>

            <div class="form-group col-3">
                <label for="saldo_total">Férias a marcar</label>
                <input type="text" name="saldo_periodo" id="saldo_periodo" class="form-control" value="{{$data['saldo_periodo']}}" disabled>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-8">
                <label for="situacao_ferias">Situação das Férias:</label>
                <select name="situacao_ferias" class="form-control" id="situacao_ferias"  value="{{$data['ferias']->situacao_ferias }}">
                    <option @if($data['ferias']['situacao_ferias'] == 'marcadas')selected @endif value="Marcadas">Marcadas</option>
                    <option @if($data['ferias']['situacao_ferias'] == 'naoMarcadas')selected @endif value="Nao_Marcadas">Não Marcadas</option>
                </select>
            </div>
            
        </div> 

        <div class="row">
            <div class="form-check col-12">
                <label for="pagamento_parcela13">Pagamento 1ª Parcela 13º:&nbsp</label>
                <input type="checkbox" name="pagamento_parcela13" id="pagamento_parcela13"  @if($data['ferias']->pagamento_parcela13 == 1) checked @endif">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-12">
                <label for="observacao">Observação:</label>
                <textarea rows="5" name="observacao" id="observacao" class="form-control" >{{$data['ferias']->observacao}}</textarea>
            </div>
        </div>
        
       
   
    </section>

@endsection

@section('footer')
<div class="text-right d-flex justify-content-end">
            <button type="submit"  class="btn btn-success">Salvar</button>
        </div> 
@endsection
</form>
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{Module::asset('funcionario:js/helpers.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/form.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/validations.js')}}"></script>
    
@endsection
