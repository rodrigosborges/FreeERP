@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    <style>
        .borda{
            border-top: 1px solid gray;
            padding-top: 10px;
        }
        
        .centro{
            text-align: center;
        }
        
        .eventoImg{
            padding-bottom: 10px;
        }
        
        .fotoPalestrante{
            max-width: 100px;
            border-radius: 50%;
        }
        
        .divAtividade{
            padding: 10px;
            border: 0.1px solid lightgrey;
            margin-bottom: 5px;
        }
        
        .palestrante {
            padding: 20px 20px 0px 20px;
            border-radius: 1%;
            border: 1px solid #ced4da;
        }
        
        #img{
            max-height:150px;
            max-width: 150px;
            height:auto;
            width:auto;
            display:block;
            margin-left: auto;
            margin-right: auto;
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" align="center">
        <h1>{{$evento->nome}}</h1>
        <p><i class="material-icons" style="vertical-align: middle;">room</i>{{$evento->local}} - {{$evento->cidade->nomeCidade}} / {{$evento->cidade->estado->uf}}</p>
    </div>
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 borda">
        <h2 class="centro">Descrição</h2>
        <p>{!!$evento->descricao!!}</p>
    </div>
    @if(count($programacao) > 0)
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 borda">
            <h2 class="centro">Atividades</h2>
            <input type="text" value="{{$evento->id}}" id="id" hidden>
        </div>
        <div class="container">
            <ul class="nav nav-tabs">
                @foreach($datas as $data)
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#{{$data}}">{{\Carbon\Carbon::parse($data)->format('d/m')}}</a>
                    </li>                    
                @endforeach
            </ul>
            
            <div class="tab-content">
                @foreach($datas as $data)
                    <div class="tab-pane" id="{{$data}}"></div>
                @endforeach
            </div>
            @foreach($programacao as $atividade)
                @foreach($datas as $data)
                    <div class="tab-pane" id="{{$data}}">
                        {{$data}}
                       @if($atividade->data == $data)
                            <div id="{{$atividade->id}}" class="row divAtividade">
                                <div class="col-flex">
                                    @if($atividade->palestrante->foto !== null && $atividade->palestrante->foto !== "")
                                        <img src="http://127.0.0.1:8000/storage/palestrantes/{{$atividade->palestrante->foto}}" class="fotoPalestrante"/>
                                    @else
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStl-KWsV0KVxQug2HoR6e3lx6UUSD4KAqyDbevILtDVDvs0YK1xA&s" class="fotoPalestrante"/>
                                    @endif
                                </div>
                                <div class="col">
                                    <p><i class="material-icons" style="vertical-align: middle;">schedule</i>{{\Carbon\Carbon::parse($atividade->horario)->format('H:i')}} <i class="material-icons" style="vertical-align: middle;">room</i>{{$atividade->local}}</p>
                                    <h4 data-toggle="modal" data-target="#modalAtividade" style="cursor: pointer;" onclick="visualizar()">{{$atividade->nome}}</h4>
                                    <p style="margin-bottom: 0px;">{{$atividade->vagas}} vagas</p>
                                </div>
                                <div class="col-flex" style="display: flex; align-items: center; justify-content: center;">
                                    <button class="btn btn-success">Inscreva-se</button>
                                </div>
                            </div>
                       @endif
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 borda centro">
        <img src="http://127.0.0.1:8000/storage/eventos/{{$evento->imagem}}" class="eventoImg"/>
        <h3>Contato</h3>
        <p>{{$evento->empresa}}</p>
        @if($evento->email !== null && $evento->email !== "")
            <p style="margin-top: -10px;"><i class="material-icons" style="vertical-align: middle;">phone</i>{{$evento->telefone}}oi</p>
        @endif
        <p style="margin-top: -10px;"><i class="material-icons" style="vertical-align: middle;">mail</i>{{$evento->email}}</p>
    </div>
    
    
@endsection

@section('js')
    <script>
        $('#modalAtividade').on('show.bs.modal');
        $('.nav-tabs a:first').tab('show');
        $('.nav-tabs a').click(function(){
            $(this).tab('show');
        });
        var id = $('#id').val();
        
        $.get('/eventos/get-programacao/' + id, function (programacao){
            $.each(programacao, function (index, value){
                
                if(value.data === '.tab-pane #id.val()'){
                    console.log('igual!');
                    /*<div id="{{$atividade->id}}" class="row divAtividade">
                        <div class="col-flex">
                            @if($atividade->palestrante->foto !== null && $atividade->palestrante->foto !== "")
                                <img src="http://127.0.0.1:8000/storage/palestrantes/{{$atividade->palestrante->foto}}" class="fotoPalestrante"/>
                            @else
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStl-KWsV0KVxQug2HoR6e3lx6UUSD4KAqyDbevILtDVDvs0YK1xA&s" class="fotoPalestrante"/>
                            @endif
                        </div>
                        <div class="col">
                            <p><i class="material-icons" style="vertical-align: middle;">schedule</i>{{\Carbon\Carbon::parse($atividade->horario)->format('H:i')}} <i class="material-icons" style="vertical-align: middle;">room</i>{{$atividade->local}}</p>
                            <h4 data-toggle="modal" data-target="#modalAtividade" style="cursor: pointer;" onclick="visualizar()">{{$atividade->nome}}</h4>
                            <p style="margin-bottom: 0px;">{{$atividade->vagas}} vagas</p>
                        </div>
                        <div class="col-flex" style="display: flex; align-items: center; justify-content: center;">
                            <button class="btn btn-success">Inscreva-se</button>
                        </div>
                    </div>*/
                }
            });
        });
    </script>
@endsection

