@extends('template')
@section('content')
    
    <div class="card ">
    <div class="card-header d-flex justify-content-center"><h3>Vaga</h3></div>
    <div class="card-body">
              
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <div class="form-row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="cargo" class="control-label font-weight-bold">Cargo</label>
                    <select class="form-control" id="cargo" name='vaga[cargo_id]'>
                        @foreach($data['cargos'] as $item)
                        <option {{ $data['model'] && $data['model']->cargo_id == $item->id ? 'selected' : '' }} value='{{$item->id}}'>{{$item->nome}}</option>
                        @endforeach
                    </select>
                    <label class="errors"> {{ $errors->first('cargo') }} </label>
                </div>
            </div>
            
            <div class="col-sm">
                <div class="form-group">
                    <label for="salario" class="control-label font-weight-bold">Salário</label>
                    <input type="text" required name="vaga[salario]" id="salario" class="form-control" value="{{ $data['model'] ? $data['model']->salario : old('salario', "A Combinar") }}">
                    <label class="errors"> {{ $errors->first('salario') }} </label>
                </div>
            </div>
        </div>

        <div class="form-row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="interessado_nome" class="control-label font-weight-bold">Nome do Interessado</label>
                    <input type="text" required name="vaga[interessado_nome]" id="interessado_nome" class="form-control" value="{{ $data['model'] ? $data['model']->interessado_nome : old('interessado_nome', "") }}">
                    <label class="errors"> {{ $errors->first('interessado_nome') }} </label>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="interessado_email" class="control-label font-weight-bold">Email do Interessado</label>
                    <input type="text" required name="vaga[interessado_email]" id="interessado_email" class="form-control" value="{{ $data['model'] ? $data['model']->interessado_email : old('interessado_email', "") }}">
                    <label class="errors"> {{ $errors->first('interessado_email') }} </label>
                </div>
            </div>
            
        </div>

        <div class="form-row">
            <div class="col-sm">
                <div class="form-group">
                    <label class="font-weight-bold" for="escolaridade">Escolaridade</label>
                    <select class="form-control" id="escolaridade" name='vaga[escolaridade]'>
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
                    <label class="font-weight-bold" for="status">Status</label>
                    <select class="form-control" id="status" name='vaga[status]'>
                        <option value=''>Escolha uma opção</option>
                        <option {{ $data['model'] && $data['model']->status == '1' ? 'selected' : '' }} value='1' >Mostrar</option>
                        <option {{ $data['model'] && $data['model']->status == '0' ? 'selected' : '' }} value='0' >Não Mostrar</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <div class="form-group">
                    <label class="font-weight-bold" for="regime">Regime de Contratação</label>
                    <select class="form-control" id="regime" name='vaga[regime]'>
                        <option value=''>Escolha uma opção</option>
                        <option {{ $data['model'] && $data['model']->regime == 'clt' ? 'selected' : '' }} value='clt'>CLT Efetivo</option>
                        <option {{ $data['model'] && $data['model']->regime == 'outro' ? 'selected' : '' }} value='outro'>Outro</option>
                    </select>
                </div>
            </div>
        
            <div class="col-sm">
                <div class="form-group">
                <label class="font-weight-bold" for="myselect2">Benefícios</label>
                <select class="js-example-basic-multiple" name="beneficios[]" id='myselect2' multiple="multiple" style='width:100%'>
                    @foreach($data['beneficios'] as $beneficio)
                    <option {{$data['model'] && in_array($beneficio->id,$data['model_beneficios']) ? 'selected' : ''}} value="{{$beneficio->id}}">{{$beneficio->nome}}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="descricao" class="control-label font-weight-bold">Descrição da Vaga</label>
                    <textarea  name="vaga[descricao]" required id="descricao" class="form-control"  rows="3">{{ $data['model'] ? $data['model']->descricao : old('descricao', "") }}</textarea>
                    <label class="errors"> {{ $errors->first('descricao') }} </label>
                </div>
            </div>
        
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="especificacoes" class="control-label font-weight-bold">Especificações da Vaga</label>
                    <textarea class="form-control" required name="vaga[especificacoes]"  id="especificacoes" rows="3">{{ $data['model'] ? $data['model']->especificacoes : old('especificacoes', "") }}</textarea>
                    <label class="errors"> {{ $errors->first('especificacoes') }} </label>
                </div>
            </div>

        </div>


        <div class="form-group">
            <a class="btn btn-light mr-sm-3" href="{{ url('recrutamento/vaga') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            <button type="submit" class="btn btn-success "><i class="material-icons" style=" vertical-align: middle;">save</i> {{ $data['button'] }} </button> 
        </div>
    </form>
    </div>
    </div>
    

@endsection

@section('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


@endsection