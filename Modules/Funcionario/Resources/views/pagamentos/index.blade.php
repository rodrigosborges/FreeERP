@extends('funcionario::template')

@section('title','Pagamentos')

@section('body')

<table class="table">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Cargo</th>
      <th scope="col">Pagamento</th>

    </tr>
  </thead>
  <tbody>
    @foreach($data['funcionarios'] as $funcionario)
    <tr>
      <td> {{ $funcionario->nome }} </td>
      <td> Cargo </td>
      <td>
        <form action="{{ url('funcionario/pagamento/create/') }}" id="form" method="GET" enctype="multipart/form-data">
            <input type="hidden" name="funcionario" value="{{$funcionario->id}}">
            <button type="submit"><i class="material-icons">note_add</i></button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
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