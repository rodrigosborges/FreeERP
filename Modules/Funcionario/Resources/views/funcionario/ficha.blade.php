@extends('funcionario::template')
@section('title','Ficha de funcionário')
@section('body')

<button class="imprimir-button btn btn-primary"><i class="material-icons">print </i></button>
<div id="ficha">
    <div class="container">
    <div class="row">
        <div class="col-lg-2 change-class-2">
            <img class="img-fluid" src="{{ URL::to('/') }}/img/user-img.jpg" style="height:150px; width:250px;">
        </div>
        <div class="col-lg-10 change-class-10">
            <span class="h2">{{$data["funcionario"]->nome}}</span>
            <hr>
            <div class="row col-12">
                <p class="col-6"><span class="font-weight-bold">Cargo: </span> {{$data["funcionario"]->cargos()->get()->first()->nome}}</p>
                <p class="col-3"><span class="font-weight-bold">Sexo: </span>{{$data["funcionario"]->sexo == 1 ? 'Masculino' : 'Feminino'}}</p> 
                <p class="col-3"><span class="font-weight-bold">Estado Civil: </span>{{$data["funcionario"]->estado_civil->nome}}</p>
            </div>
            <div class="row col-12">
                <p class="col-4"><span class="font-weight-bold">Data Admissão: </span>{{\Carbon\Carbon::parse($data["funcionario"]->data_admissao)->format('d/m/Y')}}</p>
                <p class="col-5"><span class="font-weight-bold">Data de Nascimento: </span>{{\Carbon\Carbon::parse($data["funcionario"]->data_nascimento)->format('d/m/Y')}}</p>
                <span class="col-3"></span>
            </div>
        </div>
    </div>
    <hr>
    <h4 class=" mt-4 mb-3">Documento</h4>
    <div class="row mb-4">
        <div class="col-sm">
            <div class="row">
            @foreach ($data["docs"] as $doc)
                <div class="col-4 mb-1">
                        <span class="font-weight-bold">{{$doc->nome}}:</span>{{$doc->numero}} 
                </div>
            @endforeach
            </div>      
        </div>
    </div>
    <hr>

    <h4 class=" mt-4 mb-3">Endereço</h4>    
    
    <div class="row mb-4">    
        <div class="col-2">   
            <span class="font-weight-bold">CEP:</span>{{$data["funcionario"]->endereco->cep}} 
            
        </div>

        <div class="col-2">
                <span class="font-weight-bold">Estado: </span>{{$data["estado"]->uf}}
        </div>
    
        <div class="col-3">
            <span class="font-weight-bold">Cidade: </span>{{$data["cidade"]->nome}}   
            
        </div>

        <div class="col-5">
            <span class="font-weight-bold">Bairro: </span>{{$data["funcionario"]->endereco->bairro}}
            
        </div>

        <div class="col-4">
            <span class="font-weight-bold">Lougradouro: </span>{{$data["funcionario"]->endereco->lougradouro}}
            
                
        </div>

        <div class="col-1">
                <span class="font-weight-bold">N°:</span>{{$data["funcionario"]->endereco->numero}}   
                
        </div>

        <div class="col-5">
                <span class="font-weight-bold">Comple: </span>{{$data["funcionario"]->endereco->complemento}}
        </div>

    </div>
    <hr>
    
    <h4 class="mt-4">Contato</h4>
        <div class="row mb-4">   
            <div class="col-4">
                <span class="font-weight-bold">E-mail: </span>{{$data["funcionario"]->email->email}}
            </div>
            <div class="col-4">
                @foreach($data["funcionario"]->telefone as $telefone)    
                <span class="font-weight-bold">Telefone:</span> {{$telefone->numero}}
                @endforeach
            </div>
        </div>
    <hr>

    <h4 class="mt-4 mb-3">Dependentes</h4>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th col="4">Nome</th>
                <th scope="col">Mora Junto</th>
                <th scope="col">C. Matricula</th>
                <th scope="col">C. Vacina</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data["funcionario"]->dependente()->get() as  $dependente)  
            <tr>
                <td>{{$dependente->nome}}</td>
                <td>{{ $dependente->mora_junto ? 'Sim' : 'Não'}}</td>
                <td>{{ $dependente->certidao_matricula ? 'Sim' : 'Não'}}</td>
                <td>{{ $dependente->mora_junto ? 'Sim' : 'Não'}}</td>
            </tr>
            @endforeach    
        </tbody>
    </table>
        
    <hr>

    
    <h4 class="mt-4 mb-3">Curso</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Area</th>
                <th scope="col">Duração</th>
                <th scope="col">Realizado</th>
                <th scope="col">Valido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data["funcionario"]->curso()->get() as  $curso)  
            <tr>
                <td>{{$curso->nome}}</td>
                <td>{{$curso->area_atuacao}}</td>
                <td>{{$curso->duracao_horas_curso}}</td>
                <td>{{$curso->data_realizacao}}</td>
                <td>{{$curso->validade_curso}}</td>
            </tr>
            @endforeach    
        </tbody>
    </table>
    
    
    
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