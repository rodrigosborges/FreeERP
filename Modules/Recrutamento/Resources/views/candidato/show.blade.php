@extends('template')
@section('content')

    <div class="card ">
    <div class="card-header"><h3>Candidato</h3></div>
    <div class="card-body">

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            
            <h4>Dados Pessoais</h4>

            <div class="row mb-3">
                <div class="col-md-2">
                    <img src="{{url('storage/fotos/'.$data['candidato']->foto)}}" alt="{{$data['candidato']->nome}}" style="max-width:100px;">
                </div>

                <div class="col-md-2 offset-md-8">
                    <a href="{{url('storage/curriculos/'.$data['candidato']->curriculo)}}" class="btn btn-info">Veja o Currículo</a>
                </div>

            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Nome: {{$data['candidato']->nome}}</h5>
                </div>
                <div class="col-md-3">
                    <h5>Email: {{$data['candidato']->email->email}}</h5>
                </div>
                <div class="col-md-3">
                    <h5>Telefone: {{$data['candidato']->telefone->numero}}</h5>
                </div>
            </div>

            <h4>Endereço</h4>

            <div class="row mb-3">
                <div class="col-md-3">
                    <h5>CEP: {{$data['candidato']->endereco->cep}}</h5>
                </div>
                <div class="col-md-3">
                    <h5>Estado: {{$data['candidato']->endereco->cidade->estado()->get()[0]['nome']}}</h5>
                </div>
                <div class="col-md-3">
                    <h5>Cidade: {{$data['candidato']->endereco->cidade->nome}}</h5>
                </div>
                <div class="col-md-3">
                    <h5>Bairro: {{$data['candidato']->endereco->bairro}}</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3">
                    <h5>Logradouro: {{$data['candidato']->endereco->logradouro}}</h5>
                </div>
                <div class="col-md-3">
                    <h5>Número: {{$data['candidato']->endereco->cidade->nome}}</h5>
                </div>
                <div class="col-md-6">
                    <h5>Complemento: {{$data['candidato']->endereco->complemento}}</h5>
                </div>
            </div>

            <div class="mb-3">
                
                <div class="float-right">
                    <a class="btn btn-success" href="{{url('recrutamento/entrevista/marcarEntrevista/'.$data['candidato']->id)}}">{{$data['button']}}</a>
                </div>
            </div>
            

        </div>
    </div>

    </div>
    </div>
    </div>
    
@endsection