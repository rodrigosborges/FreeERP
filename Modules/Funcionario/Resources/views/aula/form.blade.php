@extends('template.main')

@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nome" class="control-label">Nome</label>
            <input required type="text" name="nome" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
        </div>

        <div class="form-group">
            <label for="sigla" class="control-label">Sigla</label>
            <input required maxlength=3 type="text" name="sigla" id="sigla" class="form-control" value="{{ $data['model'] ? $data['model']->sigla : old('sigla', "") }}">
        </div>

        <div class="form-group">
            <label for="professor" class="control-label">Professor</label>
            <select required name="professor_id" class="form-control">
                    <option value="">Selecione uma opção</option>
                @foreach ($data['professores'] as $item)
                    <option value="{{ $item->id }}" {{ ( $data['model'] && $item->id == $data['model']->professor_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach 
            </select>
        </div>
        <label for="aluno" class="control-label">Alunos</label>
        <div class="aluno-select">
            @foreach($data['aulas_alunos'] as $aluno)
                <div class="form-group">
                    <div class="input-group">
                        <select required name="alunos[]" class="form-control">
                            <option value="">Selecione uma opção</option>
                            @foreach ($data['alunos'] as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $aluno  ? 'selected' : '' }}> {{ $item->nome }} - {{$item->prontuario}} </option>
                            @endforeach 
                        </select>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-success" id="adicionar">Adicionar</button>
            <button type="button" class="btn btn-danger" id="remover">Remover</button>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('/aula') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>
        
    </form>

@endsection

@section('js')

    <script>
        $("#adicionar").on("click", function(){
            var div = $(".aluno-select .form-group").first().clone()
            div.find("select").val("")
            div.appendTo($(".aluno-select"))
        })

        $("#remover").on("click", function(){
            if($(".aluno-select .form-group").length > 1)
                $(".aluno-select .form-group").last().remove()
        })
    </script>

@endsection