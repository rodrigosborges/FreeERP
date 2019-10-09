@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
<div class="card col-md-12 text-left" >
  <div class="card-body">
    <form method="post" action="{{url($data['url'])}}">
        @if($data['method'] == 'PUT')
            @method('PUT')
        @endif
        @csrf
    <input type="hidden" value="{{$data['funcionario']->id}}" name="atestado[funcionario_id]">
    <h5>Nome do funcionário: {{$data['funcionario']->nome}}</h5>
    <div class="form-row pt-4">     
        <div class="form-group col-md-3">
            <label for="">CID</label>
            <input type="text" class="form-control" value="{{old('atestado.cid_atestado', $data['atestado'] ? $data['Atestado']->cid_atestado : '')}}" name="atestado[cid_atestado]" >
        </div>

        <div class="form-group col-md-3">
            <label for="">Data de Início</label>
            <input type="date" class="form-control" value="{{old('atestado.data_inicio', $data['atestado'] ? $data['atestado']->data_inicio : '')}}" name="atestado[data_inicio]">
        </div>     

        <div class="form-group col-md-3">
            <label for="">Data de Fim</label>
            <input type="date" class="form-control" value="{{old('atestado.data_fim', $data['atestado'] ? $data['atestado']->data_fim : '')}}" name="atestado[data_fim]">
        </div>

        <div class="form-group col-md-2">
            <label for="">Quantidade de Dias</label>
            <input type="number" class="form-control" value="{{old('atestado.quantidade_dias', $data['atestado'] ? $data['atestado']->quantidade_dias : '')}}" name="atestado[quantidade_dias]">
        </div>
    </div>
  </div>
</div>

@section('footer')
    <div class="d-flex justify-content-end">
        <button type="submit"  class="btn btn-success ">Salvar</button>
    </div>
    </form>
@endsection

@endsection