@extends('ordemservico::layouts.index')

@section('modal')

<!-- Modal -->
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
                {{ Form::open(array('id' => 'form' , 'method'=>'put')) }}
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
@endsection

@section('js')
<script>
    
    function confirmar(rota) {
        $("#form-delete").attr("action", rota);
        $('#verifica-delete').modal('show');
    };

    $(document).ready(function() {
        $(".prioridade").click(function() {
            var linha = $(this).parent().parent();

            var id = linha.find("td:eq(0)").text().trim();

            var prioridade = linha.find("td:eq(2)").text().trim();
            console.log(prioridade);
            $("#form").attr("action", '/ordemservico/problema/' + id);
            $("#campo").remove();
            $('#prioridade').append("<select id='campo' required name='prioridade' class='custom-select mr-sm-2'><option value='3'> Baixa </option><option value='2'> Média </option><option value='1'> Alta </option></select>");
            $('#campo').val(prioridade);

            $('#definir-prioridade').modal('show');

        });
    });
</script>
@endsection