@extends('funcionario::template')

@section('title','Pagamentos')

@section('body')

<table class="table">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Salario </th>
      <th scope="col">Cargo</th>
      <th scope="col"><a class="btn btn-success" href="{{ url('funcionario/pagamento/create') }}"><i class="material-icons">
            note_add
          </i></a></th>

    </tr>
  </thead>
  <tbody>
    @foreach($data['funcionarios'] as $funcionario)
    <tr>
      <td> {{ $funcionario->nome }} </td>
      <td> Cargo </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="text-right">
  <a class="btn btn-success" href="{{ url('funcionario/pagamento/create') }}">Novo Pagamento</a>
</div>

<!--salario', 'horas_extras', 'adicional_noturno', 
                    'inss', 'faltas', 'emissao', 'funcionario_id-->
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
      success: function(data) {
        target.html(data)
      },
      error: function(jqXHR, exception) {
        $("#results").html("<div class='alert alert-danger'>Desculpe, ocorreu um erro. <br> Recarregue a página e tente novamente</div>")
      },
    })
  }

  ativosInativos = (url) => {
    search(`${url}/ativos`, $("#ativos"))
    search(`${url}/inativos`, $("#inativos"))

    $("#ativos").on('click', 'ul.pagination a', function(e) {
      e.preventDefault()
      search($(this).attr('href'), $("#ativos"))
    })

    $("#inativos").on('click', 'ul.pagination a', function(e) {
      e.preventDefault()
      search($(this).attr('href'), $("#inativos"))
    })

  }

  $(document).on("click", "#search-button", function() {
    ativosInativos(`${main_url}/funcionario/cargo/list`)
  })

  $(document).ready(function() {
    ativosInativos(`${main_url}/funcionario/cargo/list`)
    $(document).on('keypress', function(e) {
      if (e.which == 13) {
        e.preventDefault()
        ativosInativos(`${main_url}/funcionario/cargo/list`)
      }
    });
  })
</script>

@endsection