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
                <a target="_blank" rel="noopener noreferrer" href="{{url('storage/curriculos/'.$data['candidato']->curriculo)}}" class="btn btn-info btn-small "> <i class="material-icons" style="vertical-align: middle;">import_contacts</i> Currículo</a>
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

            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th colspan='4'>Dados Cadastrais</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Estado: </b> {{$data['candidato']->endereco->cidade->estado()->first()->nome}}</td>
                        <td><b>Cidade: </b> {{$data['candidato']->endereco->cidade->nome}}</td>
                        <td colspan='2'><b>Bairro: </b> {{$data['candidato']->endereco->bairro}}</td>
                    </tr>
                    @if($data['candidato']->endereco->complemento != "")
                    <tr>
                        <td><b>Logradouro: </b> {{$data['candidato']->endereco->logradouro}}</td>
                        <td><b>Complemento: </b> {{$data['candidato']->endereco->complemento}}</td>
                        <td><b>CEP: </b> {{$data['candidato']->endereco->cep}}</td>
                        <td><b>Número: </b> {{$data['candidato']->endereco->numero}}</td>
                    </tr>
                    @else

                    @endif
                </tbody>
            </table>

            <!-- <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Estado:</h5>
                    <p>{{$data['candidato']->endereco->cidade->estado()->first()->nome}}</p>
                </div>
                <div class="col-md-3">
                    <h5>Cidade:</h5>
                    <p>{{$data['candidato']->endereco->cidade->nome}}</p>
                </div>
                <div class="col-md-3">
                    <h5>Bairro:</h5>
                    <p>{{$data['candidato']->endereco->bairro}}</p>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Logradouro:</h5>
                    <p>{{$data['candidato']->endereco->logradouro}}</p>
                </div>
                @if($data['candidato']->endereco->complemento != "")
                <div class="col-md-6">
                    <h5>Complemento:</h5>
                    <p>{{$data['candidato']->endereco->complemento}}</p>
                </div>
                @endif
                <div class="col-md-3">
                    <h5>CEP:</h5>
                    <p>{{$data['candidato']->endereco->cep}}</p>
                </div>
                <div class="col-md-3">
                    <h5>Número:</h5>
                    <p>{{$data['candidato']->endereco->numero}}</p>
                </div>
            </div> -->

            <div class="card-footer">
                <a class="btn btn-success" href="{{url('recrutamento/mensagem/enviarMensagem/'.$data['candidato']->id)}}"><i class="material-icons" style="vertical-align: middle;">message</i> {{$data['button']}}</a>
            </div>
            

        </div>
    </div>

    </div>
    </div>
    
@endsection