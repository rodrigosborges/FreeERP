@extends('template')
@section('content')
    
    <div class="card ">
    <div class="card-header"><h3>Vaga</h3></div>
    <div class="card-body">
              
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <div class="form-row">
        <div class="col-sm">
            <div class="form-group">
                <label for="cargo" class="control-label">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" value="{{ $data['model'] ? $data['model']->cargo : old('cargo', "") }}">
                <label class="errors"> {{ $errors->first('cargo') }} </label>
            </div>
        </div>
        
        <div class="col-sm">
            <div class="form-group">
                <label for="salario" class="control-label">Salário</label>
                <input type="text" name="salario" id="salario" class="form-control money" value="{{ $data['model'] ? $data['model']->salario : old('salario', "") }}">
                <label class="errors"> {{ $errors->first('salario') }} </label>
            </div>
        </div>
        </div>

        <div class="form-row">
        <div class="col-sm">
            <div class="form-group">
                <label for="escolaridade" class="control-label">Escolariodade</label>
                <input type="text" name="escolaridade" id="escolaridade" class="form-control" value="{{ $data['model'] ? $data['model']->escolaridade : old('escolaridade', "") }}">
                <label class="errors"> {{ $errors->first('escolaridade') }} </label>
            </div>
        </div>

        <div class="col-sm">
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name='status'>
                    <option value=''>Escolha uma opção</option>
                    <option {{ $data['model'] && $data['model']->status == 'iniciado' ? 'selected' : '' }} value='iniciado'>Iniciado</option>
                    <option {{ $data['model'] && $data['model']->status == 'disponivel' ? 'selected' : '' }} value='disponivel'>Disponível</option>
                </select>
            </div>
        </div>
        </div>

        <div class="form-group">
                <label for="quantidade" class="control-label">Descrição da Vaga</label>
                <input type="text" name="descricao" id="descricao" class="form-control" value="{{ $data['model'] ? $data['model']->descricao : old('descricao', "") }}">
                <label class="errors"> {{ $errors->first('descricao') }} </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('recrutamento/Vaga') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>
    </form>
    </div>
    </div>
    

@endsection

@section('js')
    $('.money').mask('000.000,00', {reverse: true});
@endsection