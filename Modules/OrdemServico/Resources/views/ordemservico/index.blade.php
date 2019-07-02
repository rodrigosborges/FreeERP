@extends('ordemservico::layouts.informacoes')
@section('content')

<form method="GET" action="#">
    <div class="form-row form-group">
        {!! Form::label('busca', 'Procurar por', ['class' => 'col-sm-2 col-form-label text-right']) !!}
        <div class="input-group col-sm-8">
            {!! Form::text('busca', isset($busca) ? $busca : null, ['class' => 'form-control']) !!}
            <div class="input-group-append">
                {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</form>

<div class="text-center">
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Solicitante</th>
                <th>Descrição</th>
                <th>Prioridade</th>
                <th><a class="btn btn-success center-block" href="{{ url('ordemservico/os/create')  }}">Abrir OS</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['ordem_servico'] as $os)
            <tr>
                <td>{{$os->id}}</td>
                <td>{{$os->solicitante_id}}</td>
                <td>{{$os->descricao_problema}}</td>
                <td>{{$os->prioridade}}</td>
                <td>
                        <a class="btn btn-outline-warning btn-sm" href='{{ url("ordemservico/os/$os->id/") }}'>Detalhes</a>
                        <a class="btn btn-outline-info btn-sm" href='{{ url("ordemservico/os/$os->id/edit") }}'>Editar</a>
                        <a class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#definir-prioridade">Prioridade</a>
                        <a class="btn btn-outline-dark btn-sm" href='{{ url("ordemservico/os/pdf")}}'>PDF</a>
                        <a class="btn btn-outline-danger btn-sm" id='delete'  data-toggle="modal" data-id={{$os->id}} data-target="#verifica-delete"> Delete </a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modals -->
<div class="modal fade" id="definir-prioridade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Definir Prioridade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'form-prioridade' , 'method'=>'put')) }}
                {{Form::token()}}


                <div class="form-group">
                    <div class="form-row">
                        <div id='prioridade'>
                            {{Form::label('Prioridade')}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    {{Form::submit( 'Salvar mudanças',array('class'=>"btn btn-primary") )}}
                </div>
                {{ Form::close() }}


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="verifica-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                </button>
            </div>
            <div class="modal-body">
                <h5>Tem certeza que deseja excluir essa OS?</h5>
                <p class="text-secondary">Você poderá recuperar ordem de serviço na aba de reativação </p>
                <form id="form-delete" method="POST">
                {{method_field('DELETE')}}
                        {{ csrf_field() }}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    {{Form::submit( 'Sim',array('class'=>"btn btn-primary") )}}
                </div>
                {{ Form::close() }}


            </div>
        </div>
    </div>

<!--- Paginaçao --->
<div class="row justify-content-center">
    {{ $data['ordem_servico']->links() }}
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $("#definir-prioridade").on("show.bs.modal", function(e) {
            var linha = $(e.relatedTarget).closest("tr");
            var id = linha.find("td:eq(0)").text().trim();
            var prioridade = linha.find("td:eq(3)").text().trim();
           
            $("#form-prioridade").attr("action", '/ordemservico/os/' + id);
            $("#campo").remove();
            $('#prioridade').append("<select id='campo' required name='prioridade' class='custom-select mr-sm-2'><option value='0' disabled> A Definir </option><option value='3'> Baixa </option><option value='2'> Média </option><option value='1'> Alta </option></select>");
            $('#campo').val(prioridade);
        });
    });

    $("#verifica-delete").on('shown.bs.modal', function () {
        var id = $('#delete').attr('data-id');
        $("#form-delete").attr("action",'/ordemservico/os/'+ id);
    });
</script>
@endsection