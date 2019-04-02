@extends('funcionario::template')

@section('title','Lista de cargos')

@section('body')
    <div class="text-right">
        <a class="btn btn-success" href="{{ url('funcionario/cargo/create') }}">Novo cargo</a>
    </div>
    <br>
    <div class="container">
        <div id="results"></div>
    </div>
@endsection

@section('script')

<script>
    search = (url) => {
        // setLoading($("#results"))
        $.ajax({
            type: "POST",
            url: url,
            data: $("#form").serialize(),
            success: function (data) {
                $("#results").html(data)
            },
            error: function (jqXHR, exception) {
                $("#results").html("<div class='alert alert-danger'>Desculpe, ocorreu um erro. <br> Recarregue a página e tente novamente</div>")
            },
        })
    }

    $('#results').on('click', 'ul.pagination a', function(e){
        e.preventDefault()
        search($(this).attr('href'))
    })

    $(document).ready(function(){
        search(`${main_url}/funcionario/cargo/list`)

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                search(`${main_url}/list`)
            }
        });
    })
</script>

@endsection