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
                    <select class="form-control" id="cargo" name='cargo_id'>
                        @foreach($data['cargos'] as $item)
                        <option {{ $data['model'] && $data['model']->cargo_id == $item->id ? 'selected' : '' }} value='{{$item->id}}'>{{$item->nome}}</option>
                        @endforeach
                    </select>
                    <label class="errors"> {{ $errors->first('cargo') }} </label>
                </div>
            </div>
            
            <div class="col-sm">
                <div class="form-group">
                    <label for="salario" class="control-label">Salário</label>
                    <input type="text" name="salario" id="salario" class="form-control" value="{{ $data['model'] ? $data['model']->salario : old('salario', "A Combinar") }}">
                    <label class="errors"> {{ $errors->first('salario') }} </label>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="escolaridade">Escolaridade</label>
                    <select class="form-control" id="escolaridade" name='escolaridade'>
                        <option value=''>Escolha uma opção</option>
                        <option {{ $data['model'] && $data['model']->escolaridade == 'fundamental' ? 'selected' : '' }} value='fundamental'>Ensino Fundamental</option>
                        <option {{ $data['model'] && $data['model']->escolaridade == 'medio' ? 'selected' : '' }} value='medio'>Ensino Médio</option>
                        <option {{ $data['model'] && $data['model']->escolaridade == 'tecnico' ? 'selected' : '' }} value='tecnico'>Ensino Técnico</option>
                        <option {{ $data['model'] && $data['model']->escolaridade == 'superior' ? 'selected' : '' }} value='superior'>Ensino Superior</option>
                    </select>
                </div>
            </div>
        
        
            <div class="col-sm">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name='status'>
                        <option value=''>Escolha uma opção</option>
                        <option {{ $data['model'] && $data['model']->status == '1' ? 'selected' : '' }} value='1' >Disponível</option>
                        <option {{ $data['model'] && $data['model']->status == '0' ? 'selected' : '' }} value='0' >Indisponível</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="regime">Regime de Contratação</label>
                    <select class="form-control" id="regime" name='regime'>
                        <option value=''>Escolha uma opção</option>
                        <option {{ $data['model'] && $data['model']->regime == 'clt' ? 'selected' : '' }} value='clt'>CLT Efetivo</option>
                        <option {{ $data['model'] && $data['model']->regime == 'outro' ? 'selected' : '' }} value='outro'>Outro</option>
                    </select>
                </div>
            </div>
        
            <div class="col-sm">
                <div class="form-group">
                    <label for="beneficios" class="control-label">Benefícios</label>
                    <input type="text" name="beneficios" id="beneficios" class="form-control" value="{{ $data['model'] ? $data['model']->beneficios : old('beneficios', "") }}">
                    <label class="errors"> {{ $errors->first('beneficios') }} </label>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="descricao" class="control-label">Descrição da Vaga</label>
                    <textarea  name="descricao" id="descricao" class="form-control"  rows="3">{{ $data['model'] ? $data['model']->descricao : old('descricao', "") }}</textarea>
                    <label class="errors"> {{ $errors->first('descricao') }} </label>
                </div>
            </div>
        
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="especificacoes" class="control-label">Especificações da Vaga</label>
                    <textarea class="form-control" name="especificacoes"  id="especificacoes" rows="3">{{ $data['model'] ? $data['model']->especificacoes : old('especificacoes', "") }}</textarea>
                    <label class="errors"> {{ $errors->first('especificacoes') }} </label>
                </div>
            </div>

        </div>


        <div class="form-group">
            <a class="btn btn-light mr-sm-3" href="{{ url('recrutamento/vaga') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            <button type="submit" class="btn btn-success "> {{ $data['button'] }} </button> 
        </div>
    </form>
    </div>
    </div>
    

@endsection

@section('js')
<script>
$('.money').mask('000.000,00', {reverse: true});
$('#cep').mask('00000-000');
</script>


@endsection