@extends('usuario::layouts.informacoes')

@section('content')
<div class="card" style="margin:0 5% 0 5%;">
    <div class="card-body">
        <div class="row justify-content-center align-items-center" style="height:100%">
            <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
                <div>
                    @if(Session::has('erro'))
                    <p>{{Session::get('erro')}}</p>
                    @endif
                </div>
                <h2 class="my-4 card-title">Cadastrar Papel</h1>
                <form id="papelForm" method="POST" action="{{ url((isset($papel) ? ('papel/'.$papel->id) : 'papel') ) }}">
                    @if(isset($papel))
                        @method('PUT')
                    @endif
                        
                    @csrf

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input id="nome" value="{{old('nome', isset($papel) ? $papel->nome : '')}}" class="form-control" type="text" name="nome">
                        {{$errors->first('nome')}}
                    </div>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                    <br>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{{asset('js/jquery.validate.min.js')}}"></script>

<script>
    $("#papelForm").validate({
        rules: {
            nome: {
                required:true,
                minlength:3,
                maxlength:30,
                lettersonly:true
            }
        },
        messages:{
            nome: {
                required: "<span style='color:red'>Favor insira um nome!</span>",
                minlength: "<span style='color:red'>Mínimo 3 caracteres!</span>",
                maxlength: "<span style='color:red'>Máximo 30 caracteres!</span>",
            }
        }
    });
    
    jQuery.validator.addMethod("lettersonly", function(value, element) 
    {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "<span style='color:red'>Apenas letras e espaços!</span>");
</script>
@endsection