@extends('protocolos::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')

    <form id="form-protocolo" action="{{ $data['url'] }}" method="POST" enctype="form-data">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif
        <div class="row">
        <input id="usuario_id" type="hidden" value="{{Auth::user()->id}}" name="protocolo['usuario_id']">    
            <div class="col-lg">
                <div class="form-group">
                    <label for="nome" class="control-label">Interessados: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <input id="arrayInteressados" type="hidden" name="interessados" value="">    
                        <div id="interessados" class="interessados"></div>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">search</i>
                            </span>
                        </div>
                        <input id="pesquisa" placeholder="Pesquise aqui" class="form-control" type="text" name="pesquisa"/>
                    </div>
                    <small id="error" class="errors font-text text-danger">{{$errors->first('interessados')}}</small>
                </div>

                <div class="form-group">
                    <label for="nome" class="control-label">Tipo de Protocolo: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">description</i>
                            </span>
                        </div>
                        <select required name="protocolo[tipo_protocolo_id]" id="tipo_protocolo" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($data['tipo_protocolo'] as $item)
                                <option value="{{ $item->id }}" {{ old('protocolo.tipo_protocolo_id', $data['model']? $data['model']->tipo_protocolo()->id : '') == $item->id ? 'selected' : '' }}> {{ $item->tipo }} </option>
                            @endforeach 
                        </select>
                    </div>
                    <small id="error" class="errors font-text text-danger">{{$errors->first('protocolo.tipo_protocolo_id')}}</small>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Despacho: <span class="required-symbol">*</span></label>
                    <textarea class="form-control" min="20" max="500" id="assunto" value="" name="assunto" rows="3">{{old('assunto', isset($protocolo) ? $protocolo->assunto : '')}}</textarea>
                    <small id="error" class="errors font-text text-danger">{{$errors->first('assunto')}}</small>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Nível de Acesso: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons lock-locked">lock</i>
                            </span>
                        </div>
                        <select required name="protocolo[tipo_acesso]" id="tipo_acesso" class="form-control">
                            <option value="">Selecione</option>
                            <option {{ old('protocolo.tipo_acesso', $data['model'] ? $data['model']->tipo_acesso : '') == '0' ? 'selected' : ''}} value='0'>Público</option>
                            <option {{ old('protocolo.tipo_acesso', $data['model'] ? $data['model']->tipo_acesso : '') == '1' ? 'selected' : ''}} value='1'>Privado</option>
                        </select>
                    </div>
                <small id="error" class="errors font-text text-danger">{{$errors->first('protocolo.tipo_acesso')}}</small>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-success sendForm" type="button">
                <i class="material-icons lock-locked" style="vertical-align:middle; font-size:25px; margin-right:5px;">save</i>{{$data['button']}}
        </button>
    </div>
@endsection

@section('script')
    <script type = "text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN':"{{ csrf_token() }}"
                }
            });
            $(document).ready(function(){
                $(".sendForm").on('click',function(){
                    $(".sendForm").prop("disabled",true) 
                    $("#form-protocolo").submit()  
                    console.log('success')
                })
            });
    </script>
    <script src="{{Module::asset('Protocolos:js/views/protocolo/form.js')}}"></script>
@endsection