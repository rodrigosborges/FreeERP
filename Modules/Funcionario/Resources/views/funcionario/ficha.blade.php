@extends('funcionario::template')
@section('title','Ficha de funcionário')
@section('body')

<button class="imprimir-button btn btn-primary"><i class="material-icons">print </i></button>
<div id="ficha">
    <div class="container">
    <div class="row">
        <div class="col-lg-2 text-center change-class-2">
            <img class="img-fluid" src="{{ URL::to('/') }}/img/user-img.jpg" style="height:170px; width:200px;">
        </div>
        <div class="col-lg-10 change-class-10">
            <div class="row d-flex justify-content-center"><span class="h2">{{$data["funcionario"]->nome}}</span></div>
            <hr>
           <div class="row">
                <div class="col">
                    <p><span class="font-weight-bold">Cargo: {{$data["funcionario"]->cargos()->get()->first()->nome}}</p>
                    <p><span class="font-weight-bold">Data Admissão: </span>{{$data["funcionario"]->data_admissao}}</p>
                    <p><span class="font-weight-bold">Data de Nascimento: </span>{{$data["funcionario"]->data_nascimento}}</p>
                </div>
                <div class="col">
                    <p><span class="font-weight-bold">Sexo: </span>{{$data["funcionario"]->sexo == 1 ? 'Masculino' : 'Feminino'}}</p> 
                    <p><span class="font-weight-bold">Estado Civil: </span>{{$data["funcionario"]->estado_civil->nome}}</p>
                </div>
            </div>              
        </div>
    </div>
    <hr>
    <h4 class=" text-center mb-4"><!--<i class="material-icons mr-2">contact_phone </i> -->Documento</h4>
    <div class="row">
        <div class="col-sm">
            <div class="row">
               
            </div>      
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="row">
            @foreach ($data["docs"] as $doc)
                <div class="col-6">
                        <span class="font-weight-bold">{{$doc->nome}}:</span>{{$doc->numero}} 
                </div>
            @endforeach
            </div>      
        </div>
    </div>
    <hr>

    <h4 class=" text-center mb-4">Endereço</h4>    
    
    <div class="row">        
        <div class="col-6">   
                <span class="font-weight-bold">CEP: </span>{{$data["funcionario"]->endereco->cep}}
        </div>

        <div class="col-6">
                <span class="font-weight-bold">Bairro: </span>{{$data["funcionario"]->endereco->bairro}}
        </div>

        <div class="col-6">
                <span class="font-weight-bold">N°: </span>{{$data["funcionario"]->endereco->numero}}
        </div>

        <div class="col-6">
                <span class="font-weight-bold">complemento: </span>{{$data["funcionario"]->endereco->complemento}}
        </div>

        <div class="col-6">
                <span class="font-weight-bold">Cidade: </span>{{$data["cidade"]->nome}}
        </div>

        <div class="col-6">
                <span class="font-weight-bold">Estado: </span>{{$data["estado"]->nome}}
        </div>

        <div class="col-6">
                <span class="font-weight-bold">lougradouro: </span>{{$data["funcionario"]->endereco->lougradouro}}
        </div>
    </div>
    <hr>

    <h4 class=" text-center mb-4">Contato</h4>
'        <div class="row">   
            <div class="col-6">
                <span class="font-weight-bold">E-mail: </span>{{$data["funcionario"]->email->email}}
                @foreach($data["funcionario"]->telefone as $telefone)    
                    <p><span class="font-weight-bold">Telefone:</span> {{$telefone->numero}}</p>
                @endforeach
            </div>
        </div>
    <hr>
    
    <h4 class=" text-center mb-4">Dependentes</h4>
    @foreach($data["dependetes_nome"] as $dependente_nome)
        <div class="row"> 
            <div class="col-3"><span class="font-weight-bold">Nome: </span>{{$dependente_nome->nome}}</div>
        @foreach($data["dependentes"] as $dependente)    
            <div class="col-3"><span class="font-weight-bold">Mora Junto: </span>{{ $dependente->mora_junto ? 'Sim' : 'Não'}}</div>        
            <div class="col-3"><span class="font-weight-bold">Certidão de Matricula: </span>{{ $dependente->certidao_matricula ? 'Sim' : 'Não'}}</div>
            <div class="col-3"><span class="font-weight-bold">Certidão Vacina: </span>{{ $dependente->mora_junto ? 'Sim' : 'Não'}}</div>                
        
        @endforeach
        </div>
    @endforeach
    <hr>
    
</div>
    @endsection

@section('js')

    <script src="{{Module::asset('funcionario:js/bibliotecas/printThis.js')}}"></script>

    <script>
        $(document).on('click','.imprimir-button', function(){
            $(".change-class-2").toggleClass("col-lg-2").toggleClass("col-2");
            $(".change-class-10").toggleClass("col-lg-10").toggleClass("col-10");
            var dNow = new Date();
            var day = dNow.getDate() < 10 ? "0"+dNow.getDate() : dNow.getDate()
            var month = dNow.getMonth() < 9 ? "0"+dNow.getMonth() : dNow.getMonth()
            var hours = dNow.getHours() < 10 ? "0"+dNow.getHours() : dNow.getHours()
            var minutes = dNow.getMinutes() < 10 ? "0"+dNow.getMinutes() : dNow.getMinutes()
            var localdate = day + '/' + month + '/' + dNow.getFullYear() + ' ' + hours + ':' + minutes;

            $("#ficha").printThis({
                header: "<h1 class='text-center'>Ficha de funcionário<h1><hr><br>",
                footer: `<span class='text-center bottom-center-absolute titulo_cargo'>${localdate}<span><hr><br>`,
                afterPrint: function(){
                    $(".change-class-2").toggleClass("col-lg-2").toggleClass("col-2");
                    $(".change-class-10").toggleClass("col-lg-10").toggleClass("col-10");
                }
            });
        })
    </script>

@endsection