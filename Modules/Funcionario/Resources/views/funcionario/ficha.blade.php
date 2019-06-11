@extends('funcionario::template')
@section('title','Ficha de funcionário')
@section('body')
<div class="container">
  <div class="row">
    <div class="col-sm-2 text-center">
        <img class="img-fluid" src="{{ URL::to('/') }}/img/user-img.jpg" height=130>
    </div>
    <div class="col-sm-10">
            <div class="row">
                <div class="col">
                <span class="titulo_cargo">Nome:</span> {{$funcionario->nome}} 
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="titulo_cargo">Data de Nascimento:</span> {{$funcionario->data_nascimento}}
                </div>
                <div class="col">
                    <span class="titulo_cargo">Estado Civil:</span> {{$funcionario->estado_civil()->nome}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                   <span class="titulo_cargo">Data Admissão:</span> {{$funcionario->data_admissao}}
                </div>
                <div class="col">
                    <span class="titulo_cargo">Email:</span> {{$funcionario->email()->email}}
                </div>
            </div>
            <div class="row">
            @foreach($funcionario->documentos() as $documento)
                <div class="col">
                   <span class="titulo_cargo">{{$documento->tipo_documento->nome}}:</span> {{$documento->numero}}
                </div>
            @endforeach    
            </div>            
            <div class="row">
                @foreach($funcionario->telefones() as $telefone)    
                <div class="col">
                    <span class="titulo_cargo">Telefone:</span> {{$telefone->numero}}
                </div>
                @endforeach
                <div class="col">
                    @if($funcionario->sexo == 1)
                        <span class="titulo_cargo">Sexo:</span> Masculino
                    @else
                        <span class="titulo_cargo">Sexo:</span> Feminino
                    @endif
                </div>
            </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm">
        @foreach($funcionario->cargos as $cargo)
            <div class="row">
                <div class="col">
                   <span class="titulo_cargo">Cargo:</span> {{$cargo->nome}}
                </div>
                <div class="col">
                    <span class="titulo_cargo">Cargo:</span> {{$cargo->salario}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                   <span class="titulo_cargo">Data Entrada:</span> {{$cargo->pivot->data_entrada}}
                </div>
                <div class="col">
                   <span class="titulo_cargo"> Data Saida:</span> {{$cargo->pivot->data_saida}}
                </div>
            </div>
        @endforeach        
    </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-sm">
        <div class="row">
            <div class="col">
               <span class="titulo_cargo">Logradouro:</span> {{$funcionario->endereco()->logradouro}}
            </div>
            <div class="col">
                <span class="titulo_cargo">Bairro:</span> {{$funcionario->endereco()->bairro}}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="titulo_cargo">Cidade:</span> {{$funcionario->endereco()->cidade->nome}}
            </div>
            <div class="col">
                <span class="titulo_cargo">Estado:</span> {{$funcionario->endereco()->cidade->estado->nome}}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="titulo_cargo">CEP:</span> {{$funcionario->endereco()->cep}}
            </div>
            <div class="col">
                <span class="titulo_cargo">Complemento:</span> {{$funcionario->endereco()->complemento}}
            </div>
        </div>
    </div>
  </div>
</div>
@endsection