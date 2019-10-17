@extends('template')
@section('content')
    
    <div class="card">
    <div class="card-header"><h3>Mensagem</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST" >
            {{ csrf_field() }}
            @if($data['model'])
                @method('PUT')
            @endif
            <h3>Candidato: {{$data['candidato']->nome}}</h3>
            <hr> 
            
            <div class="form-group">
                <label for="mensagem">Mensagem</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="6"></textarea>
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('recrutamento/vaga/candidatos/')}}{{'/'.$data['candidato']->vaga()->first()->id}}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>

            <input type="text" name="candidato_id" value="{{$data['candidato']->id}}" style="display:none">

        </form>
    </div>
    </div>
    

@endsection

@section('js')

<script type="text/javascript">
    
    $(function() {
        $( "#calendario" ).datepicker();
    });


</script>     

@endsection