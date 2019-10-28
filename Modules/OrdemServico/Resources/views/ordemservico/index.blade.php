@extends('ordemservico::layouts.index')

@section('css')
<style>
    .bg-gradient-blue {
        background: linear-gradient(135deg, #036ed9 0%, #0ff0b3 100%);
        border: none;
    }

    .bg-gradient-yellow {
        background: linear-gradient(135deg, #f76b1c 0%, #fad961 100%);
        border: none;
    }

    .bg-gradient-yellow2 {
        background: linear-gradient(135deg, #f7882e 0%, #f9bc4f 100%);
        border: none;
    }

    .bg-gradient-blue2 {
        background: linear-gradient(135deg, #3bb2b8 0%, #42e695 100%);
        border: none;
    }

    .cards-dashboard .card {
        height: 24vh;
    }

    .card-dashboard-icon {
        font-size: 2.5em;
    }
</style>
@endsection

@section('cards')
<div class='row cards-dashboard'>
    <div class='col-md-3 mb-4'>
        <div class="card text-white bg-gradient-blue">
            <div class="card-body">
                <div class='float-right'>
                    <i class="card-dashboard-icon material-icons">calendar_today</i>
                </div>
                <h5>Executados no Mês</h5>
                <p>{{isset($data['ordensConcluidas']) ? 'Total : ' . $data['ordensConcluidas'] : 'Total : 0' }}</p>
            </div>
        </div>
    </div>

    <div class='col-md-3 mb-4'>
        <div class="card text-white bg-gradient-yellow">
            <div class="card-body">
                <div class='float-right'>
                    <i class="card-dashboard-icon material-icons">access_time</i>
                </div>
                <h5>Tempo Médio</h5>
                <span>{{"Em dias : " . floor($data['tempoMedio'][0]->media / 60 / 60 / 24) }}</span>
                <br>
                <span>{{"Em horas : " . floor($data['tempoMedio'][0]->media / 60 / 60) }}</span>
                <br>
                <span>{{"Em minutos : " . floor($data['tempoMedio'][0]->media / 60) }}</p>
            </div>
        </div>
    </div>

    <div class='col-md-3 mb-4'>
        <div class="card text-white bg-gradient-blue2">
            <div class="card-body">
                <div class='float-right'>
                    <i class="card-dashboard-icon material-icons">devices</i>
                </div>
                <h5>Equipamentos Inutilizados</h5>
                <div class="btn-group">
                    <button class="btn btn-info  btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mês
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">{{$data['inutilizadosMes']->count()}}</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ano
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">{{$data['inutilizadosAno']->count()}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class='col-md-3 mb-4'>
        <div class="card text-white bg-gradient-yellow2">
            <div class="card-body">
                <div class='float-right'>
                    <i class="card-dashboard-icon material-icons">list_alt</i>
                </div>
                <h5>Principais Problemas</h5>
                @foreach($data['principaisFalhas'] as $falhas)
                    {{$falhas->titulo}}
                    <br>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection

@section('acoes')
<button type="button" class="btn btn-outline-info btn-sm prioridade-button">
    Prioridade
</button>
<button type="button" class="btn btn-outline-info btn-sm status-button">
    Atualizar Status
</button>
@endsection

@section('modal')
@include('ordemservico::ordemservico.modais.status.form')
@include('ordemservico::ordemservico.modais.prioridade.form')
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

        $(".prioridade-button").click(function() {
            var linha = $(this).parent().parent();
            var id = linha.find("td:eq(0)").text().trim();
            var prioridade = linha.find("td:eq(3)").text().trim();
            $("#form-prioridade").attr("action", '/ordemservico/prioridade/' + id + "/update");
            $("#campo").remove();
            $('#prioridade').append("<select id='campo' required name='prioridade' class='custom-select mr-sm-2'><option value='3'> Baixa </option><option value='2'> Média </option><option value='1'> Alta </option></select>");
            $('#campo').val(prioridade);
            $('#definir-prioridade').modal('show');
        });

    });
</script>
@endsection