@extends('template')
@section('content')

    <div class="card ">
    <div class="card-header"><h3>Candidato</h3></div>
    <div class="card-body">

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            
            <h4>Dados Pessoais</h4>
            <hr>

            <div class="float-right">
                    <a href="{{url('storage/curriculos/'.$data['candidato']->curriculo)}}" class="btn btn-info btn-small ">Currículo</a>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <img src="{{url('storage/fotos/'.$data['candidato']->foto)}}" alt="{{$data['candidato']->nome}}" style="max-width:100px;">
                </div>
            </div>
            
            <div class="row mb-5">
                <div class="col-md-4">
                    <h5>Nome: </h5>
                    <p>{{$data['candidato']->nome}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Email:</h5>
                    <p>{{$data['candidato']->email->email}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Telefone: </h5>
                    <p>{{$data['candidato']->telefone->numero}}</p>
                </div>
            </div>

            <h4>Endereço</h4>
            <hr>

            <div class="row mb-3">
                <div class="col-md-4">
                    <h5>Estado:</h5>
                    <p>{{$data['candidato']->endereco->cidade->estado()->first()->nome}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Cidade:</h5>
                    <p>{{$data['candidato']->endereco->cidade->nome}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Bairro:</h5>
                    <p>{{$data['candidato']->endereco->bairro}}</p>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Logradouro:</h5>
                    <p>{{$data['candidato']->endereco->logradouro}}</p>
                </div>
                <div class="col-md-6">
                    <h5>Complemento:</h5>
                    <p>{{$data['candidato']->endereco->complemento}}</p>
                </div>
                <div class="col-md-3">
                    <h5>CEP:</h5>
                    <p>{{$data['candidato']->endereco->cep}}</p>
                </div>
                <div class="col-md-3">
                    <h5>Número:</h5>
                    <p>{{$data['candidato']->endereco->numero}}</p>
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
    
@endsection