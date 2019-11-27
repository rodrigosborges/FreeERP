@extends('funcionario::template')

@section('title')
{{ $data['title'] }}
@endsection

@section('body')
<form action="{{ $data['url'] }}" id="form" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@if($data['model'])
    @method('PUT')
@endif

    <!--Funcionario -->
    <div class="row">
        <div class="input-group col-md-12">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">person</i>
                </span>
            </div>
            <!--Select Funcionario -->

            <select disabled class="custom-select funcionario" id="funcionario" data-salario="{{$data['cargo']->salario}}" name="funcionario">
                
               <option value="{{ $funcionario->id }}" selected>{{ $data['funcionario']->nome }}</option>
               
            </select>
            <input type="hidden" name="funcionario_id" value="{{$data['funcionario']->id}}">

            <!--FIM Select Funcionario -->
            <span class="errors"> </span>
        </div>
    </div>
    <!--FIM Funcionario -->

    <br>

    <!--Cargo e Emissão -->

    <div class="row">
        <!--Cargo -->
        <div class="form-group mb-5 col-md-6">
            <label class="control-label" for="inputGroupSelect01">Cargo</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">work</i>
                    </span>
                </div>
                <!--Select Cargo -->
                <select class="custom-select cargos" id="cargos" data-salario="{{$data['cargo']->salario}}" name="cargos">
                    <option value="{{$data['cargo']->id}}">{{$data['cargo']->nome}}</option>
                </select>
                <!--FIM Select Cargo -->
            </div>
        </div>
        <!--FIM Cargo -->

        <!--Emissao -->
        <div class="form-group mb-5 col-md-6">
            <label class="control-label" for="emissao">Emissão</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons" for="emissao">calendar_today</i>
                    </span>
                </div>
                <input type="date" class="form-control required emissao" name="emissao" id="emissao" value="{{($data['model'] ? $data['model']->emissao :'')}}">
            </div>
        </div>
        <!--FIM Emissao -->
    </div>
    <!--FIM Cargo e Emissão -->

    <!--opção Pagamento e Horas extras -->
    <div class="row">
        <!--Opções Pagamento -->
        <div class="form-group mb-5 col-md-6">
            <label class="control-label" for="inputGroupSelect01">Opções</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <select class="custom-select opcao-pagamento" id="opcao-pagamento" name="opcao-pagamento">
                    <option value="-1">Selecione</option>
                    <option selected value="1">salario</option>
                    <option value="2">adiantamento</option>
                    <option value="3">ferias</option>
                </select>
            </div>
        </div>
        <!--Fim Opções Pagamento -->

        <!--Opções Pagamento -->
        <div class="form-group mb-5 col-md-6">
            <label class="control-label" for="inputGroupSelect01">Tipo Hora Extra</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <select class="custom-select tipo-hora-extra" id="tipo-hora-extra" name="tipo_hora_extra">
                    <option value="-1">Selecione</option>
                    <option selected value="1">100%</option>
                    <option value="2">50%</option>
                </select>
            </div>
        </div>
        <!--Fim Opções Pagamento -->

        <br>

        
    </div>
    <!--FIM opção Pagamento e Horas extras -->

    <div class="row">
        <!-- Horas Extras-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label"> Horas Extras (Inserir o valor em horas)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">access_time</i>
                    </span>
                </div>
                <input  type="text" name="horas_extras" id="horas_extras" class="horas_extras form-control required " value="{{$data['model'] ? $data['model']->horas_extras : ''}}">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Horas Extras-->

        <!-- Valor-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label">Valor Pagamento</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <input type="text" name="valor_pagamento" disabled name="valor" id="valor" class=" valor form-control valor required  valor_pagamento" value="{{$data['model'] ? $data['model']->valor : ''}}">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Valor-->

    </div>

    <br>

    <div class="row">
        <!-- Adicional Noturno-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label">Adicional Noturno</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <input type="text" name="adicional" id="adicional" class=" adicional1 form-control " value="{{$data['model'] ? $data['model']->adicional_noturno : ''}}">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Adicional Noturno-->

        <!-- INSS-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label">INSS</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <input type="text" readonly name="INSS" id="inss" class="form-control inss"  value="{{$data['model'] ? $data['model']->inss : ''}}">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim INSS-->

    </div>
    <div class="row">
        <!-- Faltas-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label"> Faltas</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">remove</i>
                    </span>
                </div>
                <input type="text" name="faltas" id="faltas" class=" faltas form-control required" value="{{$data['model'] ? $data['model']->faltas : ''}}">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Faltas-->

        <!--Total-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label"> Total</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <input type="text" name="total" id="total" placeholder="Total:"  readonly class="total form-control" value="{{$data['model'] ? $data['model']->total : ''}}">
            </div>
            <span class="errors"> </span>
        </div>
    </div>
    <!--FIM Total-->
