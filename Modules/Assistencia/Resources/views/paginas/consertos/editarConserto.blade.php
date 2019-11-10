@extends('assistencia::layouts.master')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
<div class="card text-center">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h4>Editar ordem de serviço</h4>
            <a href="{{route('consertos.index')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <form class="col-md-8" action="{{route('consertos.atualizar', $id)}}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('assistencia::paginas.consertos._formEdit')
                <button class="btn btn-success">Salvar</button>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.multi-select').select2();

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    var pecas = $('#valor_peca').val()
    $('#valor_peca').click(function() {
        console.log(pecas);
    })
})
</script>
<script>
$(document).ready(function() {

    $(document).mouseover(function() {
        var valor = 0;
        $('#valor_peca > option:selected').each(function(index, element) {
            valor = valor + Number.parseFloat($(element).attr('data-valor'));
        });
        $('#valor_servico > option:selected').each(function(index, element) {
            valor = valor + Number.parseFloat($(element).attr('data-valor'));
        });
        $('#valorTotal').val(valor);


    });
    $("[name='sinal']").inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ",",
                'digitsOptional': false,
                'allowMinus': false,
                'prefix': 'R$ ',
                'placeholder': '',
                'rightAlign':false,
                'max': 9999,
                'removeMaskOnSubmit':true
    });
    $('#valorTotal').inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ",",
                'digitsOptional': false,
                'allowMinus': false,
                'prefix': 'R$ ',
                'placeholder': '',
                'rightAlign':false,
                'max': 9999,
                 'removeMaskOnSubmit':true
    });
    $('#salvar').click(function() {
        if ($('#valor_peca').val() == null) {
            $('#valor_peca').val(0)

        }
        if ($('#valor_servico').val() == null) {
            $('#valor_servico').val(0)
            console.log($('valor_servico').val())
        }
    })
})

$('#selecionarCliente').change(function() {

    var dados = $('#selecionarCliente option:selected').attr("data-puxar")
    inserirDadosCliente(dados)
})

function inserirDadosCliente(val) {

    $.ajax({
        type: "GET",
        url: `${main_url}/assistencia/conserto/dadosCliente`,
        data: {
            'nome': val
        },
        success: function(data) {
            $("[name='idCliente']").val(data.id)
            $("[name='nome']").val(data.nome)
            $("[name='cpf']").val(data.cpf)
            $("[name='celnumero']").val(data.celnumero)
            $("[name='email']").val(data.email)
        },
    })
}
$('#selecionarTecnico').change(function() {

    var dados = $('#selecionarTecnico option:selected').attr("data-puxar")
    inserirDadosTecnico(dados)
})

function inserirDadosTecnico(val) {

    $.ajax({
        type: "GET",
        url: `${main_url}/assistencia/conserto/dadosTecnico`,
        data: {
            'nome': val
        },
        success: function(data) {
            $("[name='idTecnico']").val(data.id)
            $("[name='nome-tecnico']").val(data.nome)
            $("[name='cpf-tecnico']").val(data.cpf)
        },
    })

}
</script>

@stop