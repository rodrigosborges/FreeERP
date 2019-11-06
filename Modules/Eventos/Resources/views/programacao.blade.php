@extends('eventos::layouts.template')
@section('title', 'Programação')

@section('css')
    <style>
        .palestrante {
            padding: 20px 20px 0px 20px;
            border-radius: 1%;
            border: 1px solid #ced4da;
        }
        
        img{  
            max-height:150px;
            max-width: 150px;
            height:auto;
            width:auto;
            display:block;
            margin-left: auto;
            margin-right: auto;
            cursor: pointer;
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
        <h1 style="text-align: center;">{{$evento->nome}}</h1>
    </div>
     <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
        <h2 style="text-align: center;">Programação</h2>
    </div>
    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" align="right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAtividade" onclick="cadastrar()">Adicionar</button>
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
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($atividades as $atividade)
                    <tr>
                        <td class="text-center align-middle">
                            {{\Carbon\Carbon::parse($atividade->data)->format('d/m/Y')}}
                        </td>
                        <td class="text-center align-middle">
                            {{\Carbon\Carbon::parse($atividade->horario)->format('H:i')}}
                        </td>
                        <td class="text-center align-middle">{{$atividade->nome}}</td>
                        <td class="text-center align-middle">{{$atividade->tipo}}</td>
                        <td class="text-center align-middle">
                            {{\Carbon\Carbon::parse($atividade->duracao)->format('H:i')}}
                        </td>
                        <td class="text-center align-middle">{{$atividade->vagas}}</td>
                        <td class="text-center align-middle" style="white-space: nowrap;">
                            <button class="btn btn-xs" title="Visualizar / Editar" data-toggle="modal" data-target="#modalAtividade" onclick="visualizar('{{$atividade->id}}')"><i class="material-icons">search</i></button>
                            <button class="btn btn-xs" title="Excluir" data-toggle="modal" data-target="#modalExcluirAtividade" onclick="excluir('{{$evento->id}}', '{{$atividade->id}}', '{{$atividade->nome}}')"><i class="material-icons">delete</i></button>
                        </td> 
                    </tr>
                @endforeach    
            </tbody>
        </table>
    </div>
    
    <!-- Modal para cadastrar, visualizar ou editar as atividades do evento -->
    <form method="" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade" id="modalAtividade" tabindex="-1" role="dialog" aria-labelledby="modalAtividade" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModal"></h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group ids">
                            <!-- Passa o id do evento em que a atividade está sendo cadastrada -->
                            <input type="hidden" name="eventoId" value="{{$evento->id}}">
                            <!-- Passa o id da atividade para editar -->
                            <input type="hidden" name="id" value="">
                        </div>
                        <div class="form-group">
                            <label for="nome" class="col-form-label">Nome*:</label>
                            <input type="text" class="form-control edit" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Tipo*:</label>
                            <select class="form-control edit" name="tipo" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="Palestra">Palestra</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Minicurso">Minicurso</option>
                                <option value="Seminário">Seminário</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descricao" class="col-form-label">Descrição:</label>
                            <textarea class="form-control edit" name="descricao" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                    <label for="data" class="col-form-label">Data*:</label>
                                    <input type="date" class="form-control edit" name="data" required>
                                </div>
                                <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                    <label for="horario" class="col-form-label">Horário*:</label>
                                    <input type="time" class="form-control edit" name="horario" required>
                                </div>
                                <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                    <label for="duracao" class="col-form-label">Duração*:</label>
                                    <input type="time" class="form-control edit" name="duracao" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="local" class="col-form-label">Local*:</label>
                            <input type="text" class="form-control edit" name="local" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                                    <label for="vagas" class="col-form-label">Vagas*:</label>
                                    <input type="number" class="form-control edit" name="vagas" min="1" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group palestrante">
                            <label for="palestrante" class="col-form-label">Palestrante / Facilitador(a)</label>    
                            <div class="form-group">
                                <img src="" id="img" alt="Foto" title='Foto'/></br>
                                <input type='file' class="edit" name="fotoPalestrante" id="fotoPalestrante" accept="image/*" hidden>
                                <p style="text-align: center; margin-top: -20px; color: gray;">Utilize uma foto quadrada ou ela não será salva!</p>
                            </div>
                            <div class="form-group" style="margin-top: -30px;">
                                <label for="nomePalestrante" class="col-form-label">Nome*:</label>
                                <input type="text" class="form-control edit" name="nomePalestrante" required>
                            </div>
                            <div class="form-group">
                                <label for="bio" class="col-form-label">Bio / Descrição:</label>
                                <textarea class="form-control edit" name="bio" rows="4"></textarea>
                            </div>
                        </div>
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
    <form method="POST" action="{{route('programacao.excluir')}}">
        @method('DELETE')
        {{ csrf_field() }}
        <div class="modal fade" id="modalExcluirAtividade" tabindex="-1" role="dialog" aria-labelledby="modalExcluirAtividade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir Atividade</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id"/>
                        <input type="hidden" name="eventoId"/>
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
        $('#modalAtividade').on('show.bs.modal');
        
        function cadastrar(){
            $('form').attr('method', 'POST');    
            $('form').attr('action', '{{route('programacao.cadastrar', $evento->id)}}');
            $('.edit').val('');
            var input = document.getElementsByClassName('edit');
            for (var i=0; i<(input.length); i++){
                input[i].disabled = false;
            }            
            
            $('.modal-header #tituloModal').html('Cadastrar atividade');
            $('.modal-body #img').attr("src", 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStl-KWsV0KVxQug2HoR6e3lx6UUSD4KAqyDbevILtDVDvs0YK1xA&s');
            $('.modal-footer #btnEditar').hide();
            $('.modal-footer #btnSalvar').show().html('Salvar');
            $('.modal-footer #btnFechar').html('Fechar');
        }
        
        function visualizar(idatividade){
            var input = document.getElementsByClassName('edit');
            for (var i=0; i<(input.length); i++){
                input[i].disabled = true;
            }            
            
            $('.modal-header #tituloModal').html('Visualizar atividade');
            $('.modal-footer #btnEditar').show();
            $('.modal-footer #btnSalvar').hide();
            $('.modal-footer #btnFechar').html('Cancelar');
            
            $.get('/eventos/get-atividade/' + idatividade, function (atividade){
                $.each(atividade, function (index, value){
                    $('.modal-body [name=id]').val(idatividade);
                    $('.modal-body [name=palestrante_id]').val(value.palestrante_id);
                    $('.modal-body [name=nome]').val(value.nome);
                    $('.modal-body [name=tipo]').val(value.tipo);                            
                    $('.modal-body [name=descricao]').val(value.descricao);
                    $('.modal-body [name=data]').val(value.data);
                    $('.modal-body [name=horario]').val(value.horario);
                    $('.modal-body [name=duracao]').val(value.duracao);
                    $('.modal-body [name=local]').val(value.local);
                    $('.modal-body [name=vagas]').val(value.vagas);
                    $('.modal-body [name=nomePalestrante]').val(value.nomePalestrante);
                    $('.modal-body [name=bio]').val(value.bio);
                    
                    if(value.foto !== null & value.foto !== ""){
                        $('.modal-body #img').attr("src", "http://127.0.0.1:8000/storage/palestrantes/" + value.foto);
                    }else{
                        $('.modal-body #img').attr("src", 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStl-KWsV0KVxQug2HoR6e3lx6UUSD4KAqyDbevILtDVDvs0YK1xA&s');
                    }
                });
            });
        }
        
        function editar() {
            $('form').attr('method', 'POST');
            $('form').attr('action', '{{route('programacao.editar', $evento->id)}}');
            var input = document.getElementsByClassName('edit');

            for (var i=0; i<(input.length); i++) {
                input[i].disabled = false;
            }

            $('.modal-header #tituloModal').html('Editar atividade');
            $('.modal-footer #btnEditar').hide();
            $('.modal-footer #btnFechar').html('Cancelar');
            $('.modal-footer #btnSalvar').show();
        }
        
        $('#modalExcluirAtividade').on('show.bs.modal');
        
        function excluir (eventoId, id, nome) {
            $('#modalExcluirAtividade [name=eventoId]').val(eventoId);
            $('#modalExcluirAtividade [name=id]').val(id);
            $('#modalExcluirAtividade p').text('Tem certeza que deseja excluir ' + nome + '?'); 
        }
    </script>
    
    <!-- Preview da imagem -->
    <script>
        $('#img').click(function() {
            $('#fotoPalestrante').click();
        });

        $("#fotoPalestrante").change(function(event) {  
            readURL(this);    
        });    

        function readURL(input) {    
            
        if (input.files && input.files[0]) {    
            var reader = new FileReader();
                var filename = $("#img").val();
                filename = filename.substring(filename.lastIndexOf('\\')+1);
                reader.onload = function(e) {
                    $('img').attr('src', e.target.result);
                    $('img').hide();
                    $('img').fadeIn(500);

                };
                reader.readAsDataURL(input.files[0]); 
            } 
        }
    </script>
@endsection