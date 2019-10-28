@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    <style>
        .quebraDeTexto{
            white-space: nowrap;
        }
        
        img{  
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
                            <button class="btn btn-xs" title="Programação">
                                <a href="{{URL::route('programacao.exibir', $evento->id)}}">
                                    <i class="material-icons">schedule</i> 
                                </a>
                            </button>
                            <button class="btn btn-xs" title="Visualizar / Editar" data-toggle="modal" data-target="#modalVisualizarEvento"
                                data-id="{{$evento->id}}" data-nome="{{$evento->nome}}" data-local="{{$evento->local}}"
                                data-estado="{{$evento->estado_id}}" data-idcidade="{{$evento->cidade_id}}"
                                data-datainicio="{{$evento->dataInicio}}" data-datafim="{{$evento->dataFim}}"
                                data-descricao="{{$evento->descricao}}"
                                data-imagem="http://127.0.0.1:8000/storage/eventos/{{$evento->imagem}}" data-empresa="{{$evento->empresa}}"
                                data-email="{{$evento->email}}"
                                data-telefone="{{$evento->telefone}}">
                                <i class="material-icons">search</i>
                            </button>
                            <button class="btn btn-xs" title="Excluir" data-toggle="modal" data-target="#modalExcluirEvento"
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
                        <h5 class="modal-title">Cadastrar Evento</h5>
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
                                <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                                    <label for="estado" class="col-form-label">Estado:</label>
                                    <select class="form-control" name="estado" id="estado" required>
                                        <option value="" disabled selected>Selecione</option>
                                        @foreach ($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->uf}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                    <label for="cidade" class="col-form-label">Cidade:</label>
                                    <select class="form-control" name="cidade" id="cidade" required>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-3">
                                    <label for="dataInicio" class="col-form-label">Data Início:</label>
                                    <input type="date" class="form-control" name="dataInicio" required>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-3">
                                    <label for="dataFim" class="col-form-label">Data Fim:</label>
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
                            <img src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png" class="img" alt="Imagem evento" title='Imagem evento'/></br>
                            <input type='file' class="imgEvento" name="imgEvento" accept="image/*">
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
    
    <!-- Modal para visualizar e/ou editar evento -->
    <form method="post" action="{{route('eventos.editar')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade" id="modalVisualizarEvento" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarEvento" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <!-- Passa o id do evento -->
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <img src=" " class="img" alt="Imagem evento" title='Imagem evento'/></br>
                            <input type='file' class="imgEvento" name="imgEvento" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="nome" class="col-form-label">Nome:</label>
                            <input type="text" class="form-control edit" id="nome" name="nome" disabled>
                        </div>
                        <div class="form-group">
                            <label for="local" class="col-form-label">Local:</label>
                            <input type="text" class="form-control edit" id="local" name="local" disabled>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                                    <label for="estado" class="col-form-label">Estado:</label>
                                    <select class="form-control edit" name="estado" id="estado" disabled>
                                        @foreach ($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->uf}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                    <label for="cidade" class="col-form-label">Cidade:</label>
                                    <select class="form-control edit" name="cidade" id="cidade" disabled>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                    <label for="data_inicio" class="col-form-label">Data Início:</label>
                                    <input type="date" class="form-control edit" id="dataInicio" name="dataInicio" disabled>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                    <label for="data_fim" class="col-form-label">Data Fim:</label>
                                    <input type="date" class="form-control edit" id="dataFim" name="dataFim" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao" class="col-form-label">Descrição:</label>
                            <textarea class="form-control edit" id="descricao" name="descricao" rows="15" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="empresa" class="col-form-label">Empresa/Instituição:</label>
                            <input type="text" class="form-control edit" id="empresa" name="empresa" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="text" class="form-control edit" id="email" name="email" disabled>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                    <label for="telefone" class="col-form-label">Telefone:</label>
                                    <input type="text" class="form-control edit" id="telefone" name="telefone" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnEditar" onclick="editar()">Editar</button>
                        <button type="button" class="btn btn-secondary" id="btnFechar" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary"id="btnSalvar">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <!-- Modal de confirmação de exclusão -->
    <form method="POST" action="{{route('eventos.excluir')}}">
        @method('DELETE')
        {{ csrf_field() }}
        <div class="modal fade" id="modalExcluirEvento" tabindex="-1" role="dialog" aria-labelledby="modalExcluirEvento" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir Evento</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id"/>
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
        $('#modalCadastrarEvento').on('show.bs.modal', function() {
            $("#estado").prop('selectedIndex',0);
            $("#cidade").html('<option value="" disabled selected>Selecione o estado</option>');
        });
        
        $('#modalVisualizarEvento').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            
            //RECEBE VALORES DOS ATRIBUTOS DATA
            var imagem = button.data('imagem');
            var id = button.data('id');
            var nome = button.data('nome');
            var local = button.data('local');
            var estado = button.data('estado');
            var idcidade = button.data('idcidade');
            var datainicio = button.data('datainicio');
            var datafim = button.data('datafim');
            var descricao = button.data('descricao');
            var empresa = button.data('empresa');
            var email = button.data('email');
            var telefone = button.data('telefone'); 
            
            //ATUALIZA O CONTEÚDO DO MODAL
            var modal = $(this);
            
            $('.modal-body .imgEvento').hide(); //ESCONDE O INPUT DA IMAGEM
            $('.modal-footer #btnSalvar').hide(); //ESCONDE O BOTÃO SALVAR
            
            if(imagem !== 'http://127.0.0.1:8000/storage/eventos/'){
                modal.find('.modal-body .img').attr("src", imagem);
            } else {
                modal.find('.modal-body .img').attr("src", 'http://127.0.0.1:8000/storage/eventos/default.png');
            }
          
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nome').val(nome);
            modal.find('.modal-body #local').val(local);
            modal.find('.modal-body #estado').val(estado);
            
            //POPULA O SELECT DE CIDADES
            buscarCidades(estado, idcidade);
            
            modal.find('.modal-body #dataInicio').val(datainicio);
            modal.find('.modal-body #dataFim').val(datafim);
            modal.find('.modal-body #descricao').val(descricao);
            modal.find('.modal-body #empresa').val(empresa);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #telefone').val(telefone);
        });
        
        //LIBERA OS CAMPOS PARA EDIÇÃO
        function editar() {
            var input = document.getElementsByClassName('edit');
            
            for (var i=0; i<(input.length); i++) {
                input[i].disabled = false;
            }
            
            $('.modal-body .imgEvento').show(); //EXIBE O INPUT DA IMAGEM
            
            //EDITA OS BOTÕES
            $('.modal-footer #btnEditar').hide();
            $('.modal-footer #btnFechar').html('Cancelar');
            $('.modal-footer #btnSalvar').show();
        }
        
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
        $(".imgEvento").change(function(event) {  
            readURL(this);    
        });    
    
        function readURL(input) {    
            if (input.files && input.files[0]) {   
                var reader = new FileReader();
                var filename = $(".imgEvento").val();
                filename = filename.substring(filename.lastIndexOf('\\')+1);
                reader.onload = function(e) {
                    $('.img').attr('src', e.target.result);
                    $('.img').hide();
                    $('.img').fadeIn(500);         
                };
                reader.readAsDataURL(input.files[0]);    
            } 
        }
    </script>
    
    <!-- Selects de estados e cidades -->
    <script type="text/javascript">
        $('select[name=estado]').change(function () {
            var idestado = $(this).val();
            buscarCidades(idestado);
        });
        
        function buscarCidades (idestado, idcidade){
            $.get('/eventos/get-cidades/' + idestado, function (cidades) {
                $('select[name=cidade]').empty();
                $.each(cidades, function (index, value) {
                    if(idcidade !== null){
                        if(idcidade === value.id)
                            $('select[name=cidade]').append('<option value=' + value.id + ' selected>' + value.nomeCidade + '</option>');
                        else
                            $('select[name=cidade]').append('<option value=' + value.id + '>' + value.nomeCidade + '</option>');
                    }else{
                        $('select[name=cidade]').append('<option value=' + value.id + '>' + value.nomeCidade + '</option>');
                    }
                });
            });
        }
    </script>
@endsection
