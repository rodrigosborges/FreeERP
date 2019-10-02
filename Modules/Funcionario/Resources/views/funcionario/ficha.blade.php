@extends('funcionario::template')
@section('title','Ficha de funcionário')
@section('body')

<button class="imprimir-button btn btn-primary"><i class="material-icons">print </i></button>
<div id="ficha">
    <div class="container">
    <div class="row">
        <div class="col-lg-2 text-center change-class-2">
            <img class="img-fluid" src="{{ URL::to('/') }}/img/user-img.jpg" style="height:150px">
        </div>
        <div class="col-lg-10 change-class-10">
            <div class="row">
                <div class="col">
                    <span class="h2">{{$funcionario->nome}}</span><br><hr class="mt-2">
                    <span><b>Data de Nascimento:</b> {{$funcionario->data_nascimento}}</span><br>
                    <span><b>Sexo:</b> {{$funcionario->sexo == 1 ? 'Masculino' : 'Feminino'}}</span><br> 
                    <span><b>Estado Civil:</b> {{$funcionario->estado_civil->nome}}</span><br>
                    <span><b>Data Admissão:</b> {{$funcionario->data_admissao}}</span><br>
                </div>
            </div>              
        </div>
    </div>
    <hr>
    <h4 class="d-flex align-items-end mb-4"><i class="material-icons mr-2">contact_phone </i> Contatos</h4>
    <div class="row">
        <div class="col-sm">
            <div class="row">
                @foreach($funcionario->telefone as $telefone)    
                    <div class="col">
                        <span class="titulo_cargo">Telefone:</span> {{$telefone->numero}}
                    </div>
                @endforeach
                <div class="col">
                    <span class="titulo_cargo">Email:{{$funcionario->email->email}}</span>
                </div>
            </div>      
        </div>
    </div>
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