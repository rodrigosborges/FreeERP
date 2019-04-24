@extends('template')
@section('content')

<div class="card " style="margin:auto; max-width: 40rem;">
    <div class="card-header text-white bg-dark">Abrir OS</div>
    <div class="card-body">
        <form action="{{ $data['url'] }}" method="POST">
            {{ csrf_field() }}
            @if($data['model'])
            @method('PUT')
            @else
                <div class="form-group">
                    <div class="form-row">
                        <label>Nome</label>
                        <input type="text" placeholder="Nome" name="nome" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label>CPF</label>
                        <input type="text" placeholder="cpf" name="cpf" id="cpf" class="form-control" value="{{ $data['model'] ? $data['model']->cpf : old('cpf', "") }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>RG</label>
                        <input type="text" placeholder="rg" name="rg" id="rg" class="form-control" value="{{ $data['model'] ? $data['model']->rg : old('rg', "") }}">
                    </div>
                </div>
            @endif
            
            <div class="form-group">
                <div class="form-row">
                        <label>Email</label>
                        <input placeholder="Email" type="text" name="email" id="email" class="form-control" value="{{ $data['model'] ? $data['model']->email : old('email', "") }}">
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                        <label>Comissão</label>
                        <input type="text" placeholder="comissao" name="comissao" id="comissao" class="form-control" value="{{ $data['model'] ? $data['model']->comissao : old('comissao', "") }}">
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