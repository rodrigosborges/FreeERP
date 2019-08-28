@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')

    <section>
        <div class="row">
            <div class="form-group col-6">
                <label for="f.nome">Nome:</label>
                <input type="text" class="form-control" id="f.nome" value="Pedro" disabled>
            </div>

            <div class="form-group col-6">
                <label for="f.nome">Cargo:</label>
                <input type="text" class="form-control" id="f.cargo" value="Auxiliar Administrativo" disabled>
            </div>
        </div>
    </section>

    <section>
    <h4>Período Gozo</h4>
    <form action="">
        <div class="row">

            <div class="form-group col-4">
                <label for="data_inicio">Data Início:</label>
                <input type="date" id="data_inicio" class="form-control">
            </div>
            
            <div class="form-group col-4">
                <label for="data_fim">Data Fim:</label>
                <input type="date" id="data_fim" class="form-control">
            </div>

            <div class="form-group col-4">
                <label for="dias_ferias">Dias de Férias:</label>
                <input type="text" id="dias_ferias" class="form-control" placeholder="Ex: 2">
            </div>
        </div>

        

        <div class="row">
            <div class="form-group col-3">
                <label for="data_pagamento">Data Pagamento:</label>
                <input type="date" id="data_pagamento" class="form-control">
            </div>
            
            <div class="form-group col-3">
                <label for="data_aviso">Data de Início do Aviso:</label>
                <input type="date" id="data_aviso" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-8">
                <label for="situacao_ferias">Situação das Férias:</label>
                <select name="situacao_ferias" class="form-control" id="situacao_ferias">
                    <option value=""selected>Selecionar</option>
                    <option value="Marcadas">Marcadas</option>
                    <option value="Não Marcadas">Não Marcadas</option>
                </select>
            </div>
            
            
        </div>

        <div class="row">
        
            <div class="form-check form-check-inline">
                <label for="pagamento_parcela13">Pagamento 1ª Parcela 13º:&nbsp</label>
                <input type="checkbox" id="pagamento_parcela13" class="form-check-input">
            </div>


        </div>

        <div class="row">
            <div class="form-group col-12">
                <label for="observacao">Observação:</label>
                <textarea rows="5" id="observacao" class="form-control"></textarea>
            </div>
        <div>


        
    </form>
    </section>

@endsection



@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{Module::asset('funcionario:js/helpers.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/form.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/validations.js')}}"></script>
    
@endsection