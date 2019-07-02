@extends('ordemservico::layouts.informacoes')
@section('content')

<div class="card " style="margin:auto; max-width: 40rem;">
    <div class="card-header text-white bg-dark">{{$data['title']}}</div>
    <div class="card-body">
    
        {{ Form::open(array('url' => $data['url'] , 'method'=>'post')) }}
        {{Form::token()}}
            @if($data['model'])
            @method('PUT')
            @else
                <div class="form-group">
                    <div class="form-row">
                    {{Form::label('Nome')}}
                    {{Form::text('nome',$data['model'] ? $data['model']->nome : old('nome'),array('class' => 'form-control','placeholder'=>'Nome'))}}
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                    {{Form::label('CPF')}}
                    {{Form::text('cpf',$data['model'] ? $data['model']->cpf : old('cpf'),array('class' => 'form-control','placeholder'=>'CPF'))}}
                    </div>

                    <div class="col-md-6 mb-3">
                    {{Form::label('RG')}}
                    {{Form::text('rg',$data['model'] ? $data['model']->rg : old('rg'),array('class' => 'form-control','placeholder'=>'RG'))}}   
                    </div>
                </div>
            @endif
            
            <div class="form-group">
                <div class="form-row">
                    {{Form::label('Email')}}
                    {{Form::email('email',$data['model'] ? $data['model']->email : old('email'),array('class' => 'form-control','placeholder'=>'Email'))}}
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    {{Form::label('Comissão')}}
                    {{Form::text('comissao',$data['model'] ? $data['model']->comissao : old('comissao'),array('class' => 'form-control','placeholder'=>'Comissão'))}}     
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