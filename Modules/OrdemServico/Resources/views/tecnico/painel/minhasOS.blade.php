@extends('ordemservico::layouts.index')
@section('acoes')
<button type="button" class="btn btn-outline-info btn-sm solucao-button">
    Relatar Solucao
</button>

<button type="button" class="btn btn-outline-info btn-sm status-button">
    Atualizar Status
</button>

@endsection

@section('modal')
@include('ordemservico::ordemservico.modais.status.form')
@include('ordemservico::tecnico.painel.modais.solucao.form')
@endsection

@section('js-add')
<script>
    $(document).ready(function() {
        $(".status-button").click(function() {

            var linha = $(this).parent().parent();

            var idOS = linha.find("td:eq(0)").text().trim();

            $.get("/ordemservico/os/status/" + idOS + "/showStatusOS", function(data) {
                $('select').val(data);
            });

            $("#form").attr("action", '/ordemservico/os/status/' + idOS + '/updateStatus');

            $('#atualizar-status').modal('show');

        });
        $(".solucao-button").click(function() {
            var linha = $(this).parent().parent();

            var idOS = linha.find("td:eq(0)").text().trim();

            $("#form").attr("action", '/ordemservico/solucao/' + idOS + '/store');

            $('#solucao').modal('show');

        });
    });
</script>
@endsection