@extends('ordemservico::layouts.index')
@section('acoes')
<button type="button" class="btn btn-outline-info btn-sm" id = "responsabilidade-button">
    Pegar Responsabilidade
</button>

@endsection
@section('modal')

<!-- Modal -->
<div class="modal fade" id="pegar-responsabilidade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Deseja pegar essa responsabilidade?</h4>   
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               
            </div>
            <div class="modal-footer">
                {{ Form::open(array('id' => 'form' , 'method'=>'get')) }}
                {{Form::token()}}

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                {{Form::submit( 'Sim',array('class'=>"btn btn-primary") )}}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-add')
<script>
    $(document).ready(function() {
        $("#responsabilidade-button").click(function() {
            var linha = $(this).parent().parent();

            var idOS = linha.find("td:eq(0)").text().trim();

            $("#form").attr("action", '/ordemservico/painel/' + idOS + '/pegarResponsabilidade');

            $('#pegar-responsabilidade').modal('show');

        });
    });
</script>
@endsection