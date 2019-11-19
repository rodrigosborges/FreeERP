@extends('estoquemadeireira::layouts.master')

@section('title', 'Cadastro de Cliente')

@section('content')



    <div class="container col-12" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                   <h1>Cadastro de Cliente</h1> 
                </div>
                <form action="{{isset($cliente) ?  url('/estoquemadeireira/vendas/clientes/' . $cliente->id) : url('/estoquemadeireira/vendas/clientes')}}" method="POST">
            @csrf
            @if(isset($cliente))
                @method('put')
            @endif

                <div class="row ml-2 mt-2">
                    <div class="form-group col-3">
                        <label for="nome">Nome</label>
                        <input required type="text" class="form-control" placeholder="Insira o nome do Cliente" name="nome" value="{{isset($cliente) ? $cliente->nome : ''}}">
                        <span style="color:red">{{$errors->first('nome')}}</span>
                    </div>
                    <div class="form-group col-3">
                        <label for="nome">Telefone</label>
                        <input required minlength="13" type="numeric" class="form-control" placeholder="Insira o telefone" name="telefone" id="telefone" value="{{isset($cliente) ? $cliente->telefone : ''}}">
                        <span style="color:red">{{$errors->first('telefone')}}</span>
                    </div>  

                    <div class="form-group col-4 ml-2">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" name="endereco" placeholder="Insira o Endereço" id="endereco" value="{{isset($endereco) ? $endereco->endereco: ' '}}">
                        <label for="endereco">Complemento</label>
                        <input type="text" class="form-control" name="complemento" placeholder="Insira o Endereço" id="complemento" value="{{isset($endereco) ? $endereco->complemento: ' '}}">
                    </div>

                </div>  
                
                <div class="row ml-2 mt-2">
                    <div class="form-group col-4">
                        <label for="email">Email</label>
                        <input required type="email" class="form-control" name="email" id="email" placeholder="insira o Email" value="{{isset($cliente) ? $cliente->email: ''}}">
                    </div>
                    
                    
                    
                    
                    <div class="form-group col-3">
                        <label for="tipoDocumento">Pessoa Física ou Jurídica:</label>
                        <select required class="form-control maskField" id="tipoDocumento" name="tipoDocumento_id" data-target-id="documento">
                            <option value="">Selecione</option>
                            <option value="1" data-mask="000.000.000-00">Pessoa Física</option>
                            <option value="2" data-mask="00.000.000/0000-00">Pessoa Jurídica</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-3">
                        <label for="documento">Informe seu CPF/CNPJ:</label>
                        <input required minlength="14" type="text" id="documento" name="documento" class="form-control"/>
                    </div>
                    
                
                    <div class="row col-12 mb-2" style="justify-content: flex-end;">
                        <button type="submit" class="btn btn-primary">{{isset($cliente) ? 'Salvar' : 'Cadastrar' }}</button>
                    </div>
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

<script type="text/javascript">
	$(document).ready(function(){	
        $("#alert").hide();
        $("#cnpj").mask("99.999.999/9999-99");
        $("#telefone").mask("(99)9999-99999");
       
	});
    $(function() {
        $('.maskField').on('change', function(e) {
            var value = $(this).val();
            if (value == "") return;
            var mask = $(this).find(':selected').data('mask');
            var target = "#" + $(this).data('target-id');
            $(target).mask(mask);
            $(target).attr('placeholder', mask);
    });
});
</script>

@endsection