</form>
@endsection

@section('footer')
<div class="text-right">
    <button class="btn btn-success sendForm" type="button">{{ $data['button'] }}</button>
</div>
@endsection

<!--------------JQUERY------------->
<!--author: Denise -->

@section('script')

<script src="{{Module::asset('funcionario:js/views/cargo/form.js')}}"></script>

<script>
    //Variaveis Globais
    var total;
    var cargos;
    var selectedCargo
    var falta
    var temporaria
    var adicional
    var salario = $('.funcionario').data('salario').replace('.','');
    salario =  salario.replace(',','.')
    
    //Função desabilitar: inputs 

    $(document).ready(function(e) {
        
        ////////////MAIN///////////////
        // autor: Denise Lopes

        $('.opcao-pagamento').change(function() {
            //chamar cálculo total
            calcular()
        })
        $('.tipo-hora-extra').change(function() {
            //chamar cálculo total
            calcular()
        })
        $('.horas_extras').change(function() {
            //chamar cálculo total
            calcular()
        })
        $('.adicional1').change(function() {
            //chamar cálculo total
            calcular()
        })
        $('.faltas').change(function() {
            //chamar cálculo total
            calcular()
        })

        //calcula salario, hora_extra, adicional noturno, inss

        function calcular() {
            calculaInss()

            if($("#tipo-hora-extra").val() == 1){
                var horas_extras = parseFloat((salario/220)*2);
                horas_extras *= $('.horas_extras').val();
            }else{
                var horas_extras = parseFloat((salario/220)*1.5);
                horas_extras *= $('.horas_extras').val();
            }

            //add noturno
            // var adicional = (salario/220)*0.2;
            var adicional = (parseFloat(salario)/220)*0.2;
            console.log(adicional)
            adicional *= $('.adicional1').val();
            
            var faltas = salario/30*($('.faltas').val())
            console.log("V.faltas="+faltas)

            var inss = parseFloat($('.inss').val())
            
            var desconto = faltas+inss;

            console.log("desconto:" + -desconto)
            var temp = parseFloat(salario + adicional + horas_extras)-desconto
            console.log("temp:"+temp)
            console.log("salaior:"+salario+" adicional not"+adicional+" horas extras"+horas_extras+"  -desconto"+desconto)
            
            $('.total').val(temp.toFixed(2)) //to fixed é para arrumar as casas decimais

        }
        //FIM - calcula salario, hora_extra, adicional noturno, inss

    })
    // autor: Denise Lopes
    function opcaoPagamento() {
        if ($('.opcao-pagamento').val() == -1) {
            $('.valor').val('')
            $('.inss').val('')
            $('.total').val('')
        }
    }

    function calculaInss() {              
        // Aliquota minima 
        //$('.valor').val(salario.toFixed(2))

        if (salario <= 1751.81) {
            formula = (parseFloat(salario) * 0.8);
            inss = formula;
        }else if(salario > 1751.81 && salario < 2979.72){
            formula = (parseFloat(salario) * 0.9);
            inss = formula;
        }else{
            formula = (parseFloat(salario) * 0.11);
            inss = formula;
        }
        

        total = parseFloat(salario) - inss;
        $('.total').val(total.toFixed(2))
        $('.inss').val(inss.toFixed(2));
     

    }
    //select de salario conforme id do cargo
   
    //https://trabalhista.blog/2015/01/30/dsr-horista-com-falta-nao-justificada-no-mes/
    /*  Somam-se as horas normais trabalhadas no mês;
        Divide-se o resultado pelo número de dias úteis;
        Multiplica-se pelo número de domingos e feriados;
        Multiplica-se pelo valor da hora normal.*/


  
    //desabilita e habilita inputs
    function desabilitar(opcao) {

        $('.cargos').attr('disabled', opcao);
        $('.cargos').attr('disabled', opcao);
        $('.emissao').attr('disabled', opcao);
        $('.opcao-pagamento').attr('disabled', opcao);
        $('.tipo-hora-extra').attr('disabled', opcao);
        $('.horas_extras').attr('disabled', opcao);
        $('.adicional1').attr('disabled', opcao);
        $('.faltas').attr('disabled', opcao);
    }
</script>

@endsection