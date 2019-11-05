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
                    <div class="col-sm-6">
                        <label for="assunto" class="control-label">Assunto</label>
                        <input required type="text" name="assunto" id="assunto" class="form-control" value="{{ $data['model'] ? $data['model']->assunto : old('assunto', "") }}">
                    </div>
                    <div class="col-sm-6">
                        <label for="email" class="control-label">Email</label>
                        <select name="email" id="email" class="form-control">
                            <option value="">Selecione um Email</option>
                            @foreach($data['emails'] as $email)
                                <option value="{{$email->email}}">{{$email->email}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="font-weight-bold" for="mensagem">Mensagem</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="6"></textarea>
            </div>

            <div class="form-group">
            <a class="btn btn-light" href="{{ url('recrutamento/vaga/candidatos/')}}{{'/'.$data['candidato']->vaga()->first()->id}}">Voltar</a>
            <button type="submit" class="btn btn-success"><i class="material-icons" style=" vertical-align: middle;">email</i> {{ $data['button'] }} </button> 
            </div>

            <input type="text" name="candidato_id" value="{{$data['candidato']->id}}" style="display:none">

        </form>
    </div>
    </div>
    

@endsection