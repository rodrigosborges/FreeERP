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
                        <input type="text" placeholder="Ex: 01/01/2019 08:00:00" name="stored[{{$ponto->id}}][entrada]" class="form-control date-valid date-mask" value="{{old('stored.'.$ponto->id.'.entrada', $ponto->formated_entrada())}}">
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
                        <input type="text" placeholder="Ex: 01/01/2019 08:00:00" name="stored[{{$ponto->id}}][saida]" class="form-control date-valid date-mask" value="{{old('stored.'.$ponto->id.'.saida', $ponto->formated_saida())}}">
                    </div>
                    <span class="errors"> {{ $errors->first('stored.'.$ponto->id.'.saida') }} </span>
                </div>
            </div>
        @endforeach



        <strong><h5 class="mt-3 text-center">Novos pontos</h5></strong><hr>

        @foreach($novosPontos as $key => $ponto)
            <div class="novosPontos">
                <div class="row novoPonto {{$ponto === [] ? 'd-none' : ''}}">
                    <div class="form-group col-md">
                        <label class="control-label">Entrada</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">update</i>
                                </span>
                            </div>
                            <input type="text" placeholder="Ex: 01/01/2019 08:00:00" name="new[{{$key}}][entrada]" class="form-control date-valid date-mask" value="{{old('new.'.$key.'.entrada')}}">
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
                            <input type="text" placeholder="Ex: 01/01/2019 18:00:00" name="new[{{$key}}][saida]" class="form-control date-valid date-mask" value="{{old('new.'.$key.'.saida')}}">
                        </div>
                        <span class="errors"> {{ $errors->first('new.'.$key.'.saida') }} </span>
                    </div>
                    <div class="col-md-1 pt-4 text-center">
                        <button type="button" class="btn btn-danger btn-sm removePonto"><i class="pt-1 material-icons">delete</i></button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-center">
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
    <script>

        jQuery.validator.addMethod("validDate", function(value, element) {
            var re = /([0][1-9]|[1][0-9]|[2][0-9]|[3][0-1])\/([0][1-9]|[1][0-2])\/([1][9][0-9]{2}|[2][0-9]{3})( ([0-1][0-9]|[2][0-3]):[0-5][0-9]:[0-5][0-9])/g
            return this.optional(element) || (!/Invalid|NaN/.test(new Date(value).toString()) && re.test(value));
            }, "Por favor, insira uma data válida no formato 00/00/0000 00:00:00");

        $(document).ready(function(){
            $(".sendForm").on('click',function(){
                if($("#form").valid()){
                    if($(".novoPonto").first().hasClass("d-none")){
                        $('.novoPonto').find('input').prop('disabled', true)
                    }
                    $(".sendForm").prop("disabled",true) 
                    $("#form").submit()  
                }
            })
            $('#form').validate({
                rules: {

                },
                messages:{}
            })
        })
        
        $("#addPonto").on('click', function(){
            var pontos = $(".novoPonto")
            if(pontos.length > 1 || !$(pontos).first().hasClass("d-none")){
                var newPonto = $(pontos).last().clone()

                newPonto.find('.error').remove();
                var inputs = newPonto.find('input');

                inputs.val("");

                inputs.map((i, input)=> {
                    var match = $(input).attr('name').match(/\[(\d+)]/g)[0]
                    var contador = parseInt(match.replace('[','').replace(']',''))+1
                    var newName = $(input).attr('name').replace(match, `[${contador}]`) 
                    $(input).attr('name', newName)
                })

                $(".novosPontos").append(newPonto)

                newPonto.find('input')
                    .mask("00/00/0000 00:00:00")
                    .removeAttr('aria-describedby')
                    .rules('add', {
                        required:true, 
                        validDate: true,
                    })
            }else{
                $(pontos[0]).removeClass("d-none")
            }
        })

        $(document).on('click', ".removePonto",  function(){
            var pontos = $(".novoPonto")
            if(pontos.length > 1){
                $(this).closest(".novoPonto").remove()
            }else if(!$(this).closest(".novoPonto").hasClass('d-none')){
                $(this).closest(".novoPonto").addClass('d-none')
            }
        })

        $(".date-mask").mask("00/00/0000 00:00:00")

        $(document).ready(function(){
            $(".date-valid").each(function(){
                $(this).rules("add", { 
                    required:true,  
                    validDate: true,
                });
            })
        })
    </script>
@endsection