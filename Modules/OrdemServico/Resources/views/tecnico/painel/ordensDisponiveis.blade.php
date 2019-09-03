@extends('ordemservico::layouts.index')

@section('modal')

<!-- Modal -->
<div class="modal fade" id="pegar-responsabilidade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deseja mesmo pegar essa responsabilidade?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'form' , 'method'=>'get')) }}
                {{Form::token()}}

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    {{Form::submit( 'Sim',array('class'=>"btn btn-primary") )}}
                </div>
                {{ Form::close() }}


            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    
    $(document).ready(function() {
        $(".pegar-responsabilidade").click(function() {
            var linha = $(this).parent().parent();

            var idTecnico = "<?php print $data['tecnico']->id; ?>";

            var idOs = linha.find("td:eq(0)").text().trim();

            $("#form").attr("action", '/ordemservico/painel/' + idTecnico + "/" + idOs +'/pegarResponsabilidade');
          
            $('#pegar-responsabilidade').modal('show');

        });
    });
</script>
@endsection