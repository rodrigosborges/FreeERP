@extends('ordemservico::layouts.informacoes')
@section('content')

<div class="card " style="margin:auto; max-width: 40rem;">
    <div class="card-header text-white bg-dark">{{$data['title']}}</div>
    <div class="card-body">
    
        {{ Form::open(array('url' => $data['url'] , 'method'=>'post')) }}
        {{Form::token()}}
            @if($data['model'])
            @method('PUT')
            @endif
                <div class="form-group">
                    <div class="form-row">
                    {{Form::label('Nome')}}
                    {{Form::text('nome',$data['model'] ? $data['model']->nome : old('nome'),array('class' => 'form-control','placeholder'=>'Nome'))}}
                    </div>
                </div>

             
            <div class="form-group">
                <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button>
                <a href="{{ url('ordemservico/tecnico') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>

        </form>
    
</div>
@endsection