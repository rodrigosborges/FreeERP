@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    
@endsection

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        
        <!-- Verifica se a variável 'eventoId' está vazia/nula para selecionar o evento -->
        @if(!$evento)
        <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
            <h1 style="text-align: center;">Pessoas</h1>
            <form method="POST" action="{{route('pessoas.exibir')}}">
                {{ csrf_field() }}
                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleFormControlSelect1">Selecione o evento</label>
                    <select class="form-control" name="evento">
                        @foreach ($eventos as $evento)
                            <option value="{{$evento->id}}">{{$evento->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Ok</button>
            </form>  
        </div>
        
        <!-- Evento selecionado-->
        @else
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
            <h1 style="text-align: center;">Pessoas</h1>
        </div>
        <div class="col-xm-6 col-sm-6 col-md-6 col-lg-6">
            <h3>{{$evento->nome}}</h3>
        </div>
        <div class="col-xm-6 col-sm-6 col-md-6 col-lg-6" align="right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastrarPessoa">Adicionar</button>
        </div>
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
            <table id="pessoas" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Telefone</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evento->pessoas as $evento_pessoa)
                        <tr>
                            <td class="text-center align-middle">{{$evento_pessoa->nome}}</td>
                            <td class="text-center align-middle">{{$evento_pessoa->email}}</td>
                            <td class="text-center align-middle">{{$evento_pessoa->telefone}}</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-xs" data-toggle="modal" data-target="#modalEditarPessoa" data-id="{{$evento_pessoa->id}}" data-nome="{{$evento_pessoa->nome}}" data-email="{{$evento_pessoa->email}}" data-telefone="{{$evento_pessoa->telefone}}"><i class="material-icons">edit</i></button>
                                <button class="btn btn-xs" data-toggle="modal" data-target="#modalExcluirPessoa" data-id="{{$evento_pessoa->id}}" data-nome="{{$evento_pessoa->nome}}"><i class="material-icons">delete</i></button>
                            </td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        
        <!-- Modal para cadastrar pessoa-->
        <form method="post" action="{{route('pessoas.cadastrar')}}">
            {{ csrf_field() }}
            <div class="modal fade" id="modalCadastrarPessoa" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarPessoa" aria-hidden="true">
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
        
        <!-- Modal para editar pessoa-->
        <form method="post" action="{{route('pessoas.editar')}}">
            {{ csrf_field() }}
            <div class="modal fade" id="modalEditarPessoa" tabindex="-1" role="dialog" aria-labelledby="modalEditarPessoa" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloModal">Editar Pessoa</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <!-- Passa o id do evento em que a pessoa está sendo alterada e o id da pessoa -->
                                <input type="hidden" name="eventoId" value="{{$evento->id}}">
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="form-group">
                                <label for="nome" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">E-mail:</label>
                                <input type="text" class="form-control" name="email" id="email" required>
                                <div id="resultado"></div>
                            </div>
                            <div class="form-group">
                                <label for="telefone" class="col-form-label">Telefone:</label>
                                <input type="text" class="form-control" name="telefone" id="telefone"
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- Modal de confirmação de exclusão -->
        <form method="POST" action="{{route('pessoas.excluir')}}">
            {{ csrf_field() }}
            <div class="modal fade" id="modalExcluirPessoa" tabindex="-1" role="dialog" aria-labelledby="modalExcluirPessoa" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloModal">Excluir Pessoa</h5>
                        </div>
                        <div class="modal-body">
                            
                            <!-- Passa o id do evento e o id da pessoa para excluir-->
                            <input type="hidden" name="eventoId" value="{{$evento->id}}">
                            <input type="hidden" name="id" id="id">
                            
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Sim</button>
                        </div>
                    </div>
                </div>
            </div>   
        </form>

    </div>
@endsection

@section('js')
    <!-- DataTables -->
    <script>
        $(document).ready(function(){
            $('#pessoas').DataTable({
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
        $('#modalCadastrarPessoa').on('show.bs.modal');
        
        $('#modalEditarPessoa').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            //RECEBE VALORES DOS ATRIBUTOS DATA
            var id = button.data('id');
            var nome = button.data('nome');
            var email = button.data('email');
            var telefone = button.data('telefone'); 
            //ATUALIZA O CONTEÚDO DO MODAL
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nome').val(nome);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #telefone').val(telefone); 
        });
        
        $('#modalExcluirPessoa').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body p').text('Tem certeza que deseja excluir ' + nome + ' desse evento?');
        });
    </script>
    
@endsection