@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
            <h1 style="text-align: center;">Pessoas</h1>
            <form>
                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleFormControlSelect1">Selecione o evento</label>
                    <select class="form-control">
                        @foreach ($eventos as $evento)
                            <option>{{$evento->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Ok</button>
            </form>
        </div>
        
    </div>
    <!-- <table id="pessoas" class="table table-striped">
	<thead>
            <tr>
                <th class="text-center">Nome</th>
                <th class="text-center">E-mail</th>
                <th class="text-center">Telefone</th>
                <th class="text-center">Tipo</th>
            </tr>
	</thead>
	<!-- Aqui é onde popula a tabela com os dados que vem do backend, onde cada view vai configurar de acordo.-->
	<!--<tbody>
            <?php /*foreach ($turmas as $turma) { ?>
                <tr <?php if($turma->deletado_em): echo 'class="danger"'; endif; ?>>
                    <td class="text-center"><?= $turma->periodo->nome; ?></td>
                    <td class="text-center"><?= $turma->disciplina->curso->nome_curso ?></td>
                    <td class="text-center"><?= $turma->disciplina->nome_disciplina; ?></td>
                    <td class="text-center"><?= $turma->turno->nome_turno ?></td>
                    <td class="text-center"><?= $turma->qtd_alunos ?></td>
                    <td class="text-center"><?= ( empty($turma->dp) ) ? 'Não' : 'Sim'?></td>
                    <td class="text-center"><?= ( empty($turma->deletado_em) ) ? 'Ativado' : 'Desativado'?></td>
                    <td class="text-center">
                        <?php if ( empty($turma->deletado_em) ) : ?>
                            <a class="btn btn-warning glyphicon glyphicon-pencil" title="Editar" href="<?= site_url('turma/editar/'.$turma->id)?>"></a>
                            <button class="btn btn-danger" title="Desativar" type="button" id="btn-delete" onclick="confirmDelete(<?= $turma->id ?>,'Deseja desativar a turma?','deletar')"> <i class="glyphicon glyphicon-remove"></i></button>
                        <?php else : ?>
                            <a class="btn btn-warning glyphicon glyphicon-pencil disabled" title="Editar" href="<?= site_url('turma/editar/'.$turma->id)?>"></a>
                            <button class="btn btn-success" title="Ativar" type="button" id="btn-delete" onclick="confirmDelete(<?= $turma->id ?>,'Deseja ativar a turma?','ativar')"> <i class="glyphicon glyphicon-check"></i></button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php } */?>
	</tbody>
    </table>-->
    <script>
        $(document).ready(function(){
            $('#pessoas').DataTable({
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)"
                }
            });
        });
    </script>
@endsection
