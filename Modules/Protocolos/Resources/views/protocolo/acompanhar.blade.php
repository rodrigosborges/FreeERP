@extends('protocolos::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
    
    <h5>Protocolo de saída nº {{$data["protocolo"]->id}}</h5>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan=2 scope="row">Dados Gerais</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Setor de Origem: </b>{{$data["protocolo"]->usuario->setor->nome}}</td>
                <td><b>Nível de acesso: </b>{{$data["protocolo"]->tipo_acesso->tipo}} FAZER COR</td>
            </tr>
            <tr>
                <td colspan=2><b>Tipo: </b>{{$data["protocolo"]->tipo_protocolo->tipo}}</td>
            </tr>
            <tr>
                <td colspan=2><b>Assunto: </b>{{$data["protocolo"]->assunto}}</td>
            </tr>
            <tr>
                <td><b>Data de cadastro: </b>{{date('d/m/Y h:i:s', strtotime($data["protocolo"]->created_at))}} por {{$data["protocolo"]->usuario->nome}}</td>
                <td><b>Última modificação: </b>{{date('d/m/Y h:i:s', strtotime($data["protocolo"]->updated_at))}} FAZER</td>
            </tr>
        </tbody>
    </table>
    <hr>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    <i class="material-icons" style="vertical-align:middle; font-size:25px; margin-right:5px;">insert_drive_file</i>Documentos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="material-icons" style="vertical-align:middle; font-size:25px; margin-right:5px;">shuffle</i>Trâmites ({{$data["tramite"]->count()}})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                    <i class="material-icons" style="vertical-align:middle; font-size:25px; margin-right:5px;">attach_file</i>Protocolos apensados
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="documentos-tab">
            <br>
            <label for="" class="control-label">Adicionar um documento ao protocolo: <span class="required-symbol">* FAZER</span></label>
                <form id="form" action="{{ $data['url'] }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if($data['model'])
                        @method('PUT')
                    @endif
                    <div class="input-group col-6 mb-3 mt-3">
                        <span class="input-group-text">
                            <i class="material-icons">camera_alt</i>
                        </span>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto">
                            <label class="custom-file-label" for="foto">Selecionar</label>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success sendForm" type="button">
                                <i class="material-icons lock-locked" style="vertical-align:middle; font-size:25px; margin-right:5px;">save</i>{{$data['button']}}
                        </button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="tramites-tab">
            <br>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Criada em</th>
                        <th scope="col">Origem</th>
                        <th scope="col">Destino</th>
                        <th scope="col">Observação</th>
                        <th scope="col">Status</th>
                        <th scope="col">Concluído em</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data["tramite"] as $tramite)
                    <tr>
                        <td>{{$tramite->created_at}}</td>
                        <td>{{$tramite->origem_usuario->nome}}</td>
                        <td>{{$tramite->destino_usuario->nome}}</td>
                        <td>{{$tramite->observacao}}</td>
                        <td>{{$tramite->status}}</td>
                        <td>FAZER</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="apensadps-tab">
                <br>
                <form>
                <div class="form-group">
                    <label for="" class="control-label">Selecione o protocolo a ser apensado: <span class="required-symbol">* FAZER</span></label>
                    <div class="input-group">
                        <input id="arrayInteressados" type="hidden" value="" name="interessados">    
                        <div id="interessados" class="interessados"></div>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">search</i>
                            </span>
                        </div>
                        <input id="pesquisaProtocolos" placeholder="Pesquise aqui" class="form-control" type="text" name="pesquisa"/>
                    </div>
                </div>
                </form>
            </div>
        </div>

@endsection
@section('script')
    <script src="{{Module::asset('Protocolos:js/views/protocolo/acompanhar.js')}}"></script>
@endsection