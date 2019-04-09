@extends('funcionario::template')

@section('title','Lista de funcionários')

@section('body')
    <div class="row">
        <div class="text-right">
            <a class="btn btn-success" href="{{ url('funcionario/cargo/create') }}">Novo cargo</a>
        </div>
    </div>
    
    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel"></div>
        <div class="tab-pane fade" id="inativos" role="tabpanel"></div>
    </div>
@endsection

@section('script')

<script>
    search = (url, target) => {
        setLoading(target)
        $.ajax({
            type: "GET",
            url: url,
            data: $("#form").serialize(),
            success: function (data) {
                target.html(data)
            },
            error: function (jqXHR, exception) {
                $("#results").html("<div class='alert alert-danger'>Desculpe, ocorreu um erro. <br> Recarregue a página e tente novamente</div>")
            },
        })
    }

    ativosInativos = (url) => {
        search(`${url}/ativos`, $("#ativos"))
        search(`${url}/inativos`, $("#inativos"))

        $("#ativos").on('click', 'ul.pagination a', function(e){
            e.preventDefault()
            search($(this).attr('href'), $("#ativos"))
        })

        $("#inativos").on('click', 'ul.pagination a', function(e){
            e.preventDefault()
            search($(this).attr('href'), $("#inativos"))
        })
        
    }

    $(document).ready(function(){
        ativosInativos(`${main_url}/funcionario/funcionario/list`)
        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                ativosInativos(`${main_url}/funcionario/funcionario/list`)
            }
        });
    })
</script>

@endsection