@extends('template')

@section('content')
    
    <div class="card">
    <div class="card-header d-flex justify-content-center"><h3>Mensagem</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST" >
            {{ csrf_field() }}
            <hr> 

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label class="font-weight-bold" for="candidato">Candidatos</label>
                        <select class="js-example-basic-multiple form-control" name="candidatos[]" id='myselect2' multiple="multiple" style='width:100%'>
                            @foreach($data['model'] as $candidato)
                            <option  value="{{$candidato->id}}">{{$candidato->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="assunto" class="control-label">Assunto</label>
                        <input required type="text" name="mensagem[assunto]" id="assunto" class="form-control" value="">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="mensagem">Mensagem</label>
                <textarea class="form-control" id="mensagem" name="mensagem[mensagem]" rows="6"> </textarea>
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="material-icons" style=" vertical-align: middle;">email</i> {{ $data['button'] }} </button> 
            </div>

            <input type="text" name="mensagem[email]" value="" style="display:none">

        </form>
    </div>
    </div>
    

@endsection
@section('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


@endsection