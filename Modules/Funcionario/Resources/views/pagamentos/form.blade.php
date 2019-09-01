@extends('funcionario::template')

@section('title')
{{ $data['title'] }}
@endsection

@section('body')
<form action="{{ $data['url'] }}" id="form" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-group col-md-12">

            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">person</i>
                </span>
            </div>
            <select class="custom-select" id="funcionario">
                <!--Select Funcionario -->
                <option selected value="-1">Selecione um Funcionário</option>
                @foreach($funcionarios as $funcionario)
                <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                @endforeach
            </select>
            <span class="errors"> </span>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="form-group mb-5 col-md-6">
            <label class="control-label" for="inputGroupSelect01">Cargo</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">work</i>
                    </span>
                </div>
                <select class="custom-select" id="cargos">
                    <option value='0'>Selecione</option>

                </select>
            </div>
        </div>
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

    </div>
    <!--<div class="form-group col-md-12">
            <label for="nome" class="control-label">Nome do funcionario</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">person</i>
                    </span>
                </div>
                <input type="text" name="nome" id="nome" class="form-control required" value="" disabled>
            </div>
            <span class="errors"> </span>
        </div>
    </div>-->

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

                    <option selected value="1">Salário</option>
                    <option value="2">Adiantamento</option>
                    <option value="2">Férias</option>
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
                <input type="text" name="horas_extras" id="h_extra" class="form-control required money">
            </div>
            <span class="errors"> </span>
        </div>
        <!-- Fim Horas Extras-->

    </div>

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
    $(document).ready(function(e) {

        function recalcular(tipo) {
            var temp




            if (tipo == 1) {
                if ($('#faltas').val() == ""&& $('#faltas').val()==0) {
                    adicional = parseFloat($('.adicional1').val())
                    temp = total + adicional;
                    alert(adicional + "- " + temp)
                    $('#total').val(temp)
                    
                } else {
                    temp = total + parseFloat($('.adicional1').val());
                    $('#total').val(temp)
                }
                console.log("adicional:" + adicional + " - temp:" + temp + " total:" + total)

            }
            if (tipo == 2) {
                if ($("#faltas").val() != "") {

                    falta = parseInt($('#faltas').val())
                    var valor_hora = parseFloat(selectedCargo.salario) / parseFloat(selectedCargo.horas_semanais)
                    var horas_dia = (selectedCargo.horas_semanais / 5)
                    var horas_trabalhada = selectedCargo.horas_semanais - (horas_dia * falta)
                    var desconto = (parseFloat(selectedCargo.salario) / 30) * (horas_dia * falta)
                    temp = total - desconto
                    $('#total').val(temp)
                    console.log("valor hora:" + valor_hora + "- horas dia:" + horas_dia + "-horas trabalhadas:" + horas_trabalhada + " - Desconto :" + desconto + "vat total:" + total + "total_temp:" + temp)
                }
            }

        }

        $('.adicional1').blur(function() {
            recalcular(1)
        })
        $('#faltas').change(function() {
            recalcular(2)
        })
        // quando tirado o foco do select de funcionario ele dispara a função
        //a função faz uma requisição ajax para a pagina buscaCargos
        // autor: Denise Lopes
        $('#funcionario').change(function() {
            buscaFuncionario()
        })
        // select de cargo
        // autor: Denise Lopes
        $('#cargos').change(function() {
            buscaSalario()
        })
        $('#opcao-pagamento').change(function() {
            opcaoPagamento()
        })



    })
    // autor: Denise Lopes
    function opcaoPagamento() {
        if ($('#opcao-pagamento').val() != 1) {
            $('#valor').val('')
            $('#inss').val('')
            $('#total').val('')
        } else {
            buscaSalario()
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

            var salario;

            if (data != null && data != "") {
                var salario = parseFloat(data)

                formula = (salario * 8) / 100;
                // Aliquota minima 
                $('#valor').val(salario)
                if (salario <= 1751.81) {
                    inss = formula;

                } else if (data > 1751.81) {
                    inss = formula;

                } else {
                    inss = formula;
                }
                total = salario - inss;
                $('#total').val(total)

                $('#inss').val(inss);
            } else {

                $('#valor').val("")
                $('#inss').val("")
                $('#total').val("")

            }


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
            string = " <option value='0'>Selecione</option>"
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