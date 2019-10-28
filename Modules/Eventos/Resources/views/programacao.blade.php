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
                        <td class="text-center align-middle">
                            <button class="btn btn-xs" data-toggle="modal" data-target="#modalEditarPessoa"><i class="material-icons">edit</i></button>
                            <button class="btn btn-xs" data-toggle="modal" data-target="#modalExcluirPessoa"><i class="material-icons">delete</i></button>
                        </td> 
                    </tr>
                @endforeach    
            </tbody>
        </table>
    </div>
    
    <!-- Modal para cadastrar as atividades do evento -->
        <form method="post" action="{{route('programacao.cadastrar', $evento->id)}}">
            {{ csrf_field() }}
            <div class="modal fade" id="modalCadastrarAtividade" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarAtividade" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloModal">Cadastrar Atividade</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <!-- Passa o id do evento em que a atividade está sendo cadastrada -->
                                <input type="hidden" name="eventoId" value="{{$evento->id}}">
                            </div>
                            <div class="form-group">
                                <label for="nome" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Tipo:</label>
                                <select class="form-control" name="tipo" required>
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="Palesta">Palestra</option>
                                    <option value="Workshop">Workshop</option>
                                    <option value="Minicurso">Minicurso</option>
                                    <option value="Seminário">Seminário</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descricao" class="col-form-label">Descrição:</label>
                                <textarea class="form-control" name="descricao" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                        <label for="data" class="col-form-label">Data:</label>
                                        <input type="date" class="form-control" name="data" required>
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                        <label for="horario" class="col-form-label">Horário:</label>
                                        <input type="time" class="form-control" name="horario" required>
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-5 col-lg-3">
                                        <label for="duracao" class="col-form-label">Duração:</label>
                                        <input type="time" class="form-control" name="duracao" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="local" class="col-form-label">Local:</label>
                                <input type="text" class="form-control" name="local" required>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                                        <label for="vagas" class="col-form-label">Vagas:</label>
                                        <input type="number" class="form-control" name="vagas" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group palestrante">
                                <label for="palestrante" class="col-form-label">Palestrante / Facilitador(a)</label>    
                                <div class="form-group">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStl-KWsV0KVxQug2HoR6e3lx6UUSD4KAqyDbevILtDVDvs0YK1xA&s" id="fotoPalestrante" alt="Foto" title='Foto'/></br>
                                    <input type='file' id="inputImg" accept="image/*" hidden>
                                </div>
                                <div class="form-group" style="margin-top: -50px;">
                                    <label for="nomePalestrante" class="col-form-label">Nome:</label>
                                    <input type="text" class="form-control" name="nomePalestrante" required>
                                </div>
                                <div class="form-group">
                                    <label for="bio" class="col-form-label">Bio / Descrição:</label>
                                    <textarea class="form-control" name="bio" rows="4"></textarea>
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
    
    <!-- Preview da imagem -->
    <script>
        $('#fotoPalestrante').click(function() {
                $('#inputImg').click();
            });

            $("#inputImg").change(function(event) {  
                readURL(this);    
            });    
    
            function readURL(input) {    
                if (input.files && input.files[0]) {   
                    var reader = new FileReader();
                    var filename = $("#fotoPalestrante").val();
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