@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    <!-- NÃO DEIXA QUEBRAR O "TEXTO" DAS COLUNAS DATA E AÇÕES -->
    <style>
        .quebraDeTexto{
            white-space: nowrap;
        }
        
        #img{  
            max-height:250px;
            max-width: 250px;
            height:auto;
            width:auto;
            display:block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection

@section('content')
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
        <h1 style="text-align: center;">Eventos</h1>
    </div>
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" align="right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastrarEvento">Adicionar</button>
    </div>
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
        <table id="eventos" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Data</th>
                    <th class="text-center">Local</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                    <tr>
                        <td class="text-center align-middle">{{$evento->nome}}</td>
                        <td class="text-center align-middle quebraDeTexto" id="txtDate">
                            {{\Carbon\Carbon::parse($evento->dataInicio)->format('d/m/Y')}}
                        </td>
                        <td class="text-center align-middle">{{$evento->local}}</td>
                        <td class="text-center align-middle quebraDeTexto">
                            <button class="btn btn-xs" data-toggle="modal" data-target="#modalVisualizarEvento"
                                data-id="{{$evento->id}}" data-nome="{{$evento->nome}}" data-local="{{$evento->local}}"
                                data-dataInicio="{{$evento->dataInicio}}" data-dataFim="{{$evento->dataFim}}"
                                data-descricao="{{$evento->descricao}}"
                                data-imagem="storage/eventos/{{$evento->imagem}}" data-empresa="{{$evento->empresa}}"
                                data-email="{{$evento->email}}"
                                data-telefone="{{$evento->telefone}}">
                                <i class="material-icons">search</i>
                            </button>
                            <button class="btn btn-xs" data-toggle="modal" data-target="#modalEditarEvento" 
                                data-id="{{$evento->id}}" data-nome="{{$evento->nome}}"
                                data-descricao="{{$evento->descricao}}" data-imagem="{{$evento->imagem}}"
                                data-email="{{$evento->email}}" data-telefone="{{$evento->telefone}}">
                                <i class="material-icons">edit</i>
                            </button>
                            <button class="btn btn-xs" data-toggle="modal" data-target="#modalExcluirEvento"
                                data-id="{{$evento->id}}" data-nome="{{$evento->nome}}">
                                <i class="material-icons">delete</i>
                            </button>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para cadastrar evento -->
    <form method="post" action="{{route('eventos.cadastrar')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade" id="modalCadastrarEvento" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarEvento" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModal">Cadastrar Evento</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome" class="col-form-label">Nome:</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="local" class="col-form-label">Local:</label>
                            <input type="text" class="form-control" name="local" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                    <label for="data_inicio" class="col-form-label">Data Início:</label>
                                    <input type="date" class="form-control" name="dataInicio" required>
                                </div>
                                <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                    <label for="data_fim" class="col-form-label">Data Fim:</label>
                                    <input type="date" class="form-control" name="dataFim" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao" class="col-form-label">Descrição:</label>
                            <textarea class="form-control" name="descricao" rows="15" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="imagem" class="col-form-label">Imagem:</label>
                            <img id="img" src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png" alt="Imagem evento" title='Imagem evento'/></br>
                            <input type='file' id="imgEvento" name="imgEvento" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="empresa" class="col-form-label">Empresa/Instituição:</label>
                            <input type="text" class="form-control" name="empresa" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                    <label for="telefone" class="col-form-label">Telefone:</label>
                                    <input type="text" class="form-control" name="telefone" id="telefone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <!-- Modal para visualizar evento -->
    <div class="modal fade" id="modalVisualizarEvento" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarEvento" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Visualizar Evento</h5>
                    <img src=" " id="imagem"/>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nome" class="col-form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" readonly>
                    </div>
                    <div class="form-group">
                        <label for="local" class="col-form-label">Local:</label>
                        <input type="text" class="form-control" id="local" readonly>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <label for="data_inicio" class="col-form-label">Data Início:</label>
                                <input type="date" class="form-control" id="dataInicio" readonly>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <label for="data_fim" class="col-form-label">Data Fim:</label>
                                <input type="date" class="form-control" id="dataFim" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descricao" class="col-form-label">Descrição:</label>
                        <textarea class="form-control" id="descricao" rows="15" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="empresa" class="col-form-label">Empresa/Instituição:</label>
                        <input type="text" class="form-control" id="empresa" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-mail:</label>
                        <input type="text" class="form-control" id="email" readonly>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                <label for="telefone" class="col-form-label">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de confirmação de exclusão -->
    <form method="POST" action="">
        @method('DELETE')
        {{ csrf_field() }}
        <div class="modal fade" id="modalExcluirEvento" tabindex="-1" role="dialog" aria-labelledby="modalExcluirEvento" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModal">Excluir Evento</h5>
                    </div>
                    <div class="modal-body">

                        
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
    
@endsection

@section('js')
    <!-- DataTables -->
    <script>
        $(function() {
            $('#eventos').DataTable({
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
        $('#modalCadastrarEvento').on('show.bs.modal');
        
        $('#modalVisualizarEvento').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            //RECEBE VALORES DOS ATRIBUTOS DATA
            var imagem = button.data('imagem');
            alert(imagem);
            var id = button.data('id');
            var nome = button.data('nome');
            var local = button.data('local');
            var dataInicio = button.data('dataInicio');
            var dataFim = button.data('dataFim');
            var descricao = button.data('descricao');
            var empresa = button.data('empresa');
            var email = button.data('email');
            var telefone = button.data('telefone'); 
            //ATUALIZA O CONTEÚDO DO MODAL
            var modal = $(this);
            
            modal.find('.modal-header #imagem').attr("src", imagem);
            
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nome').val(nome);
            modal.find('.modal-body #local').val(local);
            modal.find('.modal-body #dataInicio').val(dataInicio);
            modal.find('.modal-body #dataFim').val(dataFim);
            modal.find('.modal-body #descricao').val(descricao);
            modal.find('.modal-body #empresa').val(empresa);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #telefone').val(telefone);
        });
        
        $('#modalEditarEvento').on('show.bs.modal', function (event) {
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
        
        $('#modalExcluirEvento').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body p').text('Tem certeza que deseja excluir ' + nome + ' ?');
        });
    </script>
    
    <!-- Preview da imagem -->
    <script>
        $("#imgEvento").change(function(event) {  
            readURL(this);    
        });    
    
        function readURL(input) {    
            if (input.files && input.files[0]) {   
                var reader = new FileReader();
                var filename = $("#imgEvento").val();
                filename = filename.substring(filename.lastIndexOf('\\')+1);
                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result);
                    $('#img').hide();
                    $('#img').fadeIn(500);      
                    $('.custom-file-label').text(filename);             
                };
                reader.readAsDataURL(input.files[0]);    
            } 
        }
    </script>
@endsection
