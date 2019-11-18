@extends('protocolos::template')

@section('title', 'Encaminhar Protocolo')

@section('body')
<form id="form-protocolo" action="{{ $data['url'] }}" method="POST" enctype="form-data">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif
        <div class="row">
            <!-- <input id="usuario_id" type="hidden" value="{{Auth::user()->id}}" name="protocolo['usuario_id']">  -->
            <div class="col-lg">
            <div class="form-group">
                    <label for="nome" class="control-label">Encaminhar para: <span class="required-symbol">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">description</i>
                            </span>
                        </div>
                        <select required name="tramite[destino]" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($data['usuario'] as $item)
                                <option value="{{ $item->id }}" {{ old('usuario.usuario_id', $data['model']? $data['model']->usuario()->id : '') == $item->id ? 'selected' : '' }}> {{ $item->nome }} </option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome" class="control-label">Despacho: <span class="required-symbol">*</span></label>
                    <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
                </div>
            </div>
        </div>
@endsection
@section('footer')
    <div class="d-flex flex-row justify-content-between">
        <div class="">
            <a class="btn btn-dark" href="{{url('protocolos/protocolos/acompanhar')}}<?= '/'.$data['protocolo_id'] ?>">
                <i class="material-icons find_in_page" style="vertical-align:middle; font-size:25px; margin-right:5px;">arrow_back</i>Voltar
            </a>
        </div>
        <div class="">
            <button class="btn btn-success sendForm" type="button">
                <i class="material-icons find_in_page" style="vertical-align:middle; font-size:25px; margin-right:5px;">forward</i>{{$data['button']}}
            </button>
        </div>
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