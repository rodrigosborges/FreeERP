@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('css')
    
@endsection

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        
        <!-- Verifica se a variável 'eventoId' está vazia/nula para selecionar o evento -->
        @if(!$evento)
            <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
                <h1 style="text-align: center;">Inscritos</h1>
                <form method="POST" action="{{route('pessoas.exibir')}}">
                    {{ csrf_field() }}
                    <div class="form-group" style="margin-top: 25px;">
                        <label for="evento">Selecione o evento</label>
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
                <h1>Inscritos</h1>
                <h3>{{$evento->nome}}</h3>
            </div>
        
            <div class="col-xm-10 col-sm-10 col-md-10 col-lg-10">
                <form method="POST" action="{{route('pessoas.exibir')}}">
                    {{ csrf_field() }}
                    <div class="form-group" style="margin-bottom: 40px;">
                        <input type="hidden" name="evento" value="{{$evento->id}}">
                        <label for="atividade">Filtrar por atividade</label>
                        @if(count($evento->programacao) > 0)
                            <select class="form-control" name="atividade" style="margin-bottom: 10px;">
                                <option value="todas" selected>Todas</option>
                        @else
                            <select class="form-control" name="atividade" style="margin-bottom: 10px;" disabled>
                                <option value="">Não há atividades cadastradas</option>
                            @endif
                            @foreach ($evento->programacao as $atividade)
                                <option value="{{$atividade->id}}" @if(count($programacao) == 1 && $programacao[0]->id == $atividade->id) selected @endif>{{$atividade->nome}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-default">Ok</button>
                    </div> 
                </form>
            </div>
        
            <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" align="right">
                @if(!$evento->certificado)
                    <button class="btn btn-success imprimir">Imprimir lista</button>
                    <button class="btn btn-primary btnGerar" data-toggle="modal" data-target="#modal">Gerar certificados</button>
                @else
                    <button class="btn btn-success btnGerado" disabled>Certificados gerados</button>
                @endif
            </div>
            <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
                <table id="pessoas" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Nome</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Inscrito(a) em</th>
                            <th class="text-center">Faltou</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programacao as $atividade)
                            @foreach($atividade->participantes as $pessoa)
                                {{DB::table('evento_has_participante')->where('pessoa_id', '=', $pessoa->id)->where('programacao_id', '=', $atividade->id)->pluck('faltou')}}
                                <tr>
                                    <td class="text-center align-middle">{{$pessoa->nome}}</td>
                                    <td class="text-center align-middle">{{$pessoa->email}}</td>
                                    <td class="text-center align-middle">{{$atividade->nome}}</td>
                                    <td class="text-center align-middle"><input type="checkbox" name="faltou" pessoa="{{$pessoa->id}}" atividade="{{$atividade->id}}" @if(DB::table('evento_has_participante')->where('pessoa_id', '=', $pessoa->id)->where('programacao_id', '=', $atividade->id)->pluck('faltou')->first() == 1) checked @endif @if($evento->certificado) disabled @endif></td>
                                    <td class="text-center align-middle">
                                        @if(!$evento->certificado)
                                            <button title="Remover" class="btn btn-xs" data-toggle="modal" data-target="#modal" onclick="excluir({{$pessoa->id}}, {{$atividade->id}}, '{{$pessoa->nome}}')"><i class="material-icons">delete</i></button>
                                        @else
                                            <button title="Remover" class="btn btn-xs" disabled><i class="material-icons">delete</i></button>
                                        @endif
                                    </td> 
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif        
        
        <!-- Modal de confirmação de exclusão -->
        <form method="POST" action="">
            {{ csrf_field() }}
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloModal"></h5>
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
            var table = $('#pessoas').DataTable({
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
        function excluir(id, atividadeId, nome){
            $('form').attr('method', 'POST');
            $('form').attr('action', '{{route('pessoas.excluir')}}');
            $('.modal-header #tituloModal').html('Cancelar inscrição');
            $('.modal-body #id').val(id);
            $('.modal-body #AtividadeId').val(atividadeId);
            $('.modal-body p').text('Tem certeza que deseja cancelar a inscrição de ' + nome + ' nessa atividade?');
        }
        
        function certificado(){
            $('form').attr('method', 'GET');
            $('form').attr('action', '{{route('gerar.certificados', $evento->id)}}');
            $('.modal-header #tituloModal').html('Gerar certificados');
            $('.modal-body #id').val('$pessoa->id');
            $('.modal-body #AtividadeId').val('$atividade->id');
            $('.modal-body p').text('O certificado será emitido para todos os participantes presentes do evento. Deseja realmente emitir agora?');
        }
    </script>
    
    <!-- Certificado -->
    <script>
        $('.btnGerar').click(function(){
            certificado();
        });        
    </script>
    
    <!-- Inscritos ausentes -->
    <script>
        $('[name=faltou]').change(function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({
                method:"POST",
                url:"{{route('pessoas.presenca')}}",
                data: {pessoa: $(this).attr("pessoa"), atividade: $(this).attr("atividade"), faltou: $(this).is(":checked")}
            });
        });
    </script>
    
    <!-- Imprimir lista -->
    <!-- VERIFICAR BLOQUEADOR DE POP-UP!!! -->
    <script>
        $('.imprimir').click(function(){
            $.each({!!$programacao!!}, function(index, value){
                var url = "{{ route('gerar.lista', ":id") }}";
                url = url.replace(':id', value.id);
                window.open(url, '_blank');
            });
        });
    </script>
@endsection