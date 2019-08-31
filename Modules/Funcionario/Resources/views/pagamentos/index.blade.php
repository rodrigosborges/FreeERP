@extends('funcionario::template')

@section('title','Lista Pagamentos')

@section('body')

<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Valor</th>
      <th scope="col">Tipo</th>
      <th scope="col" colspan="2">Opções</th>
      <th><a href="{{url($data['url'])}}" class="btn btn-success"><i class="material-icons">note_add</i></a></th>



    </tr>
  </thead>
  <tbody>
   
    <tr>
      <td>  </td>
      <td> </td>
      <td></td>
      <td><a href="" class="btn btn-warning"><i class="material-icons">edit</i></a></td>
      <td><a href="" class="btn btn-danger"><i class="material-icons">delete</i></a></td>
 
    </tr>
  
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