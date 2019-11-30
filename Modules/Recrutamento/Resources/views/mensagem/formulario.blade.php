@extends('template')

@section('content')
    
    <div class="card">
    <div class="card-header d-flex justify-content-center"><h3>Mensagem</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST" >
            {{ csrf_field() }}
            @if($data['model'])
                @method('PUT')
            @endif
            <h3>Candidato: {{$data['candidato']->nome}}</h3>
            <hr> 

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="assunto" class="control-label">Assunto</label>
                        <input required type="text" name="assunto" id="assunto" class="form-control" value="{{ $data['model'] ? $data['model']->assunto : old('assunto', "") }}">
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="font-weight-bold" for="mensagem">Mensagem</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="6">Olá {{$data['candidato']->nome}} Você foi selecionado para etapa de ..... Local: Horário: </textarea>
            </div>

            <div class="form-group">
            <a class="btn btn-light" href="{{ url('recrutamento/vaga/candidatos/')}}{{'/'.$data['candidato']->vaga()->first()->id}}">Voltar</a>
            <button type="submit" class="btn btn-success"><i class="material-icons" style=" vertical-align: middle;">email</i> {{ $data['button'] }} </button> 
            </div>

            <input type="text" name="candidato_id" value="{{$data['candidato']->id}}" style="display:none">
            <input type="text" name="email" value="" style="display:none">

        </form>
    </div>
    </div>
    

@endsection
@section('js')
@endsection