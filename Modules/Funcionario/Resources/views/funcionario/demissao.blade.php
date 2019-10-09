@extends('funcionario::template')

@section('title', 'Aviso prévio e demissão')

@section('body')

    <section>
        <h2>Demissão</h2>
        <div class="row">
            <div class="form-group col-6">
                <label for="data_demissao">Data Demissão:</label>
                <input type="date" name="data_demissao" id="data_demissao" class="form-control">    
            </div>

            <div class="form-group col-6">
                <label for="data_pagamento">Data pagamento: </label>
                <input type="date" name="data_pagamento" id="data_pagamento" class="form-control">
            </div>

            <div class="form-group col-6">
            <label for="tipo_demissao">Tipo de demissão: </label>
                <select name="tipo_demissao" class="form-control">
                    @foreach($data['tipo_demissao'] as $tipo_demissao)
                        <option value="{{$tipo_demissao->id}}">{{$tipo_demissao->tipo}}</option>
                    @endforeach
                </select>
            </div>  
        </div>
    </section>

    <section>
        <h2>Aviso prévio</h2>
        <div class="row">
            <div class='form-group col-3'>
                <input type="checkbox" name="aviso_previo_indenizado" id="aviso_previo_indenizado">
                <label for="aviso_previo_indenizado">Aviso previo indenizado</label>
            </div>
        </div>
    </section>


@endsection

@section('script')

@endsection