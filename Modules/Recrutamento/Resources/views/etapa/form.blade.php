@extends('template')
@section('content')
    
    <div class="card col-md-6 offset-md-3">
    <div class="card-header"><h3>{{$data['title']}}</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST">
            {{ csrf_field() }}
            @if($data['model'])
                @method('PUT')
            @endif 

            <div class="form-group">
            <div class="form-row">
                <div class="col-md-12">    
                    <label for="nome" class="control-label">Nome</label>
                    <input required type="text" name="nome" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
                    <label class="errors"> {{ $errors->first('nome') }} </label>
                </div>
            </div>

            <div class="form-group">
            <div class="form-row">
                <div class="col-md-12">    
                    <label for="descricao" class="control-label">Descrição</label>
                    <textarea required class="form-control" id="descricao" name="descricao" rows="2">{{ $data['model'] ? $data['model']->descricao : old('descricao', "") }}</textarea>
                    <label class="errors"> {{ $errors->first('descricao') }} </label>
                </div>
            </div>
            </div>

            <div class="form-row">
                <a class="btn btn-light mr-sm-3" href="{{ $data['voltar'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
                <button type="submit" class="btn btn-success flot"> {{ $data['button'] }} </button>
            </div>

        </form>
    </div>
    </div>
    </div>

@endsection
