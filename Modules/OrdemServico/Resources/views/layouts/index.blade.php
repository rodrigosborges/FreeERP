@extends('ordemservico::layouts.informacoes')
@section('content')

<!---- Busca ----->
<form method="GET" action="#">
    <div class="form-row form-group">
        {!! Form::label('busca', 'Procurar por', ['class' => 'col-sm-2 col-form-label text-right']) !!}
        <div class="input-group col-sm-8">
            {!! Form::text('busca', isset($busca) ? $busca : null, ['class' => 'form-control']) !!}
            <div class="input-group-append">
                {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</form>

<nav class="nav nav-tabs">
    <a href="#ativos" data-toggle="tab" class="nav-item nav-link active show">
        Ativos
    </a>
    <a href="#inativos" data-toggle="tab" class="nav-item nav-link">
        Inativos
    </a>
</nav>

<div class="tab-content">
    <div id="ativos" class="tab-pane fade in active show">
        <div class="text-center">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <!--- Gera titulo para a coluna com atributos do modelo -->
                        @foreach($data['atributos'] as $atributo)
                        <th>{{($atributo)}}</th>
                        @endforeach

                        <!--- Se a opção cadastrar tiver habilitada , criar botão de cadastro --->
                        @if($data['cadastro'] != null)
                        <th><a class="btn btn-success center-block" href="{{  route($data['route'] . 'create') }}">{{$data['cadastro']}}</a></th>
                        @else
                        <th></th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    <!--- Gera Linhas com atributos e dados do banco --->
                    @foreach($data['ativos'] as $model)
                    <tr>
                        @foreach($data['atributos'] as $atributo)
                        <td>{{$model->$atributo}}</td>
                        @endforeach

                        <!---- Se existir ações possíveis , habilita-las --->
                        @if($data['acoes'])
                        <td>
                            @foreach($data['acoes'] as $acao)
                            <a class="{{$acao['class']}}" href="{{route($data['route'] . $acao['complemento-route'],$model->id)}}">{{$acao['nome']}}</a>
                            @endforeach
                            <a class="btn btn-outline-danger btn-sm" id='delete' onclick="confirmar('{{route($data['route'] . 'destroy' , $model->id )}}')" data-id={{$model->id}}> Delete </a>
                            </form>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!--- Tabela Inativos -->
    <div id="inativos" class="tab-pane fade">
        <div class="text-center">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <!--- Gera titulo para a coluna com atributos do modelo -->
                        @foreach($data['atributos'] as $atributo)
                        <th>{{($atributo)}}</th>
                        @endforeach
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!--- Gera Linhas com atributos e dados do banco --->
                    @foreach($data['inativos'] as $model)
                    <tr>
                        @foreach($data['atributos'] as $atributo)
                        <td>{{$model->$atributo}}</td>
                        @endforeach
                        <td>
                            <form action="{{route('modulo.os.destroy',$model->id)}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                {{Form::submit( 'Restaurar',array('class'=>"btn btn-outline-danger btn-sm") )}}
                                {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<!--- Modal Deletar -->
<div class="modal fade" id="verifica-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                </button>
            </div>
            <div class="modal-body">
                <h5>Tem certeza que deseja excluir?</h5>
                <p class="text-secondary">Você poderá recuperar na aba de reativação </p>
                <form id="form-delete" method="POST">
                    {{method_field('DELETE')}}
                    {{ csrf_field() }}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                {{Form::submit( 'Sim',array('class'=>"btn btn-primary") )}}
            </div>
            {{ Form::close() }}


        </div>
    </div>
</div>


<!--- Modal Prioridade -->
<div class="modal fade" id="verifica-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                </button>
            </div>
            <div class="modal-body">
                <h5>Tem certeza que deseja excluir?</h5>
                <p class="text-secondary">Você poderá recuperar na aba de reativação </p>
                <form id="form-delete" method="POST">
                    {{method_field('DELETE')}}
                    {{ csrf_field() }}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                {{Form::submit( 'Sim',array('class'=>"btn btn-primary") )}}
            </div>
            {{ Form::close() }}


        </div>
    </div>
</div>

<!--- Paginaçao --->
<div class="row justify-content-center">
    {{ $data['ativos']->links() }}
</div>
@endsection

@section('js')
<script>
    function confirmar(rota) {
        $("#form-delete").attr("action", rota);
        $('#verifica-delete').modal('show');
    };
</script>
@endsection