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
                    <i class="material-icons" style="vertical-align:middle; font-size:25px; margin-right:5px;">insert_drive_file</i>Documentos ({{$data["documento"]->count()}})
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
                <label for="" class="control-label">Adicionar um documento ao protocolo: <span class="required-symbol">*</span></label>
                <form id="doc-protocolo"> 
                    {{ csrf_field() }}
                    <div class="row">
                        <input id="id-protocolo" name="id-protocolo" type="hidden" value="{{$data['protocolo']->id}}">
                        <div class="input-group col-6 mb-3 mt-3">
                            <span class="input-group-text">
                                <i class="material-icons">camera_alt</i>
                            </span>
                            <div class="custom-file">
                                <input type="file" name="documento" class="custom-file-input" id="documento">
                                <label class="custom-file-label" for="documento">Selecionar</label>
                            </div>
                        </div>
                    
                        <div class="col-2 justify-content-center mt-3">
                            <button class="btn btn-success" type="submit">Adicionar</button>
                        </div>
                    </div>
                </form>
                <br>
                    <table class="table table-bordered table-hover" id="table-documento">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col" class="col-md-2">Documento</th>
                                <th scope="col">Download</th>
                            </tr>
                        </thead>
                        <tbody id="teste">
                        @foreach($data["documento"] as $documento)
                            <tr>
                                <td>{{$documento->nome_documento}}</td>
                                <td class="text-center">
                                   <form data-id="{{$documento->id}}" class="doc-download">
                                   {{ csrf_field() }}
                                        <button  class="btn btn-success btn-sm download-doc" type="submit" style="border-radius:50px;">
                                            <i class="material-icons lock-locked" style="font-size:25px;">file_download</i>
                                        </button>
                                   </form>
                                </td>
                                <td>
                                <a href="{{url('vstorage/app/documentos/'.$documento->documento)}}" class="btn btn-info btn-small ">Documento</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                <form id="form-apensados">
                {{ csrf_field() }}
                @if($data['model'])
                    @method('PUT')
                @endif
                    <input id="id-protocolo" name="id-protocolo" type="hidden" value="{{$data['protocolo']->id}}">
                    <div class="form-group">
                        <label for="nome" class="control-label">Escolha o protocolo que gostaria de apensar: <span class="required-symbol">*</span></label>
                            <div class="input-group">
                                <input id="arrayApensados" type="hidden" value="" name="apensados">    
                                <div id="interessados" class="interessados"></div>
                            </div>
                            <br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">search</i>
                                    </span>
                                    <input id="pesquisa" placeholder="Pesquise aqui" class="form-control" type="text" name="pesquisa"/>
                                </div>
                            </div>
                    </div>
                </form>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">Número</th>
                            <th scope="col">Setor de Origem</th>
                            <th scope="col">Data de cadastro</th>
                            <th scope="col">Última modificação</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
        </div>

@endsection
@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN':"{{ csrf_token() }}"
                }
        });

        $("#doc-protocolo").submit(function (e){
            e.preventDefault();
            var idprotocolo = document.getElementById('id-protocolo').value;
            var form = $('#doc-protocolo')[0] 
            var dados = new FormData(form)
            console.log(form);
            $.ajax({
                url: main_url+'/protocolos/protocolos/acompanhar/'+idprotocolo,
                method:"POST",
                dataType:"html",
                data:dados,
                processData: false, 
                contentType: false,
                success:function(response){
                
                    var obj = JSON.parse(response); 
                    
                    $('#table-documento > tbody:last-child').append("<tr><td>"+obj.nome_documento+"</td><td>Teste</td></tr>");
                },
                error:function(err){
                console.log(err);
                }
            });
        })

        $(".doc-download").submit(function (e){
            e.preventDefault();

            var dados = $(this).serialize();
            console.log(dados);
            $.ajax({
                url: main_url+'/protocolos/protocolos/download',
                method:"POST",
                dataType:"html",
                data:dados,
                processData: false, 
                contentType: false,
                success:function(response){
                    console.log(response);
                    
                },
                error:function(err){
                    console.log(err);
                }
            });
        })
        
    </script>
    <script src="{{Module::asset('Protocolos:js/views/protocolo/acompanhar.js')}}"></script>
@endsection