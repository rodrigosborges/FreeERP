@extends('funcionario::template')

@section('title','Lista de cargos')

@section('body')
    <div class="row">
        <div class="col-md-4">
            <form id="form">
                <div class="form-group">
                    <input id="search-input" class="form-control" type="text" name="pesquisa" />
                </div>
            </form>
        </div>
        <div class="col-md-2 pl-0">
            <div class="form-group">
                <i id="search-button" class="btn btn-info material-icons">search</i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <a class="btn btn-success" href="{{ url('funcionario/cargo/create') }}">Novo Cargo</a>
            </div>
        </div>
    </div>
    <!-- <div class="form-group col-md-8">
        <label>Nome</label>
        <div class="input-group">
            <input type="text" name="nome" class="form-control">
        </div>
    </div>
    <button type="button" class="btn btn-mapes btn-block" id="sendForm">Pesquisar</button> -->
    <!-- <br> -->
    <!-- <div class="container"> -->
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
    <!-- </div> -->
@endsection

@section('script')

<script>

console.log($("#form").serialize())

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

    $(document).on("click", "#search-button", function() {
        ativosInativos(`${main_url}/funcionario/cargo/list`)
    })

    $(document).ready(function(){
        ativosInativos(`${main_url}/funcionario/cargo/list`)
        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                e.preventDefault()
                ativosInativos(`${main_url}/funcionario/cargo/list`)
            }
        });
    })
</script>

@endsection