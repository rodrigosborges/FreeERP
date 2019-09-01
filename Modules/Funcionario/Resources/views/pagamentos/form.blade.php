@extends('funcionario::template')

@section('title')
{{ $data['title'] }}
@endsection

@section('body')
<form action="{{ $data['url'] }}" id="form" method="POST" enctype="multipart/form-data">

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
            <select class="custom-select" id="funcionario">
                <option selected value="-1">Selecione um Funcionário</option>
                @foreach($funcionarios as $funcionario)
                <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
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
                <select class="custom-select" id="cargos">
                    <option value='-1'>Selecione</option>
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
                <input type="date" class="form-control required" name="emissao" id="emissao">
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
                <select class="custom-select" id="opcao-pagamento">
                    <option value="-1">Selecione</option>
                    <option selected value="1">Salário</option>
                    <option value="2">Adiantamento</option>
                    <option value="3">Férias</option>
                </select>
            </div>
        </div>
        <!--Fim Opções Pagamento -->

        <br>

        <!-- Horas Extras-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label"> Horas Extras</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">access_time</i>
                    </span>
                </div>
                <input type="text" name="horas_extras" id="horas_extras" class="form-control required money">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Horas Extras-->
    </div>
    <!--FIM opção Pagamento e Horas extras -->

    <div class="row">
        <!-- Valor-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label">Valor Pagamento</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <input type="text" placeholder="" disabled name="valor" id="valor" class="form-control required money">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Valor-->

        <!-- Adicional Noturno-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label">Adicional Noturno</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <input type="text" name="adicional" id="adicional" class=" adicional1 form-control money">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Adicional Noturno-->
    </div>

    <br>

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
                <input type="text" name="faltas" id="faltas" class="form-control required money">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Faltas-->

        <!-- INSS-->
        <div class="form-group col-md-6">
            <label for="salario" class="control-label">INSS</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <!-- REFAZER -->
                <input type="text" name="inss" id="inss" class="form-control required money" value="8" disabled>
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim INSS-->
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="salario" class="control-label"> Total</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">attach_money</i>
                    </span>
                </div>
                <input type="text" name="faltas" id="total" placeholder="Total:" disabled class="form-control  ">
            </div>
            <span class="errors"> </span>
        </div>
    </div>
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

    //Função desabilitar: inputs conforme preenchimento do campo

    $(document).ready(function(e) {
////////////MAIN///////////////
        //Chamadas de funções:funções
        // quando tirado o foco do select de funcionario ele dispara a função
        //a função faz uma requisição ajax para a pagina buscaCargos
        // select de cargo
        // autor: Denise Lopes


        //verificação para habilitar busca funcionario
        $('#funcionario').change(function() {
            if ($('#funcionario').val() == -1) {
                desabilitar(true)
                $('#valor').val('')
                $('#inss').val('')
                $('#total').val('')
            } else
                buscaFuncionario()
        })

        //No selecione ele não permanece com os dados do funcionario
        $('#cargos').change(function() {


            if ($('#cargos').val() != -1) {
                buscaSalario()
                $('#emissao').val('')
            } else {
                desabilitar(true)
                $('#funcionario').attr('disabled', false)
                $('#cargos').attr('disabled', false)
                $('#valor').val('')
                $('#inss').val('')
                $('#total').val('')

            }
        })

        $('#opcao-pagamento').change(function() {

            opcaoPagamento()
        })

        $('#emissao').change(function() {
            $('#opcao-pagamento').attr('disabled', false)
            desabilitar(false)
        })
        // Mantém os inputs em cache:
        var inputs = $('input');

        // Chama a função de verificação quando as entradas forem modificadas
        // Usei o 'keyup', mas 'change' ou 'keydown' são também eventos úteis aqui
        inputs.on('keyup', verificarInputs);

        verificarInputs()
////////////FIM "MAIN"///////////////

        //FUNÇÕES
        function verificarInputs() {
            var preenchidos = true; // assumir que estão preenchidos
            inputs.each(function() {
                // verificar um a um e passar a false se algum falhar
                // no lugar do if pode-se usar alguma função de validação, regex ou outros
                console.log(this)
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
            var horas_extras = parseFloat($('#horas_extras').val())
            var valor_dia = salario / 20
            var horas_dias = parseFloat(selectedCargo.horas_semanais / 5)
            var valor_hora_extra = (valor_dia / 8) * horas_extras
            var adicional = parseFloat($('.adicional1').val())
            var faltas = parseFloat($('#faltas').val())
            var inss = parseFloat($('#inss').val())
            var desconto = salario / 30 * (faltas * horas_dias)

            console.log("desconto:" + -desconto)
            var temp = total;

            //do total ele efetua os descontos e soma os extras
            temp -= desconto
            temp += (valor_hora_extra + adicional)
            console.log(temp)
            $('#total').val(temp.toFixed(2)) //to fixed é para arrumar as casas decimais
            console.log("valor hora:" + valor_dia / 8)

        }

        //FIM - calcula salario, hora_extra, adicional noturno, inss


        desabilitar(true)

        function desabilitar(opcao) {

            $('#cargos').attr('disabled', opcao);
            $('#cargos').attr('disabled', opcao);
            $('#emissao').attr('disabled', opcao);
            $('#opcao-pagamento').attr('disabled', opcao);
            $('#horas_extras').attr('disabled', opcao);
            $('.adicional1').attr('disabled', opcao);
            $('#faltas').attr('disabled', opcao);
        }

    })
    // autor: Denise Lopes
    function opcaoPagamento() {
        if ($('#opcao-pagamento').val() == -1) {
            $('#valor').val('')
            $('#inss').val('')
            $('#total').val('')
        } else {
            buscaSalario()
        }
    }

    function calculaInss(data) {
        var salario;

        if (data != null && data != "") {
            salario = parseFloat(data)

            formula = (salario * 8) / 100;
            // Aliquota minima 
            $('#valor').val(salario.toFixed(2))
            if (salario <= 1751.81) {
                inss = formula;

            } else if (data > 1751.81) {
                inss = formula;

            } else {
                inss = formula;
            }
            total = salario - inss;
            $('#total').val(total.toFixed(2))

            $('#inss').val(inss.toFixed(2));
        } else {

            $('#valor').val("")
            $('#inss').val("")
            $('#total').val("")

        }

    }

    function buscaSalario() {
        $.ajax({
            url: main_url + "/buscasalario",
            datatype: 'json',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#cargos').val()
            }
            //data é igual a salário
        }).done(function(data) {

            $('#emissao').attr('disabled', false)
            if ($('#opcao-pagamento').val() == 2) {
                var valor = parseFloat(data) * 0.4

                calculaInss(valor)
                console.log("Adiantamento:" + valor)
            } else
                calculaInss(data)

            // $('#opcao-pagamento').attr('disabled',false)
            // $('#horas_extras').attr('disabled',false)
            // $('.adicional1').attr('disabled',false)
            // $('#faltas').attr('disabled',false)


            console.log()
            $.each(cargos, function(chave, valor) {
                if (valor.id == $('#cargos').val()) {
                    selectedCargo = valor
                }
                /* 
                var valor_hora = valor.salario / valor.horas_semanais
                var horas_dia = (valor.horas_semanais / 5)
                var horas_trabalhada = valor.horas_semanais - (horas_dia * falta)
                var desconto = horas_trabalhada / 20 * 4 * valor_hora
                */
            })
            console.log(selectedCargo.horas_semanais)


            //alert(desconto)
            //  

        }).fail(function() {

        })
    }
    //https://trabalhista.blog/2015/01/30/dsr-horista-com-falta-nao-justificada-no-mes/
    /*  Somam-se as horas normais trabalhadas no mês;
        Divide-se o resultado pelo número de dias úteis;
        Multiplica-se pelo número de domingos e feriados;
        Multiplica-se pelo valor da hora normal.*/


    function buscaFuncionario() {
        $.ajax({
            url: main_url + "/buscacargos",
            datatype: 'json',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#funcionario').val()
            }
        }).done(function(data) {
            //após capturar os cargos ele faz um foreach nos cargos e adiciona em uma string 
            // que posteriormente é enviada para o select de cargos
            cargos = $.parseJSON(data);
            $('#cargos').attr('disabled', false)
            string = " <option value='-1'>Selecione</option>"
            $.each(cargos, function(chave, valor) {
                string += '<option value="' + valor.id + '">' + valor.nome + "</option>"
                console.log(valor.horas_semanais);


                //  console.log(desconto)

            })

            $('#cargos').html(string);
        }).fail(function() {})





    }
</script>

@endsection