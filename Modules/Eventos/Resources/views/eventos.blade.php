@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    <!-- CHOSEN / MULTISELECT -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet" type="text/css">

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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalEvento" onclick="cadastrar()">Adicionar</button>
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
                            <a class="btn btn-xs btn-secondary text-white" href="{{URL::route('programacao.exibir', $evento->id)}}">
                                <i class="material-icons">schedule</i> 
                            </a>
                            <button class="btn btn-xs btn-secondary" title="Visualizar / Editar" data-toggle="modal" data-target="#modalEvento" onclick="visualizar('{{$evento->id}}')">
                                <i class="material-icons">search</i>
                            </button>
                            <button class="btn btn-xs btn-secondary" title="Excluir" data-toggle="modal" data-target="#modalExcluirEvento" onclick="excluir('{{$evento->id}}', '{{$evento->nome}}')"><i class="material-icons">delete</i></button>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de evento -->
    <form method="" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="modalEvento" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModal"></h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome" class="col-form-label">Nome*:</label>
                            <input type="text" class="form-control edit" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="local" class="col-form-label">Local*:</label>
                            <input type="text" class="form-control edit" name="local" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                                    <label for="estado" class="col-form-label">Estado*:</label>
                                    <select class="form-control edit" name="estado" required>
                                        <option value="" disabled selected>Selecione</option>
                                        @foreach ($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->uf}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                    <label for="cidade" class="col-form-label">Cidade*:</label>
                                    <select class="form-control edit" name="cidade" required></select>
                                </div>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-3">
                                    <label for="dataInicio" class="col-form-label">Data Início*:</label>
                                    <input type="date" class="form-control edit" name="dataInicio" required>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-3">
                                    <label for="dataFim" class="col-form-label">Data Fim*:</label>
                                    <input type="date" class="form-control edit" name="dataFim" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao" class="col-form-label">Descrição*:</label>
                            <textarea class="form-control edit" name="descricao" rows="15" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="imagem" class="col-form-label">Imagem:</label>
                            <img src="" class="img" alt="Imagem evento" title='Imagem evento'/></br>
                            <input type='file' class="imgEvento edit" name="imgEvento" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="empresa" class="col-form-label">Empresa/Instituição*:</label>
                            <input type="text" class="form-control edit" name="empresa" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="text" class="form-control edit" name="email">
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                    <label for="telefone" class="col-form-label">Telefone:</label>
                                    <input type="text" class="form-control edit" name="telefone">
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="organizador" class="col-form-label">Organizador(es):</label>
                            <select class="chosen-select form-control" id="organizador" name="organizador[]" multiple>
                                @foreach($pessoas as $pessoa)
                                    @if(!$pessoa->id == auth::id())
                                        <option value="{{$pessoa->id}}">{{$pessoa->nome}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnEditar" onclick="editar()">Editar</button>
                        <button type="button" class="btn btn-secondary" id="btnFechar" data-dismiss="modal"></button>
                        <button type="submit" class="btn btn-primary" id="btnSalvar">Salvar</button>
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
    <!-- CHOSEN / MULTISELECT -->
    <script src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js"></script>
    
    <!-- DataTables e Chosen -->
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
        
        $('#modalEvento').on('show.bs.modal', function (){
            console.log('abriu');
            $(".chosen-select").chosen({width: "inherit"});
        });
        
        function cadastrar(){
            $('form').attr('method', 'POST');
            $('form').attr('action', '{{route('eventos.cadastrar')}}');
            $('.edit').val('');
            var input = document.getElementsByClassName('edit');
            for (var i=0; i<(input.length); i++){
                input[i].disabled = false;
            }            
            
            $('.modal-header #tituloModal').html('Cadastrar evento');
            $('.modal-body [name=estado]').prop('selectedIndex',0);
            $('.modal-body [name=cidade]').html('<option value="" disabled selected>Selecione o estado</option>');
            $('.modal-body .img').attr("src", "http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png");
            
            //EDITA OS BOTÕES
            $('.modal-footer #btnEditar').hide();
            $('.modal-footer #btnSalvar').show().html('Salvar');
            $('.modal-footer #btnFechar').html('Fechar');
            
            
        }
        
        function visualizar(idevento){
            var input = document.getElementsByClassName('edit');
            for (var i=0; i<(input.length); i++){
                input[i].disabled = true;
            }            
            
            $('.modal-header #tituloModal').html('Visualizar evento');
            
            //EDITA OS BOTÕES
            $('.modal-footer #btnEditar').show();
            $('.modal-footer #btnSalvar').hide();
            $('.modal-footer #btnFechar').html('Cancelar');
            
            $.get('/eventos/get-evento/' + idevento, function (evento){
                $.each(evento, function (index, value){
                    $('.modal-body [name=id]').val(idevento);
                    $('.modal-body [name=nome]').val(value.nome);
                    $('.modal-body [name=local]').val(value.local);
                    $('.modal-body [name=estado]').val(value.estado_id);
                    buscarCidades(value.estado_id, value.cidade_id); //POPULA O SELECT DE CIDADES
                    $('.modal-body [name=dataInicio]').val(value.dataInicio);
                    $('.modal-body [name=dataFim]').val(value.dataFim);
                    $('.modal-body [name=descricao]').val(value.descricao);
                    $('.modal-body [name=empresa]').val(value.empresa);
                    $('.modal-body [name=email]').val(value.email);
                    $('.modal-body [name=telefone]').val(value.telefone);
                    
                    if(value.imagem !== null & value.imagem !== ""){
                        $('.modal-body .img').attr("src", "http://127.0.0.1:8000/storage/eventos/" + value.imagem);
                    }else{
                        $('.modal-body .img').attr("src", 'http://ulbra-to.br/geda/wp-content/themes/geda/img/miniatura.jpg');
                    }
                });
            });
        }
        
        //LIBERA OS CAMPOS PARA EDIÇÃO
        function editar() {
            $('form').attr('method', 'POST');    
            $('form').attr('action', '{{route('eventos.editar')}}');
            
            var input = document.getElementsByClassName('edit');
            
            for (var i=0; i<(input.length); i++) {
                input[i].disabled = false;
            }
            
            //EDITA OS BOTÕES
            $('.modal-footer #btnEditar').hide();
            $('.modal-footer #btnFechar').html('Cancelar');
            $('.modal-footer #btnSalvar').show();
        }
        
        $('#modalExcluirEvento').on('show.bs.modal');
        
        function excluir (id, nome) {
            $('#modalExcluirEvento [name=id]').val(id);
            $('#modalExcluirEvento p').text('Tem certeza que deseja excluir ' + nome + '?'); 
        }
        
        //VERIFICA SE A DATA DIGITADA É MENOR QUE A DATA ATUAL E SE A DATA FIM É MENOR 
        //QUE A DATA DE INÍCIO DO EVENTO
        $('.modal-body [name=dataInicio]').change(function(event) { 
            var datainicio = $('.modal-body [name=dataInicio]').val();
            $.get( "/eventos/get-data/", function( data ) {
                if (datainicio < data){
                    console.log('Digite uma data válida');
                }else{
                    console.log('ok');
                }
            });
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
    
    
@endsection
