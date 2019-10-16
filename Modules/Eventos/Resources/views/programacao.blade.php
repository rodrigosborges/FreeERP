@extends('eventos::layouts.template')
@section('title', 'Programação')

@section('content')
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
        <h1 style="text-align: center;">{{$evento->nome}}</h1>
    </div>
     <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
        <h2 style="text-align: center;">Programação</h2>
    </div>
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" align="right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastrarAtividade">Adicionar</button>
    </div>
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
        <table id="programacao" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Data</th>
                    <th class="text-center">Horário</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Duração</th>
                    <th class="text-center">Vagas</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td class="text-center align-middle"></td>
                        <td class="text-center align-middle"></td>
                        <td class="text-center align-middle"></td>
                        <td class="text-center align-middle"></td>
                        <td class="text-center align-middle"></td>
                        <td class="text-center align-middle">
                            <button class="btn btn-xs" data-toggle="modal" data-target="#modalEditarPessoa"><i class="material-icons">edit</i></button>
                            <button class="btn btn-xs" data-toggle="modal" data-target="#modalExcluirPessoa"><i class="material-icons">delete</i></button>
                        </td> 
                    </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Modal para cadastrar pessoa-->
        <form method="post" action="">
            {{ csrf_field() }}
            <div class="modal fade" id="modalCadastrarAtividade" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarAtividade" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloModal">Cadastrar Pessoa</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <!-- Passa o id do evento em que a pessoa está sendo cadastrada -->
                                <input type="hidden" name="eventoId" value="{{$evento->id}}">
                            </div>
                            <div class="form-group">
                                <label for="nome" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">E-mail:</label>
                                <input type="text" class="form-control" name="email" required>
                                <div id="resultado"></div>
                            </div>
                            <div class="form-group">
                                <label for="telefone" class="col-form-label">Telefone:</label>
                                <input type="text" class="form-control" name="telefone" id="telefone">
                            </div>
                            <!-- IMPLEMENTAR INSERÇÃO DE FOTO -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

@endsection

@section('js')
    <!-- DataTables -->
    <script>
        $(document).ready(function(){
            $('#programacao').DataTable({
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primeira",
                        "last":  "Última",
                        "next":  "Próxima",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
    
    <!-- Modal -->
    <script>
        $("#programacao > tbody > tr").on("click", function (e) {
            $('#modalCadastrarAtividade').on('show.bs.modal');
        });
        
        $('#modalCadastrarAtividade').on('show.bs.modal');
    </script>
@endsection