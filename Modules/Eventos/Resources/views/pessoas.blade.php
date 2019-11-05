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
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
            <h1>Pessoas</h1>
            <h3>{{$evento->nome}}</h3>
        </div>
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
            <table id="pessoas" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Inscrito(a) em</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evento->programacao as $atividade)
                        @foreach($atividade->participantes as $pessoa)
                            <tr>
                                <td class="text-center align-middle">{{$pessoa->nome}}</td>
                                <td class="text-center align-middle">{{$pessoa->email}}</td>
                                <td class="text-center align-middle">{{$atividade->nome}}</td>
                                <td class="text-center align-middle">
                                    <button title="Remover" class="btn btn-xs" data-toggle="modal" data-target="#modalExcluirPessoa" data-id="{{$pessoa->id}}" data-nome="{{$pessoa->nome}}" data-atividade="{{$atividade->id}}"><i class="material-icons">delete</i></button>
                                </td> 
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif        
        
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
                            <!-- Passa o id da atividade e da id da pessoa para excluir-->
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="AtividadeId" id="AtividadeId">
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
        
        $('#modalExcluirPessoa').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var AtividadeId = button.data('atividade');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #AtividadeId').val(AtividadeId);
            modal.find('.modal-body p').text('Tem certeza que deseja remover a inscrição de ' + nome + ' dessa atividade?');
        });
    </script>
    
@endsection