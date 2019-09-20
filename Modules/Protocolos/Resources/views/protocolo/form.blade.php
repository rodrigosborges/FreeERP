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
            <div class="col-lg-9">
                <div class="form-group">
                    <label for="nome" class="control-label">Interessados: <span class="required-symbol">*</span></label>
                        <div class="input-group">
                       
                            <input id="arrayInteressados" type="hidden" value="{{isset($interessado->id) ? $interessado->id : ''}}" name="interessados">
                           
                        <div id="interessados" class="interessados">

                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <input id="pesquisa" class="form-control" type="text" name="pesquisa"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Tipo de processo: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">person</i>
                            </span>
                        </div>
                        <select required name="protocolo[tipo_protocolo_id]" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($data['tipo_protocolo'] as $item)
                                <option value="{{ $item->id }}" {{ old('tipo_protocolo.tipo_protocolo_id', $data['model']? $data['model']->tipo_protocolo()->id : '') == $item->id ? 'selected' : '' }}> {{ $item->tipo }} </option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Assunto: <span class="required-symbol">*</span></label>
                    <textarea class="form-control" id="assunto" name="assunto" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Nível de Acesso: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons lock-locked">lock</i>
                            </span>
                        </div>
                        <select required name="protocolo[tipo_acesso_id]" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($data['tipo_acesso'] as $item)
                                <option value="{{ $item->id }}" {{ old('tipo_acesso.tipo_acesso_id', $data['model']? $data['model']->tipo_acesso()->id : '') == $item->id ? 'selected' : '' }}> {{ $item->tipo }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Setor de Criação: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">business</i>
                            </span>
                        </div>
                        <select required name="protocolo[setor_id]" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($data['setor'] as $item)
                                <option value="{{ $item->id }}" {{ old('setor.setor_id', $data['model']? $data['model']->setor()->id : '') == $item->id ? 'selected' : '' }}> {{ $item->nome }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-success sendForm" type="button">{{$data['button']}}</button>
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