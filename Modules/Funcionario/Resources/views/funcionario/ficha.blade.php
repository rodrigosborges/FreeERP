@extends('funcionario::template')
@section('title','Ficha de funcionário')
@section('body')
<div class="container">
  <div class="row">
    <div class="col-sm">
    
        <ul class="lista-ficha">
            <li><h5>Dados Pessoais</h5></li>
            <ul class="lista-ficha">
                <li>Nome: {{$funcionario->nome}}</li>
                <li>Data de Nascimento: {{$funcionario->data_nascimento}}</li>
                <li>Estado Civil: {{$funcionario->estado_civil()->nome}}</li>
                <li>Data Admissão: {{$funcionario->data_admissao}}</li>
            </ul>
        </ul>
    </div>
    <div class="col-sm">
        <ul class="lista-ficha">
            <li><h5>Endereço</h5></li>
            <ul class="lista-ficha">
                <li>Logradouro: {{$funcionario->endereco()->logradouro}}</li>
                <li>Bairro: {{$funcionario->endereco()->bairro}}</li>
                <li>Cidade: {{$funcionario->endereco()->cidade->nome}}</li>
                <li>Estado: {{$funcionario->endereco()->cidade->estado->nome}}</li>
                <li>CEP: {{$funcionario->endereco()->cep}}</li>
                <li>Complemento: {{$funcionario->endereco()->complemento}}</li>
            </ul>
        </ul>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm">
    <ul class="lista-ficha">
      <li><h5>Contato</h5></li>
      <ul class="lista-ficha">
          <li>Email: {{$funcionario->email()->email}}</li>
          @foreach($funcionario->telefones() as $telefone)
            <li>Telefone: {{$telefone->numero}}</li>
          @endforeach
    </ul>
  </ul>
    </div>
    <div class="col-sm">
        <ul class="lista-ficha">
            <li><h5>Documentos</h5></li>
            <ul class="lista-ficha">
            @foreach($funcionario->documentos() as $documento)
                <li>{{$documento->tipo_documento->nome}}: {{$documento->numero}} </li>
            @endforeach
            </ul>
        </ul>
    </div>
  </div>
</div>



@endsection