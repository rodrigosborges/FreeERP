@extends('template')
@section('content')
    
    <div class="card">
    <div class="card-header"><h3>Entrevista</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST" >
            {{ csrf_field() }}
            @if($data['model'])
                @method('PUT')
            @endif
            <h3>Candidato: {{$data['candidato']->nome}}</h3>
            <hr> 
            <div class="form-group form-row mb-3 ">
                <div class="col-md-3 offset-md-1">
                    <label for="data">Data:</label>
                    <input type="date" class="form-control" name="data" />
                </div>

                <div class="col-md-2 offset-md-1">
                    <label for="hora">Hora:</label>
                    <input type="time" id="hora" class="form-control" name="hora"  />
                </div>

                <div class="col-md-3 offset-md-1">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"  />
                </div>
            </div>

            <div class="form-group form-row mb-3">
                <div class="col-md-12">
                    <label for="local">Local:</label>
                    <input type="text" id="local" class="form-control" name="local"  />
                </div>
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('recrutamento/entrevista') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
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