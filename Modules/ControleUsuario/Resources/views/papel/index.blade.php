@extends('template')
@section('title', 'Papéis')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>Página de Papéis</h1>
    </div>
</div>

<div class="row  justify-content-center">
    <div class="table table-responsive col-sm-8 table-bordered text-center 
         justify-content-center">
        <table class="table table-bordered" id="table">
            <tr>
                <th>Nº</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Criado em:</th>
                <th>Criado por:</th>
                <th class="text.center" width="250px">
                    <a href="#" class=" create-modal btn btn-success btn-sm" data-toggle="modal" data-target="#create">
                        <i class="material-icons">note_add</i>
                    </a>
                </th>
            </tr>
            {{ csrf_field() }}
            <?php $no = 1 ?>
            @foreach ($papeis as $papel)
            <tr class="papel{{$papel->id}}">
                <td>{{ $no++ }}</td>
                <td>{{ $papel->nome }}</td>
                <td>{{ $papel->descricao }}</td>
                <td>{{ $papel->created_at }}</td>
                <td></td>
                <td>
                    <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$papel->id}}" data-nome="{{$papel->nome}}" data-descricao="{{$papel->descricao}}" data-usuario="">
                        <i class="material-icons">remove_red_eye</i>
                    </a>
                    <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$papel->id}}" data-nome="{{$papel->nome}}" data-descricao="{{$papel->descricao}}" data-usuario="">
                        <i class="material-icons" style="color:white">edit</i>
                    </a>
                    <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$papel->id}}" data-nome="{{$papel->nome}}" data-descricao="{{$papel->descricao}}" data-usuario="">
                        <i class="material-icons">delete</i>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<!--Formulário modal de criação de papéis -->
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Cadastrar Papel</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div >
            <p class="error text-center alert " id="msg"></p>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class=" form-group">
                        <label class="control-label col-sm-2" for="nome">Nome:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do cargo" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="descricao">Descrição:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do cargo" required>
                            <p class="error text-center alert alert-danger hiden"></p>
                        </div>
                    </div>
                </form>





            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span>Salvar
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Fechar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

<!--Ajax para o formulário de criação de papéis -->
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.error').hide();
    })

$('#add').click(function(){
    $.ajax({
        type:'POST',
        url:'papel/add',
        data:{'_token':$('input[name=_token]').val(),
        'nome':$('input[name=nome]').val(),
        'descricao':$('input[name=descricao]').val(),
        },
        success:function(data){
        console.log('foi: '+ data);
       ;
      
        $('#msg').html(data);
        $("#msg").fadeIn("slow");
        $('#msg').addClass('alert-success')
        $('#nome').val('');
        $('#descricao').val('');
    }
    }
    
    )
    $('#create').click(function(){
        $('.error').removeClass('alert-success');
        $('#msg').val('');
        $('#msg').hide();
    })
     
})
/*TESTE*/
</script>
@endsection