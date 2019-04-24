@extends('template')
@section('content')
    
    <div class="card">
    <div class="card-header"><h3>Curriculo</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST">
            {{ csrf_field() }}
            @if($data['model'])
                @method('PUT')
            @endif
       
            <div class="form-group">

            <div class="form-row">
                <div class="col-sm">    
                    <label for="nome" class="control-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
                    <label class="errors"> {{ $errors->first('nome') }} </label>
                </div>

                <div class="col-sm">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control money" value="{{ $data['model'] ? $data['model']->email : old('email', "") }}">
                    <label class="errors"> {{ $errors->first('email') }} </label>
                </div>
            </div>
            

            <div class="form-row">
                <div class="col-sm">
                    <label for="formacao" class="control-label">Formação</label>
                    <input type="text" name="formacao" id="formacao" class="form-control" value="{{ $data['model'] ? $data['model']->formacao : old('formacao', "") }}">
                    <label class="errors"> {{ $errors->first('formacao') }} </label>
                </div>

                <div class="col-sm">
                    <label for="endereco" class="control-label">Endereço</label>
                    <input type="text" name="endereco" id="endereco" class="form-control" value="{{ $data['model'] ? $data['model']->endereco : old('endereco', "") }}">
                    <label class="errors"> {{ $errors->first('endereco') }} </label>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                        <label for="telefone" class="control-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $data['model'] ? $data['model']->telefone : old('telefone', "") }}">
                        <label class="errors"> {{ $errors->first('telefone') }} </label>
                </div>

                <div class="col-sm">
                        <label for="experiencia" class="control-label">Experiências</label>
                        <input type="text" name="experiencia" id="experiencia" class="form-control" value="{{ $data['model'] ? $data['model']->experiencia : old('experiencia', "") }}">
                        <label class="errors"> {{ $errors->first('experiencia') }} </label>
                </div>
            </div>
            </div>

            <div class="form-group">
            <label for="status">Selecione a Vaga</label>
            <select class="form-control" id="vaga_id" name='vaga_id'>
                <option value=''>Escolha uma opção</option>
                @foreach($data['vaga'] as $vaga)
                        <option value="{{ $vaga->id }}" {{ $vaga->id == $data['model']['id'] ? 'selected' : '' }}> {{ $vaga->cargo }} </option>
                @endforeach
            </select>
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('recrutamento/vagasDisponiveis') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>

        </form>
    </div>
    </div>
    

@endsection