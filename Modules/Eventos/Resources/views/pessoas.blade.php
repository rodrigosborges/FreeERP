@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    
@endsection

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        
        <!-- Verifica se a variável 'eventoId' está vazia/nula para selecionar o evento -->
        @if(empty($eventoId))
        <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
            <h1 style="text-align: center;">Pessoas</h1>
            <form method="get" action="{{route('pessoas.exibir')}}">
                {{ csrf_field() }}
                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleFormControlSelect1">Selecione o evento</label>
                    <select class="form-control" name="eventoSelecionado">
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
            <h3>{{$eventoNome->nome}}</h3>
        </div>
        <div class="col-xm-6 col-sm-6 col-md-6 col-lg-6" align="right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastrarPessoa" data-whatever="teste">Adicionar</button>
        </div>
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
            <table id="pessoas" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evento_pessoas as $evento_pessoa)
                        <tr>
                            <td class="text-center">{{$evento_pessoa->nome}}</td>
                            <td class="text-center">{{$evento_pessoa->email}}</td>
                            <td class="text-center">{{$evento_pessoa->telefone}}</td>
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
                                <input type="hidden" name="idEvento" value="{{$eventoId}}">
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
                                <input type="text" class="form-control" name="telefone">
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
        $('#modalCadastrarPessoa').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Botão que acionou o modal
            var recipient = button.data('whatever') // Extrai informação dos atributos data-*
            // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
            // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
            var modal = $(this);
            //modal.find('.modal-title').text('Nova mensagem para ' + recipient)
            //modal.find('.modal-body input').val(recipient)
        });
    </script>
@endsection
