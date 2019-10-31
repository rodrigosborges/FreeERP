@extends('estoquemadeireira::layouts.master')

@section('title', 'Cadastro de Fornecedor')

@section('content')



    <div class="container col-12" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                   <h1>Cadastro de Fornecedor</h1> 
                </div>
                <form action="{{isset($fornecedor) ?  url('/estoquemadeireira/produtos/fornecedores/' . $fornecedor->id) : url('/estoquemadeireira/produtos/fornecedores')}}" id="formulario" method="POST">
                    @csrf
                    @if(isset($fornecedor))
                        @method('put')
                    @endif
                        <p id="alert" class="alert text-center"></p>
                        <div class="row mt-2 ml-2">
                            <div class="form-group col-4">
                                <label for="nome">Nome</label>
                                <input required type="text" class="form-control" maxlength="45" placeholder="Insira o nome do Fornecedor" name="nome" value="{{isset($fornecedor) ? $fornecedor->nome : ''}}">
                                <span style="color:red">{{$errors->first('nome')}}</span>
                            </div>
                    
                            <div class="form-group col-4">
                                <label for="endereco">Endereço</label>
                                <input required type="text" class="form-control" placeholder="Insira o endereço do Fornecedor" name="endereco" value="{{isset($fornecedor) ? $fornecedor->endereco : ''}}">
                                <span style="color:red">{{$errors->first('endereco')}}</span>
                            </div>               
                        
                            <div class="form-group col-2 ">
                                <label for="numero"></label>
                            </div>

                        </div>

                        <div class="row mt-2 ml-2">
                            <div class="form-group col-4">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" class="form-control" placeholder="Insira o CNPJ" id="cnpj" name="cnpj" value="{{isset($fornecedor) ? $fornecedor->cnpj : ''}}">
                                <span style="color:red">{{$errors->first('cnpj')}}</span>
                            </div>

                            <div class="form-group col-4">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" placeholder="Insira o telefone" id="telefone" name="telefone" value="{{isset($fornecedor) ? $fornecedor->telefone : ''}}">
                                <span style="color:rede">{{$errors->first('telefone')}}</span>
                            </div>

                        </div>

                        <div class="row col-4 ml-2">
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select class="form-control" name="categoria_id">
                                    @if(isset($produto))
                                        @foreach($categorias as $categoria)
                                            @if($categoria->id == $produto->categoria_id)
                                                <option value="{{$categoria->id}}" selected>{{$categoria->nome}}</option>
                                            @else
                                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option disabled value="" selected>Selecione uma Categoria</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                            @endforeach
                                    @endif
                                </select>
                                {{$errors->first('categoria_id')}}            
                            </div>
                        </div>
                    
                        <div class="row col-8 mb-2" style="justify-content: flex-end;">
                            <button type="submit" id="cadastrar" class="btn btn-primary">{{isset($categoria) ? 'Salvar' : 'Cadastrar' }}</button>
                        </div>
                
                </form>
        
        </div>
        
     
    </div>       

  


@endsection
@section('js')
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>


<script type="text/javascript">
	$(document).ready(function(){	
        $("#alert").hide();
        $("#cnpj").mask("99.999.999/9999-99");
        $("#telefone").mask("(99)99999-9999");
        $("#cadastrar").click(function(e){
            validaCnpj(e)
            validaTelefone(e)
         
        })
	});

    $("#formulario").validade({
        rules: {
            'nome': {
                maxlength: 2,
            }
        },
        messeges: {}
    })

    function validaCnpj(e){
        $("#alert").hide();
            e.preventDefault()
            var valida = (/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/)
            if(valida.test($("#cnpj").val()))
                $("#formulario").submit()
            else{
                $("#alert").fadeIn("slow")
                $("#alert").html("CNPJ inválido")
                $("#alert").addClass("alert-warning")
            }
    }

    function validaTelefone(e){
        $("#alert").hide()
            e.preventDefault()
            var valida =  (\([0-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})
            if(valida.test($("telefone").val()))
                $("#formulario").submit()
            else {
                $("#alert").fadeIn("slow")
                $("#alert").html("Telefone inválido!")
                $("#alert").addClass("alert-warning")
            }
    }   
</script>

@endsection