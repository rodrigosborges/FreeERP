@extends('funcionario::template')

@section('title','Aviso de Férias')

@section('body')
<button class="imprimir-button btn btn-primary"><i class="material-icons">print </i></button>
<div id="ficha">
    <div class="row d-flex justify-content-center">
    
           <div class="col">
           
             <h4 class="font-weight-bold">Dados do Funcionário</h4>
             <hr>
           </div>           
    </div>

    <div class="row">
        <div class="col-4  d-flex justify-content-start" >
            
              <p class="font-weight-bold">Nome:&nbsp</p>  {{$funcionario}}
            
         </div>

         <div class="col d-flex justify-content-end">
         
         <p class="font-weight-bold">Cargo:&nbsp</p>{{$cargo}}
                 
         </div>
    </div>

    <div class="row mt-2 d-flex justify-content-start">
            <div class="col-5 d-flex justify-content-start" >
                <p class="font-weight-bold">Carteira de Trabalho:&nbsp</p>{{$carteiraTrabalho}}
            </div>
        <div class="col-3 d-flex " >
            <p class="font-weight-bold">Série:&nbsp</p>{{$serieCarteiraTrabalho}}
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h4 class="font-weight-bold mt-2">Aviso</h4>
        <hr>
            <p class="mt-4 ">Comunicamos-lhe na forma do artigo 135/CLT, que suas férias relativas ao período de {{date('d/m/Y', strtotime($inicio_periodo_aquisitivo))}}  a {{date('d/m/Y', strtotime($fim_periodo_aquisitivo))}} 
             se iniciarão no dia  <strong>{{date('d/m/Y', strtotime($ferias->data_inicio))}}</strong> e terminarão no dia <strong>{{{date('d/m/Y', strtotime($ferias->data_fim))}}}</strong>.</p>
        </div>
    </div>

    
    <div class="row-5 d-flex justify-content-between">
        <div class="col-4 mt-5" style="border-top: solid 1px">
            <p>Assinatura do Funcionario</p>
        </div>

        <div class="col-4 mt-5" style="border-top: solid 1px">
            <p>Assinatura da Empresa</p>
        </div>
    </div>
    <hr>  
    </div>  
    @section('footer')
    <div class="text-right">
    <a class="btn btn-success" href="{{url('funcionario/ferias')}}">Voltar</a>
    </div>
@endsection
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
            header: "<h1 class='text-center'>Aviso de Férias<h1><hr><br>",
            // footer: `<span class='text-center bottom-center-absolute titulo_cargo'>${localdate}<span><hr><br>`,
            afterPrint: function(){
                $(".change-class-2").toggleClass("col-lg-2").toggleClass("col-2");
                $(".change-class-10").toggleClass("col-lg-10").toggleClass("col-10");
            }
        });
    })
</script>
@endsection
