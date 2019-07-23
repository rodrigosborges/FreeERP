@extends('template')
@section('content')
    
    <div class="card">
    <div class="card-header"><h3>Formulário</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($data['model'])
                @method('PUT')
            @endif
            <h3>Candidato</h3>
            <hr> 
            <div class="form-group">
            
            <div class="form-row">
                <div class="col-sm">    
                    <label for="nome" class="control-label">Nome</label>
                    <input type="text" name="candidato[nome]" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
                    <label class="errors"> {{ $errors->first('nome') }} </label>
                </div>

            

                <div class="col-sm">
                    <label for="status">Selecione a Vaga</label>
                    <select class="form-control" id="vaga_id" name='candidato[vaga_id]'>
                        <option value=''>Escolha uma opção</option>
                        @foreach($data['vaga'] as $vaga)
                                <option value="{{ $vaga->id }}" {{ $vaga->id == $data['model']['id'] ? 'selected' : '' }}> {{ $vaga->cargo }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm">
                    <label for="curriculo">Currículo(Obs: Somente Arquivos PDF)</label>
                    <input type="file" name="curriculum" class="form-control-file" id="curriculo">
                </div>

            </div>


        <br>
        <h3>Contato</h3>
        <hr> 

        <label for="email" class="control-label">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">email</i>
                            </span>
                        </div>
                        <input required type="text" placeholder="E-mail" name="email[email]" id="email" class="form-control" value="{{ old('email', $data['model'] ? $data['model']->email()->email : '') }}">
                    </div>
                    <span class="errors"> {{ $errors->first('email') }} </span>
                </div>


        <div class="form-row">
        <div class="col-sm">
            <label for="tipo" class="control-label">Tipo de Telefone</label>
            <select required name="telefone[tipo_telefone_id]" class="form-control tipo_telefones">
                <option value="">Selecione</option>
                @foreach($data['tipos_telefone'] as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $data['telefone']['tipo_telefone_id'] ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach
            </select>
            <label class="errors"> {{ $errors->first('telefone.tipo') }} </label>
        </div>       

        <div class="col-sm">
            <label for="numero" class="control-label">Número</label>
            <input type="text" required name="telefone[numero]" maxlength='11' id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->telefones->numero : old('numero', "") }}">
            <label class="errors"> {{ $errors->first('telefone.numero') }} </label>
        </div>
        </div>
            <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('recrutamento/vagasDisponiveis') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>

        </form>
    </div>
    </div>
    

@endsection
