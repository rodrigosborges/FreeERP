@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
    <form action='{{ url("funcionario/frequencia/".$data["id"]."/update/".$data["ano"]."/".$data["mes"]) }}' id="form" method="POST" enctype="multipart/form-data">
        
        @csrf

        @method('PUT')

        <strong><h5 class="mb-3 text-center">Pontos registrados</h5></strong><hr>

        <?php 
            $novosPontos = old('new', [[]]);
        ?>

        @foreach($data['pontos'] as $key => $ponto)
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label">Entrada</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">update</i>
                            </span>
                        </div>
                        <input type="text" initial="{{old('stored.'.$ponto->id.'.entrada', $ponto->formated_entrada())}}" placeholder="Ex: 01/01/2019 08:00:00" name="stored[{{$ponto->id}}][entrada]" class="form-control required date-stored date-validate date-mask" value="{{old('stored.'.$ponto->id.'.entrada', $ponto->formated_entrada())}}">
                    </div>
                    <span class="errors"> {{ $errors->first('stored.'.$ponto->id.'.entrada') }} </span>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label">Saída {{$ponto->automatico == 1 ? "- Automático" : ""}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">update</i>
                            </span>
                        </div>
                        <input type="text" initial="{{old('stored.'.$ponto->id.'.saida', $ponto->saida ? $ponto->formated_saida() : '')}}" placeholder="Ex: 01/01/2019 08:00:00" name="stored[{{$ponto->id}}][saida]" class="form-control required date-stored date-validate date-mask" value="{{old('stored.'.$ponto->id.'.saida', $ponto->saida ? $ponto->formated_saida() : '')}}">
                    </div>
                    <span class="errors"> {{ $errors->first('stored.'.$ponto->id.'.saida') }} </span>
                </div>
                <div class="form-group col-md-12 d-none stored-justificativa">
                    <label class="control-label">Justificativa</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">text_fields</i>
                            </span>
                        </div>
                        <textarea initial="{{$ponto->justificativa}}" placeholder="Insira sua justificativa aqui" name="stored[{{$ponto->id}}][justificativa]" class="form-control required" rows=2>{{old('stored.'.$ponto->id.'.justificativa', $ponto->justificativa)}}</textarea>
                    </div>
                    <span class="errors"> {{ $errors->first('stored.'.$ponto->id.'.justificativa') }} </span>
                </div>
            </div>
        @endforeach



        <strong><h5 class="mt-3 text-center">Novos pontos</h5></strong><hr>

        @foreach($novosPontos as $key => $ponto)
            <div class="novosPontos">
                <div class="row novoPonto {{$ponto === [] ? 'd-none' : ''}}">
                    <div class="col-md">
                        <div class="row">
                            <div class="form-group col-md">
                                <label class="control-label">Entrada</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">update</i>
                                        </span>
                                    </div>
                                    <input type="text" placeholder="Ex: 01/01/2019 08:00:00" name="new[{{$key}}][entrada]" class="form-control date-validate date-mask required" value="{{old('new.'.$key.'.entrada')}}">
                                </div>
                                <span class="errors"> {{ $errors->first('new.'.$key.'.entrada') }} </span>
                            </div>
                            <div class="form-group col-md">
                                <label class="control-label">Saída</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">update</i>
                                        </span>
                                    </div>
                                    <input type="text" placeholder="Ex: 01/01/2019 18:00:00" name="new[{{$key}}][saida]" class="form-control date-validate date-mask required" value="{{old('new.'.$key.'.saida')}}">
                                </div>
                                <span class="errors"> {{ $errors->first('new.'.$key.'.saida') }} </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Justificativa</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">text_fields</i>
                                        </span>
                                    </div>
                                    <textarea placeholder="Insira sua justificativa aqui" name="new[{{$key}}][justificativa]" class="form-control required" rows=2>{{old('new.'.$key.'.justificativa')}}</textarea>
                                </div>
                                <span class="errors"> {{ $errors->first('new.'.$key.'.justificativa') }} </span>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-1 button-remove-ponto text-center">
                        <button type="button" class="btn btn-danger btn-sm removePonto"><i class="pt-1 material-icons">delete</i></button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-center mt-3">
            <button type="button" id="addPonto" class="btn btn-success btn-sm"><i class="pt-1 material-icons">add</i></button>
        </div>

    </form>
@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-success sendForm" type="button">Atualizar</button>
    </div>
@endsection

@section('script')
    <script src="{{Module::asset('funcionario:js/views/frequencia/form.js')}}"></script>
@endsection