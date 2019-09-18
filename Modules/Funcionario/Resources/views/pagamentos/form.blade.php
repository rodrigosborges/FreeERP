@extends('funcionario::template')

@section('title')
{{ $data['title'] }}
@endsection

@section('body')
<form action="{{url('funcionario/pagamento')}}" id="form" method="POST" enctype="multipart/form-data">
@if($data['pagamento'])
    @method('put')
@endif

    {{ csrf_field() }}

    <!--Funcionario -->
    <div class="row">
        <div class="input-group col-md-12">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">person</i>
                </span>
            </div>
            <!--Select Funcionario -->

            <select class="custom-select funcionario" id="funcionario" $data-salario="{{$data['cargo']->salario}}" name="funcionario">
                @foreach($data['funcionarios'] as $funcionario)
                <option value="{{ $funcionario->id }}" {{($data['pagamento']) && $data['pagamento']->funcionario->id == $funcionario->id?'selected':''}}>{{ $funcionario->nome }}</option>
                @endforeach

            </select>

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
                <input type="date" class="form-control required emissao" name="emissao" id="emissao" value="{{!is_null($data['pagamento'] ? $data['pagamento']->emissao :'')}}">
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
                    <option selected value="1">Salário</option>
                    <option value="2">Adiantamento</option>
                    <option value="3">Férias</option>
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
            <label for="salario" class="control-label"> Horas Extras</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">access_time</i>
                    </span>
                </div>
                <input value='0' type="text" name="horas_extras" id="horas_extras" class="horas_extras form-control required " value="{{$data['pagamento'] ? $data['pagamento']->horas_extras : ''}}">
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
                <input type="text" name="valor_pagamento" disabled name="valor" id="valor" class=" valor form-control valor required  valor_pagamento" value="">
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
                <input value='0' type="text" name="adicional" id="adicional" class=" adicional1 form-control " value="{{$data['pagamento'] ? $data['pagamento']->adicional_noturno : ''}}">
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
                <input type="text" readonly name="INSS" id="inss" class="form-control inss" value="8"  value="{{$data['pagamento'] ? $data['pagamento']->inss : ''}}">
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
                <input value='0' type="text" name="faltas" id="faltas" class=" faltas form-control required   " value="{{$data['pagamento'] ? $data['pagamento']->faltas : ''}}">
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
                <input type="text" name="total" id="total" placeholder="Total:"  readonly class="total form-control">
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
    
    //Função desabilitar: inputs 

    $(document).ready(function(e) {
        var dados = $('.salario').dataset.salario.val();
        alert(dados);
        if ($('.funcionario').val() != -1) {
            desabilitar(false)
            buscaFuncionario()
        } else {
            desabilitar(true)
        }
        ////////////MAIN///////////////
        //Chamadas de funções:funções
        // quando tirado o foco do select de funcionario ele dispara a função
        //a função faz uma requisição ajax para a pagina buscaCargos
        // select de cargo
        // autor: Denise Lopes


        //verificação para habilitar busca funcionario
        $('.funcionario').change(function() {

            if ($('.funcionario').val() == -1) {
                desabilitar(true)
                $('.valor').val('')
                $('.inss').val('')
                $('.total').val('')
            } else
                buscaFuncionario()
        })

        //No selecione ele não permanece com os dados do funcionario
        $('.cargos').change(function() {

            //Se cargo for igual a selecione    
            if ($('.cargos').val() != -1) {
                buscaSalario()
                $('.emissao').val('')
                desabilitar(true)
            } else {
                desabilitar(true)
                $('.funcionario').attr('disabled', false)
                $('.cargos').attr('disabled', false)
                $('.valor').val('')
                $('.inss').val('')
                $('.total').val('')

            }
        })

        $('.opcao-pagamento').change(function() {

            opcaoPagamento()
        })

        $('.emissao').change(function() {
            $('.opcao-pagamento').attr('disabled', false)
            desabilitar(false)
        })
        // Mantém os inputs em cache:
        var inputs = $('input');

        // Chama a função de verificação quando as entradas forem modificadas
        // Usei o 'keyup', mas 'change' ou 'keydown' são também eventos úteis aqui
        inputs.on('keyup', verificarInputs);

        verificarInputs()
        ////////////FIM "MAIN"///////////////

        ///////FUNÇÕES/////////
        function verificarInputs() {
            var preenchidos = true; // assumir que estão preenchidos
            inputs.each(function() {
                // verificar um a um e passar a false se algum falhar
                // no lugar do if pode-se usar alguma função de validação, regex ou outros
                // console.log(this)
                if (!this.value) {
                    preenchidos = false;
                    // parar o loop, evitando que mais inputs sejam verificados sem necessidade
                    //return false;
                }

            });
            // Habilite, ou não, o <button>, dependendo da variável:
            $('button').prop('disabled', !preenchidos); // 
            if (preenchidos) {
                calcular()
            }

        }

        //calcula salario, hora_extra, adicional noturno, inss

        function calcular() {

            console.log("Valor salario :" + selectedCargo.salario + "hora Extra:" + $('#horas_extras').val() + "Adicional noturno:" + $('.adicional1').val() + " Faltas:" + $('#faltas').val())
            var salario = parseFloat(selectedCargo.salario)
            if($("#tipo-hora-extra").val() == 1){
                var horas_extras = parseFloat((salario/220)*2);
                horas_extras *= $('.horas_extras').val();
            }else{
                var horas_extras = parseFloat((salario/220)*1.5);
                horas_extras *= $('.horas_extras').val();
            }

            //add noturno
            var adicional = parseFloat((salario/220)*0.2);
            adicional *= $('.adicional1').val();
            

            var faltas = salario/30*($('.faltas').val())
            console.log("V.faltas="+faltas)

            var inss = parseFloat($('.inss').val())
            
            var desconto = faltas+inss;


            console.log("desconto:" + -desconto)
            var temp = (salario + adicional + horas_extras)-desconto
            console.log("salaior:"+salario+" adicional not"+adicional+" horas extras"+horas_extras+"  -desconto"+desconto)
            console.log("temp:"+temp)
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
        } else {
            buscaSalario()
        }
    }

    function calculaInss() {
        //var salario = $('.cargo').("data-id").val();

        if (data != null && data != "") {
            salario = data.salario
            
            
            // Aliquota minima 
            $('.valor').val(salario.toFixed(2))
            if (salario <= 1693.72) {
                formula = (parseFloat(salario) * 0.8);
                inss = formula;
            }else if(salario > 1693.73 && salario < 2222.90){
                formula = (parseFloat(salario) * 0.9);
                inss = formula;
            }else{
                formula = (parseFloat(salario) * 0.11);
                inss = formula;
            }
            

            total = parseFloat(salario) - inss;
            $('.total').val(total.toFixed(2))

            $('.inss').val(inss.toFixed(2));
        } else {

            $('.valor').val("")
            $('.inss').val("")
            $('.total').val("")

        }

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