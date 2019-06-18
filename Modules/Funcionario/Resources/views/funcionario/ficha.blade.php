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
                <span class="h2">{{$funcionario->nome}}</span><br><hr class="mt-2">
                <span><b>Data de Nascimento:</b> {{$funcionario->data_nascimento}}</span><br>
                <span><b>Sexo:</b> {{$funcionario->sexo == 1 ? 'Masculino' : 'Feminino'}}</span><br> 
                <span><b>Estado Civil:</b> {{$funcionario->estado_civil()->nome}}</span><br>
                <span><b>Data Admissão:</b> {{$funcionario->data_admissao}}</span><br>
            </div>
        </div>              
    </div>
</div>
  <hr>
    <h4 class="d-flex align-items-end mb-4"><i class="material-icons mr-2">contact_phone </i> Contatos</h4>
  <div class="row">
    <div class="col-sm">
            <div class="row">
                @foreach($funcionario->telefones() as $telefone)    
                    <div class="col">
                        <span class="titulo_cargo">Telefone:</span> {{$telefone->numero}}
                    </div>
                @endforeach
                <div class="col">
                    <span class="titulo_cargo">Email:</span> {{$funcionario->email()->email}}
                </div>
            </div>      
    </div>
 </div>
<hr>
<h4 class="d-flex align-items-end mb-4"><i class="material-icons mr-2">attachment </i> Documentos</h4>
<div class="row">
    <div class="col-sm">
        <div class="row">
        @foreach($funcionario->documentos() as $documento)
            <div class="col-md-6">
                <span class="titulo_cargo">{{$documento->tipo_documento->nome}}:</span> {{$documento->numero}}
            </div>
        @endforeach 
        </div>      
    </div>
</div>
<hr>
<h4 class="d-flex align-items-end mb-4"><i class="material-icons mr-2">room </i> Endereços</h4>
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
            @if($funcionario->endereco()->cep == '')
            <span class="titulo_cargo">CEP:</span> -
            @else
                <span class="titulo_cargo">CEP:</span> {{$funcionario->endereco()->cep}}
            @endif
            </div>
            <div class="col">
                <span class="titulo_cargo">Complemento:</span> {{$funcionario->endereco()->complemento}}
            </div>
        </div>
    </div>
  </div>
  <hr>
  <h4 class="d-flex align-items-end mb-4"><i class="material-icons mr-2">work </i> Cargos</h4>
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
                <span class="titulo_cargo"> Data Saida:</span> {{$cargo->pivot->data_saida ? $cargo->pivot->data_saida : ""}}
                </div>
            </div>
            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
    </div>
    </div>
</div>
@endsection