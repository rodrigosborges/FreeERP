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
            @foreach($programacao as $atividade)
                <div id="{{$atividade->id}}" class="row divAtividade">
                    <div class="col-flex">
                        @if($atividade->palestrante->foto !== null && $atividade->palestrante->foto !== "")
                            <img src="http://127.0.0.1:8000/storage/palestrantes/{{$atividade->palestrante->foto}}" class="fotoPalestrante"/>
                        @else
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStl-KWsV0KVxQug2HoR6e3lx6UUSD4KAqyDbevILtDVDvs0YK1xA&s" class="fotoPalestrante"/>
                        @endif
                    </div>
                    <div class="col">
                        <p>
                            <i class="material-icons" style="vertical-align: middle;">calendar_today</i>
                            {{\Carbon\Carbon::parse($atividade->data)->format('d/m')}}
                            <i class="material-icons" style="vertical-align: middle;">schedule</i>
                            {{\Carbon\Carbon::parse($atividade->horario)->format('H:i')}}
                            <i class="material-icons" style="vertical-align: middle;">room</i>
                            {{$atividade->local}}
                        </p>
                        <h4 data-toggle="modal" data-target="#modalAtividade-{{$atividade->id}}" style="cursor: pointer;">{{$atividade->nome}}</h4>
                        <p style="margin-bottom: 0px;">{{$atividade->vagas}} vagas</p>
                    </div>
                    <div class="col-flex" style="display: flex; align-items: center; justify-content: center;">
                        <button class="btn btn-success">Inscreva-se</button>
                    </div>
                </div>
            
                <!-- MODAL -->
                <form method="get" action="">
                    {{ csrf_field() }}
                    <div class="modal fade" id="modalAtividade-{{$atividade->id}}" tabindex="-1" role="dialog" aria-labelledby="modalAtividade-{{$atividade->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tituloModal">{{$atividade->nome}}</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Tipo:</label>
                                        <select class="form-control" name="tipo" disabled>
                                            <option value="{{$atividade->tipo}}" disabled selected>{{$atividade->tipo}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="descricao" class="col-form-label">Descrição:</label>
                                        <textarea class="form-control" name="descricao" rows="5" disabled>{{$atividade->descricao}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                                <label for="data" class="col-form-label">Data:</label>
                                                <input type="date" class="form-control" name="data" value="{{$atividade->data}}" disabled>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                                <label for="horario" class="col-form-label">Horário:</label>
                                                <input type="time" class="form-control" name="horario" value="{{$atividade->horario}}" disabled>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                                <label for="duracao" class="col-form-label">Duração:</label>
                                                <input type="time" class="form-control" name="duracao" value="{{$atividade->duracao}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="local" class="col-form-label">Local:</label>
                                        <input type="text" class="form-control" name="local" value="{{$atividade->local}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                                                <label for="vagas" class="col-form-label">Vagas:</label>
                                                <input type="number" class="form-control" name="vagas" value="{{$atividade->vagas}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group palestrante">
                                        <label for="palestrante" class="col-form-label">Palestrante / Facilitador(a)</label>    
                                        <div class="form-group">
                                            @if($atividade->palestrante->foto !== null && $atividade->palestrante->foto !== "")
                                                <img src="http://127.0.0.1:8000/storage/palestrantes/{{$atividade->palestrante->foto}}" id="img" alt="Foto" title='Foto'/></br>
                                            @else
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStl-KWsV0KVxQug2HoR6e3lx6UUSD4KAqyDbevILtDVDvs0YK1xA&s" id="img" alt="Foto" title='Foto'/></br>
                                            @endif
                                            <input type='file' name="fotoPalestrante" id="fotoPalestrante" accept="image/*" hidden>
                                        </div>
                                        <div class="form-group" style="margin-top: -30px;">
                                            <label for="nomePalestrante" class="col-form-label">Nome:</label>
                                            <input type="text" class="form-control" name="nomePalestrante" value="{{$atividade->palestrante->nome}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="bio" class="col-form-label">Bio / Descrição:</label>
                                            <textarea class="form-control" name="bio" rows="4" disabled>{{$atividade->palestrante->bio}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>    
    @endif
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 borda centro">
        @if($evento->imagem !== null && $evento->imagem !== "")
            <img src="http://127.0.0.1:8000/storage/eventos/{{$evento->imagem}}" class="eventoImg"/>
        @endif
        <h3>Contato</h3>
        <p>{{$evento->empresa}}</p>
        @if($evento->email !== null && $evento->email !== "")
            <p style="margin-top: -10px;"><i class="material-icons" style="vertical-align: middle;">phone</i>{{$evento->telefone}}</p>
        @endif
        @if($evento->telefone !== null && $evento->telefone !== "")
            <p style="margin-top: -10px;"><i class="material-icons" style="vertical-align: middle;">mail</i>{{$evento->email}}</p>
        @endif
    </div>
    
    
@endsection

@section('js')
    @if(count($programacao) > 0)
        <script>
            $('#modalAtividade-{{$atividade->id}}').on('show.bs.modal');
        </script>
    @endif
@endsection

