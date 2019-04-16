@extends('funcionario::template')

@section('title','Lista de funcionários')

@section('body')

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input id="search-input" class="form-control" type="text" name="pesquisa" />
            </div>
        </div>
        <div class="col-md-2 pl-0">
            <div class="form-group">
                <i id="search-button" class="btn btn-info material-icons">search</i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <a class="btn btn-success" href="{{ url('funcionario/cargo/create') }}">Novo Funcionário</a>
            </div>
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

    function searchFuncionarios() {
        const valor = $("#search-input").val()

        $.ajax({
            url: main_url + '/funcionario/funcionario/search/'+valor,
            method: 'GET',
            type: 'json',
            success: function(data) {
                var table = '<table class="table table-striped"><thead><tr><th>Nome</th><th>Cargo</th><th class="min">Ações</th></thead></tr>'

                $.each(data, function(i, funcionario) {
                    table += '<tr><td>'+funcionario['funcionario_nome']+'</td>'
                    table += '<td>'+funcionario['cargo_nome']+'</td>'
                    table += '<td class="min"><a class="btn btn-warning" href="funcionario/'+funcionario['id']+'/edit">Editar</a></td>'
                    table += '<td class="min"><a id="desativar-'+funcionario['id']+'" class="btn btn-danger desativar" href="#">Desativar</a></td>'
                    table += '</tr>'
                })

                table += '</table>'

                Swal.fire({
                    title: 'Resultados da busca:',
                    html: '<p>Exibindo os resultados mais relevantes</p>' +
                    table

                })
            }
        })
    }

    $(document).on("click", "#search-button", function() {
        searchFuncionarios()
    })

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