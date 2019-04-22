@extends('template')
@section('content')

<div class="card " style="margin:auto; max-width: 40rem;">
    <div class="card-header text-white bg-dark">Abrir OS</div>
    <div class="card-body">
        <form action="{{ $data['url'] }}" method="POST">
            {{ csrf_field() }}
            @if($data['model'])
            @method('PUT')
            @endif

            <div class="form-group">
                <div class="form-row">
                    <label>Solicitante</label>
                    <input type="text" placeholder="Solicitante" name="solicitante_id" id="solicitante_id" class="form-control" value="{{ $data['model'] ? $data['model']->solicitante_id : old('solicitante_id', "") }}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Tipo do Aparelho</label>
                    <input type="text" placeholder="ex: computador" name="tipo_aparelho" id="tipo_aparelho" class="form-control" value="{{ $data['model'] ? $data['model']->tipo_aparelho : old('tipo_aparelho', "") }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Marca</label>
                    <input type="text" placeholder="Marca" name="marca" id="marca" class="form-control" value="{{ $data['model'] ? $data['model']->marca : old('marca', "") }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Número de Série</label>
                    <input placeholder="Número de Série" type="text" name="numero_serie" id="numero_serie" class="form-control" value="{{ $data['model'] ? $data['model']->numero_serie : old('numero_serie', "") }}">
                </div>
            </div>

            <div class="form-group">
                <textarea placeholder='Descrição do Problema' name="descricao_problema" id="descricao_problema" class="form-control">{{ $data['model'] ? $data['model']->descricao_problema : old('descricao_problema', "") }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button>
                <a href="{{ url('ordemservico/os') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
</div>
@endsection