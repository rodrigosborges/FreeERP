@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
<div class="algo">

    <form method="post" action="{{url($data['url'])}}">
        @if($data['method'] == 'PUT')
            @method('PUT')
        @endif
        @csrf
    <input type="hidden" value="{{$data['funcionario']->id}}" name="atestado[funcionario_id]">
    <h5>Nome do funcionário: {{$data['funcionario']->nome}}</h5>

    <div class="col-lg-12 pt-5">
            <div class="form-group">
                <label for="">Motivo da mudança de situação:</label>
                <div class="input-group">
                    
                <select name="situacao" class="form-control">
                    <option value="previdencia">Previdência</option>
                    <option value="acidente">Acidente de Trabalho</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label for="">CID:</label>
            <div class="input-group">
                <input type="text" class="form-control" value="{{old('atestado.cid_atestado', $data['atestado'] ? $data['Atestado']->cid_atestado : '')}}" name="atestado[cid_atestado]" >
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label for="">Data de Início:</label>
            <div class="input group">
                <input type="date" class="form-control" id="data_inicio" value="{{old('atestado.data_inicio', $data['atestado'] ? $data['atestado']->data_inicio : '')}}" name="atestado[data_inicio]">
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label for="">Data de Fim:</label>
            <div class="input-group">
                <input type="date" class="form-control" id="data_fim" value="{{old('atestado.data_fim', $data['atestado'] ? $data['atestado']->data_fim : '')}}" name="atestado[data_fim]">
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label for="">Quantidade de Dias:</label>
            <div class="input-group">
                <input type="text" disabled id="resultado" class="form-control" >
            </div>
        </div>
    </div>
    </div>
@section('footer')
    <div class="d-flex justify-content-end">
        <a  href='{{ url("/funcionario/funcionario/listaHistorico/".$data["funcionario"]->id) }}' class="btn btn-info d-flex justify-content-end text-white "><i class="material-icons">assignment</i>Histórico</a>
        <button type="submit"  class="btn btn-success ml-2">Salvar</button>

    </div>

@endsection

@endsection

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
  $(document).ready(function () {

    $('#data_fim').on("focusout", function () {

      var data_inicio = new Date(document.getElementById('data_inicio').value);
      var data_fim = new Date(document.getElementById('data_fim').value);

      var diferenca = data_fim - data_inicio;
      var diferenca_dias = diferenca / (1000 * 60 * 60 * 24);

      console.log(data_inicio)
      document.getElementById('resultado').value = diferenca_dias;
    })
  });
</script>
